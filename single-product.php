<?php
/**
 * Template for displaying all single products (3-Column Layout)
 */
defined( 'ABSPATH' ) || exit;
get_header(); ?>

<main class="site-container single-product-page" dir="rtl" role="main">
    <?php while ( have_posts() ) : the_post(); global $product; ?>
        
        <nav class="product-breadcrumbs" aria-label="Breadcrumb">
            <?php woocommerce_breadcrumb(); ?>
        </nav>

        <article id="product-<?php the_ID(); ?>" <?php wc_product_class( 'product-main-grid', $product ); ?>>
            
            <div class="product-gallery-custom">
                <?php 
                $main_image_url = wp_get_attachment_image_url( $product->get_image_id(), 'full' );
                $attachment_ids = $product->get_gallery_image_ids();
                ?>
                <div class="main-image-container" onclick="openLightbox()" title="کلیک کنید برای بزرگ‌نمایی">
                    <img id="mainProductImage" src="<?php echo esc_url($main_image_url); ?>" data-original-src="<?php echo esc_url($main_image_url); ?>" alt="<?php echo esc_attr(the_title_attribute('echo=0')); ?>">
                </div>
                
                <?php if ( $attachment_ids ) : ?>
                    <div class="thumbnail-row">
                        <img src="<?php echo esc_url($main_image_url); ?>" class="gallery-thumb active-thumb" onclick="swapImage(this, '<?php echo esc_url($main_image_url); ?>')" alt="Thumbnail">
                        <?php foreach ( $attachment_ids as $attachment_id ) : 
                            $thumb_url = wp_get_attachment_image_url( $attachment_id, 'full' );
                        ?>
                            <img src="<?php echo esc_url($thumb_url); ?>" class="gallery-thumb" onclick="swapImage(this, '<?php echo esc_url($thumb_url); ?>')" alt="Thumbnail">
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="product-info-center">
                <h1 class="product-title"><?php the_title(); ?></h1>
                
                <div class="product-rating-link">
                    <a href="#reviews">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#f39c12" stroke="#f39c12" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <?php echo esc_html($product->get_review_count()); ?> دیدگاه کاربران
                    </a>
                </div>

                <div class="product-key-features">
                    <h3>ویژگی‌های محصول</h3>
                    <?php wc_display_product_attributes( $product ); ?>
                </div>

                <?php if ( has_excerpt() ) : ?>
                    <div class="product-short-desc">
                        <h3>خلاصه توضیحات</h3>
                        <?php the_excerpt(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="product-buy-box">
                <div class="seller-info-card">
                    <div class="seller-badge">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span class="seller-label">سازنده و اصالت:</span>
                        <span class="seller-name">گالری طلا و جواهرات رازگِم</span>
                    </div>
                </div>

                <div class="buy-box-trust-list">
                    <div class="trust-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        <span>ضمانت اصالت طلای ۱۸ عیار و سنگ‌های طبیعی</span>
                    </div>
                    <div class="trust-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#27ae60" stroke-width="2.5"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                        <span>ارسال رایگان و بیمه شده به سراسر کشور</span>
                    </div>
                    <div class="trust-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#A67C1E" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <span>بسته‌بندی نفیس کادویی همراه شناسنامه</span>
                    </div>
                </div>

                <div class="buy-box-divider"></div>

                <!-- Ring Size Guide Trigger (T017 / FR-018) -->
                <div class="size-guide-trigger-wrap">
                    <button type="button" class="ring-size-guide-btn" onclick="openSizeGuideModal()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
                        <span>راهنمای انتخاب سایز انگشتر</span>
                    </button>
                </div>

                <div class="stock-status-wrapper">
                    <?php echo wc_get_stock_html( $product ); ?>
                </div>

                <div class="product-price-box">
                    <?php echo $product->get_price_html(); ?>
                </div>

                <div class="add-to-cart-wrapper">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>

                <div class="product-shortlink-box">
                    <div class="shortlink-header">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                        <span>اشتراک‌گذاری با لینک کوتاه:</span>
                    </div>
                    <div class="shortlink-field">
                        <input type="text" readonly value="<?php echo esc_url( function_exists('razgem_get_product_shortlink') ? razgem_get_product_shortlink($product->get_id()) : (function_exists('golkhane_get_product_shortlink') ? golkhane_get_product_shortlink($product->get_id()) : home_url('/p/' . $product->get_id())) ); ?>" class="shortlink-input" id="razgemShortLinkInput" dir="ltr" onclick="this.select()">
                        <button type="button" class="copy-shortlink-btn" onclick="copyProductShortLink(this)" aria-label="کپی لینک کوتاه">
                            <svg class="icon-copy" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                            <span class="copy-btn-text">کپی لینک</span>
                        </button>
                    </div>
                </div>
            </div>

        </article> 
        
        <div class="product-bottom-sections">
            <?php 
            /* 
               This single hook safely loads the Tabs, then Related Products, 
               then our Custom Reviews (hooked via functions.php) in perfect order 
               without duplicating any elements!
            */
            do_action( 'woocommerce_after_single_product_summary' ); 
            ?>
        </div>

    <?php endwhile; ?>
</main>

<div class="mobile-sticky-buy-bar" id="mobileStickyBuyBar">
    <div class="sticky-buy-info">
        <img src="<?php echo esc_url($main_image_url); ?>" alt="<?php echo esc_attr(the_title_attribute('echo=0')); ?>">
        <div class="sticky-buy-text">
            <h4 class="sticky-title"><?php the_title(); ?></h4>
            <div class="sticky-price"><?php echo $product->get_price_html(); ?></div>
        </div>
    </div>
    <?php if ( ! $product->is_in_stock() ) : ?>
        <button type="button" class="sticky-buy-btn disabled" id="triggerMobileBuy" disabled aria-disabled="true">ناموجود</button>
    <?php else : ?>
        <button type="button" class="sticky-buy-btn" id="triggerMobileBuy">افزودن به سبد خرید</button>
    <?php endif; ?>
</div>

<script>
(function() {
    window.swapImage = function(element, newSrc) {
        document.getElementById('mainProductImage').src = newSrc;
        document.querySelectorAll('.gallery-thumb').forEach(thumb => thumb.classList.remove('active-thumb'));
        element.classList.add('active-thumb');
    };

    document.addEventListener('DOMContentLoaded', function() {
        const cartForm = document.querySelector('form.cart');
        if (!cartForm) return;

        const nativeQtyDiv = cartForm.querySelector('.quantity');
        if (nativeQtyDiv) nativeQtyDiv.style.display = 'none';

        const submitBtn = cartForm.querySelector('.single_add_to_cart_button');
        if (!submitBtn) return;
        
        const originalBtnText = submitBtn.innerHTML;

        // Create Morph Cart Controls
        const morphWrapper = document.createElement('div');
        morphWrapper.className = 'morph-cart-wrapper';
        morphWrapper.style.display = 'none';
        morphWrapper.innerHTML = `
            <div class="morph-cart-container">
                <button type="button" class="morph-btn morph-plus" aria-label="Increase Quantity">+</button>
                <span class="morph-qty">1</span>
                <button type="button" class="morph-btn morph-minus" aria-label="Decrease Quantity">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </button>
            </div>
            <a href="/checkout" class="morph-checkout-btn">تکمیل سفارش و تسویه حساب</a>
        `;
        
        submitBtn.parentNode.insertBefore(morphWrapper, submitBtn.nextSibling);
        let currentQty = 0;

        function getProductId() {
            const pidInput = cartForm.querySelector('input[name="product_id"]') || cartForm.querySelector('input[name="add-to-cart"]') || cartForm.querySelector('button[name="add-to-cart"]');
            return pidInput ? parseInt(pidInput.value, 10) : 0;
        }

        function getVariationId() {
            const varInput = cartForm.querySelector('input[name="variation_id"]');
            return varInput ? parseInt(varInput.value, 10) || 0 : 0;
        }

        function isVariableProduct() {
            return cartForm.classList.contains('variations_form') || !!cartForm.querySelector('input[name="variation_id"]');
        }

        function showWarning(msg) {
            let toast = document.querySelector('.cart-warning-toast');
            if (!toast) {
                toast = document.createElement('div');
                toast.className = 'cart-warning-toast';
                cartForm.appendChild(toast);
            }
            toast.textContent = msg;
            toast.classList.add('active');
            setTimeout(() => toast.classList.remove('active'), 3500);

            const swatches = cartForm.querySelectorAll('.razgem-swatch-wrapper, .golkhane-swatch-wrapper');
            swatches.forEach(s => {
                s.classList.add('swatch-error-highlight');
                setTimeout(() => s.classList.remove('swatch-error-highlight'), 2000);
            });
        }

        function getCartTargetElement() {
            if (window.innerWidth <= 992) {
                const bottomNavCart = document.querySelector('.magic-bottom-nav .nav-cart-icon') || document.querySelector('.magic-bottom-nav li:nth-child(3) .icon') || document.querySelector('.magic-bottom-nav li:nth-child(3)');
                if (bottomNavCart && bottomNavCart.getBoundingClientRect().height > 0) {
                    return bottomNavCart;
                }
            }
            return document.getElementById('openMiniCart') || document.querySelector('.nav-cart-icon') || document.querySelector('.magic-bottom-nav li:nth-child(3)');
        }

        function triggerFlyToCartAnimation(startRect) {
            const targetHeaderCart = getCartTargetElement();
            if (!targetHeaderCart || !startRect) return;

            const targetRect = targetHeaderCart.getBoundingClientRect();

            const flyer = document.createElement('div');
            flyer.className = 'flying-cart-item';

            const mainImg = document.getElementById('mainProductImage');
            if (mainImg && mainImg.src && mainImg.naturalWidth > 0) {
                flyer.style.backgroundImage = `url("${mainImg.src}")`;
            } else {
                flyer.innerHTML = `<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>`;
            }

            const flyerSize = 48;
            const startX = startRect.left + startRect.width / 2 - flyerSize / 2;
            const startY = startRect.top + startRect.height / 2 - flyerSize / 2;
            const endX = targetRect.left + targetRect.width / 2 - flyerSize / 2;
            const endY = targetRect.top + targetRect.height / 2 - flyerSize / 2;

            flyer.style.left = startX + 'px';
            flyer.style.top = startY + 'px';
            document.body.appendChild(flyer);

            const deltaX = endX - startX;
            const deltaY = endY - startY;

            function onArrival() {
                flyer.remove();
                targetHeaderCart.classList.add('cart-icon-bounce');
                const badge = document.querySelector('.nav-cart-count') || document.querySelector('.cart-count');
                if (badge) badge.classList.add('cart-icon-bounce');
                setTimeout(() => {
                    targetHeaderCart.classList.remove('cart-icon-bounce');
                    if (badge) badge.classList.remove('cart-icon-bounce');
                }, 700);
            }

            if (typeof gsap !== 'undefined') {
                gsap.to(flyer, {
                    duration: 0.7,
                    x: deltaX,
                    y: deltaY,
                    scale: 0.2,
                    rotation: 360,
                    opacity: 0.9,
                    ease: 'power2.inOut',
                    onComplete: onArrival
                });
            } else {
                flyer.style.transition = 'transform 0.7s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.7s ease';
                requestAnimationFrame(() => {
                    flyer.style.transform = `translate(${deltaX}px, ${deltaY}px) scale(0.2) rotate(360deg)`;
                    flyer.style.opacity = '0.9';
                });
                setTimeout(onArrival, 720);
            }
        }

        const ajaxUrl = (typeof razgem_ajax !== 'undefined' && razgem_ajax.ajax_url) ? razgem_ajax.ajax_url : '/wp-admin/admin-ajax.php';
        const ajaxNonce = (typeof razgem_ajax !== 'undefined' && razgem_ajax.nonce) ? razgem_ajax.nonce : '';

        function syncCartWithServer(qty) {
            const pId = getProductId();
            const vId = getVariationId();

            const data = new URLSearchParams();
            data.append('action', 'razgem_update_morph_cart');
            data.append('product_id', pId);
            data.append('variation_id', vId);
            data.append('qty', qty);
            if (ajaxNonce) data.append('nonce', ajaxNonce);

            const attrInputs = cartForm.querySelectorAll('select[name^="attribute_"], input[name^="attribute_"]');
            attrInputs.forEach(input => {
                if (input.name && input.value) {
                    data.append(input.name, input.value);
                }
            });

            fetch(ajaxUrl, {
                method: 'POST',
                body: data,
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    if (response.data && response.data.fragments) {
                        for (let key in response.data.fragments) {
                            const elems = document.querySelectorAll(key);
                            elems.forEach(el => { el.outerHTML = response.data.fragments[key]; });
                        }
                    }
                    if (window.jQuery) {
                        jQuery(document.body).trigger('wc_fragment_refresh');
                    }
                }
            })
            .catch(err => console.error('Cart sync failed:', err));
        }

        function checkInCartQty(targetVarId) {
            const pId = getProductId();
            const vId = targetVarId || getVariationId();

            const data = new URLSearchParams();
            data.append('action', 'razgem_update_morph_cart');
            data.append('product_id', pId);
            data.append('variation_id', vId);
            data.append('check_only', '1');
            if (ajaxNonce) data.append('nonce', ajaxNonce);

            fetch(ajaxUrl, {
                method: 'POST',
                body: data,
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(res => res.json())
            .then(res => {
                if (res.success && res.data.in_cart_qty > 0) {
                    currentQty = res.data.in_cart_qty;
                    submitBtn.style.display = 'none';
                    morphWrapper.querySelector('.morph-qty').textContent = currentQty;
                    morphWrapper.style.display = 'flex';
                } else {
                    currentQty = 0;
                    morphWrapper.style.display = 'none';
                    submitBtn.style.display = 'flex';
                }
            });
        }

        // Check initial cart state for simple product
        if (!isVariableProduct()) {
            checkInCartQty(0);
        }

        // Handle WooCommerce variation change events
        if (window.jQuery) {
            jQuery(cartForm).on('found_variation', function(e, variation) {
                if (variation && variation.variation_id) {
                    checkInCartQty(variation.variation_id);
                }
            });
            jQuery(cartForm).on('reset_data', function() {
                currentQty = 0;
                morphWrapper.style.display = 'none';
                submitBtn.style.display = 'flex';
            });
        }

        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (isVariableProduct()) {
                const varId = getVariationId();
                if (!varId) {
                    showWarning('لطفاً ابتدا ویژگی‌های محصول (رنگ، سایز و...) را انتخاب کنید.');
                    return;
                }
            }

            const startRect = submitBtn.getBoundingClientRect();
            triggerFlyToCartAnimation(startRect);

            currentQty = 1;
            submitBtn.style.display = 'none';
            morphWrapper.querySelector('.morph-qty').textContent = currentQty;
            morphWrapper.style.display = 'flex';
            syncCartWithServer(currentQty);
        });

        morphWrapper.querySelector('.morph-plus').addEventListener('click', function() {
            currentQty++;
            morphWrapper.querySelector('.morph-qty').textContent = currentQty;
            syncCartWithServer(currentQty);
        });

        morphWrapper.querySelector('.morph-minus').addEventListener('click', function() {
            currentQty--;
            if (currentQty > 0) {
                morphWrapper.querySelector('.morph-qty').textContent = currentQty;
                syncCartWithServer(currentQty);
            } else {
                morphWrapper.style.display = 'none';
                submitBtn.style.display = 'flex';
                submitBtn.innerHTML = originalBtnText;
                syncCartWithServer(0); 
            }
        });

        // Mobile Sticky Buy Bar Trigger Controller & Scroll Observer
        const stickyBar = document.getElementById('mobileStickyBuyBar');
        const triggerBtn = document.getElementById('triggerMobileBuy');

        if (stickyBar) {
            const buyBoxCard = document.querySelector('.product-buy-box') || submitBtn;
            if ('IntersectionObserver' in window && buyBoxCard) {
                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (!entry.isIntersecting) {
                            stickyBar.classList.add('active');
                        } else {
                            stickyBar.classList.remove('active');
                        }
                    });
                }, { threshold: 0.1 });
                observer.observe(buyBoxCard);
            } else {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 300) {
                        stickyBar.classList.add('active');
                    } else {
                        stickyBar.classList.remove('active');
                    }
                });
            }
        }

        if (triggerBtn) {
            triggerBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (isVariableProduct()) {
                    const varId = getVariationId();
                    if (!varId) {
                        const variationsTable = cartForm.querySelector('.variations') || cartForm;
                        variationsTable.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        showWarning('لطفاً ابتدا گزینه مورد نظر (سایز، رنگ و...) را انتخاب کنید.');
                        return;
                    }
                }

                if (morphWrapper && morphWrapper.style.display !== 'none') {
                    const morphPlus = morphWrapper.querySelector('.morph-plus');
                    if (morphPlus) morphPlus.click();
                } else if (submitBtn && submitBtn.style.display !== 'none') {
                    submitBtn.click();
                }
            });
        }
    });
})();
</script>

<!-- Product Lightbox Overlay Modal -->
<div id="razgemLightbox" class="razgem-lightbox-overlay golkhane-lightbox-overlay" aria-hidden="true">
    <div class="lightbox-backdrop" onclick="closeLightbox()"></div>
    <div class="lightbox-content">
        <button type="button" class="lightbox-close-btn" onclick="closeLightbox()" title="بستن (Esc)">&times;</button>
        <div class="lightbox-counter" id="lightboxCounter">۱ از ۱</div>
        <div class="lightbox-image-wrapper">
            <button type="button" class="lightbox-nav-btn lightbox-prev" onclick="navigateLightbox(1)" title="بعدی">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
            <img id="lightboxMainImage" src="" alt="تصویر محصول">
            <button type="button" class="lightbox-nav-btn lightbox-next" onclick="navigateLightbox(-1)" title="قبلی">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
        </div>
    </div>
</div>

<!-- Ring Size Guide Modal (T017 / FR-018) -->
<div id="ringSizeGuideModal" class="size-guide-modal-overlay" aria-hidden="true">
    <div class="size-guide-backdrop" onclick="closeSizeGuideModal()"></div>
    <div class="size-guide-dialog" role="dialog" aria-labelledby="sizeGuideTitle" aria-modal="true">
        <button type="button" class="size-guide-close" onclick="closeSizeGuideModal()" aria-label="بستن">&times;</button>
        <div class="size-guide-header">
            <h3 id="sizeGuideTitle">راهنمای جامع تعیین سایز انگشتر رازگِم</h3>
            <p>راهنمای گام‌به‌گام اندازه‌گیری دقیق دور انگشت در منزل</p>
        </div>
        <div class="size-guide-body">
            <div class="size-step-item">
                <span class="size-step-num">۱</span>
                <p>یک نوار کاغذی باریک یا تکه نخ را دور عریض‌ترین قسمت مفصل انگشت مورد نظر بپیچید.</p>
            </div>
            <div class="size-step-item">
                <span class="size-step-num">۲</span>
                <p>محل دقیق برخورد دو سر نوار را با خودکار علامت زده و طول آن را با خط‌کش (به میلی‌متر) اندازه بگیرید.</p>
            </div>
            <div class="size-step-item">
                <span class="size-step-num">۳</span>
                <p>عدد میلی‌متر حاصل را با ستون محیط در جدول زیر مطابقت دهید تا سایز مناسب شما مشخص شود:</p>
            </div>
            <div class="size-table-responsive">
                <table class="size-guide-table">
                    <thead>
                        <tr>
                            <th>محیط انگشت (mm)</th>
                            <th>قطر داخلی (mm)</th>
                            <th>سایز استاندارد ایران / اروپا</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>۵۰ میلی‌متر</td><td>۱۵.۹</td><td><strong>۵۰</strong></td></tr>
                        <tr><td>۵۲ میلی‌متر</td><td>۱۶.۵</td><td><strong>۵۲</strong></td></tr>
                        <tr><td>۵۴ میلی‌متر</td><td>۱۷.۲</td><td><strong>۵۴</strong></td></tr>
                        <tr><td>۵۶ میلی‌متر</td><td>۱۷.۸</td><td><strong>۵۶</strong></td></tr>
                        <tr><td>۵۸ میلی‌متر</td><td>۱۸.۵</td><td><strong>۵۸</strong></td></tr>
                        <tr><td>۶۰ میلی‌متر</td><td>۱۹.۱</td><td><strong>۶۰</strong></td></tr>
                    </tbody>
                </table>
            </div>
            <p class="size-guide-tip"><strong>نکته مهم:</strong> در صورتی که اندازه شما بین دو سایز قرار دارد، همواره انتخاب سایز بزرگ‌تر توصیه می‌شود. همچنین در صورت نیاز به سایز سفارشی با پشتیبانی رازگِم تماس حاصل فرمایید.</p>
        </div>
    </div>
</div>

<script>
(function() {
    let currentLightboxIndex = 0;
    let extraVariationImages = [];

    function getGalleryImages() {
        const images = [];
        extraVariationImages.forEach(img => {
            if (img && !images.includes(img)) images.push(img);
        });
        const mainImg = document.getElementById('mainProductImage');
        if (mainImg && mainImg.src && !images.includes(mainImg.src)) {
            images.push(mainImg.src);
        }
        const thumbs = document.querySelectorAll('.gallery-thumb');
        thumbs.forEach(thumb => {
            const src = thumb.src;
            if (src && !images.includes(src)) {
                images.push(src);
            }
        });
        return images;
    }

    window.swapImage = function(element, newSrc) {
        if (!newSrc) return;
        const mainImg = document.getElementById('mainProductImage');
        if (mainImg) {
            mainImg.style.opacity = '0.5';
            mainImg.src = newSrc;
            setTimeout(() => { mainImg.style.opacity = '1'; }, 100);
        }
        document.querySelectorAll('.gallery-thumb').forEach(thumb => thumb.classList.remove('active-thumb'));
        if (element) element.classList.add('active-thumb');
        
        const images = getGalleryImages();
        const idx = images.indexOf(newSrc);
        if (idx !== -1) currentLightboxIndex = idx;
    };

    window.openLightbox = function(index) {
        const images = getGalleryImages();
        if (!images.length) return;

        if (typeof index === 'number') {
            currentLightboxIndex = index;
        } else {
            const mainImg = document.getElementById('mainProductImage');
            const currentSrc = mainImg ? mainImg.src : '';
            const idx = images.indexOf(currentSrc);
            currentLightboxIndex = (idx !== -1) ? idx : 0;
        }
        updateLightboxContent();
        const lightbox = document.getElementById('razgemLightbox') || document.getElementById('golkhaneLightbox');
        if (lightbox) {
            lightbox.classList.add('active');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeLightbox = function() {
        const lightbox = document.getElementById('razgemLightbox') || document.getElementById('golkhaneLightbox');
        if (lightbox) {
            lightbox.classList.remove('active');
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    };

    window.navigateLightbox = function(dir) {
        const images = getGalleryImages();
        if (!images.length) return;
        currentLightboxIndex = (currentLightboxIndex + dir + images.length) % images.length;
        updateLightboxContent();
    };

    function updateLightboxContent() {
        const images = getGalleryImages();
        const imgEl = document.getElementById('lightboxMainImage');
        const counterEl = document.getElementById('lightboxCounter');
        if (!images.length) return;

        if (currentLightboxIndex >= images.length) currentLightboxIndex = 0;
        const src = images[currentLightboxIndex];

        if (imgEl) {
            imgEl.style.opacity = '0.5';
            imgEl.src = src;
            setTimeout(() => { imgEl.style.opacity = '1'; }, 100);
        }
        if (counterEl) {
            const toPersianNum = n => String(n).replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d]);
            counterEl.textContent = `${toPersianNum(currentLightboxIndex + 1)} از ${toPersianNum(images.length)}`;
        }
    }

    window.updateLightboxVariationImage = function(newSrc) {
        if (!newSrc) return;
        const mainImg = document.getElementById('mainProductImage');
        if (mainImg) {
            mainImg.style.opacity = '0.4';
            mainImg.src = newSrc;
            setTimeout(() => { mainImg.style.opacity = '1'; }, 150);
        }
        if (!extraVariationImages.includes(newSrc)) {
            extraVariationImages.unshift(newSrc);
        }
        currentLightboxIndex = 0;
    };

    window.resetLightboxVariationImage = function() {
        const mainImg = document.getElementById('mainProductImage');
        if (mainImg && mainImg.getAttribute('data-original-src')) {
            const orig = mainImg.getAttribute('data-original-src');
            mainImg.src = orig;
        }
        currentLightboxIndex = 0;
    };

    // Ring Size Guide Modal Functions (T017)
    window.openSizeGuideModal = function() {
        const modal = document.getElementById('ringSizeGuideModal');
        if (modal) {
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeSizeGuideModal = function() {
        const modal = document.getElementById('ringSizeGuideModal');
        if (modal) {
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    };

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
            closeSizeGuideModal();
        }
        const lightbox = document.getElementById('razgemLightbox') || document.getElementById('golkhaneLightbox');
        if (lightbox && lightbox.classList.contains('active')) {
            if (e.key === 'ArrowRight') navigateLightbox(1);
            if (e.key === 'ArrowLeft') navigateLightbox(-1);
        }
    });

    window.copyProductShortLink = function(btn) {
        const input = document.getElementById('razgemShortLinkInput') || document.getElementById('golkhaneShortLinkInput');
        if (!input) return;
        
        input.select();
        input.setSelectionRange(0, 99999);
        
        const textSpan = btn.querySelector('.copy-btn-text');
        const origText = textSpan ? textSpan.textContent : 'کپی لینک';

        function showSuccess() {
            btn.classList.add('copied');
            if (textSpan) textSpan.textContent = 'کپی شد ✓';
            setTimeout(() => {
                btn.classList.remove('copied');
                if (textSpan) textSpan.textContent = origText;
            }, 2000);
        }

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(input.value).then(showSuccess).catch(() => {
                try {
                    document.execCommand('copy');
                    showSuccess();
                } catch(e) {}
            });
        } else {
            try {
                document.execCommand('copy');
                showSuccess();
            } catch(e) {}
        }
    };
})();
</script>

<?php get_footer(); ?>