<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible"
		content="IE=edge">
<meta name="viewport"
		content="width=device-width, initial-scale=1.0">
<title>Document</title>
<script>

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
            stockDetails.price = parseFloat(stockDetails.price.toFixed(5));
            stockDetails.marketCap = parseFloat(stockDetails.marketCap.toFixed(5));
            stockDetails.dayHigh = parseFloat(stockDetails.dayHigh.toFixed(5));
            stockDetails.dayLow = parseFloat(stockDetails.dayLow.toFixed(5));
            stockDetails.open = parseFloat(stockDetails.open.toFixed(5));
            stockDetails.previousClose = parseFloat(stockDetails.previousClose.toFixed(5));
            stockDetails.eps = parseFloat(stockDetails.eps.toFixed(5));
            stockDetails.pe = parseFloat(stockDetails.pe.toFixed(5));

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
                        <div>
                            <div class="text-sm text-gray-500 mb-1">Market Cap</div>
                            <div class="text-xl font-bold text-gray-900">${stockDetails.marketCap}</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div class="text-sm text-gray-500 mb-1">Day High</div>
                            <div class="text-xl font-bold text-gray-900">$${stockDetails.dayHigh}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 mb-1">Day Low</div>
                            <div class="text-xl font-bold text-gray-900">$${stockDetails.dayLow}</div>
                        </div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500 mb-1">Price History</div>
                        <div class="aspect-[9/4] shadow-lg">
                            <div style="width: 100%; height: 100%;">
                                <div style="position: relative;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="350" height="155.546875" role="application">
                                        <div id="area-chart"></div>
                                    </svg>
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
                            <div>
                                <div class="text-sm text-gray-500">Previous Close</div>
                                <div class="text-xl font-bold text-gray-900">${stockDetails.previousClose}</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">EPS</div>
                                <div class="text-xl font-bold text-gray-900">${stockDetails.eps}</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">P/E Ratio</div>
                                <div class="text-xl font-bold text-gray-900">${stockDetails.pe}</div>
                            </div>
                        </div>
                    </div>
                </div>`;

            // Insert the content into the previewDiv
            previewDiv.innerHTML = content;
        } else {
            console.error('No stock details found');
        }
    } catch (error) {
        console.error('Error fetching stocks:', error);
        // Optionally, handle the error or show a message to the user
    }
}


        if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
        chart = new ApexCharts(document.getElementById("area-chart"), options);
        chart.render();
        }
        const options = {
  chart: {
    height: "100%",
    maxWidth: "100%",
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
  grid: {
    show: false,
    strokeDashArray: 4,
    padding: {
      left: 2,
      right: 2,
      top: 0
    },
  },
  series: [
    {
      name: "New users",
      data: [6500, 6418, 6456, 6526, 6356, 6456],
      color: "#1A56DB",
    },
  ],
  xaxis: {
    categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
    labels: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  yaxis: {
    show: false,
  },
}

if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("area-chart"), options);
  chart.render();
}
    </script>
</head>
<body>

<div
  id="cpzbuivsoot"
  class="flex flex-col md:flex-row gap-6 max-w-6xl mx-auto px-4 md:px-6 py-8 bg-white text-gray-900 flex justify-center"
>
  <div class=" ">
    <div class="mb-6 shadow-lg">
      <input
        id="searchInput"
        class="flex h-10 rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full shadow-lg"
        placeholder="Search for a stock..."
        oninput="fetchStocks()"
      />
    </div>
    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
      <div class="divide-y divide-gray-200">
        <div class="px-4 py-3 bg-gray-100 text-sm font-medium text-gray-500">Search Results</div>
        <div id="results" class="max-h-[400px] overflow-y-auto"></div>
      </div>
    </div>
  </div>
  <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden w-full md:w-[400px]">
    <div class="px-4 py-3 bg-gray-100 text-sm font-medium text-gray-500 ">Stock Preview</div>
    <div class="p-6 space-y-6" id="Preview"></div>
  </div>
</div>
<script src="https://cdn.tailwindcss.com"></script>
</body>

</html>