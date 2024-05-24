import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_squared_error
import json
#from textblob import TextBlob  # Import for sentiment analysis if needed
import requests

# Load data
data = pd.read_csv('../data/tesla_stock_data.csv')

# Prepare data
data['Date'] = pd.to_datetime(data['Date'])
data.set_index('Date', inplace=True)
data.sort_index(inplace=True)

# Use only the closing prices for prediction
data['Price'] = data['Close']
data = data[['Price']]

# Create features and labels
data['Prediction'] = data['Price'].shift(-30)
X = np.array(data.drop(['Prediction'], axis=1))[:-30]
y = np.array(data['Prediction'])[:-30]

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
future_X = np.array(data.drop(['Prediction'], axis=1))[-30:]
future_predictions = model.predict(future_X)

# Calculate Moving Averages
data['SMA'] = data['Price'].rolling(window=30, min_periods=1).mean()
data['EMA'] = data['Price'].ewm(span=30, adjust=False).mean()

# Calculate Bollinger Bands
data['SMA'] = data['Price'].rolling(window=30, min_periods=1).mean()
data['STD'] = data['Price'].rolling(window=30, min_periods=1).std()
data['Bollinger High'] = data['SMA'] + (data['STD'] * 2)
data['Bollinger Low'] = data['SMA'] - (data['STD'] * 2)

# Fill NaN values in Bollinger Bands
data['Bollinger High'].bfill(inplace=True)
data['Bollinger Low'].bfill(inplace=True)
"""
# Fetch recent news articles and perform sentiment analysis
news_api_key = 'YOUR_NEWS_API_KEY'  # Replace with your News API key
news_url = f'https://newsapi.org/v2/everything?q=Tesla&apiKey={news_api_key}'
news_response = requests.get(news_url)
news_data = news_response.json()

sentiments = []
for article in news_data['articles']:
    analysis = TextBlob(article['description'])
    sentiments.append(analysis.sentiment.polarity)

# Load competitor data
competitor_data = pd.read_csv('../data/competitor_stock_data.csv')
competitor_data['Date'] = pd.to_datetime(competitor_data['Date'])
competitor_data.set_index('Date', inplace=True)
competitor_data.sort_index(inplace=True)
"""
# Prepare data for JSON output
output_data = {
    'actual': data['Price'].tolist(),
    'predicted': future_predictions.tolist(),
    'dates': data.index.astype(str).tolist(),
    'error': error,
    'SMA': data['SMA'].tolist(),
    'EMA': data['EMA'].tolist(),
    'Bollinger_High': data['Bollinger High'].tolist(),
    'Bollinger_Low': data['Bollinger Low'].tolist(),
    #'Sentiments': sentiments,
    #'Competitor': competitor_data['Close'].tolist()
}

# Save output to JSON file
with open('../public/prediction.json', 'w') as f:
    json.dump(output_data, f)

print("Prediction completed and saved.")
