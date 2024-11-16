let currentSlide = 0;
let slideInterval;

// Function to show the current slide
function showSlide(slideIndex) {
    const slides = document.querySelector('.slides');
    const totalSlides = slides.children.length;
    
    // Wrap around if out of bounds
    if (slideIndex >= totalSlides) {
        currentSlide = 0;
    } else if (slideIndex < 0) {
        currentSlide = totalSlides - 1;
    } else {
        currentSlide = slideIndex;
    }

    // Calculate the offset and set it to slides
    const offset = -currentSlide * 100; // Each image takes 100% of the slider width
    slides.style.transform = `translateX(${offset}%)`;
}

// Change slide function
function changeSlide(direction) {
    showSlide(currentSlide + direction);
}

// Start automatic sliding
function startSlideShow() {
    slideInterval = setInterval(() => {
        changeSlide(1);
    }, 3000); // Change slide every 3 seconds
}

// Stop automatic sliding
function stopSlideShow() {
    clearInterval(slideInterval);
}

// Event listeners for mouse hover
const slider = document.querySelector('.slider');
slider.addEventListener('mouseenter', stopSlideShow);
slider.addEventListener('mouseleave', startSlideShow);

// Initialize the slider
showSlide(currentSlide);
startSlideShow();
