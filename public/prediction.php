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
        
        /* New spinner styles */
.spinner {
    display: none;
    position: absolute;
    width: 9px;
    height: 9px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.spinner div {
    position: absolute;
    width: 50%;
    height: 150%;
    background: #000000;
    transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1%));
    animation: spinner-fzua35 1s calc(var(--delay) * 1s) infinite ease;
}

.spinner div:nth-child(1) {
    --delay: 0.1;
    --rotation: 36;
    --translation: 150;
}

.spinner div:nth-child(2) {
    --delay: 0.2;
    --rotation: 72;
    --translation: 150;
}

.spinner div:nth-child(3) {
    --delay: 0.3;
    --rotation: 108;
    --translation: 150;
}

.spinner div:nth-child(4) {
    --delay: 0.4;
    --rotation: 144;
    --translation: 150;
}

.spinner div:nth-child(5) {
    --delay: 0.5;
    --rotation: 180;
    --translation: 150;
}

.spinner div:nth-child(6) {
    --delay: 0.6;
    --rotation: 216;
    --translation: 150;
}

.spinner div:nth-child(7) {
    --delay: 0.7;
    --rotation: 252;
    --translation: 150;
}

.spinner div:nth-child(8) {
    --delay: 0.8;
    --rotation: 288;
    --translation: 150;
}

.spinner div:nth-child(9) {
    --delay: 0.9;
    --rotation: 324;
    --translation: 150;
}

.spinner div:nth-child(10) {
    --delay: 1;
    --rotation: 360;
    --translation: 150;
}

@keyframes spinner-fzua35 {
    0%, 10%, 20%, 30%, 50%, 60%, 70%, 80%, 90%, 100% {
        transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1%));
    }

    50% {
        transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1.5%));
    }
}

@-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Overlay styles */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

    </style>
<script>
    window.onload = function() {
        // Get the value from localStorage
        var value = localStorage.getItem('Csymbol');
        console.log(value);
        // Display the value on the page
        document.getElementById('name').value = value
    };
    function showLoader() {
        document.getElementById("loader").style.display = "block";
        document.getElementById("overlay").style.display = "block";
        document.querySelector(".spinner").style.display = "block";
    }

    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form");
        const loader = document.getElementById("loader");
        const overlay = document.getElementById("overlay");
        const spinner = document.querySelector(".spinner");

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
            loader.style.display = "none";
            overlay.style.display = "none";
            spinner.style.display = "none";
        <?php endif; ?>
    });
</script>


</head>

<body>
    <?php include 'navigation.php'; ?>
    <div class="mx-10">

    <div class="overlay" id="overlay">
        <div class="loader" id="loader"></div>
        <div class="spinner">
  <div></div>   
  <div></div>    
  <div></div>    
  <div></div>    
  <div></div>    
  <div></div>    
  <div></div>    
  <div></div>    
  <div></div>    
  <div></div>    
</div>
    </div>



        <div class="m-5 sm:m-10">

            <div class="flex flex-col">
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-lg">
                    <form action="prediction.php" method="post" onsubmit="showLoader()">
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
            // summary table for the prediction
            if (!empty($predicted) && !empty($sma) && !empty($ema) && isset($rsi_latest) && !empty($macd) && !empty($signal_line) && isset($buy_sell_signal)) {
                echo '<table class="summary-table border-collapse w-full mt-8">';
                echo '<thead>';
                echo '<tr class="bg-gray-200">';
                echo '<th class="border border-gray-400 px-4 py-2 text-left">Metric</th>';
                echo '<th class="border border-gray-400 px-4 py-2 text-left">Value</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>';
                echo '<td class="border border-gray-400 px-4 py-2">Latest Predicted Price</td>';
                echo '<td class="border border-gray-400 px-4 py-2">' . end($predicted) . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td class="border border-gray-400 px-4 py-2">SMA (' . htmlspecialchars($sma_period) . ' days)</td>';
                echo '<td class="border border-gray-400 px-4 py-2">' . end($sma) . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td class="border border-gray-400 px-4 py-2">EMA (' . htmlspecialchars($ema_period) . ' days)</td>';
                echo '<td class="border border-gray-400 px-4 py-2">' . end($ema) . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td class="border border-gray-400 px-4 py-2">RSI</td>';
                echo '<td class="border border-gray-400 px-4 py-2">' . htmlspecialchars($rsi_latest) . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td class="border border-gray-400 px-4 py-2">MACD</td>';
                echo '<td class="border border-gray-400 px-4 py-2">' . end($macd) . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td class="border border-gray-400 px-4 py-2">Signal Line</td>';
                echo '<td class="border border-gray-400 px-4 py-2">' . end($signal_line) . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td class="border border-gray-400 px-4 py-2">Buy/Sell Signal</td>';
                echo '<td class="border border-gray-400 px-4 py-2">' . htmlspecialchars($buy_sell_signal) . '</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
            }
            
            ?>
            
            

        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>