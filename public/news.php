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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const carouselTrack = document.querySelector(".carousel-track");
            const slides = Array.from(carouselTrack.children);
            const nextButton = document.querySelector("#nextButton");
            const prevButton = document.querySelector("#prevButton");

            let slideWidth;
            if (slides.length > 0) {
                slideWidth = slides[0].getBoundingClientRect().width;
                slides.forEach((slide, index) => {
                    slide.style.left = `${slideWidth * index}px`;
                });
                slides[0].classList.add("current-slide");
            }

            let currentIndex = 0;

            const moveToSlide = (track, currentSlide, targetSlide) => {
                if (targetSlide) {
                    track.style.transform = `translateX(-${targetSlide.style.left})`;
                    currentSlide.classList.remove("current-slide");
                    targetSlide.classList.add("current-slide");
                }
            };

            const autoMoveSlides = () => {
                const currentSlide = carouselTrack.querySelector(".current-slide");
                const nextSlide = currentSlide.nextElementSibling || slides[0];
                moveToSlide(carouselTrack, currentSlide, nextSlide);
            };


            nextButton.addEventListener("click", e => {
                const currentSlide = carouselTrack.querySelector(".current-slide");
                const nextSlide = currentSlide ? currentSlide.nextElementSibling : null;
                moveToSlide(carouselTrack, currentSlide, nextSlide || slides[0]);
            });

            prevButton.addEventListener("click", e => {
                const currentSlide = carouselTrack.querySelector(".current-slide");
                const prevSlide = currentSlide ? currentSlide.previousElementSibling : null;
                moveToSlide(carouselTrack, currentSlide, prevSlide || slides[slides.length - 1]);
            });

            fetchNews().then(() => {
        // Automatically move slides every 5 seconds after fetching the news
        setInterval(autoMoveSlides, 5000);
    });
        });

        async function fetchNews(){
            try {
                const response = await fetch(`https://financialmodelingprep.com/api/v3/fmp/articles?page=0&size=10&apikey=81qC7Lodzx8JtrOt85WL7jwjYmT6h3Bf`);
                const News = await response.json();
                console.log(News);  // Add this line to check the response
                displayNews(News);
            } catch (error) {
                console.error('Error fetching News:', error);
                // Optionally, handle the error or show a message to the user
            }
        }

        function displayNews(News){
    const caroDiv = document.getElementById("carousel-data");
    caroDiv.innerHTML = ""; // Clear any existing content
    News['content'].forEach(element => {
        const maxLength = 1; // Maximum number of lines to show
        const lines = element.content.split('\n'); // Split the content into lines
        const truncatedContent = lines.slice(0, maxLength).join('\n'); // Get the first 4 lines

        // Check if the content has more than 4 lines
        const showEllipsis = lines.length > maxLength;

        // Update the content to show only the truncated version
        const updatedContent = showEllipsis ? `${truncatedContent}` : truncatedContent;

        const content = `
            <div class="carousel-slide" role="group">
                <div class="flex items-center gap-6">
                    <img src="${element.image}" alt="News Thumbnail" width="400" height="225" class="object-cover rounded-md" style="aspect-ratio: 300 / 225; object-fit: cover;" />
                    <div class="space-y-2">
                        <h3 class="text-xl font-semibold">${element.title}</h3>
                        <p class="text-gray-500 dark:text-gray-400">${updatedContent}</p>
                        <div class="flex justify-end">
                            <a href="${element.link}"><button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Learn More</button></a>
                        </div>
                    </div>
                </div>
            </div>`;
        caroDiv.innerHTML += content;
    });

    // Update the slides and slideWidth
    const carouselTrack = document.querySelector(".carousel-track");
    const slides = Array.from(carouselTrack.children);
    let slideWidth = slides[0].getBoundingClientRect().width;
    slides.forEach((slide, index) => {
        slide.style.left = `${slideWidth * index}px`;
    });
    slides[0].classList.add("current-slide");
}


    </script>
</body>
</html>
