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
    $site_name  = 'گالری طلا و جواهرات رازگِم';
    
    if ( is_front_page() ) {
        $page_desc = 'گالری طلا و جواهرات دست‌ساز رازگِم - طراحی و ساخت زیورآلات فاخر طلا، مرواریدهای باروک طبیعی و سنگ‌های قیمتی اصیل با اصالت ایرانی و هنر دست';
        $og_type   = 'website';
        $og_image  = get_site_icon_url() ? get_site_icon_url() : get_template_directory_uri() . '/assets/images/Razgem-Logo.png';
    } elseif ( is_singular() ) {
        global $post;
        $page_desc = has_excerpt($post->ID) ? wp_strip_all_tags(get_the_excerpt($post->ID)) : wp_strip_all_tags(wp_trim_words($post->post_content, 30));
        $page_desc = !empty($page_desc) ? $page_desc : 'خرید آنلاین زیورآلات دست‌ساز فاخر طلا و مروارید با ضمانت اصالت و ارسال رایگان و بیمه شده از گالری رازگِم';
        $og_type   = is_singular('product') ? 'product' : 'article';
        $thumb_id  = get_post_thumbnail_id($post->ID);
        $og_image  = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : get_template_directory_uri() . '/assets/images/Razgem-Logo.png';
    } else {
        $page_desc = get_bloginfo('description') ? get_bloginfo('description') : 'گالری طلا و جواهرات دست‌ساز رازگِم - زیورآلات طلا و مرواریدهای دست‌ساز طبیعی';
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
        <meta name="twitter:image" content="<?php echo esc_url( $og_image ); ?>" />
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="top-bar">
    <div class="site-container top-bar__wrapper">
        <span><?php echo esc_html(get_theme_mod('top_bar_announcement', 'ارسال رایگان و بیمه شده تمامی سفارش‌ها به سراسر کشور')); ?></span>
        <span>مشاوره و پشتیبانی اختصاصی: <?php echo esc_html(get_theme_mod('contact_phone', '۰۲۱-۹۱۰۰XXXX')); ?></span>
    </div>
</div>

<div class="mobile-overlay" id="mobileOverlay"></div>
<nav class="mobile-drawer" id="mobileDrawer" aria-label="منوی موبایل">
    <button class="mobile-drawer__close" id="closeMobileMenu" aria-label="بستن منو">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>
    
    <div class="mobile-drawer__nav">
        <?php if ( is_user_logged_in() ) : 
            $current_user = wp_get_current_user();
        ?>
            <div style="color: var(--color-gold); font-size: 0.85rem; margin-bottom: -0.5rem; font-weight: 700;">سلام، <?php echo esc_html( $current_user->display_name ); ?></div>
            <a href="<?php echo esc_url( razgem_account_url( 'dashboard' ) ); ?>">پیشخوان کاربری</a>
            <a href="<?php echo esc_url( razgem_account_url( 'orders' ) ); ?>">سفارش‌های من</a>
            <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" style="color: #d35400;">خروج از حساب</a>
            <hr style="border:0; border-top:1px dashed var(--color-border); margin: 0.5rem 0;">
        <?php else : ?>
            <a href="<?php echo esc_url( razgem_account_url() ); ?>" class="open-otp-modal-btn" style="color: var(--color-gold);">ورود / ثبت‌نام</a>
            <hr style="border:0; border-top:1px dashed var(--color-border); margin: 0.5rem 0;">
        <?php endif; ?>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">صفحه اصلی</a>
        
        <a href="#" class="mobile-drawer-accordion-toggle">کالکشن‌ها و دسته‌بندی‌ها</a>
        <div class="mobile-drawer-accordion-content">
            <a href="<?php echo esc_url( razgem_shop_url() ); ?>" style="color:var(--color-dark); font-weight:700;">همه زیورآلات</a>
            <?php
            $prod_categories = get_terms( 'product_cat', array('hide_empty' => true) );
            if ( ! empty( $prod_categories ) && ! is_wp_error( $prod_categories ) ) {
                foreach( $prod_categories as $cat ) {
                    echo '<a href="' . esc_url( get_term_link( $cat ) ) . '">- ' . esc_html( $cat->name ) . '</a>';
                }
            }
            ?>
        </div>
        
        <a href="<?php echo esc_url( razgem_shop_url() ); ?>?post_type=product&on_sale=1">مجموعه برگزیده</a>
        <a href="/track-order">پیگیری سفارش</a>
        <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">مجله جواهرات</a>
        <a href="/about-us">داستان برند رازگِم</a>
        <a href="/contact">ارتباط با ما</a>
    </div>
</nav>

<header class="site-header">
    <div class="site-container">
        <div class="header-grid-layout">
            
            <button class="mobile-menu-toggle" id="openMobileMenuTrigger" aria-label="باز کردن منو">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </button>

            <div class="header-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="صفحه اصلی گالری طلا و جواهرات رازگِم">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Razgem-Logo-NoBg.png' ); ?>" alt="گالری طلا و جواهرات رازگِم" class="site-logo-img">
                </a>
            </div>

            <nav class="header-desktop-nav" aria-label="منوی اصلی">
                <ul class="header-nav-list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">صفحه اصلی</a></li>
                    <li><a href="<?php echo esc_url( razgem_shop_url() ); ?>">فروشگاه</a></li>
                    
                    <li class="nav-has-dropdown">
                        <a href="<?php echo esc_url( razgem_shop_url() ); ?>">دسته‌بندی‌ها 
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
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

                    <li><a href="<?php echo esc_url( razgem_shop_url() ); ?>?post_type=product&on_sale=1">مجموعه برگزیده</a></li>
                    <li><a href="/track-order">پیگیری سفارش</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">مجله جواهرات</a></li>
                    <li><a href="/about-us">داستان برند رازگِم</a></li>
                    <li><a href="/contact">ارتباط با ما</a></li>
                </ul>
            </nav>

            <div class="header-search">
                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form" role="search">
                    <input type="text" placeholder="جستجو در زیورآلات طلا و مروارید رازگِم..." name="s" class="search-input" aria-label="Search" autocomplete="off">
                    <button type="submit" class="search-submit" aria-label="جستجو">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    </button>
                    <input type="hidden" name="post_type" value="product" />
                    <div class="live-search-results"></div>
                </form>
            </div>

            <div class="header-actions">
                <div class="action-item account-dropdown-wrapper">
                    <?php if ( is_user_logged_in() ) : 
                        $current_user = wp_get_current_user();
                    ?>
                        <a href="<?php echo esc_url( razgem_account_url( 'dashboard' ) ); ?>" class="account-toggle" aria-label="حساب کاربری">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            <span><?php echo esc_html( $current_user->display_name ); ?></span>
                        </a>
                        <div class="account-dropdown-menu">
                            <a href="<?php echo esc_url( razgem_account_url( 'dashboard' ) ); ?>">پیشخوان کاربری</a>
                            <a href="<?php echo esc_url( razgem_account_url( 'orders' ) ); ?>">سفارش‌های من</a>
                            <a href="<?php echo esc_url( razgem_account_url( 'edit-account' ) ); ?>">اطلاعات حساب</a>
                            <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="logout-link">خروج از سیستم</a>
                        </div>
                    <?php else : ?>
                        <a href="#" class="account-toggle open-otp-modal-btn" aria-label="ورود و ثبت‌نام">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            <span>ورود / ثبت‌نام</span>
                        </a>
                    <?php endif; ?>
                </div>

                <button id="openMiniCart" class="action-item cart-icon-wrapper" aria-label="سبد خرید" style="background:transparent; cursor:pointer; outline:none;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    <span>سبد خرید</span>
                    <span class="cart-count">
                        <?php echo esc_html( razgem_cart_count() ); ?>
                    </span>
                </button>
            </div>
            
        </div>
    </div>
</header>