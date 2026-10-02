<?php
/**
 * The Template for displaying product archives, including the main shop page.
 * RazGem Coastal Haute-Joaillerie Edition
 *
 * @package RazGem
 */
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

// Check if user is viewing a single specimen directly (?view_product=r-001)
if ( ! empty( $_GET['view_product'] ) ) {
    get_template_part( 'template-parts/content-single-product' );
    get_footer( 'shop' );
    return;
}
?>

<!-- Blue Mini-Hero & Breadcrumb Section -->
<div class="shop-coastal-mini-hero" role="region" aria-label="سربرگ فروشگاه">
    <div class="site-container">
        <div class="shop-mini-hero-content" style="text-align: center; color: #fff; padding: 2rem 0 1rem;">
            <h1 class="woocommerce-products-header__title page-title" style="font-size: 2rem; margin: 0 0 0.5rem 0; font-weight: 800;">
                <?php woocommerce_page_title(); ?>
            </h1>
            <nav class="shop-breadcrumbs-nav" aria-label="Breadcrumb" style="font-size: 0.9rem; color: rgba(255,255,255,0.7);">
                <?php 
                if ( function_exists( 'woocommerce_breadcrumb' ) ) {
                    woocommerce_breadcrumb(array(
                        'wrap_before' => '<nav class="woocommerce-breadcrumb">',
                        'wrap_after'  => '</nav>',
                    ));
                }
                ?>
            </nav>
            <?php do_action( 'woocommerce_archive_description' ); ?>
        </div>
    </div>
    
    <!-- Mini Wave Transition to White -->
    <div class="shop-mini-wave-btm" aria-hidden="true" style="line-height: 0;">
        <svg class="ocean-waves-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto" style="height: 35px; width: 100%; display: block;">
            <defs>
                <path id="shop-mini-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="ocean-parallax-waves">
                <use xlink:href="#shop-mini-wave" x="48" y="0" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#shop-mini-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                <use xlink:href="#shop-mini-wave" x="48" y="5" fill="rgba(255,255,255,0.7)" />
                <use xlink:href="#shop-mini-wave" x="48" y="7" fill="#ffffff" />
            </g>
        </svg>
    </div>
</div>

<main class="site-container shop-archive-page" dir="rtl" role="main">
    
    <div class="shop-layout-grid">
        
        <!-- Sticky Coastal Sidebar / Mobile Drawer -->
        <aside class="shop-sidebar offcanvas-sidebar" id="shopSidebar" role="complementary" aria-label="فیلترها">
            <div class="shop-sidebar-header-mobile">
                <h3>فیلتر محصولات</h3>
                <button class="shop-sidebar-close" aria-label="بستن فیلترها">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="shop-sidebar-sticky">
                
                <?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'shop-sidebar' ); ?>
                <?php else : ?>
                    <p>لطفاً ابزارک‌های ووکامرس (فیلتر قیمت، دسته‌بندی و...) را به سایدبار "shop-sidebar" اضافه کنید.</p>
                <?php endif; ?>

            </div>
        </aside>

        <!-- Shop Main Product Grid -->
        <section class="shop-main-content">
            
            <div class="shop-mobile-actions" style="margin-bottom: 1.5rem;">
                <button class="shop-mobile-filter-btn" aria-label="نمایش فیلترها" aria-expanded="false" aria-controls="shopSidebar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    <span>فیلتر محصولات</span>
                </button>
            </div>

            <div id="shop-ajax-container">
                <?php
                if ( woocommerce_product_loop() ) {
                    woocommerce_product_loop_start();

                    if ( wc_get_loop_prop( 'total' ) ) {
                        while ( have_posts() ) {
                            the_post();
                            do_action( 'woocommerce_shop_loop' );
                            wc_get_template_part( 'content', 'product' );
                        }
                    }

                    woocommerce_product_loop_end();
                    woocommerce_pagination();
                } else {
                    echo '<p class="woocommerce-info">اثری یافت نشد.</p>';
                }
                ?>
            </div>
        </section>

    </div>
</main>

<div class="drawer-backdrop" aria-hidden="true"></div>

<?php
// Enqueue our new AJAX script
wp_enqueue_script( 'razgem-shop-ajax', get_template_directory_uri() . '/assets/js/shop-ajax.js', array(), '1.0', true );

get_template_part( 'template-parts/variation-modal' );
get_footer( 'shop' );
?>
