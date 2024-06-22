<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Market Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        /* Hide scrollbar for WebKit browsers */
        #settings-modal::-webkit-scrollbar,
        #Cprofile-modal::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge, and Firefox */
        #settings-modal,
        #Cprofile-modal {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Ensure inner container is scrollable */
        .scrollable-container {
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            -ms-overflow-style: none; /* Hide scrollbar for IE and Edge */
            scrollbar-width: none; /* Hide scrollbar for Firefox */
        }

        .scrollable-container::-webkit-scrollbar {
            display: none; /* Hide scrollbar for WebKit browsers */
        }

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
    <?php include 'navigation.php'; ?>

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
                        <button id="prevButton"
                            class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-5 h-5">
                                <path d="m15 18-6-6 6-6"></path>
                            </svg>
                        </button>
                        <button id="nextButton"
                            class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-5 h-5">
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
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div id="cpzbuivsoot" style="background-color: transparent;"
            class="flex flex-col md:flex-row gap-6 max-w-6xl mx-auto px-4 md:px-6 py-8 text-gray-900 flex justify-center">
            <div>
                <div class="mb-6 shadow-lg flex">
                    <input id="searchInput"
                        class="flex h-10 rounded-l-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full shadow-lg"
                        placeholder="Search for a stock..." />
                    <button onclick="fetchStocks()"
                        class="h-10 rounded-r-md bg-gray-500 text-white px-4 flex items-center justify-center hover:bg-gray-700 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
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
                <div class="w-full md:w-[470px] px-4 py-3 bg-gray-100 text-sm font-medium text-gray-500">Stock Preview
                </div>
                <div class="w-full md:w-[470px] p-6 space-y-6 overflow-y-scroll" id="Preview"
                    style="max-height: calc(100vh - 200px);"></div>
            </div>
        </div>
    </div>

    <!-- watchliste section -->
    <div id="watchlist-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl">
            <div class="flex flex-col items-center p-6">
                <h3 class="text-2xl font-semibold mb-4">Stocks Watchlist</h3>
                <button class="bg-blue-500 text-white rounded-md px-4 py-2 mb-4 hover:bg-blue-600">Add Stock</button>
                <div class="w-full overflow-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2 px-4 font-medium">Ticker</th>
                                <th class="py-2 px-4 font-medium text-right">Price</th>
                                <th class="py-2 px-4 font-medium text-right">Change</th>
                                <th class="py-2 px-4 font-medium text-right">Recommendation</th>
                                <th class="py-2 px-4 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-2 px-4">AMZN</td>
                                <td class="py-2 px-4 text-right">$3210.45</td>
                                <td class="py-2 px-4 text-right text-green-500">+0.8%</td>
                                <td class="py-2 px-4 text-right">Hold</td> <!-- Example Recommendation -->
                                <td class="py-2 px-4 text-right">
                                    <button class="bg-red-500 text-white rounded-md p-2 hover:bg-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                            <path d="M3 6h18"></path>
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                            <line x1="10" x2="10" y1="11" y2="17"></line>
                                            <line x1="14" x2="14" y1="11" y2="17"></line>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <!-- Add more -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- settings section --->
    <div id="settings-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed top-[60px] inset-x-0 z-50 flex justify-center items-start overflow-hidden"
        style="overflow-y: scroll;">
        <div class="bg-white flex flex-col gap-8 w-full max-w-4xl mx-auto p-6 md:p-10 overflow-y-auto max-h-[calc(100vh-80px)]"
            style="background-color: transparent;">
            <div class="grid gap-6">
                <div class="bg-white rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Personal
                            Information</h3>
                        <p class="text-sm text-muted-foreground">Update your personal details.</p>
                    </div>
                    <div class="p-6 grid gap-6">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="name">
                                    Name
                                </label>
                                <input
                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                    id="name" placeholder="Enter your name" />
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="email">
                                    Email
                                </label>
                                <input
                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                    id="email" placeholder="Enter your email" type="email" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                Profile Picture
                            </label>
                            <div class="flex items-center gap-4">
                                <span class="relative flex shrink-0 overflow-hidden rounded-full h-14 w-14">
                                    <img class="aspect-square h-full w-full" alt="@shadcn"
                                        src="/placeholder-user.jpg" />
                                </span>
                                <button
                                    class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
                                    Change
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Account
                            Settings</h3>
                        <p class="text-sm text-muted-foreground">Manage your account preferences.</p>
                    </div>
                    <div class="p-6 grid gap-6">
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                for="password">
                                Password
                            </label>
                            <input
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                id="password" placeholder="Enter your password" type="password" />
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-sm font-medium">Two-Factor Authentication</p>
                                <p class="text-sm text-muted-foreground">Add an extra layer of security to your account.
                                </p>
                            </div>
                            <button type="button" role="switch" aria-checked="false" data-state="unchecked" value="on"
                                class="peer inline-flex h-[24px] w-[44px] shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=unchecked]:bg-input"
                                id="two-factor">
                                <span data-state="unchecked"
                                    class="pointer-events-none block h-5 w-5 rounded-full bg-background shadow-lg ring-0 transition-transform data-[state=checked]:translate-x-5 data-[state=unchecked]:translate-x-0"></span>
                            </button>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-sm font-medium">Delete Account</p>
                                <p class="text-sm text-muted-foreground">This will permanently delete your account and
                                    all your data.</p>
                            </div>
                            <button
                                class=" hover:bg-red-600 bg-red-500 inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-destructive text-destructive-foreground hover:bg-destructive/90 h-10 px-4 py-2">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Privacy
                            Preferences</h3>
                        <p class="text-sm text-muted-foreground">Control your privacy settings.</p>
                    </div>
                    <div class="p-6 grid gap-6">
                        <div class="flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-sm font-medium">Share Data</p>
                                <p class="text-sm text-muted-foreground">Allow your data to be shared with third-party
                                    services.</p>
                            </div>
                            <button type="button" role="switch" aria-checked="false" data-state="unchecked" value="on"
                                class="peer inline-flex h-[24px] w-[44px] shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=unchecked]:bg-input"
                                id="share-data">
                                <span data-state="unchecked"
                                    class="pointer-events-none block h-5 w-5 rounded-full bg-background shadow-lg ring-0 transition-transform data-[state=checked]:translate-x-5 data-[state=unchecked]:translate-x-0"></span>
                            </button>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-sm font-medium">Receive Notifications</p>
                                <p class="text-sm text-muted-foreground">Get notified about important updates and
                                    activities.</p>
                            </div>
                            <button type="button" role="switch" aria-checked="false" data-state="unchecked" value="on"
                                class="peer inline-flex h-[24px] w-[44px] shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=unchecked]:bg-input"
                                id="receive-notifications">
                                <span data-state="unchecked"
                                    class="pointer-events-none block h-5 w-5 rounded-full bg-background shadow-lg ring-0 transition-transform data-[state=checked]:translate-x-5 data-[state=unchecked]:translate-x-0"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button
                        class="bg-white inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-secondary text-secondary-foreground hover:bg-secondary/80 h-10 px-4 py-2">
                        Cancel
                    </button>
                    <button
                        class="bg-green-500 inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 hover:bg-green-600">
                        Save Changes
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!---->
    <div id="Cprofile-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed top-[60px] inset-x-0 z-50 flex justify-center items-start overflow-hidden"
        style="overflow-y: scroll;">
        <div class="bg-white flex flex-col gap-8 w-full max-w-4xl mx-auto p-6 md:p-10 overflow-y-auto max-h-[calc(100vh-80px)]"
            style="background-color: transparent;">
            <div class="relative rounded-lg border bg-white text-gray-800 shadow-md w-full max-w-3xl mx-auto my-8 p-6"
                data-v0-t="card">
                <button onclick="toggleModal(false)"
                    class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 text-2xl">&times;</button>
                <div id="profile"></div>
            </div>
        </div>

    </div>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <div id="modal-backdrop" class="fixed inset-0 bg-black opacity-50 z-40 hidden"></div>

</body>

</html>