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
    fetchActivs()
    fetchNews().then(() => {
// Automatically move slides every 5 seconds after fetching the news
setInterval(autoMoveSlides, 5000);
});
});
async function fetchActivs(){
    try {
    const response = await fetch(`https://financialmodelingprep.com/api/v3/stock_market/actives?apikey=81qC7Lodzx8JtrOt85WL7jwjYmT6h3Bf`);
        const Actives = await response.json();
        console.log(Actives);  // Add this line to check the response
        displayActives(Actives);
    } catch (error) {
        console.error('Error fetching News:', error);
        // Optionally, handle the error or show a message to the user
    }
}
function displayActives(Actives){
    const activs = document.getElementById('ticker');
    activs.innerHTML = '';
    Actives.forEach(element => {
        // Check if changesPercentage is positive or negative
        const isPositive = parseFloat(element.changesPercentage) >= 0;

        // Set the color based on whether it's positive or negative
        const colorClass = isPositive ? 'text-green-500' : 'text-red-500';

        // Add a plus sign (+) in front of the percentage
        const formattedPercentage = isPositive ? `▲+${element.changesPercentage}%` : `▼${element.changesPercentage}%`;

        const content = `<div class="ticker-item">
            <span class="font-bold">${element.symbol}: </span><span class="${colorClass}">${formattedPercentage}</span>
        </div>`;
        
        activs.innerHTML += content;
    });

}

async function fetchNews(){
    try {
        const response = await fetch(`https://financialmodelingprep.com/api/v3/fmp/articles?page=0&size=15&apikey=81qC7Lodzx8JtrOt85WL7jwjYmT6h3Bf`);
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

