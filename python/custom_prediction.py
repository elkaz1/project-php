import sys
import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_squared_error
import json
from textblob import TextBlob
import requests

# Get user inputs
stock_name = sys.argv[1]
time_frame = int(sys.argv[2])
sma_period = int(sys.argv[3])
ema_period = int(sys.argv[4])

# Load data
data = pd.read_csv(f'../data/{stock_name}.csv')

# Prepare data
data['Date'] = pd.to_datetime(data['Date'])
data.set_index('Date', inplace=True)
data.sort_index(inplace=True)

# Use only the closing prices for prediction
data['Price'] = data['Close']
data = data[['Price']]

# Create features and labels
data['Prediction'] = data['Price'].shift(-time_frame)
X = np.array(data.drop(['Prediction'], axis=1))[:-time_frame]
y = np.array(data['Prediction'])[:-time_frame]

# Split the data
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2)

# Train the model
model = LinearRegression()
model.fit(X_train, y_train)

# Make predictions
predictions = model.predict(X_test)

# Calculate error
error = mean_squared_error(y_test, predictions)

# Future predictions
future_X = np.array(data.drop(['Prediction'], axis=1))[-time_frame:]
future_predictions = model.predict(future_X)

# Calculate Moving Averages
data['SMA'] = data['Price'].rolling(window=30, min_periods=1).mean()
data['EMA'] = data['Price'].ewm(span=30, adjust=False).mean()

# Calculate Bollinger Bands


# Calculate RSI
def calculate_rsi(data, window):
    delta = data['Price'].diff(1)
    gain = (delta.where(delta > 0, 0)).rolling(window=window).mean()
    loss = (-delta.where(delta < 0, 0)).rolling(window=window).mean()
    rs = gain / loss
    rsi = 100 - (100 / (1 + rs))
    return rsi

data['RSI'] = calculate_rsi(data, 14)
data['RSI'].fillna(50, inplace=True)  # Fill NaN values with 50, indicating a neutral RSI

# Calculate MACD
def calculate_macd(data, short_window=12, long_window=26, signal_window=9):
    data['ShortEMA'] = data['Price'].ewm(span=short_window, adjust=False).mean()
    data['LongEMA'] = data['Price'].ewm(span=long_window, adjust=False).mean()
    data['MACD'] = data['ShortEMA'] - data['LongEMA']
    data['Signal Line'] = data['MACD'].ewm(span=signal_window, adjust=False).mean()
    return data

data = calculate_macd(data)

# Calculate Stochastic Oscillator
def calculate_stochastic_oscillator(data, window=14):
    data['L14'] = data['Price'].rolling(window=window).min()
    data['H14'] = data['Price'].rolling(window=window).max()
    data['%K'] = (data['Price'] - data['L14']) * 100 / (data['H14'] - data['L14'])
    data['%D'] = data['%K'].rolling(window=3).mean()
    return data

data = calculate_stochastic_oscillator(data)

# Handle NaN values
data['%K'].bfill(inplace=True)
data['%D'].bfill(inplace=True)

# calculate the volume 


# Prepare data for JSON output
output_data = {
    'actual': data['Price'].tolist(),
    'predicted': future_predictions.tolist(),
    'dates': data.index.astype(str).tolist(),
    'error': error,
    'SMA': data['SMA'].tolist(),
    'EMA': data['EMA'].tolist(),
    #'Bollinger_High': data['Bollinger_High'].tolist(),
    #'Bollinger_Low': data['Bollinger_Low'].tolist(),
    'RSI': data['RSI'].tolist(),
    'MACD': data['MACD'].tolist(),
    'Signal_Line': data['Signal Line'].tolist(),
    '%K': data['%K'].tolist(),
    '%D': data['%D'].tolist()
}

# Save output to JSON file
with open('../public/custom_prediction.json', 'w') as f:
    json.dump(output_data, f)

print("Prediction completed and saved.")
