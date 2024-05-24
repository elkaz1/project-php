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
            margin-bottom: 20px;
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

            // Load the prediction data
            $prediction_data = json_decode(file_get_contents('prediction.json'), true);
            $actual = $prediction_data['actual'];
            $predicted = $prediction_data['predicted'];
            $dates = $prediction_data['dates'];
            $error = $prediction_data['error'];
            $sma = $prediction_data['SMA'];
            $ema = $prediction_data['EMA'];
            $bollinger_high = $prediction_data['Bollinger_High'];
            $bollinger_low = $prediction_data['Bollinger_Low'];
            #$sentiments = $prediction_data['Sentiments'];
            #$competitor = $prediction_data['Competitor'];
        ?>
        <h2>Prediction Results</h2>

        <!-- Price Chart -->
        <canvas id="priceChart"></canvas>
        <script>
            var ctxPrice = document.getElementById('priceChart').getContext('2d');
            var priceChart = new Chart(ctxPrice, {
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

        <!-- Moving Averages Chart -->
        <canvas id="movingAveragesChart"></canvas>
        <script>
            var ctxMA = document.getElementById('movingAveragesChart').getContext('2d');
            var movingAveragesChart = new Chart(ctxMA, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($dates); ?>,
                    datasets: [
                        {
                            label: '30-day SMA',
                            data: <?php echo json_encode($sma); ?>,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            fill: false
                        },
                        {
                            label: '30-day EMA',
                            data: <?php echo json_encode($ema); ?>,
                            borderColor: 'rgba(255, 159, 64, 1)',
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
        <!-- Bollinger Bands Chart -->
        <canvas id="bollingerBandsChart"></canvas>
        <script>
            var ctxBB = document.getElementById('bollingerBandsChart').getContext('2d');
            var bollingerBandsChart = new Chart(ctxBB, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($dates); ?>,
                    datasets: [
                        {
                            label: 'Bollinger High',
                            data: <?php echo json_encode($bollinger_high); ?>,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            fill: false
                        },
                        {
                            label: 'Bollinger Low',
                            data: <?php echo json_encode($bollinger_low); ?>,
                            borderColor: 'rgba(255, 99, 132, 1)',
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
        <?php
        }
        ?>
    </div>
</body>
</html>
