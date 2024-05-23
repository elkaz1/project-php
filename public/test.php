<!DOCTYPE html>
<html>
<head>
    <title>Tesla Stock Prediction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        .output {
            margin-top: 20px;
        }
        img {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <h1>Tesla Stock Prediction</h1>
    <form action="test.php" method="post">
        <button type="submit">Predict Tesla Stock Prices</button>
    </form>

    <div class="output">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $output = shell_exec('python ../python/test.py 2>&1');
            echo "<pre>$output</pre>";

            // Display the plot
            echo '<h2>Prediction Results</h2>';
            echo '<img src="prediction.png" alt="Stock Prediction">';

            // Display the error and predictions
            $prediction_data = json_decode(file_get_contents('prediction.json'), true);
            echo '<h3>Prediction Error (Mean Squared Error): ' . $prediction_data['error'] . '</h3>';
            echo '<h3>Future Predictions:</h3>';
            echo '<ul>';
            foreach ($prediction_data['predictions'] as $pred) {
                echo '<li>' . $pred . '</li>';
            }
            echo '</ul>';
        }
        ?>
    </div>
</body>
</html>
