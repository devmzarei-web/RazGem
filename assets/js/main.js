/**
 * RazGem Luxury Jewelry Theme JavaScript
 * Zero-CDN Architecture with Local GSAP 3.12.5 Animations
 *
 * @package RazGem
 */

document.addEventListener("DOMContentLoaded", () => {
  /* =========================================================================
     1. GSAP Scroll Animations & Luxury Viewport Reveals (T019 / US3)
     ========================================================================= */
  if (typeof gsap !== "undefined") {
    if (typeof ScrollTrigger !== "undefined") {
      gsap.registerPlugin(ScrollTrigger);
    }

    const prefersReducedMotion = window.matchMedia(
      "(prefers-reduced-motion: reduce)"
    ).matches;

    if (!prefersReducedMotion) {
      // 1.1 Haute-Joaillerie Hero Entrance Timeline
      const heroTl = gsap.timeline({ defaults: { ease: "power3.out" } });

      if (document.querySelector(".razgem-hero-spotlight")) {
        heroTl
          .fromTo(
            ".razgem-spotlight-frame",
            { opacity: 0, scale: 0.92, y: 30 },
            { opacity: 1, scale: 1, y: 0, duration: 1.2 }
          )
          .fromTo(
            ".razgem-spotlight-halo",
            { opacity: 0, scale: 0.8 },
            { opacity: 1, scale: 1, duration: 1.4 },
            "-=1.0"
          )
          .fromTo(
            ".razgem-hero-badge, .razgem-hero-title, .razgem-hero-subtitle, .razgem-hero-cta-group, .razgem-hero-trust-bar",
            { opacity: 0, y: 25 },
            { opacity: 1, y: 0, stagger: 0.12, duration: 0.9 },
            "-=1.0"
          )
          .fromTo(
            ".razgem-hotspot-pin",
            { opacity: 0, scale: 0 },
            { opacity: 1, scale: 1, stagger: 0.2, ease: "back.out(2)", duration: 0.6 },
            "-=0.4"
          );
      }

      // 1.2 ScrollTrigger: Section Titles & Eyebrows
      if (typeof ScrollTrigger !== "undefined") {
        gsap.utils.toArray(".section-header, .razgem-section-heading").forEach((header) => {
          gsap.from(header, {
            scrollTrigger: {
              trigger: header,
              start: "top 85%",
              toggleActions: "play none none none",
            },
            opacity: 0,
            y: 30,
            duration: 0.8,
            ease: "power2.out",
          });
        });

        // 1.3 ScrollTrigger: Category Mosaic Cards
        if (document.querySelector(".razgem-category-mosaic")) {
          gsap.from(".mosaic-card", {
            scrollTrigger: {
              trigger: ".razgem-category-mosaic",
              start: "top 80%",
            },
            opacity: 0,
            y: 35,
            stagger: 0.18,
            duration: 0.9,
            ease: "power2.out",
          });
        }

        // 1.4 ScrollTrigger: Artisan Atelier Section
        if (document.querySelector(".razgem-atelier-section")) {
          gsap.from(".razgem-atelier-frame", {
            scrollTrigger: {
              trigger: ".razgem-atelier-section",
              start: "top 75%",
            },
            opacity: 0,
            x: -30,
            duration: 1,
            ease: "power3.out",
          });

          gsap.from(".razgem-atelier-content > *", {
            scrollTrigger: {
              trigger: ".razgem-atelier-section",
              start: "top 75%",
            },
            opacity: 0,
            x: 30,
            stagger: 0.12,
            duration: 0.8,
            ease: "power2.out",
          });
        }

        // 1.5 ScrollTrigger: Product Cards & Feature Pills
        gsap.utils.toArray(".product-carousel-section").forEach((section) => {
          const cards = section.querySelectorAll(".product-card");
          if (cards.length > 0) {
            gsap.from(cards, {
              scrollTrigger: {
                trigger: section,
                start: "top 80%",
              },
              opacity: 0,
              y: 25,
              stagger: 0.08,
              duration: 0.6,
              ease: "power2.out",
            });
          }
        });

        gsap.from(".feature-card", {
          scrollTrigger: { trigger: ".features-section", start: "top 85%" },
          opacity: 0,
          y: 20,
          stagger: 0.1,
          duration: 0.6,
          ease: "power2.out",
        });
      }
    } else {
      // Reduced motion fallback: instantly reveal all elements
      gsap.set(
        ".razgem-spotlight-frame, .razgem-spotlight-halo, .razgem-hero-badge, .razgem-hero-title, .razgem-hero-subtitle, .razgem-hero-cta-group, .razgem-hero-trust-bar, .razgem-hotspot-pin, .mosaic-card, .razgem-atelier-frame, .razgem-atelier-content > *, .product-card, .feature-card",
        { opacity: 1, y: 0, x: 0, scale: 1 }
      );
    }
  }

  /* =========================================================================
     2. Haute-Joaillerie Hero Showcase Slider (2-3 Slides with Auto-Rotation)
     ========================================================================= */
  const heroSlider = document.getElementById("razgemHeroSlider");
  if (heroSlider) {
    const slides = heroSlider.querySelectorAll(".razgem-hero-slide");
    const dots = heroSlider.querySelectorAll(".razgem-dot");
    const prevBtn = heroSlider.querySelector(".razgem-slider-btn.prev");
    const nextBtn = heroSlider.querySelector(".razgem-slider-btn.next");
    let currentIndex = 0;
    let autoSlideTimer = null;
    const slideInterval = 5000;

    function goToSlide(index) {
      if (slides.length <= 1) return;
      if (index < 0) {
        index = slides.length - 1;
      } else if (index >= slides.length) {
        index = 0;
      }
      currentIndex = index;

      slides.forEach((slide, idx) => {
        const isActive = idx === currentIndex;
        slide.classList.toggle("is-active", isActive);
        if (isActive) {
          const img = slide.querySelector(".razgem-spotlight-img");
          if (typeof gsap !== "undefined" && img) {
            gsap.fromTo(img, { scale: 1.06 }, { scale: 1, duration: 1.2, ease: "power2.out" });
          }
        }
      });

      dots.forEach((dot, idx) => {
        dot.classList.toggle("is-active", idx === currentIndex);
      });
    }

    function startAutoSlide() {
      stopAutoSlide();
      autoSlideTimer = setInterval(() => {
        goToSlide(currentIndex + 1);
      }, slideInterval);
    }

    function stopAutoSlide() {
      if (autoSlideTimer) {
        clearInterval(autoSlideTimer);
        autoSlideTimer = null;
      }
    }

    if (prevBtn) {
      prevBtn.addEventListener("click", () => {
        goToSlide(currentIndex - 1);
        startAutoSlide();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener("click", () => {
        goToSlide(currentIndex + 1);
        startAutoSlide();
      });
    }

    dots.forEach((dot) => {
      dot.addEventListener("click", () => {
        const targetIndex = parseInt(dot.getAttribute("data-go-to"), 10) || 0;
        goToSlide(targetIndex);
        startAutoSlide();
      });
    });

    // Pause on hover
    heroSlider.addEventListener("mouseenter", stopAutoSlide);
    heroSlider.addEventListener("mouseleave", startAutoSlide);

    // Touch Swipe Support
    let touchStartX = 0;
    let touchEndX = 0;

    heroSlider.addEventListener("touchstart", (e) => {
      touchStartX = e.changedTouches[0].screenX;
      stopAutoSlide();
    }, { passive: true });

    heroSlider.addEventListener("touchend", (e) => {
      touchEndX = e.changedTouches[0].screenX;
      const diffX = touchEndX - touchStartX;
      if (Math.abs(diffX) > 45) {
        if (diffX > 0) {
          goToSlide(currentIndex - 1);
        } else {
          goToSlide(currentIndex + 1);
        }
      }
      startAutoSlide();
    }, { passive: true });

    // Initialize auto-rotation
    if (slides.length > 1) {
      startAutoSlide();
    }
  }

  /* =========================================================================
     3. Interactive Hotspot Pins with Expandable Tooltips (T020 / US2 & US3)
     ========================================================================= */
  const hotspotPins = document.querySelectorAll(".razgem-hotspot-pin");
  if (hotspotPins.length > 0) {
    hotspotPins.forEach((pin) => {
      // Click/Tap toggle for touchscreens and desktop inspection
      pin.addEventListener("click", (e) => {
        e.stopPropagation();
        const isActive = pin.classList.contains("is-active");
        // Close other active pins
        hotspotPins.forEach((p) => p.classList.remove("is-active"));
        if (!isActive) {
          pin.classList.add("is-active");
        }
      });

      // Keyboard accessibility (Enter & Space)
      pin.addEventListener("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") {
          e.preventDefault();
          pin.click();
        }
      });
    });

    // Close any active tooltip when clicking elsewhere
    document.addEventListener("click", () => {
      hotspotPins.forEach((p) => p.classList.remove("is-active"));
    });
  }

  /* =========================================================================
     3. Smooth Drag-to-Scroll for Horizontal Carousels
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
  const accordions = document.querySelectorAll(".mobile-drawer-accordion-toggle");
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
