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
    const response = await fetch(`https://financialmodelingprep.com/api/v3/stock_market/actives?apikey=6fPRdhwBHTpkm3FjMWPGuOM05S1a2m6x`);
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
            <button onclick="profilemodel('${element.symbol}')" data-modal-target="Cprofile-modal" data-modal-toggle="Cprofile-modal" ><span class="font-bold">${element.symbol}: </span></button><span class="${colorClass}">${formattedPercentage}</span>
        </div>`;
        
        activs.innerHTML += content;
    });

}

async function fetchNews(){
    try {
        const response = await fetch(`https://financialmodelingprep.com/api/v3/fmp/articles?page=0&size=15&apikey=6fPRdhwBHTpkm3FjMWPGuOM05S1a2m6x`);
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

async function profilemodel(symbol) {
    console.log(symbol);
    const profileContainer = document.getElementById('profile');
    profileContainer.innerHTML = '';

    try {
        const response = await fetch(`https://financialmodelingprep.com/api/v3/profile/${symbol}?apikey=6fPRdhwBHTpkm3FjMWPGuOM05S1a2m6x`);
        const profileData = await response.json();
        const profile = profileData[0];

        console.log(profile);

        const content = `
    <div class="flex items-center gap-4">
        <img
            src="${profile.image}"
            alt="${profile.companyName} Logo"
            width="48"
            height="48"
            class="rounded-full object-cover"
        />
        <div>
            <h1 class="text-2xl font-semibold">${profile.companyName} (${profile.symbol})</h1>
            <p class="text-gray-500">${profile.industry}</p>
        </div>
    </div>
    <div class="text-right">
        <div class="text-3xl font-bold">$${profile.price}</div>
        <div class="text-gray-500">
            <span class="font-medium text-${profile.changes > 0 ? 'green-500' : 'red-500'}">${profile.changes}%</span> (Last 24h)
        </div>
    </div>
</div>

<div class="grid grid-cols-2 gap-6 mb-6">
    <div class="space-y-2">
        <div class="flex justify-between">
            <span class="text-gray-500">Beta</span>
            <span>${profile.beta}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">Trading Volume</span>
            <span>${profile.volAvg}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">Market Cap</span>
            <span>$${(profile.mktCap / 1e12).toFixed(2)}T</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">Dividend</span>
            <span>$${profile.lastDiv}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">DCF Diff</span>
            <span>${profile.dcfDiff}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">DCF</span>
            <span>${profile.dcf}</span>
        </div>
    </div>
    <div class="space-y-2">
        <div class="flex justify-between">
            <span class="text-gray-500">52-Week Range</span>
            <span>${profile.range}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">1-Year Change</span>
            <span class="text-${profile.changes > 0 ? 'green-500' : 'red-500'}">${profile.changes}%</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">5-Year Change</span>
            <span class="text-${profile.changes > 0 ? 'green-500' : 'red-500'}">${profile.changes}%</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">Exchange</span>
            <span>${profile.exchange}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">IPO Date</span>
            <span>${profile.ipoDate}</span>
        </div>
    </div>
</div>

<div class="mb-6">
    <h2 class="text-lg font-semibold mb-2">About ${profile.companyName}</h2>
    <p class="text-gray-600">
        ${profile.description}
    </p>
</div>

<div class="mb-6">
    <h2 class="text-lg font-semibold mb-2">Leadership</h2>
    <div class="flex justify-between">
        <span class="text-gray-500">CEO</span>
        <span>${profile.ceo}</span>
    </div>
</div>

<div>
    <h2 class="text-lg font-semibold mb-2">Contact Information</h2>
    <div class="space-y-2">
        <div class="flex justify-between">
            <span class="text-gray-500">Phone</span>
            <span>${profile.phone}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">Address</span>
            <span>${profile.address}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">City</span>
            <span>${profile.city}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">State</span>
            <span>${profile.state}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-500">ZIP</span>
            <span>${profile.zip}</span>
        </div>
        <div class="flex items-center gap-2">
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
                class="h-4 w-4 text-gray-500"
            >
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                <path d="M2 12h20"></path>
            </svg>
            <a href="${profile.website}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">
                ${profile.website}
            </a>
        </div>
    </div>
</div>
`;


        profileContainer.innerHTML = content;
        toggleModal(true);
    } catch (error) {
        console.error('Error fetching profile:', error);
    }
}

function toggleModal(show) {
    const modal = document.getElementById('Cprofile-modal');
    const backdrop = document.getElementById('modal-backdrop');

    if (show) {
        modal.classList.remove('hidden');
        backdrop.classList.remove('hidden');
    } else {
        modal.classList.add('hidden');
        backdrop.classList.add('hidden');
    }
}
