<!DOCTYPE html>
<html>

<head>
    <title>Stock Prediction</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/stock.js"></script>
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
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="mx-10">

        <form action="api.php" method="post" class="max-w-md mx-auto my-4 p-4 bg-gray-100 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="stock_name" class="block text-gray-700 font-bold mb-2">Enter a stock symbol:</label>
                <input type="text" id="stock_name" name="stock_name" required
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="time_frame" class="block text-gray-700 font-bold mb-2">Prediction Time Frame (days):</label>
                <input type="number" id="time_frame" name="time_frame" value="30" required
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="sma_period" class="block text-gray-700 font-bold mb-2">SMA Period (days):</label>
                <input type="number" id="sma_period" name="sma_period" value="30" required
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="ema_period" class="block text-gray-700 font-bold mb-2">EMA Period (days):</label>
                <input type="number" id="ema_period" name="ema_period" value="30" required
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="text-center">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Predict Stock Prices
                </button>
            </div>
        </form>
        -->

        <div class="m-5 sm:m-10">

            <div class="flex flex-col">
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-lg">
                    <form action="api.php" method="post">
                        <div class="relative mb-10 w-full flex  items-center justify-between rounded-md">
                            <svg class="absolute left-2 block h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" class=""></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65" class=""></line>
                            </svg>
                            <input type="name" name="search"
                                class="h-12 w-full cursor-text rounded-md border border-gray-100 bg-gray-100 py-4 pr-40 pl-12 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="Search by name, type, manufacturer, etc" />
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                            <div class="flex flex-col">
                                <label for="name" class="text-sm font-medium text-stone-600">Stock name</label>
                                <input type="text" id="name" name="stock_name" placeholder="Enter the stock name"
                                    class="mt-2 block w-full rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                            </div>

                            <div class="flex flex-col">
                                <label for="time_frame" class="text-sm font-medium text-stone-600">Time Frame (In Days)
                                </label>
                                <input type="number" id="time_frame" name="time_frame" value="30"
                                    class="mt-2 block w-full rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                            </div>

                            <div class="flex flex-col">
                                <label for="sma_period" class="text-sm font-medium text-stone-600">SMA (In Days)</label>
                                <input type="number" id="sma_period" name="sma_period" value="30"
                                    class="mt-2 block w-full cursor-pointer rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                            </div>

                            <div class="flex flex-col">
                                <label for="ema_period" class="text-sm font-medium text-stone-600">EMA (In Days)</label>
                                <input type="number" id="ema_period" name="ema_period" value="30"
                                    class="mt-2 block w-full cursor-pointer rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                            </div>
                        </div>

                        <div class="mt-6 grid w-full grid-cols-2 justify-end space-x-4 md:flex">
                            <button type="submit"
                                class="rounded-lg bg-blue-600 px-8 py-2 font-medium text-white outline-none hover:opacity-80 focus:ring">Search</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>





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
                    $output = shell_exec("python ../python/api_prediction.py $time_frame $sma_period $ema_period 2>&1");
                    echo "<pre>$output</pre>";

                    // Check if the prediction file exists
                    if (file_exists('api_pred.json')) {
                        // Load prediction data
                        $prediction_data = json_decode(file_get_contents('api_pred.json'), true);
                        if ($prediction_data === null) {
                            echo "<p>Error loading prediction data. Please try again.</p>";
                            exit;
                        }
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

                    <h1>Stock Prediction for <?= htmlspecialchars($stock_name) ?></h1>
                    <div id="priceChart" style="height: 600px; min-width: 310px"></div>
                    <div id="rsiChart" style="height: 500px; min-width: 310px"></div>
                    <div id="stochasticChart" style="height: 500px; min-width: 310px"></div>

                    <script>
                        // Convert PHP arrays to JavaScript arrays
                        const actualPrices = <?= json_encode($actual) ?>;
                        const predictedPrices = <?= json_encode($predicted) ?>;
                        const dates = <?= json_encode($dates) ?>;
                        const sma = <?= json_encode($sma) ?>;
                        const ema = <?= json_encode($ema) ?>;
                        const rsi = <?= json_encode($rsi) ?>;
                        const k = <?= json_encode($k) ?>;
                        const d = <?= json_encode($d) ?>;

                        // Prepare the data for Highcharts
                        const actualData = dates.map((date, index) => [new Date(date).getTime(), actualPrices[index]]);
                        const predictedData = dates.map((date, index) => [new Date(date).getTime(), predictedPrices[index]]);
                        const smaData = dates.map((date, index) => [new Date(date).getTime(), sma[index]]);
                        const emaData = dates.map((date, index) => [new Date(date).getTime(), ema[index]]);
                        const rsiData = dates.map((date, index) => [new Date(date).getTime(), rsi[index]]);
                        const kData = dates.map((date, index) => [new Date(date).getTime(), k[index]]);
                        const dData = dates.map((date, index) => [new Date(date).getTime(), d[index]]);

                        // Create stock chart
                        Highcharts.stockChart('priceChart', {
                            rangeSelector: {
                                selected: 1
                            },
                            title: {
                                text: 'Stock Prices'
                            },
                            series: [{
                                name: 'Actual Prices',
                                data: actualData,
                                tooltip: {
                                    valueDecimals: 2
                                }
                            }, {
                                name: 'Predicted Prices',
                                data: predictedData,
                                tooltip: {
                                    valueDecimals: 2
                                }
                            }, {
                                name: 'SMA',
                                data: smaData,
                                tooltip: {
                                    valueDecimals: 2
                                }
                            }, {
                                name: 'EMA',
                                data: emaData,
                                tooltip: {
                                    valueDecimals: 2
                                }
                            }]
                        });

                        // Create RSI chart
                        Highcharts.chart('rsiChart', {
                            chart: {
                                type: 'line'
                            },
                            title: {
                                text: 'RSI'
                            },
                            xAxis: {
                                type: 'datetime'
                            },
                            yAxis: {
                                title: {
                                    text: 'RSI'
                                }
                            },
                            series: [{
                                name: 'RSI',
                                data: rsiData
                            }]
                        });

                        // Create Stochastic chart
                        Highcharts.chart('stochasticChart', {
                            chart: {
                                type: 'line'
                            },
                            title: {
                                text: 'Stochastic Oscillator'
                            },
                            xAxis: {
                                type: 'datetime'
                            },
                            yAxis: {
                                title: {
                                    text: 'Percentage'
                                }
                            },
                            series: [{
                                name: '%K',
                                data: kData
                            }, {
                                name: '%D',
                                data: dData
                            }]
                        });
                    </script>

                    <?php
                } else {
                    echo "<p>Error fetching stock data. Please check the stock symbol and try again.</p>";
                }
            }
            ?>
            <table class="summary-table border-collapse w-full mt-8">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-400 px-4 py-2 text-left">Metric</th>
                        <th class="border border-gray-400 px-4 py-2 text-left">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">Latest Predicted Price</td>
                        <td class="border border-gray-400 px-4 py-2"><?php echo end($predicted); ?></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">SMA (<?php echo $sma_period; ?> days)</td>
                        <td class="border border-gray-400 px-4 py-2"><?php echo end($sma); ?></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">EMA (<?php echo $ema_period; ?> days)</td>
                        <td class="border border-gray-400 px-4 py-2"><?php echo end($ema); ?></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">RSI</td>
                        <td class="border border-gray-400 px-4 py-2"><?php echo $rsi_latest; ?></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">MACD</td>
                        <td class="border border-gray-400 px-4 py-2"><?php echo end($macd); ?></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">Signal Line</td>
                        <td class="border border-gray-400 px-4 py-2"><?php echo end($signal_line); ?></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">Buy/Sell Signal</td>
                        <td class="border border-gray-400 px-4 py-2"><?php echo $buy_sell_signal; ?></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>