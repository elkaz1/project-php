import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_squared_error
import json

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

# Prepare data for JSON output
output_data = {
    'actual': data['Price'].tolist(),
    'predicted': future_predictions.tolist(),
    'dates': data.index.astype(str).tolist(),
    'error': error
}

# Save output to JSON file
with open('../public/prediction.json', 'w') as f:
    json.dump(output_data, f)

print("Prediction completed and saved.")
