<!DOCTYPE html>
<html>
<head>
    <title>Stock Prediction</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
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
        .chart-container {
            position: relative;
        }
        .chart-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
        }
        .chart-controls button {
            margin-bottom: 5px;
        }
        .summary-table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        .summary-table th, .summary-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .summary-table th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Stock Prediction</h1>
    <form action="api.php" method="post">
        <label for="stock_name">Enter a stock symbol:</label>
        <input type="text" id="stock_name" name="stock_name" required>
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

            // Fetch stock data from Financial Modeling Prep API
            $api_key = 'LJWTJvuZeGUQIT4qSimmZhegPSwDMS34';
            $api_url = "https://financialmodelingprep.com/api/v3/historical-price-full/$stock_name?apikey=$api_key";
            $response = file_get_contents($api_url);
            $stock_data = json_decode($response, true);

            if ($stock_data && isset($stock_data['historical'])) {
                // Save the stock data to a JSON file
                file_put_contents('stock_data.json', json_encode($stock_data['historical']));

                // Execute Python script and get output
                $output = shell_exec("python3 api_prediction.py $time_frame $sma_period $ema_period 2>&1");
                echo "<pre>$output</pre>";

                // Load prediction data
                $prediction_data = json_decode(file_get_contents('api_pred.json'), true);
                if ($prediction_data === null) {
                    echo "<p>Error loading prediction data. Please try again.</p>";
                    exit;
                }
                $actual = $prediction_data['actual'];
                $predicted = $prediction_data['predicted'];
                $dates = $prediction_data['dates'];
                $sma = $prediction_data['SMA'];
                $ema = $prediction_data['EMA'];
                $rsi = $prediction_data['RSI'];
                $macd = $prediction_data['MACD'];
                $signal_line = $prediction_data['Signal_Line'];
                $k = $prediction_data['%K'];
                $d = $prediction_data['%D'];

                // Generate buy/sell signal based on RSI
                $rsi_latest = end($rsi);
                $buy_sell_signal = 'Hold';
                if ($rsi_latest < 30) {
                    $buy_sell_signal = 'Buy';
                } elseif ($rsi_latest > 70) {
                    $buy_sell_signal = 'Sell';
                }
        ?>
        <div class="chart-container">
            <canvas id="priceChart"></canvas>
            <div class="chart-controls">
                <button type="button" onclick="zoomIn('priceChart')">Zoom In</button>
                <button type="button" onclick="zoomOut('priceChart')">Zoom Out</button>
                <button type="button" onclick="resetZoom('priceChart')">Reset Zoom</button>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="rsiChart"></canvas>
            <div class="chart-controls">
                <button type="button" onclick="zoomIn('rsiChart')">Zoom In</button>
                <button type="button" onclick="zoomOut('rsiChart')">Zoom Out</button>
                <button type="button" onclick="resetZoom('rsiChart')">Reset Zoom</button>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="smaEmaChart"></canvas>
            <div class="chart-controls">
                <button type="button" onclick="zoomIn('smaEmaChart')">Zoom In</button>
                <button type="button" onclick="zoomOut('smaEmaChart')">Zoom Out</button>
                <button type="button" onclick="resetZoom('smaEmaChart')">Reset Zoom</button>
            </div>
        </div>

        <table class="summary-table">
            <tr>
                <th>Metric</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Latest Predicted Price</td>
                <td><?php echo end($predicted); ?></td>
            </tr>
            <tr>
                <td>SMA (<?php echo $sma_period; ?> days)</td>
                <td><?php echo end($sma); ?></td>
            </tr>
            <tr>
                <td>EMA (<?php echo $ema_period; ?> days)</td>
                <td><?php echo end($ema); ?></td>
            </tr>
            <tr>
                <td>RSI</td>
                <td><?php echo $rsi_latest; ?></td>
            </tr>
            <tr>
                <td>MACD</td>
                <td><?php echo end($macd); ?></td>
            </tr>
            <tr>
                <td>Signal Line</td>
                <td><?php echo end($signal_line); ?></td>
            </tr>
            <tr>
                <td>Buy/Sell Signal</td>
                <td><?php echo $buy_sell_signal; ?></td>
            </tr>
        </table>

        <script>
            var zoomOptions = {
                pan: {
                    enabled: true,
                    mode: 'x',
                },
                zoom: {
                    enabled: true,
                    mode: 'x',
                    drag: true,
                    wheel: {
                        enabled: true
                    }
                }
            };

            function createChart(ctx, labels, datasets) {
                return new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: datasets
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
                        },
                        plugins: {
                            zoom: zoomOptions
                        }
                    }
                });
            }

            var priceCtx = document.getElementById('priceChart').getContext('2d');
            var rsiCtx = document.getElementById('rsiChart').getContext('2d');
            var smaEmaCtx = document.getElementById('smaEmaChart').getContext('2d');

            var priceChart = createChart(priceCtx, <?php echo json_encode($dates); ?>, [
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
            ]);

            var rsiChart = createChart(rsiCtx, <?php echo json_encode($dates); ?>, [
                {
                    label: 'RSI',
                    data: <?php echo json_encode                    ($rsi); ?>,
                    borderColor: 'rgba(255, 159, 64, 1)',
                    fill: false
                }
            ]);

            var smaEmaChart = createChart(smaEmaCtx, <?php echo json_encode($dates); ?>, [
                {
                    label: 'SMA',
                    data: <?php echo json_encode($sma); ?>,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    fill: false
                },
                {
                    label: 'EMA',
                    data: <?php echo json_encode($ema); ?>,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    fill: false
                }
            ]);

            function zoomIn(chartId) {
                window[chartId].zoom(1.1);
            }

            function zoomOut(chartId) {
                window[chartId].zoom(0.9);
            }

            function resetZoom(chartId) {
                window[chartId].resetZoom();
            }
        </script>
        <?php
            } else {
                echo "<p>Error fetching stock data. Please check the stock symbol and try again.</p>";
            }
        }
        ?>
    </div>
</body>
</html>

