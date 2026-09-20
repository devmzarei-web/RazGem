<?php
/**
 * The Template for displaying product archives, including the main shop page.
 * Optimized for SEO and clean DOM structure.
 */
defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>

<main class="site-container shop-archive-page" dir="rtl" role="main">
    
    <header class="shop-custom-header">
        <nav class="shop-breadcrumbs" aria-label="Breadcrumb">
            <?php woocommerce_breadcrumb(); ?>
        </nav>
        
        <div class="shop-header-inner">
            <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
            
            <div class="shop-header-actions">
                <?php
                if ( woocommerce_product_loop() ) {
                    woocommerce_result_count();
                    woocommerce_catalog_ordering();
                }
                ?>
            </div>
        </div>

        <!-- Jewelry Category Filter Pills (T012 / US1) -->
        <nav class="jewelry-filter-pills" aria-label="فیلتر دسته‌بندی زیورآلات">
            <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="filter-pill <?php echo ( function_exists('is_shop') && is_shop() && ! isset( $_GET['on_sale'] ) ) ? 'active' : ''; ?>">
                همه زیورآلات
            </a>
            <?php
            $current_cat_id = function_exists('is_product_category') && is_product_category() ? get_queried_object_id() : 0;
            $cats = get_terms( array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
                'parent'     => 0,
            ) );
            if ( ! empty( $cats ) && ! is_wp_error( $cats ) ) {
                foreach ( $cats as $cat ) {
                    $is_active = ( $current_cat_id === $cat->term_id );
                    echo '<a href="' . esc_url( get_term_link( $cat ) ) . '" class="filter-pill ' . ( $is_active ? 'active' : '' ) . '">' . esc_html( $cat->name ) . '</a>';
                }
            }
            ?>
            <a href="<?php echo esc_url( add_query_arg( 'on_sale', '1', razgem_shop_url() ) ); ?>" class="filter-pill filter-pill--sale <?php echo isset( $_GET['on_sale'] ) ? 'active' : ''; ?>">
                مجموعه برگزیده
            </a>
        </nav>
        
        <?php do_action( 'woocommerce_archive_description' ); ?>
    </header>

    <div class="shop-layout-grid">
        
        <aside class="shop-sidebar" role="complementary">
            <div class="shop-sidebar-sticky">
                <?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'shop-sidebar' ); ?>
                <?php else: ?>
                    <div class="shop-widget">
                        <p class="empty-sidebar">ابزارک‌های فیلتر را از بخش نمایش > ابزارک‌ها به سایدبار فروشگاه اضافه کنید.</p>
                    </div>
                <?php endif; ?>
            </div>
        </aside>

        <section class="shop-main-content">
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
                do_action( 'woocommerce_no_products_found' );
            }
            ?>
        </section>

    </div>
</main>

<?php get_footer( 'shop' ); ?>