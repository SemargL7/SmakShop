function goToPrevSlide(sliderId) {
    const slider = document.getElementById(sliderId);
    const slides = slider.querySelectorAll('.slider-item');
    let currentSlide = Array.from(slides).findIndex(slide => slide.classList.contains('slider-item-active'));
    if (currentSlide === -1) {
        currentSlide = 0;
    }
    currentSlide = (currentSlide === 0) ? slides.length - 1 : currentSlide - 1;
    showSlide(sliderId, currentSlide);
}

// Function to go to the next slide
function goToNextSlide(sliderId) {
    const slider = document.getElementById(sliderId);
    const slides = slider.querySelectorAll('.slider-item');
    let currentSlide = Array.from(slides).findIndex(slide => slide.classList.contains('slider-item-active'));
    if (currentSlide === -1) {
        currentSlide = 0;
    }
    currentSlide = (currentSlide === slides.length - 1) ? 0 : currentSlide + 1;
    showSlide(sliderId, currentSlide);
}

function showSlide(sliderId, currentSlide) {
    const slider = document.getElementById(sliderId);
    const sliderContent = slider.querySelector('.slider-content');
    const slides = slider.querySelectorAll('.slider-item');
    const slideWidth = slides[0].offsetWidth;

    // Remove 'slider-item-active' class from all slides
    slides.forEach(slide => slide.classList.remove('slider-item-active'));

    // Add 'slider-item-active' class to the current slide
    slides[currentSlide].classList.add('slider-item-active');

    sliderContent.style.transition = 'transform 0.5s';
    sliderContent.style.transform = `translateX(-${slideWidth * currentSlide}px)`;
}

