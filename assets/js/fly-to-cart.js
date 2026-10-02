/**
 * RazGem Fly-to-Cart Micro-Animation
 * High-performance, GPU-accelerated parabolic trajectory for cart interactions.
 * 
 * @package RazGem
 */
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    function initFlyToCart() {
        document.body.addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-fly-trigger, .single_add_to_cart_button, .ajax_add_to_cart, .product-card-cart-btn:not(.disabled), .btn-coastal-action');
            if (!btn || btn.classList.contains('disabled')) return;

            // 1. Locate closest source product image
            let srcImg = null;
            const singleVitrine = document.querySelector('.single-product-vitrine, .product-gallery-section');
            if (singleVitrine && singleVitrine.contains(btn)) {
                srcImg = document.getElementById('mainProductDisplay') || singleVitrine.querySelector('img');
            } else {
                const card = btn.closest('.product-card, .carousel-card, .shop-item-wrapper, .modal-box, .stella-product-card');
                if (card) {
                    srcImg = card.querySelector('.img-primary') || card.querySelector('.stella-img-main') || card.querySelector('img');
                }
            }

            if (!srcImg) return;

            // 2. Locate target cart icon in header or mobile bar
            const cartBtn = document.querySelector('.cart-icon-wrapper') ||
                            document.querySelector('.header-cart-btn') || 
                            document.querySelector('.mobile-cart-btn') || 
                            document.querySelector('.cart-link');
            if (!cartBtn) return;

            // 3. Compute source and target coordinates
            const srcRect = srcImg.getBoundingClientRect();
            const targetRect = cartBtn.getBoundingClientRect();

            if (srcRect.width === 0 || srcRect.height === 0) return;

            // 4. Create floating sprite clone
            const flyer = document.createElement('img');
            flyer.src = srcImg.src;
            flyer.alt = '';
            flyer.className = 'razgem-flying-sprite';
            flyer.style.position = 'fixed';
            flyer.style.zIndex = '999999';
            flyer.style.pointerEvents = 'none';
            flyer.style.left = srcRect.left + 'px';
            flyer.style.top = srcRect.top + 'px';
            flyer.style.width = srcRect.width + 'px';
            flyer.style.height = srcRect.height + 'px';
            flyer.style.borderRadius = '16px';
            flyer.style.objectFit = 'cover';
            flyer.style.boxShadow = '0 12px 30px rgba(27, 51, 71, 0.3)';
            flyer.style.transition = 'transform 0.65s cubic-bezier(0.2, 0.8, 0.2, 1), opacity 0.65s ease, border-radius 0.65s ease';
            flyer.style.transformOrigin = 'center center';

            document.body.appendChild(flyer);

            // 5. Trigger animation on next frame
            requestAnimationFrame(function () {
                const targetX = targetRect.left + (targetRect.width / 2) - (srcRect.left + (srcRect.width / 2));
                const targetY = targetRect.top + (targetRect.height / 2) - (srcRect.top + (srcRect.height / 2));

                flyer.style.transform = `translate3d(${targetX}px, ${targetY}px, 0) scale(0.12) rotate(-15deg)`;
                flyer.style.opacity = '0.35';
                flyer.style.borderRadius = '50%';
            });

            // 6. On arrival: pulse target cart badge and remove flyer
            setTimeout(function () {
                if (flyer.parentNode) {
                    flyer.parentNode.removeChild(flyer);
                }

                const badge = cartBtn.querySelector('.cart-count, .cart-badge, .header-cart-count');
                if (badge) {
                    badge.classList.remove('cart-badge--pulse');
                    void badge.offsetWidth; // trigger reflow
                    badge.classList.add('cart-badge--pulse');
                }

                cartBtn.classList.remove('cart-icon--bounce');
                void cartBtn.offsetWidth;
                cartBtn.classList.add('cart-icon--bounce');
            }, 650);
        });
    }

    initFlyToCart();
});
