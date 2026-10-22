<?php defined( 'ABSPATH' ) || exit; ?>

<footer class="site-footer">
    <!-- Coastal Shoreline Waves & Seafoam Texture Overlay -->
    <div class="footer-texture-overlay" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/coastal-wave-shoreline.jpg' ); ?>');" aria-hidden="true"></div>

    <div class="site-container footer-main-grid">
        
        <div class="footer-widget footer-brand-widget">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Razgem-Logo-NoBg.png" alt="RazGem Logo" class="footer-logo-img" onerror="this.style.display='none'">
            <p class="footer-about-text"><?php echo esc_html( get_theme_mod( 'footer_tagline', 'گالری دست‌ساز رازجم؛ شکوه بی‌انتهای طبیعت در تلاقی صدف‌های طبیعی وارداتی اصل، مرواریدهای باروک و هنر اصیل ایرانی.' ) ); ?></p>
            
            <?php
            $social_telegram  = get_theme_mod('social_telegram', 'https://t.me/+989007423055');
            $social_instagram = get_theme_mod('social_instagram', 'https://instagram.com/razgem.ir');
            $social_rubika    = get_theme_mod('social_rubika', 'https://rubika.ir/raz_gem');
            $social_whatsapp  = get_theme_mod('social_whatsapp', '');
            $icon_dir         = get_template_directory_uri() . '/assets/icons/';
            ?>
            <div class="social-icons">
                <?php if ($social_telegram) : ?>
                    <a href="<?php echo esc_url($social_telegram); ?>" aria-label="مدیر تلگرام رازجم" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo esc_url($icon_dir . 'telegram.png'); ?>" alt="تلگرام" class="footer-social-png" width="22" height="22">
                    </a>
                <?php endif; ?>
                <?php if ($social_instagram) : ?>
                    <a href="<?php echo esc_url($social_instagram); ?>" aria-label="مدیر اینستاگرام رازجم" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo esc_url($icon_dir . 'instagram.png'); ?>" alt="اینستاگرام" class="footer-social-png" width="22" height="22">
                    </a>
                <?php endif; ?>
                <?php if ($social_rubika) : ?>
                    <a href="<?php echo esc_url($social_rubika); ?>" aria-label="مدیر روبیکا رازجم" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo esc_url($icon_dir . 'Rubika.png'); ?>" alt="روبیکا" class="footer-social-png" width="22" height="22">
                    </a>
                <?php endif; ?>
                <?php if ($social_whatsapp) : ?>
                    <a href="<?php echo esc_url($social_whatsapp); ?>" aria-label="واتس‌اپ رازجم" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo esc_url($icon_dir . 'whatsapp.png'); ?>" alt="واتس‌اپ" class="footer-social-png" width="22" height="22">
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <nav class="footer-widget" aria-label="دسترسی سریع">
            <h4 class="footer-widget-title">دسترسی سریع</h4>
            <ul class="footer-links">
                <li><a href="<?php echo esc_url( razgem_shop_url() ); ?>">فروشگاه زیورآلات</a></li>
                <li><a href="<?php echo esc_url( razgem_shop_url() ); ?>?post_type=product&on_sale=1">کالکشن‌های برگزیده</a></li>
                <li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">مجله راز دریا و گوهر</a></li>
                <li><a href="<?php echo esc_url( home_url( '/track-order' ) ); ?>">پیگیری سفارشات</a></li>
                <li><a href="<?php echo esc_url( home_url( '/about-us' ) ); ?>">درباره آتلیه رازجم</a></li>
                <li><a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>">تماس و مشاوره خرید</a></li>
            </ul>
        </nav>

        <nav class="footer-widget" aria-label="خدمات مشتریان">
            <h4 class="footer-widget-title">خدمات مشتریان و مقررات</h4>
            <ul class="footer-links">
                <li><a href="<?php echo esc_url( home_url( '/terms' ) ); ?>">شرایط و قوانین خرید</a></li>
                <li><a href="<?php echo esc_url( home_url( '/return-policy' ) ); ?>">ضمانت اصالت و بازگشت کالا (۷ روز)</a></li>
                <li><a href="<?php echo esc_url( home_url( '/shipping-payment' ) ); ?>">شیوه‌های پرداخت و ارسال امن</a></li>
                <li><a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>">سیاست حفظ حریم خصوصی</a></li>
                <li><a href="<?php echo esc_url( home_url( '/faq' ) ); ?>">راهنمای سایز و سوالات متداول</a></li>
            </ul>
        </nav>

        <div class="footer-widget footer-contact-widget">
            <h4 class="footer-widget-title">ارتباط با ما</h4>
            <ul class="contact-list">
                <?php 
                $phone1  = get_theme_mod('contact_phone', '۰۲۱-۹۱۰۰XXXX');
                $phone2  = get_theme_mod('contact_phone_2', '');
                $phone3  = get_theme_mod('contact_phone_3', '');
                $address = get_theme_mod('contact_address', 'تهران، نیاوران، خیابان عمار، پلاک ۱۲، واحد ۳');
                
                $phones = array_filter(array($phone1, $phone2, $phone3));
                ?>
                <?php if (!empty($phones)) : ?>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <span>تلفن: <?php 
                            $phone_links = array();
                            foreach ($phones as $p) {
                                $clean_p = function_exists('razgem_clean_phone') ? razgem_clean_phone($p) : (function_exists('golkhane_clean_phone') ? golkhane_clean_phone($p) : $p);
                                $phone_links[] = '<a href="tel:' . esc_attr($clean_p) . '" style="color:inherit;text-decoration:none;" class="footer-phone-link">' . esc_html($p) . '</a>';
                            }
                            echo implode(' <span class="phone-sep" style="margin:0 4px;opacity:0.6;">|</span> ', $phone_links);
                        ?></span>
                    </li>
                <?php endif; ?>
                <?php if ($address) : ?>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <span>آدرس: <?php echo esc_html($address); ?></span>
                    </li>
                <?php endif; ?>
                <li>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span>ایمیل: <?php echo esc_html(get_theme_mod('contact_email', 'info@razgem.ir')); ?></span>
                </li>
                <li>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <span>ساعت پاسخگویی: <?php echo esc_html( get_theme_mod( 'contact_hours', '۱۰ الی ۲۲' ) ); ?></span>
                </li>
            </ul>
            
            <div class="trust-seals">
                <?php 
                $enamad_custom = get_theme_mod( 'enamad_code', '' );
                if ( ! empty( $enamad_custom ) ) {
                    $has_seal_wrapper = ( strpos( $enamad_custom, 'footer-trust-seal' ) !== false );
                    if ( ! $has_seal_wrapper ) {
                        echo '<div class="footer-trust-seal">';
                    }
                    if ( function_exists( 'razgem_sanitize_enamad_code' ) ) {
                        echo razgem_sanitize_enamad_code( $enamad_custom ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    } else {
                        echo wp_kses_post( $enamad_custom );
                    }
                    if ( ! $has_seal_wrapper ) {
                        echo '</div>';
                    }
                } else {
                ?>
                <div class="footer-trust-seal">
                    <a referrerpolicy='origin' target='_blank' href='https://trustseal.enamad.ir/?id=8322807&Code=EkmPqDTAfKBcazxFx94rkzgoY66mwJZd'><img referrerpolicy='origin' src='https://trustseal.enamad.ir/logo.aspx?id=8322807&Code=EkmPqDTAfKBcazxFx94rkzgoY66mwJZd' alt='نماد تجارت الکترونیکی گالری رازجم' style='cursor:pointer' code='EkmPqDTAfKBcazxFx94rkzgoY66mwJZd'></a>
                </div>
                <?php } ?>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <div class="site-container footer-bottom-inner">
            <p class="footer-copyright">&copy; <?php echo date('Y'); ?> <?php echo esc_html( get_theme_mod( 'footer_copyright', 'تمامی حقوق مادی و معنوی این وب‌سایت متعلق به گالری زیورآلات ارگانیک و دست‌ساز صدف و مروارید رازجم (RazGem) می‌باشد.' ) ); ?></p>
            <p class="footer-creator">
                <?php echo esc_html( get_theme_mod( 'footer_creator_prefix', 'طراحی و توسعه:' ) ); ?>
                <a href="<?php echo esc_url( get_theme_mod( 'footer_creator_url', 'https://devzarei.ir' ) ); ?>" target="_blank" rel="noopener" class="footer-creator-link">
                    <?php echo esc_html( get_theme_mod( 'footer_creator_name', 'محمدعلی زارعی' ) ); ?>
                </a>
            </p>
        </div>
    </div>
</footer>

<div class="mini-cart-overlay" id="miniCartOverlay"></div>
<div class="mini-cart-drawer" id="miniCartDrawer">
    <div class="mini-cart-header">
        <h3>سبد خرید شما</h3>
        <button id="closeMiniCart" aria-label="بستن سبد خرید">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    <div class="mini-cart-body">
        <div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. Mobile Menu Logic ---
    const drawerMenu = document.getElementById('mobileDrawer');
    const overlayMenu = document.getElementById('mobileOverlay');
    const closeMenuBtn = document.getElementById('closeMobileMenu');

    function toggleMenu(e) {
        if (e) e.preventDefault();
        if(drawerMenu) drawerMenu.classList.toggle('active');
        if(overlayMenu) overlayMenu.classList.toggle('active');
        document.body.style.overflow = drawerMenu && drawerMenu.classList.contains('active') ? 'hidden' : '';
    }

    document.querySelectorAll('#openMobileMenu, #openMobileMenuTrigger, .mobile-menu-toggle').forEach(btn => {
        btn.addEventListener('click', toggleMenu);
    });
    if(closeMenuBtn) closeMenuBtn.addEventListener('click', toggleMenu);
    if(overlayMenu) overlayMenu.addEventListener('click', toggleMenu);

    // --- 1.5. Mobile Search Bar Dropdown Toggle ---
    const mobileSearchTrigger = document.getElementById('mobileSearchTrigger');
    const mobileSearchBar = document.getElementById('mobileSearchBar');
    const mobileSearchClose = document.getElementById('mobileSearchClose');

    if (mobileSearchTrigger && mobileSearchBar) {
        mobileSearchTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            const isOpen = mobileSearchBar.classList.toggle('is-open');
            mobileSearchBar.setAttribute('aria-hidden', !isOpen);
            if (isOpen) {
                const searchInp = mobileSearchBar.querySelector('.mobile-search-bar-input');
                if (searchInp) setTimeout(() => searchInp.focus(), 120);
            }
        });
    }

    if (mobileSearchClose && mobileSearchBar) {
        mobileSearchClose.addEventListener('click', function(e) {
            e.preventDefault();
            mobileSearchBar.classList.remove('is-open');
            mobileSearchBar.setAttribute('aria-hidden', 'true');
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileSearchBar && mobileSearchBar.classList.contains('is-open')) {
            mobileSearchBar.classList.remove('is-open');
            mobileSearchBar.setAttribute('aria-hidden', 'true');
        }
    });


    // --- 2. Event Delegation for Mini Cart & Add to Cart Flying Animation ---
    function getCartTargetElement() {
        if (window.innerWidth <= 768) {
            const bottomCart = document.querySelector('.magic-nav-cart') || document.getElementById('magicBottomCartTrigger');
            if (bottomCart && bottomCart.offsetParent !== null) return bottomCart;
        }
        return document.getElementById('openMiniCart') || 
               document.querySelector('.cart-icon-wrapper') || 
               document.querySelector('.cart-count') ||
               document.querySelector('.magic-nav-cart');
    }

    function triggerGlobalFlyToCart(btn) {
        if (!btn) return;
        const cartTarget = getCartTargetElement();
        const startRect = btn.getBoundingClientRect();
        
        const flyer = document.createElement('div');
        flyer.className = 'flying-cart-item';
        
        const card = btn.closest('.product-card, li.product, .single-product-page, .hero-slide');
        let imgUrl = '';
        if (card) {
            const img = card.querySelector('img');
            if (img && img.src) imgUrl = img.src;
        }
        
        if (imgUrl) {
            flyer.style.backgroundImage = `url("${imgUrl}")`;
        } else {
            flyer.innerHTML = `<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>`;
        }

        const flyerSize = 44;
        const startX = startRect.left + startRect.width / 2 - flyerSize / 2;
        const startY = startRect.top + startRect.height / 2 - flyerSize / 2;

        let endX = window.innerWidth - 50;
        let endY = 30;

        if (cartTarget) {
            const targetRect = cartTarget.getBoundingClientRect();
            if (targetRect.width > 0 && targetRect.height > 0) {
                endX = targetRect.left + targetRect.width / 2 - flyerSize / 2;
                endY = targetRect.top + targetRect.height / 2 - flyerSize / 2;
            }
        }

        flyer.style.left = startX + 'px';
        flyer.style.top = startY + 'px';
        flyer.style.position = 'fixed';
        flyer.style.zIndex = '999999';
        document.body.appendChild(flyer);

        const deltaX = endX - startX;
        const deltaY = endY - startY;

        function onArrival() {
            if (flyer.parentNode) flyer.parentNode.removeChild(flyer);
            if (cartTarget) cartTarget.classList.add('cart-icon-bounce');
            const badges = document.querySelectorAll('.cart-count, .nav-cart-count');
            badges.forEach(b => b.classList.add('cart-icon-bounce'));
            setTimeout(() => {
                if (cartTarget) cartTarget.classList.remove('cart-icon-bounce');
                badges.forEach(b => b.classList.remove('cart-icon-bounce'));
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

    document.addEventListener('click', function(e) {
        // Trigger fly animation on Add to Cart tap
        const addBtn = e.target.closest('.add_to_cart_button, .single_add_to_cart_button, .ajax_add_to_cart');
        if (addBtn) {
            triggerGlobalFlyToCart(addBtn);
        }

        // Open Cart
        const openCartBtn = e.target.closest('#openMiniCart, #magicBottomCartTrigger, .magic-nav-cart a, .open-mini-cart-btn');
        if (openCartBtn) {
            e.preventDefault();
            const cartDrawer = document.getElementById('miniCartDrawer');
            const cartOverlay = document.getElementById('miniCartOverlay');
            if(cartDrawer) cartDrawer.classList.add('active');
            if(cartOverlay) cartOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // Close Cart
        const closeCartBtn = e.target.closest('#closeMiniCart');
        const cartOverlay = e.target.closest('#miniCartOverlay');
        if (closeCartBtn || cartOverlay) {
            const drawer = document.getElementById('miniCartDrawer');
            const overlay = document.getElementById('miniCartOverlay');
            if(drawer) drawer.classList.remove('active');
            if(overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Mini Cart Live Quantity Buttons
        const miniPlus = e.target.closest('.mini-cart-qty-btn.plus');
        const miniMinus = e.target.closest('.mini-cart-qty-btn.minus');
        if (miniPlus || miniMinus) {
            e.preventDefault();
            const btn = miniPlus || miniMinus;
            const pId = btn.getAttribute('data-product-id');
            const vId = btn.getAttribute('data-variation-id') || 0;
            const currentQty = parseInt(btn.getAttribute('data-current-qty'), 10) || 1;
            let newQty = currentQty + (miniPlus ? 1 : -1);
            if (newQty < 0) newQty = 0;

            const data = new URLSearchParams();
            data.append('action', 'razgem_update_morph_cart');
            data.append('product_id', pId);
            data.append('variation_id', vId);
            data.append('qty', newQty);

            fetch('<?php echo admin_url("admin-ajax.php"); ?>', { method: 'POST', body: data })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    if (res.data && res.data.fragments) {
                        for (let key in res.data.fragments) {
                            const elems = document.querySelectorAll(key);
                            elems.forEach(el => { el.outerHTML = res.data.fragments[key]; });
                        }
                    }
                    if (window.jQuery) {
                        jQuery(document.body).trigger('wc_fragment_refresh');
                    }
                }
            });
        }
    });

    if (typeof jQuery !== 'undefined') {
        jQuery(document.body).on('added_to_cart', function() {
            const cartDrawer = document.getElementById('miniCartDrawer');
            const cartOverlay = document.getElementById('miniCartOverlay');
            if(cartDrawer && !cartDrawer.classList.contains('active')) {
                cartDrawer.classList.add('active');
                if (cartOverlay) cartOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });
    }


    // --- 3. Dynamic Live Search Script ---
    const searchForms = document.querySelectorAll('.search-form');
    
    searchForms.forEach(form => {
        const input = form.querySelector('.search-input');
        const resultsBox = form.querySelector('.live-search-results');
        let debounceTimer;

        if(input && resultsBox) {
            input.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                const keyword = this.value.trim();
                
                if (keyword.length < 2) {
                    resultsBox.classList.remove('active');
                    return;
                }
                
                debounceTimer = setTimeout(() => {
                    resultsBox.innerHTML = '<div class="live-search-message">در حال جستجو در زیورآلات...</div>';
                    resultsBox.classList.add('active');
                    
                    const formData = new FormData();
                    formData.append('action', 'razgem_live_search');
                    formData.append('keyword', keyword);
                    
                    fetch('<?php echo admin_url("admin-ajax.php"); ?>', { method: 'POST', body: formData })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            resultsBox.innerHTML = data.data;
                        } else {
                            resultsBox.innerHTML = '<div class="live-search-message" style="color:#d35400;">محصولی یافت نشد.</div>';
                        }
                    });
                }, 400); 
            });

            document.addEventListener('click', function(e) {
                if (!form.contains(e.target)) {
                    resultsBox.classList.remove('active');
                }
            });
        }
    });
});
</script>

<?php wp_footer(); ?>
</body>
</html>
