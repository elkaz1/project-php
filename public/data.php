<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="api.php" method="post">
        <label for="stockName">Select a Stock:</label>
        <select id="stockName" name="stockName">
            <option value="TESLA">Tesla</option>
            <option value="AAPL">Apple</option>
            <option value="GOOGL">Google</option>
            <!-- Add more options as needed -->
        </select>
        <br><br>
        <a href="./api.php"><button type="submit">Predict Stock Prices</button></a>
    </form>
</body>
</html>