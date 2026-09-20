document.addEventListener("DOMContentLoaded", () => {
  /* =========================================================================
     1. GSAP Scroll Animations
     ========================================================================= */
  if (typeof gsap !== "undefined") {
    gsap.registerPlugin(ScrollTrigger);
    let prefersReducedMotion = window.matchMedia(
      "(prefers-reduced-motion: reduce)",
    ).matches;

    if (!prefersReducedMotion) {
      const heroTl = gsap.timeline({ defaults: { ease: "power4.out" } });
      heroTl.to(".hero-3d-slider", { opacity: 1, x: 0, duration: 1.4 });
      heroTl.to(".hero-content", { opacity: 1, y: 0, duration: 1 }, "-=1");

      gsap.from(".feature-card", {
        scrollTrigger: { trigger: ".features-section", start: "top 80%" },
        opacity: 0,
        y: 20,
        stagger: 0.15,
        duration: 0.6,
      });
      gsap.from(".category-block", {
        scrollTrigger: { trigger: ".categories-section", start: "top 80%" },
        opacity: 0,
        y: 20,
        stagger: 0.1,
        duration: 0.8,
      });
      gsap.from(".product-card", {
        scrollTrigger: { trigger: ".products-section", start: "top 80%" },
        opacity: 0,
        y: 20,
        stagger: 0.15,
        duration: 0.8,
      });
    } else {
      gsap.set(".hero-content, .hero-3d-slider", { opacity: 1, y: 0, x: 0 });
    }
  }

  /* =========================================================================
     2. 3D Hero Slider Controller (T032 / FR-016)
     ========================================================================= */
  const sliderContainer = document.querySelector(".hero-3d-slider");
  if (sliderContainer) {
    const slides = Array.from(sliderContainer.querySelectorAll(".hero-slide"));
    let currentIndex = 0;
    const totalSlides = slides.length;
    let slideInterval = null;
    let isPaused = false;

    function updateSlides() {
      if (window.innerWidth <= 768) {
        // Mobile layout: scroll snap to active item
        if (slides[currentIndex]) {
          const scrollTarget = slides[currentIndex].offsetLeft - sliderContainer.offsetLeft;
          sliderContainer.scrollTo({ left: scrollTarget, behavior: "smooth" });
        }
      } else {
        // Desktop 3D stacked perspective transform
        slides.forEach((slide, index) => {
          slide.classList.remove("slide-active", "slide-next-1", "slide-next-2", "slide-hidden");
          const position = (index - currentIndex + totalSlides) % totalSlides;

          if (position === 0) {
            slide.classList.add("slide-active");
          } else if (position === 1) {
            slide.classList.add("slide-next-1");
          } else if (position === 2) {
            slide.classList.add("slide-next-2");
          } else {
            slide.classList.add("slide-hidden");
          }
        });

        // If GSAP is present, add subtle micro-animation to the newly active slide
        if (typeof gsap !== "undefined") {
          const activeSlide = sliderContainer.querySelector(".slide-active");
          if (activeSlide) {
            gsap.fromTo(
              activeSlide,
              { scale: 0.96, opacity: 0.9 },
              { scale: 1, opacity: 1, duration: 0.5, ease: "power2.out" }
            );
          }
        }
      }
    }

    function nextSlide() {
      currentIndex = (currentIndex + 1) % totalSlides;
      updateSlides();
    }

    function prevSlide() {
      currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
      updateSlides();
    }

    function startAutoSlide() {
      if (slideInterval) clearInterval(slideInterval);
      slideInterval = setInterval(() => {
        if (!isPaused) nextSlide();
      }, 3800);
    }

    updateSlides();
    startAutoSlide();

    // Pause auto-rotation on mouse hover
    sliderContainer.addEventListener("mouseenter", () => {
      isPaused = true;
    });
    sliderContainer.addEventListener("mouseleave", () => {
      isPaused = false;
    });

    // Advance to next slide on click
    sliderContainer.addEventListener("click", (e) => {
      if (e.target.closest("a") && !e.target.closest(".slide-active")) {
        // Clicking non-active preview card advances to it
        e.preventDefault();
      }
      nextSlide();
      startAutoSlide();
    });

    // Touch Swipe support for Mobile
    let touchStartX = 0;
    let touchEndX = 0;

    sliderContainer.addEventListener("touchstart", (e) => {
      touchStartX = e.changedTouches[0].screenX;
      isPaused = true;
    }, { passive: true });

    sliderContainer.addEventListener("touchend", (e) => {
      touchEndX = e.changedTouches[0].screenX;
      isPaused = false;
      const diffX = touchStartX - touchEndX;
      if (Math.abs(diffX) > 40) {
        if (diffX > 0) {
          nextSlide(); // Swiped left
        } else {
          prevSlide(); // Swiped right
        }
        startAutoSlide();
      }
    }, { passive: true });
  }

  /* =========================================================================
     3. Drag to Scroll functionality for Carousels
     ========================================================================= */
  const sliders = document.querySelectorAll(".carousel-wrapper");
  sliders.forEach((slider) => {
    let isDown = false;
    let isDragging = false;
    let startX;
    let scrollLeft;

    slider.querySelectorAll("img, a").forEach((el) => {
      el.addEventListener("dragstart", (e) => e.preventDefault());
      el.addEventListener("click", (e) => {
        if (isDragging) e.preventDefault();
      });
    });

    slider.style.cursor = "grab";

    slider.addEventListener("mousedown", (e) => {
      isDown = true;
      isDragging = false;
      slider.style.cursor = "grabbing";
      slider.style.scrollSnapType = "none";
      startX = e.pageX - slider.offsetLeft;
      scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener("mouseleave", () => {
      isDown = false;
      slider.style.cursor = "grab";
      slider.style.scrollSnapType = "x mandatory";
    });

    slider.addEventListener("mouseup", () => {
      isDown = false;
      slider.style.cursor = "grab";
      slider.style.scrollSnapType = "x mandatory";
      setTimeout(() => {
        isDragging = false;
      }, 50);
    });

    slider.addEventListener("mousemove", (e) => {
      if (!isDown) return;
      isDragging = true;
      e.preventDefault();
      const x = e.pageX - slider.offsetLeft;
      const walk = (x - startX) * 2;
      slider.scrollLeft = scrollLeft - walk;
    });
  });

  /* =========================================================================
     4. Mobile Drawer Accordion Toggle
     ========================================================================= */
  const accordions = document.querySelectorAll(
    ".mobile-drawer-accordion-toggle",
  );
  accordions.forEach((toggle) => {
    toggle.addEventListener("click", function (e) {
      e.preventDefault();
      this.classList.toggle("active");
      const content = this.nextElementSibling;
      if (content) {
        content.style.display =
          content.style.display === "block" ? "none" : "block";
      }
    });
  });

  /* =========================================================================
     5. Mobile Menu Drawer Toggles
     ========================================================================= */
  const openMobileMenuBtn = document.getElementById("openMobileMenuTrigger");
  const closeMobileMenuBtn = document.getElementById("closeMobileMenu");
  const mobileDrawer = document.getElementById("mobileDrawer");
  const mobileOverlay = document.getElementById("mobileOverlay");

  if (openMobileMenuBtn && mobileDrawer && mobileOverlay) {
    const toggleDrawer = (open) => {
      mobileDrawer.classList.toggle("active", open);
      mobileOverlay.classList.toggle("active", open);
      document.body.style.overflow = open ? "hidden" : "";
    };

    openMobileMenuBtn.addEventListener("click", () => toggleDrawer(true));
    if (closeMobileMenuBtn)
      closeMobileMenuBtn.addEventListener("click", () => toggleDrawer(false));
    mobileOverlay.addEventListener("click", () => toggleDrawer(false));
  }
});
