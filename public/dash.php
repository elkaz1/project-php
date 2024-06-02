<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Market Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        .carousel-container {
            overflow: hidden;
            position: relative;
        }
        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-slide {
            min-width: 100%;
            box-sizing: border-box;
        }
        .gainers-losers-card .grid-cols-3>span {
            justify-self: start;
        }
        .ticker-container {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }
        .ticker {
            display: inline-block;
            padding-left: 100%;
            animation: ticker-animation 50s linear infinite;
        }
        .ticker-item {
            display: inline-block;
            margin-right: 2rem;
        }
        @keyframes ticker-animation {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }
        }
        .ticker-container:hover .ticker {
            animation-play-state: paused;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../js/dash.js"></script>
    <script src="../js/search.js"></script>
</head>
<body>
    <!-- NAV section --->
    <nav class="flex items-center justify-between h-16 px-4 md:px-6 border-b">
  <a class="flex items-center gap-2" href="#" rel="ugc">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width="24"
      height="24"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      stroke-width="2"
      stroke-linecap="round"
      stroke-linejoin="round"
      class="h-6 w-6"
    >
      <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
      <polyline points="9 22 9 12 15 12 15 22"></polyline>
    </svg>
    <span class="sr-only">Home</span>
  </a>
  <div class="flex items-center gap-4">
    <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        class="h-6 w-6"
      >
        <circle cx="11" cy="11" r="8"></circle>
        <path d="m21 21-4.3-4.3"></path>
      </svg>
      <span class="sr-only">Search</span>
    </button>
    <button
      class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10"
      type="button"
      id="radix-:r2:"
      aria-haspopup="menu"
      aria-expanded="false"
      data-state="closed"
    >
      <img
        src="../assets/preview.png"
        width="32"
        height="32"
        class="rounded-full"
        alt="Avatar"
        style="aspect-ratio: 32 / 32; object-fit: cover;"
      />
      <span class="sr-only">Open user menu</span>
    </button>
  </div>
    </nav>
    <div class="ticker-container mt-4">
        <div class="ticker" id="ticker">
            <!-- Ticker Items will be inserted here -->
        </div>
    </div>
    <!-- Dashboard Section -->
    <div class="flex flex-col lg:flex-row max-w-7xl mx-auto p-4 gap-6">
        <div class="w-full lg:w-2/3">
            <div id="yq2i4fkqru" class="w-full">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Stock Market News</h2>
                    <div class="flex items-center gap-2">
                        <button id="prevButton" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                <path d="m15 18-6-6 6-6"></path>
                            </svg>
                        </button>
                        <button id="nextButton" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="carousel-container" role="region" aria-roledescription="carousel">
                    <div class="carousel-track" id="carousel-data">
                        <!-- News Slides will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
        <div id="rkfaxuykns" class="w-full lg:w-1/3 grid grid-cols-1 gap-6">
            <div class="gainers-card rounded-lg border bg-card text-card-foreground shadow-lg" data-v0-t="card">
                <div class="flex flex-col space-y-1.5 p-4">
                    <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Top Gainers</h3>
                </div>
                <div class="p-4">
                    <div class="grid gap-2">
                        <div class="grid grid-cols-3 items-center text-sm font-medium">
                            <span>Ticker</span>
                            <span class="justify-self-end">Price Change</span>
                            <span class="justify-self-end">% Change</span>
                        </div>
                        <div class="grid grid-cols-3 items-center text-sm">
                            <span class="font-medium">AAPL</span>
                            <span class="text-green-500 font-medium justify-self-end">+$2.50</span>
                            <span class="text-green-500 font-medium justify-self-end">+3.2%</span>
                        </div>
                        <div class="grid grid-cols-3 items-center text-sm">
                            <span class="font-medium">MSFT</span>
                            <span class="text-green-500 font-medium justify-self-end">+$1.75</span>
                            <span class="text-green-500 font-medium justify-self-end">+2.1%</span>
                        </div>
                        <div class="grid grid-cols-3 items-center text-sm">
                            <span class="font-medium">GOOGL</span>
                            <span class="text-green-500 font-medium justify-self-end">+$3.10</span>
                            <span class="text-green-500 font-medium justify-self-end">+1.9%</span>
                        </div>
                        <div class="grid grid-cols-3 items-center text-sm">
                            <span class="font-medium">AMZN</span>
                            <span class="text-green-500 font-medium justify-self-end">+$4.20</span>
                            <span class="text-green-500 font-medium justify-self-end">+1.8%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="losers-card rounded-lg border bg-card text-card-foreground shadow-lg" data-v0-t="card">
                <div class="flex flex-col space-y-1.5 p-4">
                    <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Top Losers</h3>
                </div>
                <div class="p-4">
                    <div class="grid gap-2">
                        <div class="grid grid-cols-3 items-center text-sm font-medium">
                            <span>Ticker</span>
                            <span class="justify-self-end">Price Change</span>
                            <span class="justify-self-end">% Change</span>
                        </div>
                        <div class="grid grid-cols-3 items-center text-sm">
                            <span class="font-medium">TSLA</span>
                            <span class="text-red-500 font-medium justify-self-end">-$3.80</span>
                            <span class="text-red-500 font-medium justify-self-end">-2.5%</span>
                        </div>
                        <div class="grid grid-cols-3 items-center text-sm">
                            <span class="font-medium">NFLX</span>
                            <span class="text-red-500 font-medium justify-self-end">-$2.45</span>
                            <span class="text-red-500 font-medium justify-self-end">-2.0%</span>
                        </div>
                        <div class="grid grid-cols-3 items-center text-sm">
                            <span class="font-medium">FB</span>
                            <span class="text-red-500 font-medium justify-self-end">-$1.90</span>
                            <span class="text-red-500 font-medium justify-self-end">-1.8%</span>
                        </div>
                        <div class="grid grid-cols-3 items-center text-sm">
                            <span class="font-medium">NVDA</span>
                            <span class="text-red-500 font-medium justify-self-end">-$2.30</span>
                            <span class="text-red-500 font-medium justify-self-end">-1.5%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div id="cpzbuivsoot" style="background-color: transparent;" class="flex flex-col md:flex-row gap-6 max-w-6xl mx-auto px-4 md:px-6 py-8 text-gray-900 flex justify-center">
        <div>
            <div class="mb-6 shadow-lg flex">
                <input id="searchInput" class="flex h-10 rounded-l-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full shadow-lg" placeholder="Search for a stock..." />
                <button onclick="fetchStocks()" class="h-10 rounded-r-md bg-gray-500 text-white px-4 flex items-center justify-center hover:bg-gray-700 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </div>
            <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
                <div class="divide-y divide-gray-200">
                    <div class="px-4 py-3 bg-gray-100 text-sm font-medium text-gray-500">Search Results</div>
                    <div id="results" class="max-h-[400px] overflow-y-auto"></div>
                </div>
            </div>
        </div>
        <div class="w-full md:w-[470px] bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
            <div class="w-full md:w-[470px] px-4 py-3 bg-gray-100 text-sm font-medium text-gray-500">Stock Preview</div>
            <div class="w-full md:w-[470px] p-6 space-y-6 overflow-y-scroll" id="Preview" style="max-height: calc(100vh - 200px);"></div>
        </div>
    </div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
