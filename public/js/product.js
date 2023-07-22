function goToPrevSlideProduct(sliderId) {
    const slider = document.getElementById(sliderId);
    const slides = slider.querySelectorAll('.detail-product-slider-item');
    let currentSlide = Array.from(slides).findIndex(slide => slide.classList.contains('detail-product-slider-item-active'));
    currentSlide = (currentSlide === 0) ? slides.length - 1 : currentSlide - 1;
    showSlideProduct(sliderId, currentSlide);
}

function goToNextSlideProduct(sliderId) {
    const slider = document.getElementById(sliderId);
    const slides = slider.querySelectorAll('.detail-product-slider-item');
    let currentSlide = Array.from(slides).findIndex(slide => slide.classList.contains('detail-product-slider-item-active'));
    currentSlide = (currentSlide === slides.length - 1) ? 0 : currentSlide + 1;
    showSlideProduct(sliderId, currentSlide);
}

function showSlideProduct(sliderId, currentSlide) {
    const slider = document.getElementById(sliderId);
    const sliderContent = slider.querySelector('.detail-product-slider-content');
    const slides = slider.querySelectorAll('.detail-product-slider-item');
    const slideHeight = slides[0].offsetHeight;

    slides.forEach(slide => slide.classList.remove('detail-product-slider-item-active'));
    slides[currentSlide].classList.add('detail-product-slider-item-active');
    document.getElementById('showImage').src = slides[currentSlide].getElementsByTagName('img')[0].src;
    sliderContent.style.transition = 'transform 0.5s';
    sliderContent.style.transform = `translateY(-${slideHeight * currentSlide}px)`;
}

showSlideProduct('detail-product-gallery', 0);
