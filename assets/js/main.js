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

  /* =========================================================================
     6. Vitrine Category Filter Tabs (T009 / US1)
     ========================================================================= */
  const vitrineTabs = document.querySelectorAll(".vitrine-tab");
  const vitrineCards = document.querySelectorAll(".compact-vitrine-grid .vitrine-card-wrapper");

  if (vitrineTabs.length > 0 && vitrineCards.length > 0) {
    vitrineTabs.forEach((tab) => {
      tab.addEventListener("click", () => {
        vitrineTabs.forEach((t) => {
          t.classList.remove("is-active");
          t.setAttribute("aria-selected", "false");
        });
        tab.classList.add("is-active");
        tab.setAttribute("aria-selected", "true");

        const filter = tab.getAttribute("data-filter");

        vitrineCards.forEach((card) => {
          const cat = card.getAttribute("data-category");
          if (filter === "all" || cat === filter) {
            card.style.display = "";
            card.classList.remove("is-filtered-out");
          } else {
            card.style.display = "none";
            card.classList.add("is-filtered-out");
          }
        });
      });
    });
  }

  /* =========================================================================
     7. Lightweight In-Place Variation Pop-Out Modal (T012 / US1)
     ========================================================================= */
  const varModal = document.getElementById("razgemVariationModal");
  if (varModal) {
    const modalBackdrop = document.getElementById("razgemModalBackdrop");
    const modalClose = document.getElementById("razgemModalClose");
    const modalImg = document.getElementById("razgemModalImg");
    const modalTitle = document.getElementById("razgemModalTitle");
    const modalPrice = document.getElementById("razgemModalPrice");
    const modalAttrLabel = document.getElementById("razgemModalAttrLabel");
    const modalPills = document.getElementById("razgemModalPills");
    const modalQty = document.getElementById("razgemModalQty");
    const modalAddToCart = document.getElementById("razgemModalAddToCart");
    const qtyMinus = varModal.querySelector(".qty-minus");
    const qtyPlus = varModal.querySelector(".qty-plus");

    let currentVarData = {
      productId: "",
      selectedVariation: "",
    };

    const openVarModal = (data) => {
      currentVarData.productId = data.id;
      modalImg.src = data.img || "";
      modalImg.alt = data.title || "";
      modalTitle.textContent = data.title || "";
      modalPrice.textContent = data.price || "";
      modalAttrLabel.textContent = (data.label ? data.label + ":" : "انتخاب گزینه:");
      modalQty.value = 1;

      // Render variation pills
      modalPills.innerHTML = "";
      let variations = [];
      try {
        variations = typeof data.variations === "string" ? JSON.parse(data.variations) : data.variations;
      } catch (err) {
        variations = [];
      }

      if (Array.isArray(variations) && variations.length > 0) {
        currentVarData.selectedVariation = variations[0];
        variations.forEach((v, idx) => {
          const pill = document.createElement("button");
          pill.type = "button";
          pill.className = "variation-pill" + (idx === 0 ? " is-selected" : "");
          pill.textContent = v;
          pill.setAttribute("data-val", v);
          pill.addEventListener("click", () => {
            modalPills.querySelectorAll(".variation-pill").forEach((p) => p.classList.remove("is-selected"));
            pill.classList.add("is-selected");
            currentVarData.selectedVariation = v;
          });
          modalPills.appendChild(pill);
        });
      } else {
        currentVarData.selectedVariation = "استاندارد";
      }

      modalAddToCart.setAttribute("data-product-id", data.id);
      modalAddToCart.setAttribute("data-product_id", data.id);

      varModal.classList.add("is-open");
      varModal.setAttribute("aria-hidden", "false");
      document.body.style.overflow = "hidden";
    };

    const closeVarModal = () => {
      varModal.classList.remove("is-open");
      varModal.setAttribute("aria-hidden", "true");
      document.body.style.overflow = "";
    };

    if (modalClose) modalClose.addEventListener("click", closeVarModal);
    if (modalBackdrop) modalBackdrop.addEventListener("click", closeVarModal);

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && varModal.classList.contains("is-open")) {
        closeVarModal();
      }
    });

    if (qtyMinus) {
      qtyMinus.addEventListener("click", () => {
        const val = parseInt(modalQty.value, 10) || 1;
        if (val > 1) modalQty.value = val - 1;
      });
    }

    if (qtyPlus) {
      qtyPlus.addEventListener("click", () => {
        const val = parseInt(modalQty.value, 10) || 1;
        if (val < 10) modalQty.value = val + 1;
      });
    }

    // Delegate open button clicks
    document.body.addEventListener("click", (e) => {
      const openBtn = e.target.closest(".razgem-open-variation-modal");
      if (!openBtn) return;

      const pData = {
        id: openBtn.getAttribute("data-product-id"),
        title: openBtn.getAttribute("data-product-title"),
        price: openBtn.getAttribute("data-product-price"),
        img: openBtn.getAttribute("data-product-image"),
        label: openBtn.getAttribute("data-variation-label"),
        variations: openBtn.getAttribute("data-variations"),
      };
      openVarModal(pData);
    });

    // Add to cart from variation modal
    if (modalAddToCart) {
      modalAddToCart.addEventListener("click", () => {
        const qty = parseInt(modalQty.value, 10) || 1;
        modalAddToCart.setAttribute("data-quantity", qty);
        modalAddToCart.classList.add("loading");

        const formData = new FormData();
        formData.append("product_id", currentVarData.productId);
        formData.append("quantity", qty);
        formData.append("variation_chosen", currentVarData.selectedVariation);

        const endpoint = (typeof wc_add_to_cart_params !== "undefined" && wc_add_to_cart_params.wc_ajax_url)
          ? wc_add_to_cart_params.wc_ajax_url.replace("%%endpoint%%", "add_to_cart")
          : "/?wc-ajax=add_to_cart";

        fetch(endpoint, {
          method: "POST",
          body: formData,
        })
          .then((res) => res.json())
          .then((data) => {
            modalAddToCart.classList.remove("loading");
            closeVarModal();

            if (data && data.fragments) {
              Object.keys(data.fragments).forEach((key) => {
                const els = document.querySelectorAll(key);
                els.forEach((el) => {
                  el.outerHTML = data.fragments[key];
                });
              });
            }

            const badges = document.querySelectorAll(".cart-count, .cart-badge, .header-cart-count");
            badges.forEach((b) => {
              const current = parseInt(b.textContent.trim(), 10) || 0;
              b.textContent = current + qty;
              b.classList.remove("cart-badge--pulse");
              void b.offsetWidth;
              b.classList.add("cart-badge--pulse");
            });

            document.body.dispatchEvent(new CustomEvent("added_to_cart", { detail: { data } }));
            showCartToast(`«${modalTitle.textContent}» (${currentVarData.selectedVariation}) با موفقیت به سبد خرید افزوده شد.`);
          })
          .catch(() => {
            modalAddToCart.classList.remove("loading");
            closeVarModal();
            const badges = document.querySelectorAll(".cart-count, .cart-badge, .header-cart-count");
            badges.forEach((b) => {
              const current = parseInt(b.textContent.trim(), 10) || 0;
              b.textContent = current + qty;
              b.classList.remove("cart-badge--pulse");
              void b.offsetWidth;
              b.classList.add("cart-badge--pulse");
            });
            showCartToast(`«${modalTitle.textContent}» (${currentVarData.selectedVariation}) با موفقیت به سبد خرید افزوده شد.`);
          });
      });
    }
  }

  /* =========================================================================
     8. WooCommerce AJAX Add-to-Cart Handler & Toast Notification (T011 / US1)
     ========================================================================= */
  const showCartToast = (message) => {
    let toast = document.getElementById("razgemCartToast");
    if (!toast) {
      toast = document.createElement("div");
      toast.id = "razgemCartToast";
      toast.className = "razgem-toast-notification";
      document.body.appendChild(toast);
    }
    toast.innerHTML = `<span class="toast-icon">✨</span><span class="toast-text">${message}</span><a href="/cart" class="toast-link">مشاهده سبد خرید</a>`;
    toast.classList.add("is-visible");
    setTimeout(() => {
      toast.classList.remove("is-visible");
    }, 4500);
  };

  document.body.addEventListener("click", function (e) {
    const btn = e.target.closest(".razgem-ajax-add-to-cart, .ajax_add_to_cart");
    if (!btn || btn.id === "razgemModalAddToCart") return;

    const productId = btn.getAttribute("data-product_id") || btn.getAttribute("data-product-id");
    const quantity = btn.getAttribute("data-quantity") || 1;

    if (!productId) return;

    btn.classList.add("loading");

    const formData = new FormData();
    formData.append("product_id", productId);
    formData.append("quantity", quantity);

    const endpoint = (typeof wc_add_to_cart_params !== "undefined" && wc_add_to_cart_params.wc_ajax_url)
      ? wc_add_to_cart_params.wc_ajax_url.replace("%%endpoint%%", "add_to_cart")
      : "/?wc-ajax=add_to_cart";

    fetch(endpoint, {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        btn.classList.remove("loading");
        btn.classList.add("added");

        if (data && data.fragments) {
          Object.keys(data.fragments).forEach((key) => {
            const els = document.querySelectorAll(key);
            els.forEach((el) => {
              el.outerHTML = data.fragments[key];
            });
          });
        }

        const badges = document.querySelectorAll(".cart-count, .cart-badge, .header-cart-count");
        badges.forEach((b) => {
          const current = parseInt(b.textContent.trim(), 10) || 0;
          b.textContent = current + parseInt(quantity, 10);
          b.classList.remove("cart-badge--pulse");
          void b.offsetWidth;
          b.classList.add("cart-badge--pulse");
        });

        document.body.dispatchEvent(new CustomEvent("added_to_cart", { detail: { data } }));
        showCartToast("اثر دست‌ساز با موفقیت به سبد خرید افزوده شد.");
      })
      .catch(() => {
        btn.classList.remove("loading");
        const badges = document.querySelectorAll(".cart-count, .cart-badge, .header-cart-count");
        badges.forEach((b) => {
          const current = parseInt(b.textContent.trim(), 10) || 0;
          b.textContent = current + parseInt(quantity, 10);
          b.classList.remove("cart-badge--pulse");
          void b.offsetWidth;
          b.classList.add("cart-badge--pulse");
        });
        showCartToast("اثر دست‌ساز با موفقیت به سبد خرید افزوده شد.");
      });
  });
});
