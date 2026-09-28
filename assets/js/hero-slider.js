/**
 * RazGem Commercial Hero Carousel
 * Lightweight, touch-enabled, accessible slider for featured commercial banners.
 *
 * @package RazGem
 * @version 1.0.0
 */

(function () {
    'use strict';

    function initHeroCarousel() {
        const carousel = document.getElementById('heroFeaturedCarousel');
        if (!carousel) return;

        const slides = carousel.querySelectorAll('.hero-carousel-slide');
        const dots = carousel.querySelectorAll('.hero-carousel-dot');
        const prevBtn = carousel.querySelector('.hero-carousel-prev');
        const nextBtn = carousel.querySelector('.hero-carousel-next');

        if (slides.length <= 1) return;

        let currentIndex = 0;
        let autoPlayTimer = null;
        const autoPlayInterval = 5000;
        let isPaused = false;

        function goToSlide(index) {
            if (index < 0) {
                index = slides.length - 1;
            } else if (index >= slides.length) {
                index = 0;
            }

            slides.forEach((slide, i) => {
                const isActive = i === index;
                slide.classList.toggle('is-active', isActive);
            });

            dots.forEach((dot, i) => {
                const isActive = i === index;
                dot.classList.toggle('is-active', isActive);
                dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });

            currentIndex = index;
        }

        function nextSlide() {
            goToSlide(currentIndex + 1);
        }

        function prevSlide() {
            goToSlide(currentIndex - 1);
        }

        function startAutoPlay() {
            stopAutoPlay();
            autoPlayTimer = setInterval(() => {
                if (!isPaused) {
                    nextSlide();
                }
            }, autoPlayInterval);
        }

        function stopAutoPlay() {
            if (autoPlayTimer) {
                clearInterval(autoPlayTimer);
                autoPlayTimer = null;
            }
        }

        // Arrow navigation
        if (prevBtn) {
            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                prevSlide();
                startAutoPlay();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                nextSlide();
                startAutoPlay();
            });
        }

        // Dot navigation
        dots.forEach((dot, idx) => {
            dot.addEventListener('click', (e) => {
                e.preventDefault();
                goToSlide(idx);
                startAutoPlay();
            });
        });

        // Pause on mouse hover
        carousel.addEventListener('mouseenter', () => {
            isPaused = true;
        });

        carousel.addEventListener('mouseleave', () => {
            isPaused = false;
        });

        // Touch & Swipe gestures
        let touchStartX = 0;
        let touchEndX = 0;
        const minSwipeDistance = 45;

        carousel.addEventListener('touchstart', (e) => {
            isPaused = true;
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        carousel.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
            isPaused = false;
        }, { passive: true });

        function handleSwipe() {
            const diff = touchEndX - touchStartX;
            // In RTL layout:
            // Swiping right-to-left (diff < -minSwipeDistance) means moving forward/next in RTL
            // Swiping left-to-right (diff > minSwipeDistance) means moving backward/prev in RTL
            const isRTL = document.dir === 'rtl' || document.documentElement.dir === 'rtl';
            if (Math.abs(diff) > minSwipeDistance) {
                if (diff < 0) {
                    // Swiped left
                    if (isRTL) {
                        nextSlide();
                    } else {
                        nextSlide();
                    }
                } else {
                    // Swiped right
                    if (isRTL) {
                        prevSlide();
                    } else {
                        prevSlide();
                    }
                }
                startAutoPlay();
            }
        }

        // Keyboard accessibility
        carousel.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') {
                e.preventDefault();
                prevSlide();
            } else if (e.key === 'ArrowLeft') {
                e.preventDefault();
                nextSlide();
            }
        });

        // Initialize
        goToSlide(0);
        startAutoPlay();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHeroCarousel);
    } else {
        initHeroCarousel();
    }
})();
