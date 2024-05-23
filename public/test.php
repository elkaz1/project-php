<!DOCTYPE html>
<html>
<head>
    <title>Tesla Stock Prediction</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        canvas {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <h1>Tesla Stock Prediction</h1>
    <form action="index.php" method="post">
        <button type="submit">Predict Tesla Stock Prices</button>
    </form>

    <div class="output">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $output = shell_exec('python ../python/test.py 2>&1');
            echo "<pre>$output</pre>";

            // Load the prediction data
            $prediction_data = json_decode(file_get_contents('prediction.json'), true);
            $actual = $prediction_data['actual'];
            $predicted = $prediction_data['predicted'];
            $dates = $prediction_data['dates'];
            $error = $prediction_data['error'];
        ?>
        <h2>Prediction Results</h2>
        <canvas id="stockChart"></canvas>
        <script>
            var ctx = document.getElementById('stockChart').getContext('2d');
            var stockChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($dates); ?>,
                    datasets: [
                        {
                            label: 'Actual Prices',
                            data: <?php echo json_encode($actual); ?>,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            fill: false
                        },
                        {
                            label: 'Predicted Prices',
                            data: <?php echo json_encode(array_merge(array_fill(0, count($actual) - count($predicted), null), $predicted)); ?>,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderDash: [5, 5],
                            fill: false
                        }
                    ]
                },
                options: {
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Price'
                            }
                        }
                    }
                }
            });
        </script>
        <h3>Prediction Error (Mean Squared Error): <?php echo $error; ?></h3>
        <?php
        }
        ?>
    </div>
</body>
</html>
