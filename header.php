<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Local Fonts & Asset Preload for Speed -->
    <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/assets/fonts/font.css' ); ?>" as="style">

    <!-- Google Search Console Verification -->
    <meta name="google-site-verification" content="3h0xZqWx3Wg-Tmf4Bk1jUY1rcmkQA-vA84_Y_J8dCVQ" />

    <!-- Dynamic SEO, Open Graph & Twitter Metadata -->
    <?php
    $page_title = wp_get_document_title();
    $page_url   = is_front_page() ? home_url('/') : get_permalink();
    $site_name  = 'گالری طلا و مروارید رازجم';
    
    if ( is_front_page() ) {
        $page_desc = 'گالری طلا و مروارید دست‌ساز رازجم - طراحی و ساخت زیورآلات فاخر طلا، مرواریدهای باروک طبیعی و سنگ‌های قیمتی اصیل با اصالت ایرانی و هنر دست';
        $og_type   = 'website';
        $og_image  = get_site_icon_url() ? get_site_icon_url() : get_template_directory_uri() . '/assets/images/Razgem-Logo.png';
    } elseif ( is_singular() ) {
        global $post;
        $page_desc = has_excerpt($post->ID) ? wp_strip_all_tags(get_the_excerpt($post->ID)) : wp_strip_all_tags(wp_trim_words($post->post_content, 30));
        $page_desc = !empty($page_desc) ? $page_desc : 'خرید آنلاین زیورآلات دست‌ساز فاخر طلا و مروارید با ضمانت اصالت و ارسال رایگان و بیمه شده از گالری رازجم';
        $og_type   = is_singular('product') ? 'product' : 'article';
        $thumb_id  = get_post_thumbnail_id($post->ID);
        $og_image  = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : get_template_directory_uri() . '/assets/images/Razgem-Logo.png';
    } else {
        $page_desc = get_bloginfo('description') ? get_bloginfo('description') : 'گالری طلا و مروارید دست‌ساز رازجم - زیورآلات طلا و مرواریدهای دست‌ساز طبیعی';
        $og_type   = 'website';
        $og_image  = get_site_icon_url() ? get_site_icon_url() : get_template_directory_uri() . '/assets/images/Razgem-Logo.png';
    }
    ?>
    <meta name="description" content="<?php echo esc_attr( $page_desc ); ?>">
    <link rel="canonical" href="<?php echo esc_url( $page_url ); ?>" />

    <!-- Open Graph / Facebook / Telegram / WhatsApp -->
    <meta property="og:type" content="<?php echo esc_attr( $og_type ); ?>" />
    <meta property="og:title" content="<?php echo esc_attr( $page_title ); ?>" />
    <meta property="og:description" content="<?php echo esc_attr( $page_desc ); ?>" />
    <meta property="og:url" content="<?php echo esc_url( $page_url ); ?>" />
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>" />
    <meta property="og:locale" content="fa_IR" />
    <?php if ( $og_image ) : ?>
        <meta property="og:image" content="<?php echo esc_url( $og_image ); ?>" />
    <?php endif; ?>

    <!-- Twitter Card Meta -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo esc_attr( $page_title ); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr( $page_desc ); ?>" />
    <?php if ( $og_image ) : ?>
        <meta property="og:image" content="<?php echo esc_url( $og_image ); ?>" />
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( get_theme_mod( 'top_bar_enable', true ) ) : ?>
<div class="top-bar">
    <div class="site-container top-bar__wrapper">
        <span><?php echo esc_html( get_theme_mod( 'top_bar_announcement', 'ارسال رایگان و بیمه‌شده سفارش‌ها به سراسر کشور' ) ); ?></span>
        <span>مشاوره و پشتیبانی: <a href="tel:<?php echo esc_attr( razgem_clean_phone( get_theme_mod( 'contact_phone', '۰۲۱-۹۱۰۰XXXX' ) ) ); ?>"><?php echo esc_html( get_theme_mod( 'contact_phone', '۰۲۱-۹۱۰۰XXXX' ) ); ?></a><?php if ( get_theme_mod( 'contact_phone_2', '' ) ) : ?> | <a href="tel:<?php echo esc_attr( razgem_clean_phone( get_theme_mod( 'contact_phone_2' ) ) ); ?>"><?php echo esc_html( get_theme_mod( 'contact_phone_2' ) ); ?></a><?php endif; ?></span>
    </div>
</div>
<?php endif; ?>

<div class="mobile-overlay" id="mobileOverlay"></div>
<nav class="mobile-drawer mobile-nav-drawer" id="mobileDrawer" aria-label="منوی موبایل رازجم">
    
    <!-- Drawer Brand Header -->
    <div class="mobile-drawer-header">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-drawer-brand">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Razgem-Logo-NoBg.png' ); ?>" alt="گالری رازجم" class="mobile-drawer-logo">
        </a>
        <button class="mobile-drawer__close" id="closeMobileMenu" aria-label="بستن منو">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>

    <!-- Live Search Input in Mobile Drawer -->
    <div class="mobile-drawer-search">
        <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="mobile-search-form" role="search">
            <input type="text" placeholder="جستجو در آثار صدف و مروارید..." name="s" class="mobile-search-input" aria-label="جستجو در آثار">
            <button type="submit" class="mobile-search-btn" aria-label="جستجو">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
            </button>
            <input type="hidden" name="post_type" value="product" />
        </form>
    </div>

    <!-- Category Chips with Nature Icons -->
    <div class="mobile-category-chips">
        <span class="chips-title">دسته‌بندی‌های دست‌ساز:</span>
        <div class="chips-grid">
            <a href="<?php echo esc_url( add_query_arg( 'category', 'earrings', razgem_shop_url() ) ); ?>" class="mobile-chip">
                <span class="chip-icon">🦪</span>
                <span>گوشواره صدف</span>
            </a>
            <a href="<?php echo esc_url( add_query_arg( 'category', 'necklaces', razgem_shop_url() ) ); ?>" class="mobile-chip">
                <span class="chip-icon">🌊</span>
                <span>گردنبند و چوکر</span>
            </a>
            <a href="<?php echo esc_url( add_query_arg( 'category', 'bracelets', razgem_shop_url() ) ); ?>" class="mobile-chip">
                <span class="chip-icon">✨</span>
                <span>دستبند و انگشتر</span>
            </a>
            <a href="<?php echo esc_url( razgem_shop_url() ); ?>?post_type=product&on_sale=1" class="mobile-chip mobile-chip--highlight">
                <span class="chip-icon">💎</span>
                <span>مجموعه برگزیده</span>
            </a>
        </div>
    </div>
    
    <!-- Navigation Links -->
    <div class="mobile-drawer__nav">
        <?php if ( is_user_logged_in() ) : 
            $current_user = wp_get_current_user();
        ?>
            <div class="drawer-user-greeting">سلام، <?php echo esc_html( $current_user->display_name ); ?></div>
            <a href="<?php echo esc_url( razgem_account_url( 'dashboard' ) ); ?>" class="drawer-nav-item">پیشخوان کاربری</a>
            <a href="<?php echo esc_url( razgem_account_url( 'orders' ) ); ?>" class="drawer-nav-item">سفارش‌های من</a>
            <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="drawer-nav-item logout-link" style="color: #c0392b;">خروج از حساب</a>
            <div class="drawer-divider"></div>
        <?php else : ?>
            <a href="<?php echo esc_url( razgem_account_url() ); ?>" class="drawer-nav-item open-otp-modal-btn user-login-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <span>ورود / عضویت در گالری</span>
            </a>
            <div class="drawer-divider"></div>
        <?php endif; ?>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="drawer-nav-item">صفحه اصلی</a>
        <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="drawer-nav-item">فروشگاه آثار صدف طبیعی</a>
        <a href="<?php echo esc_url( razgem_shop_url() ); ?>?post_type=product&on_sale=1" class="drawer-nav-item">مجموعه برگزیده و حراج</a>
        <a href="/track-order" class="drawer-nav-item">پیگیری سفارشات</a>
        <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="drawer-nav-item">مجله راز دریا و گوهر</a>
        <a href="/about-us" class="drawer-nav-item">داستان آتلیه رازجم</a>
        <a href="/contact" class="drawer-nav-item">مشاوره و ساخت اختصاصی</a>
    </div>

    <!-- Direct WhatsApp Consultation Box -->
    <div class="mobile-drawer-contact-box">
        <?php
        $drawer_wa_phone = get_theme_mod( 'contact_phone', '09120000000' );
        $drawer_wa_clean = preg_replace( '/[^0-9]/', '', $drawer_wa_phone );
        if ( strpos( $drawer_wa_clean, '09' ) === 0 ) {
            $drawer_wa_clean = '98' . substr( $drawer_wa_clean, 1 );
        }
        $drawer_wa_url = 'https://wa.me/' . $drawer_wa_clean . '?text=' . rawurlencode( 'سلام، برای انتخاب و مشاوره در خرید زیورآلات صدف طبیعی رازجم راهنمایی می‌خواستم.' );
        ?>
        <a href="<?php echo esc_url( $drawer_wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="mobile-drawer-wa-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
            <span>مشاوره مستقیم در واتس‌اپ</span>
        </a>
    </div>

</nav>

<header class="site-header">
    <div class="site-container">
        <!-- Tier 1: Main Brand Showcase Bar (Symmetrical 3-Column) -->
        <div class="header-main-bar">
            
            <!-- Right Column: Mobile Menu Toggle & Luxury Search Bar -->
            <div class="header-col header-col--right">
                <button class="mobile-menu-toggle" id="openMobileMenuTrigger" aria-label="باز کردن منو">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </button>

                <div class="header-search-wrap">
                    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form" role="search">
                        <input type="text" placeholder="جستجو در گالری رازجم..." name="s" class="search-input" aria-label="جستجو در زیورآلات" autocomplete="off">
                        <button type="submit" class="search-submit" aria-label="جستجو">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                        </button>
                        <input type="hidden" name="post_type" value="product" />
                        <div class="live-search-results"></div>
                    </form>
                </div>
            </div>

            <!-- Center Column: Grand Maison Logo -->
            <div class="header-col header-col--center header-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="صفحه اصلی گالری طلا و مروارید رازجم" class="logo-link">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Razgem-Logo-NoBg.png' ); ?>" alt="گالری طلا و مروارید رازجم" class="site-logo-img">
                </a>
            </div>

            <!-- Left Column: User Account & Luxury Shopping Bag -->
            <div class="header-col header-col--left">
                <div class="header-actions">
                    <div class="action-item account-dropdown-wrapper">
                        <?php if ( is_user_logged_in() ) : 
                            $current_user = wp_get_current_user();
                        ?>
                            <a href="<?php echo esc_url( razgem_account_url( 'dashboard' ) ); ?>" class="account-toggle" aria-label="حساب کاربری">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="action-label"><?php echo esc_html( $current_user->display_name ); ?></span>
                            </a>
                            <div class="account-dropdown-menu">
                                <a href="<?php echo esc_url( razgem_account_url( 'dashboard' ) ); ?>">پیشخوان کاربری</a>
                                <a href="<?php echo esc_url( razgem_account_url( 'orders' ) ); ?>">سفارش‌های من</a>
                                <a href="<?php echo esc_url( razgem_account_url( 'edit-account' ) ); ?>">اطلاعات حساب</a>
                                <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="logout-link">خروج از سیستم</a>
                            </div>
                        <?php else : ?>
                            <a href="#" class="account-toggle open-otp-modal-btn" aria-label="ورود و ثبت‌نام">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="action-label">ورود / ثبت‌نام</span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <button id="openMiniCart" class="action-item cart-icon-wrapper" aria-label="سبد خرید" type="button">
                        <div class="cart-icon-box">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                            <span class="cart-count">
                                <?php echo esc_html( razgem_cart_count() ); ?>
                            </span>
                        </div>
                        <span class="action-label">سبد خرید</span>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Tier 2: Dedicated Editorial Navigation Bar (Centered) -->
    <div class="header-nav-bar">
        <div class="site-container">
            <nav class="header-desktop-nav" aria-label="منوی اصلی">
                <ul class="header-nav-list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">صفحه اصلی</a></li>
                    <li><a href="<?php echo esc_url( razgem_shop_url() ); ?>">فروشگاه زیورآلات</a></li>
                    
                    <li class="nav-has-dropdown">
                        <a href="<?php echo esc_url( razgem_shop_url() ); ?>">دسته‌بندی‌ها 
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>
                        <ul class="nav-dropdown">
                            <?php
                            $prod_categories = get_terms( 'product_cat', array(
                                'orderby'    => 'name',
                                'order'      => 'ASC',
                                'hide_empty' => true,
                            ));
                            if(!empty($prod_categories) && !is_wp_error($prod_categories)) {
                                foreach( $prod_categories as $cat ) {
                                    echo '<li><a href="' . esc_url( get_term_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
                                }
                            } else {
                                echo '<li><a href="#">بدون دسته</a></li>';
                            }
                            ?>
                        </ul>
                    </li>

                    <li><a href="<?php echo esc_url( razgem_shop_url() ); ?>?post_type=product&on_sale=1" class="nav-link--spotlight">مجموعه برگزیده <span class="nav-gem-dot"></span></a></li>
                    <li><a href="/track-order">پیگیری سفارشات</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">مجله طلا و جواهر</a></li>
                    <li><a href="/about-us">داستان رازجم</a></li>
                    <li><a href="/contact">سفارش ساخت اختصاصی</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>