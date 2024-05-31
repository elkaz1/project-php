import sys
import json
import pandas as pd
import numpy as np
from sklearn.linear_model import LinearRegression

def calculate_sma(data, period):
    return data.rolling(window=period).mean()

def calculate_ema(data, period):
    return data.ewm(span=period, adjust=False).mean()

def calculate_rsi(data, period=14):
    delta = data.diff()
    gain = (delta.where(delta > 0, 0)).fillna(0)
    loss = (-delta.where(delta < 0, 0)).fillna(0)
    avg_gain = gain.rolling(window=period).mean()
    avg_loss = loss.rolling(window=period).mean()
    rs = avg_gain / avg_loss
    return 100 - (100 / (1 + rs))

def calculate_macd(data, short_period=12, long_period=26, signal_period=9):
    short_ema = calculate_ema(data, short_period)
    long_ema = calculate_ema(data, long_period)
    macd = short_ema - long_ema
    signal_line = calculate_ema(macd, signal_period)
    return macd, signal_line

# Get parameters from command line arguments
try:
    time_frame = int(sys.argv[1])
    sma_period = int(sys.argv[2])
    ema_period = int(sys.argv[3])
except IndexError:
    print("Error: Missing required arguments.")
    sys.exit(1)
except ValueError:
    print("Error: Invalid argument type.")
    sys.exit(1)

# Load stock data
try:
    with open('stock_data.json', 'r') as file:
        stock_data = json.load(file)
except FileNotFoundError:
    print("Error: stock_data.json file not found.")
    sys.exit(1)
except json.JSONDecodeError:
    print("Error: JSON decoding error.")
    sys.exit(1)

df = pd.DataFrame(stock_data)
df['date'] = pd.to_datetime(df['date'])
df.set_index('date', inplace=True)
df.sort_index(inplace=True)

# Calculate indicators
df['SMA'] = calculate_sma(df['close'], sma_period)
df['EMA'] = calculate_ema(df['close'], ema_period)
df['RSI'] = calculate_rsi(df['close'])
df['MACD'], df['Signal_Line'] = calculate_macd(df['close'])

# Prepare data for prediction
X = np.arange(len(df)).reshape(-1, 1)
y = df['close'].values

# Train the model
model = LinearRegression()
model.fit(X, y)

# Make predictions
future_X = np.arange(len(df), len(df) + time_frame).reshape(-1, 1)
predicted_prices = model.predict(future_X)

# Save the results
result = {
    'dates': df.index.strftime('%Y-%m-%d').tolist() + pd.date_range(df.index[-1], periods=time_frame + 1, closed='right').strftime('%Y-%m-%d').tolist(),
    'actual': df['close'].tolist(),
    'predicted': [None] * len(df['close']) + predicted_prices.tolist(),
    'SMA': df['SMA'].tolist(),
    'EMA': df['EMA'].tolist(),
    'RSI': df['RSI'].tolist(),
    'MACD': df['MACD'].tolist(),
    'Signal_Line': df['Signal_Line'].tolist(),
    '%K': df['RSI'].tolist(),  # Placeholder for Stochastic %K
    '%D': df['RSI'].tolist()   # Placeholder for Stochastic %D
}

try:
    with open('api_pred.json', 'w') as file:
        json.dump(result, file)
    print("Prediction data saved successfully.")
except IOError:
    print("Error: Unable to write to prediction.json file.")
    sys.exit(1)
