<!DOCTYPE html>
<html>
<head>
    <title>Stock Prediction</title>
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
    <h1>Stock Prediction</h1>
    <form action="custom_prediction.php" method="post">
        <label for="stock_name">Choose a stock:</label>
        <select id="stock_name" name="stock_name" required>
            <option value="tesla_stock_data">Tesla</option>
            <option value="apple">Apple</option>
            <option value="google">Google</option>
            <!-- Add more options as needed -->
        </select>
        
        <label for="time_frame">Prediction Time Frame (days):</label>
        <input type="number" id="time_frame" name="time_frame" value="30" required>
        <label for="sma_period">SMA Period (days):</label>
        <input type="number" id="sma_period" name="sma_period" value="30" required>
        <label for="ema_period">EMA Period (days):</label>
        <input type="number" id="ema_period" name="ema_period" value="30" required>
        <button type="submit">Predict Stock Prices</button>
    </form>

    <div class="output">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stock_name = $_POST['stock_name'];
            $time_frame = $_POST['time_frame'];
            $sma_period = $_POST['sma_period'];
            $ema_period = $_POST['ema_period'];

            // Pass user inputs to the Python script
            $output = shell_exec("python ../python/custom_prediction.py $stock_name $time_frame $sma_period $ema_period 2>&1");
            echo "<pre>$output</pre>";

            // Load the prediction data
            $prediction_data = json_decode(file_get_contents('custom_prediction.json'), true);
            $actual = $prediction_data['actual'];
            $predicted = $prediction_data['predicted'];
            $dates = $prediction_data['dates'];
            $error = $prediction_data['error'];
            $sma = $prediction_data['SMA'];
            $ema = $prediction_data['EMA'];
            $rsi = $prediction_data['RSI'];
            $macd = $prediction_data['MACD'];
            $signal_line = $prediction_data['Signal_Line'];
            $k = $prediction_data['%K'];
            $d = $prediction_data['%D'];
            $rsi_latest = end($rsi);
            $buy_sell_signal = 'Hold';
            if ($rsi_latest < 30) {
                $buy_sell_signal = 'Buy';
            } elseif ($rsi_latest > 70) {
                $buy_sell_signal = 'Sell';
            }
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

        <!-- RSI Chart -->
        <canvas id="rsiChart"></canvas>
        <script>
            var ctxRSI = document.getElementById('rsiChart').getContext('2d');
            var rsiChart = new Chart(ctxRSI, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($dates); ?>,
                    datasets: [
                        {
                            label: 'RSI',
                            data: <?php echo json_encode($rsi); ?>,
                            borderColor: 'rgba(153, 102, 255, 1)',
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
                                text: 'RSI'
                            }
                        }
                    }
                }
            });
        </script>

        <!-- SMA and EMA Chart -->
        <canvas id="smaEmaChart"></canvas>
        <script>
            var ctxSmaEma = document.getElementById('smaEmaChart').getContext('2d');
            var smaEmaChart = new Chart(ctxSmaEma, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($dates); ?>,
                    datasets: [
                        {
                            label: 'SMA',
                            data: <?php echo json_encode($sma); ?>,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            fill: false
                        },
                        {
                            label: 'EMA',
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
                                text: 'Value'
                            }
                        }
                    }
                }
            });
        </script>
        <canvas id="macdChart"></canvas>
        <script>
            var ctxMACD = document.getElementById('macdChart').getContext('2d');
            var macdChart = new Chart(ctxMACD, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($dates); ?>,
                    datasets: [
                        {
                            label: 'MACD',
                            data: <?php echo json_encode($macd); ?>,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            fill: false
                        },
                        {
                            label: 'Signal Line',
                            data: <?php echo json_encode($signal_line); ?>,
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
                                text: 'Value'
                            }
                        }
                    }
                }
            });
        </script>
        <canvas id="stochChart"></canvas>
        <script>
            var ctxStoch = document.getElementById('stochChart').getContext('2d');
            var stochChart = new Chart(ctxStoch, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($dates); ?>,
                    datasets: [
                        {
                            label: '%K',
                            data: <?php echo json_encode($k); ?>,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            fill: false
                        },
                        {
                            label: '%D',
                            data: <?php echo json_encode($d); ?>,
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
                                text: 'Value'
                            }
                        }
                    }
                }
            });
            <!-- Buy/Sell Signal -->
            var buySellSignal = document.createElement('p');
            buySellSignal.innerHTML = 'Buy/Sell Signal: <?php echo $buy_sell_signal; ?>';
            document.querySelector('.output').appendChild(buySellSignal);

            
        </script>


        <?php
        }
        ?>
    </div>
</body>
</html>
