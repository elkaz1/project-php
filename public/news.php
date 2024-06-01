<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Market Dashboard</title>
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
            animation: ticker-animation 15s linear infinite;
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
</head>

<body>
    <div class="flex flex-col lg:flex-row max-w-7xl mx-auto p-4 gap-6">
        <!-- News Carousel and Ticker Container -->
        <div class="w-full lg:w-2/3">
            <!-- News Carousel -->
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
                    <div class="carousel-track">
                        <!-- Mock Data Slides -->
                        <div class="carousel-slide" role="group">
                            <div class="flex items-center gap-6">
                                <img src="https://cdn.financialmodelingprep.com/images/fmp-1717174844079.jpg" alt="News Thumbnail" width="400" height="225" class="object-cover rounded-md" style="aspect-ratio: 300 / 225; object-fit: cover;" />
                                <div class="space-y-2">
                                    <h3 class="text-xl font-semibold">Tech Stocks Surge as Investors Bet on Innovation</h3>
                                    <p class="text-gray-500 dark:text-gray-400">
                                        The tech-heavy Nasdaq Composite index rose 2.5% as investors piled into leading tech companies,
                                        fueling hopes of a broader market recovery.
                                    </p>
                                    <div class="flex justify-end">
                                        <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Learn More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-slide" role="group">
                            <div class="grid grid-cols-[300px_1fr] gap-6">
                                <img src="/placeholder.svg" alt="News Thumbnail" width="300" height="225" class="object-cover rounded-md" style="aspect-ratio: 300 / 225; object-fit: cover;" />
                                <div class="space-y-2">
                                    <h3 class="text-xl font-semibold">Oil Prices Surge as OPEC Cuts Production</h3>
                                    <p class="text-gray-500 dark:text-gray-400">
                                        Crude oil prices jumped 3% after OPEC announced plans to reduce output, sparking concerns about
                                        supply shortages and higher energy costs.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-slide" role="group">
                            <div class="grid grid-cols-[300px_1fr] gap-6">
                                <img src="/placeholder.svg" alt="News Thumbnail" width="300" height="225" class="object-cover rounded-md" style="aspect-ratio: 300 / 225; object-fit: cover;" />
                                <div class="space-y-2">
                                    <h3 class="text-xl font-semibold">Cryptocurrency Prices Rebound After Regulatory Clarity</h3>
                                    <p class="text-gray-500 dark:text-gray-400">
                                        Bitcoin and other major cryptocurrencies saw a surge in prices as investors welcomed new regulatory
                                        guidelines from global financial authorities.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-slide" role="group">
                            <div class="grid grid-cols-[300px_1fr] gap-6">
                                <img src="/placeholder.svg" alt="News Thumbnail" width="300" height="225" class="object-cover rounded-md" style="aspect-ratio: 300 / 225; object-fit: cover;" />
                                <div class="space-y-2">
                                    <h3 class="text-xl font-semibold">Retail Sales Surge as Consumers Shrug Off Inflation</h3>
                                    <p class="text-gray-500 dark:text-gray-400">
                                        Retail sales rose 0.7% last month, defying expectations of a slowdown, as consumers continued to
                                        spend despite high inflation.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-slide" role="group">
                            <div class="grid grid-cols-[300px_1fr] gap-6">
                                <img src="/placeholder.svg" alt="News Thumbnail" width="300" height="225" class="object-cover rounded-md" style="aspect-ratio: 300 / 225; object-fit: cover;" />
                                <div class="space-y-2">
                                    <h3 class="text-xl font-semibold">Housing Prices Stabilize as Mortgage Rates Ease</h3>
                                    <p class="text-gray-500 dark:text-gray-400">
                                        Home prices showed signs of leveling off as mortgage rates declined, offering some relief to
                                        prospective homebuyers after a period of rapid price appreciation.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Add more slides here if needed -->
                    </div>
                </div>
            </div>

            <!-- Ticker -->
            <div class="ticker-container mt-4">
                <div class="ticker">
                    <div class="ticker-item">
                        <span class="font-bold">AAPL: </span><span class="text-green-500">+2.5%</span>
                    </div>
                    <div class="ticker-item">
                        <span class="font-bold">TSLA: </span><span class="text-red-500">-1.8%</span>
                    </div>
                    <div class="ticker-item">
                        <span class="font-bold">AMZN: </span><span class="text-green-500">+1.2%</span>
                    </div>
                    <div class="ticker-item">
                        <span class="font-bold">GOOGL: </span><span class="text-green-500">+0.9%</span>
                    </div>
                    <div class="ticker-item">
                        <span class="font-bold">MSFT: </span><span class="text-green-500">+1.3%</span>
                    </div>
                    <!-- Add more ticker items as needed -->
                </div>
            </div>
        </div>

        <!-- Top Gainers and Losers -->
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const carouselTrack = document.querySelector(".carousel-track");
            const slides = Array.from(carouselTrack.children);
            const nextButton = document.querySelector("#nextButton");
            const prevButton = document.querySelector("#prevButton");
            let slideWidth = slides[0].getBoundingClientRect().width;
            let currentIndex = 0;

            const moveToSlide = (track, currentSlide, targetSlide) => {
                track.style.transform = `translateX(-${targetSlide.style.left})`;
                currentSlide.classList.remove("current-slide");
                targetSlide.classList.add("current-slide");
            };

            slides.forEach((slide, index) => {
                slide.style.left = `${slideWidth * index}px`;
            });

            nextButton.addEventListener("click", e => {
                const currentSlide = carouselTrack.querySelector(".current-slide");
                const nextSlide = currentSlide.nextElementSibling;
                moveToSlide(carouselTrack, currentSlide, nextSlide || slides[0]);
            });

            prevButton.addEventListener("click", e => {
                const currentSlide = carouselTrack.querySelector(".current-slide");
                const prevSlide = currentSlide.previousElementSibling;
                moveToSlide(carouselTrack, currentSlide, prevSlide || slides[slides.length - 1]);
            });

            slides[0].classList.add("current-slide");
        });
    </script>
</body>

</html>
