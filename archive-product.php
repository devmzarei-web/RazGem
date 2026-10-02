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

// Determine current category or filter state
$current_cat_param = isset( $_GET['category'] ) ? sanitize_text_field( wp_unslash( $_GET['category'] ) ) : 'all';
$is_on_sale_param  = ! empty( $_GET['on_sale'] );
?>

<!-- Compact Breadcrumb Section with subtle wave -->
<div class="shop-compact-breadcrumbs" role="region" aria-label="مسیر راهنما">
    <div class="site-container">
        <nav class="shop-breadcrumbs-nav" aria-label="Breadcrumb">
            <?php 
            if ( function_exists( 'woocommerce_breadcrumb' ) ) {
                woocommerce_breadcrumb();
            } else {
                echo '<a href="/">خانه</a> / فروشگاه زیورآلات';
            }
            ?>
        </nav>
        <!-- Mobile Filter Toggle Button -->
        <button class="shop-mobile-filter-btn" aria-label="نمایش فیلترها" aria-expanded="false" aria-controls="shopSidebar">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
            <span>فیلترها</span>
        </button>
    </div>
    <!-- Mini Wave -->
    <div class="shop-mini-wave" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="shop-mini-gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="mini-parallax-waves">
                <use href="#shop-mini-gentle-wave" x="48" y="0" fill="var(--color-bg-base, #FBF8F2)" opacity="0.3" />
                <use href="#shop-mini-gentle-wave" x="48" y="3" fill="var(--color-bg-base, #FBF8F2)" opacity="0.5" />
                <use href="#shop-mini-gentle-wave" x="48" y="5" fill="var(--color-bg-base, #FBF8F2)" opacity="0.7" />
                <use href="#shop-mini-gentle-wave" x="48" y="7" fill="var(--color-bg-base, #FBF8F2)" />
            </g>
        </svg>
    </div>
</div>

<main class="site-container shop-archive-page" dir="rtl" role="main">
    
    <header class="shop-custom-header">
        <h1 class="woocommerce-products-header__title page-title sr-only">
            <?php woocommerce_page_title(); ?>
        </h1>
        <?php do_action( 'woocommerce_archive_description' ); ?>
    </header>

    <div class="shop-layout-grid">
        
        <!-- Sticky Coastal Sidebar / Mobile Drawer -->
        <aside class="shop-sidebar offcanvas-sidebar" id="shopSidebar" role="complementary" aria-label="فیلترها و مشخصات گالری رازجم">
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
                    
                    <!-- Coastal Categories Widget -->
                    <div class="coastal-sidebar-widget widget_product_categories">
                        <h3 class="coastal-widget-title">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                            دسته‌بندی آثار
                        </h3>
                        <ul class="coastal-widget-list product-categories">
                            <li class="cat-item <?php echo ( 'all' === $current_cat_param && ! $is_on_sale_param ) ? 'current-cat' : ''; ?>">
                                <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="coastal-widget-link">
                                    <span>همه زیورآلات</span>
                                </a>
                            </li>
                            <li class="cat-item <?php echo ( 'earrings' === $current_cat_param ) ? 'current-cat' : ''; ?>">
                                <a href="<?php echo esc_url( add_query_arg( 'category', 'earrings', razgem_shop_url() ) ); ?>" class="coastal-widget-link">
                                    <span>گوشواره صدف طبیعی</span>
                                </a>
                            </li>
                            <li class="cat-item <?php echo ( 'necklaces' === $current_cat_param ) ? 'current-cat' : ''; ?>">
                                <a href="<?php echo esc_url( add_query_arg( 'category', 'necklaces', razgem_shop_url() ) ); ?>" class="coastal-widget-link">
                                    <span>گردنبند و چوکر صدف</span>
                                </a>
                            </li>
                            <li class="cat-item <?php echo ( 'bracelets' === $current_cat_param ) ? 'current-cat' : ''; ?>">
                                <a href="<?php echo esc_url( add_query_arg( 'category', 'bracelets', razgem_shop_url() ) ); ?>" class="coastal-widget-link">
                                    <span>دستبند و انگشتر</span>
                                </a>
                            </li>
                            <li class="cat-item <?php echo $is_on_sale_param ? 'current-cat' : ''; ?>">
                                <a href="<?php echo esc_url( add_query_arg( 'on_sale', '1', razgem_shop_url() ) ); ?>" class="coastal-widget-link">
                                    <span>مجموعه برگزیده و حراج</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Authenticity & Handcraft Spec Checklist -->
                    <div class="coastal-sidebar-widget">
                        <h3 class="coastal-widget-title">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            اصالت و مشخصات کارگاه
                        </h3>
                        <ul class="coastal-spec-checklist">
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>صدف طبیعی دست‌تراش بدون رنگ شیمیایی</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>اتصالات برنجی با آبکاری طلایی مقاوم</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>تک‌نسخه و تکرارناپذیر در نقوش طبیعی</span>
                            </li>
                        </ul>
                    </div>

                <?php endif; ?>

            </div>
        </aside>

        <!-- Shop Main Product Grid -->
        <section class="shop-main-content">
            <div id="shop-ajax-container">
                <?php
                $has_wc_products = false;

                if ( function_exists( 'woocommerce_product_loop' ) && woocommerce_product_loop() && function_exists( 'wc_get_loop_prop' ) && wc_get_loop_prop( 'total' ) ) {
                    $has_wc_products = true;
                }

                if ( $has_wc_products ) :
                    woocommerce_product_loop_start();

                    while ( have_posts() ) {
                        the_post();
                        do_action( 'woocommerce_shop_loop' );
                        wc_get_template_part( 'content', 'product' );
                    }

                    woocommerce_product_loop_end();
                    woocommerce_pagination();
                else :
                    // Render Handcrafted Mock Catalog (R-001, R-002, etc.)
                    $filter_args = array();
                    if ( 'all' !== $current_cat_param ) {
                        $filter_args['category'] = $current_cat_param;
                    }
                    if ( $is_on_sale_param ) {
                        $filter_args['on_sale'] = true;
                    }

                    $catalog_items = function_exists( 'razgem_get_filtered_mock_products' ) ? razgem_get_filtered_mock_products( $filter_args ) : array();

                    if ( ! empty( $catalog_items ) ) :
                        ?>
                        <div class="shop-catalog-grid" id="shopCatalogGrid">
                            <?php foreach ( $catalog_items as $item ) : ?>
                                <div class="shop-item-wrapper" 
                                     data-product-id="<?php echo esc_attr( $item['id'] ); ?>"
                                     data-product-code="<?php echo esc_attr( $item['code'] ); ?>"
                                     data-product-title="<?php echo esc_attr( $item['title'] ); ?>"
                                     data-product-dimensions="<?php echo esc_attr( $item['dimensions'] ); ?>"
                                     data-product-material="<?php echo esc_attr( $item['material'] ); ?>"
                                     data-product-color="<?php echo esc_attr( $item['color'] ); ?>"
                                     data-product-desc="<?php echo esc_attr( $item['desc'] ); ?>"
                                     data-product-price="<?php echo esc_attr( $item['price_formatted'] ); ?>"
                                     data-product-primary="<?php echo esc_url( $item['img_primary'] ); ?>"
                                     data-product-hover="<?php echo esc_url( ! empty( $item['img_hover'] ) ? $item['img_hover'] : $item['img_primary'] ); ?>">
                                    <?php razgem_render_mock_product_card( $item ); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p class="woocommerce-info">اثری با مشخصات انتخابی یافت نشد. لطفاً فیلترهای دیگر را انتخاب نمایید.</p>
                    <?php endif; ?>

                <?php endif; ?>
            </div>
        </section>

    </div>
</main>

<div class="drawer-backdrop" aria-hidden="true"></div>

<?php
// Enqueue our new AJAX script
wp_enqueue_script( 'razgem-shop-ajax', get_template_directory_uri() . '/assets/js/shop-ajax.js', array(), '1.0', true );

// In-Place Lightweight Variation Pop-out Modal (Variable Products: R-005, R-006, R-008)
get_template_part( 'template-parts/variation-modal' );
get_footer( 'shop' );
?>