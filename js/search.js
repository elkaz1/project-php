

    // Your code that interacts with the DOM, including getElementById
    async function fetchStocks(){
        const searchInput = document.getElementById('searchInput');
        if (!searchInput) {
            console.error("Element with ID 'searchInput' not found.");
            return;
        }
        const query = searchInput.value.trim();

        if (query === '') {
            // Optionally handle empty query case
            return;
        }

        try {
            const response = await fetch(`testapi.php?query=${query}`);
            const stocks = await response.json();
            console.log(stocks);  // Add this line to check the response
            
            displayResults(stocks);
        } catch (error) {
            console.error('Error fetching stocks:', error);
            // Optionally, handle the error or show a message to the user
        }
    }

    // Attach event listener or other actions as needed



        function displayResults(stocks) {
          const resultsDiv = document.getElementById('results');
            resultsDiv.innerHTML = '';
            stocks.forEach(stock => {
                const stockLink = document.createElement('a');
                stockLink.classList.add('flex', 'items-center', 'gap-4', 'px-4', 'py-3', 'hover:bg-gray-100/50', 'transition', 'shadow-lg');
                stockLink.href = '#';
                stockLink.onclick = () => showPreview(stock);

                const stockInfo = document.createElement('div');
                stockInfo.classList.add('flex-1');
                stockInfo.innerHTML = `<div class="font-medium text-gray-900">${stock.name}</div>
                                       <div class="text-sm text-gray-500">${stock.symbol}</div>`;

                const stockPrice = document.createElement('div');
                stockPrice.classList.add('font-medium', 'text-gray-900');
                stockPrice.textContent = `${stock.exchangeShortName}`;

                stockLink.appendChild(stockInfo);
                stockLink.appendChild(stockPrice);
                resultsDiv.appendChild(stockLink); 
            });
        }
        async function showPreview(stock) {
    const query = stock.symbol;
    try {
        const response = await fetch(`stockdetails.php?query=${query}`);
        const details = await response.json();
        console.log(details);  // Add this line to check the response

        // Reference the preview div here
        const previewDiv = document.getElementById('Preview');
        if (!previewDiv) {
            console.error('Preview div not found');
            return;
        }
        // Ensure details is an array and access the first item
        if (details && details.length > 0) {
            const stockDetails = details[0];

            // Limit decimals to 5
            stockDetails.price = stockDetails.price !== null && stockDetails.price !== undefined ? parseFloat(stockDetails.price.toFixed(5)) : null;
            stockDetails.marketCap = stockDetails.marketCap !== null && stockDetails.marketCap !== undefined ? parseFloat(stockDetails.marketCap.toFixed(5)) : null;
            stockDetails.dayHigh = stockDetails.dayHigh !== null && stockDetails.dayHigh !== undefined ? parseFloat(stockDetails.dayHigh.toFixed(5)) : null;
            stockDetails.dayLow = stockDetails.dayLow !== null && stockDetails.dayLow !== undefined ? parseFloat(stockDetails.dayLow.toFixed(5)) : null;
            stockDetails.open = stockDetails.open !== null && stockDetails.open !== undefined ? parseFloat(stockDetails.open.toFixed(5)) : null;
            stockDetails.previousClose = stockDetails.previousClose !== null && stockDetails.previousClose !== undefined ? parseFloat(stockDetails.previousClose.toFixed(5)) : null;
            stockDetails.eps = stockDetails.eps !== null && stockDetails.eps !== undefined ? parseFloat(stockDetails.eps.toFixed(5)) : null;
            stockDetails.pe = stockDetails.pe !== null && stockDetails.pe !== undefined ? parseFloat(stockDetails.pe.toFixed(5)) : null;

            // Create and populate the HTML structure
            const content = `
    <div class="p-6 space-y-6" id="Preview">
         <div>
            <div id="previewName" class="text-2xl font-bold text-gray-900">${stockDetails.name}</div>
            <div id="previewSymbol" class="text-sm text-gray-500">${stockDetails.symbol}</div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <div class="text-sm text-gray-500 mb-1">Current Price</div>
                <div class="text-xl font-bold text-gray-900">$${stockDetails.price}</div>
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-500 mb-1">Market Cap</div>
                <div class="text-xl font-bold text-gray-900">${stockDetails.marketCap}</div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <div class="text-sm text-gray-500 mb-1">Day High</div>
                <div class="text-xl font-bold text-gray-900">$${stockDetails.dayHigh}</div>
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-500 mb-1">Day Low</div>
                <div class="text-xl font-bold text-gray-900">$${stockDetails.dayLow}</div>
            </div>
        </div>
        <div class="w-full h-full">
            <div class="relative">
                <div class="max-w-sm w-full bg-white rounded-lg shadow">
                    <div class="flex justify-between p-4 md:p-6 pb-0">
                        <div>
                            <h5 id="sales-amount" class="leading-none text-3xl font-bold text-gray-900 pb-2">$00,00</h5>
                            <p class="text-base font-normal text-gray-500">Current Price</p>
                        </div>
                        <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 text-center">
                            <span id="percentage">0%</span>
                            <span id="arrow" class="w-3 h-3 ms-1" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div id="labels-chart" class="px-2.5" style="height: 350px;"></div>
                    <div class="grid grid-cols-1 items-center border-gray-200 border-t justify-between mt-5 p-4 md:p-6 pt-0">
                        <div class="flex justify-between items-center pt-5">
                        <button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 shadow-purple-800/80 shadow-lg">Predict Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
        <div class="text-sm text-gray-500 mb-1">Key Financials</div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <div class="text-sm text-gray-500">Open</div>
                    <div class="text-xl font-bold text-gray-900">${stockDetails.open}</div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-500">Previous Close</div>
                    <div class="text-xl font-bold text-gray-900">${stockDetails.previousClose}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">EPS</div>
                    <div class="text-xl font-bold text-gray-900">${stockDetails.eps}</div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-500">P/E Ratio</div>
                    <div class="text-xl font-bold text-gray-900">${stockDetails.pe}</div>
                </div>
            </div>
    </div>`;


            // Insert the content into the previewDiv
            previewDiv.innerHTML = content;
            // Update the chart with the stock details
            console.log(details[0].symbol);
            updateChart(details[0]);
        } else {
            console.error('No stock details found');
        }
    } catch (error) {
        console.error('Error fetching stocks:', error);
        // Optionally, handle the error or show a message to the user
    }
}
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

        // Function to fetch data from the API
        async function fetchData(symbol) {
            console.log(symbol);
          // Get today's date
    const today = new Date();
    
    // Calculate yesterday's date
    const yesterday = new Date(today);
    yesterday.setDate(today.getDate() - 1);
    
    // Format dates
    const fromDate = formatDate(yesterday);
    const toDate = formatDate(today);
    console.log(fromDate,toDate);
    // Construct the API URL with dynamic dates
    const response = await fetch(`https://financialmodelingprep.com/api/v3/historical-chart/1hour/${symbol}?from=${fromDate}&to=${toDate}&apikey=81qC7Lodzx8JtrOt85WL7jwjYmT6h3Bf`);
          const data = await response.json();
            return data;
        }

        // Function to update the chart with the fetched data
        async function updateChart(details) {
      const data = await fetchData(details.symbol);
            console.log(data);
            data.reverse();
            
            const dates = data.map(item => item.date.split(' ')[1]); // Extract only the date part
            const Open = data.map(item => item.open); // Example: using 'open' prices for Developer Edition
            const Close = data.map(item => item.close); // Example: using 'close' prices for Designer Edition

            const options = {
                xaxis: {
                    show: true,
                    categories: dates,
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500'
                        }
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: true,
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500'
                        },
                        formatter: function (value) {
                            return '$' + value;
                        }
                    }
                },
                series: [
                    {
                        name: "Open",
                        data: Open,
                        color: "#1A56DB",
                    },
                    {
                        name: "Close",
                        data: Close,
                        color: "#7E3BF2",
                    },
                ],
                chart: {
                    sparkline: {
                        enabled: false
                    },
                    height: "350px",
                    type: "area",
                    fontFamily: "Inter, sans-serif",
                    dropShadow: {
                        enabled: false,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                tooltip: {
                    enabled: true,
                    x: {
                        show: false,
                    },
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.55,
                        opacityTo: 0,
                        shade: "#1C64F2",
                        gradientToColors: ["#1C64F2"],
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 6,
                },
                legend: {
                    show: false
                },
                grid: {
                    show: false,
                },
            };

            if (document.getElementById("labels-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("labels-chart"), options);
                chart.render();
            }

            // Update sales amount and percentage
            const latestData = data[data.length - 1];
            const currentPrice = details.price; // Assuming 'close' price is the current price// Previous price for comparison

            const salesAmountElement = document.getElementById("sales-amount");
            salesAmountElement.textContent = `$${currentPrice.toFixed(2)}`; // Update sales amount

            // Update percentage and color based on price change
            const percentageChange = details.changesPercentage;
            const percentageElement = document.getElementById("percentage");
            percentageElement.textContent = `${percentageChange.toFixed(2)}%`; // Update percentage

            if (percentageChange > 0) {
                percentageElement.classList.remove("text-red-500");
                percentageElement.classList.add("text-green-500");
            } else if (percentageChange < 0) {
                percentageElement.classList.remove("text-green-500");
                percentageElement.classList.add("text-red-500");
            }
            // Update arrow color based on price change
            const arrowElement = document.getElementById("arrow");
            if (percentageChange > 0) {
                arrowElement.classList.remove("text-red-500");
                arrowElement.classList.add("text-green-500");
                arrowElement.innerHTML = `<svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/></svg>`;
            } else if (percentageChange < 0) {
                arrowElement.classList.remove("text-green-500");
                arrowElement.classList.add("text-red-500");
                arrowElement.innerHTML = `<svg class="w-3 h-3 ms-1 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1v12m0 0 4-4m-4 4L1 9"/></svg>`;
            }
        }
