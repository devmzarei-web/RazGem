<?php
/**
 * Front Page Template (Products Prioritized)
 */
defined( 'ABSPATH' ) || exit;
get_header(); ?>

<main id="primary" class="site-main" role="main">

    <?php
    // --- 1. HAUTE-JOAILLERIE SPOTLIGHT HERO & INTERACTIVE SHOWCASE ---
    get_template_part( 'template-parts/hero' );
    ?>

    <?php
    // --- 2. SUGGESTED PRODUCTS CAROUSEL (پیشنهاد گالری رازجم) ---
    $suggested_products = array();

    if ( function_exists( 'wc_get_products' ) ) {
        // Query products marked with _razgem_is_suggested = 'yes' (or fallback _golkhane_is_suggested)
        $suggested_products = wc_get_products( array(
            'status'     => 'publish',
            'limit'      => 12,
            'meta_key'   => '_razgem_is_suggested',
            'meta_value' => 'yes',
            'orderby'    => 'date',
            'order'      => 'DESC',
        ) );

        if ( empty( $suggested_products ) ) {
            $suggested_products = wc_get_products( array(
                'status'     => 'publish',
                'limit'      => 12,
                'meta_key'   => '_golkhane_is_suggested',
                'meta_value' => 'yes',
                'orderby'    => 'date',
                'order'      => 'DESC',
            ) );
        }
    }

    // Direct WP_Query fallback check
    if ( empty( $suggested_products ) ) {
        $direct_sugg_query = new WP_Query( array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 12,
            'meta_query'     => array(
                'relation' => 'OR',
                array(
                    'key'     => '_razgem_is_suggested',
                    'value'   => 'yes',
                    'compare' => '=',
                ),
                array(
                    'key'     => '_golkhane_is_suggested',
                    'value'   => 'yes',
                    'compare' => '=',
                ),
            ),
            'orderby'        => 'date',
            'order'          => 'DESC',
            'no_found_rows'  => true,
        ) );

        if ( $direct_sugg_query->have_posts() && function_exists( 'wc_get_product' ) ) {
            foreach ( $direct_sugg_query->posts as $p_post ) {
                $p_obj = wc_get_product( $p_post->ID );
                if ( $p_obj ) {
                    $suggested_products[] = $p_obj;
                }
            }
            wp_reset_postdata();
        }
    }

    if ( ! empty( $suggested_products ) ) :
    ?>
    <section id="suggested-products" class="product-carousel-section product-carousel-section--suggested">
        <div class="site-container">
            <div class="section-header section-header--flex">
                <div>
                    <h2>پیشنهاد گالری رازجم</h2>
                    <p>شاهکارهای دست‌ساز برگزیده از طلا و مروارید باروک</p>
                </div>
                <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="view-all-link">مشاهده همه فروشگاه <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg></a>
            </div>

            <div class="carousel-wrapper">
                <div class="carousel-track">
                    <?php
                    foreach ( $suggested_products as $s_prod ) :
                        if ( ! is_object( $s_prod ) || ! method_exists( $s_prod, 'is_visible' ) || ! $s_prod->is_visible() ) continue;
                        $s_id   = $s_prod->get_id();
                        $s_link = get_permalink( $s_id );
                        $attachment_ids = $s_prod->get_gallery_image_ids();
                        ?>
                        <article class="carousel-card">
                            <div class="product-card<?php echo ( is_a( $s_prod, 'WC_Product' ) && ! $s_prod->is_in_stock() ) ? ' is-out-of-stock' : ''; ?>">
                                <div class="product-card__gallery">
                                    <a href="<?php echo esc_url( $s_link ); ?>">
                                        <?php 
                                        $primary_img_id = $s_prod->get_image_id();
                                        if ( $primary_img_id ) {
                                            echo wp_get_attachment_image( $primary_img_id, 'full', false, array( 'class' => 'img-primary', 'alt' => esc_attr( $s_prod->get_name() ) ) );
                                        } else {
                                            echo function_exists('wc_placeholder_img') ? wc_placeholder_img( 'full', array( 'class' => 'img-primary', 'alt' => esc_attr( $s_prod->get_name() ) ) ) : '';
                                        }
                                        if ( ! empty( $attachment_ids ) ) {
                                            echo wp_get_attachment_image( $attachment_ids[0], 'full', false, array( 'class' => 'img-hover', 'alt' => esc_attr( $s_prod->get_name() ) ) );
                                        }
                                        ?>
                                    </a>
                                    <?php if ( is_a( $s_prod, 'WC_Product' ) && ! $s_prod->is_in_stock() ) : ?>
                                        <span class="product-badge product-badge--outofstock">ناموجود</span>
                                    <?php else : ?>
                                        <span class="product-badge product-badge--suggested">پیشنهادی</span>
                                    <?php endif; ?>
                                </div>
                                <div class="product-card__content">
                                    <h3 class="product-title"><a href="<?php echo esc_url( $s_link ); ?>"><?php echo esc_html( $s_prod->get_name() ); ?></a></h3>
                                    <div class="product-meta"><?php echo function_exists('wc_get_product_category_list') ? wc_get_product_category_list( $s_id, ', ' ) : ''; ?></div>
                                    <div class="product-card__action-row">
                                        <div class="product-price"><?php echo method_exists( $s_prod, 'get_price_html' ) ? $s_prod->get_price_html() : ''; ?></div>
                                        <?php if ( is_a( $s_prod, 'WC_Product' ) && ! $s_prod->is_in_stock() ) : ?>
                                            <span class="product-card-cart-btn disabled" aria-disabled="true" title="این محصول ناموجود است">
                                                 <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                            </span>
                                        <?php else : ?>
                                            <a href="<?php echo esc_url( method_exists( $s_prod, 'add_to_cart_url' ) ? $s_prod->add_to_cart_url() : '#' ); ?>" data-quantity="1" class="product-card-cart-btn button product_type_<?php echo esc_attr( method_exists( $s_prod, 'get_type' ) ? $s_prod->get_type() : 'simple' ); ?> add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo esc_attr( $s_id ); ?>" aria-label="افزودن به سبد خرید" rel="nofollow">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section id="new-arrivals" class="product-carousel-section">
        <div class="site-container">
            <div class="section-header section-header--flex">
                <div>
                    <h2>جدیدترین دست‌سازه‌ها</h2>
                    <p>درخشش بی‌بدیل طلا و مروارید در تازه‌ترین آثار کارگاه رازجم</p>
                </div>
                <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="view-all-link">مشاهده همه فروشگاه <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg></a>
            </div>

            <div class="carousel-wrapper">
                <div class="carousel-track">
                    <?php
                    $sale_ids_exclude = function_exists('wc_get_product_ids_on_sale') ? wc_get_product_ids_on_sale() : array();
                    $args = array(
                        'post_type'      => 'product',
                        'posts_per_page' => 8,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                        'status'         => 'publish',
                        'post__not_in'   => ! empty($sale_ids_exclude) ? $sale_ids_exclude : array()
                    );
                    $loop = new WP_Query( $args );

                    if ( $loop->have_posts() ) :
                        while ( $loop->have_posts() ) : $loop->the_post();
                            global $product;
                            ?>
                            <article class="carousel-card">
                                <div class="product-card<?php echo ( is_a( $product, 'WC_Product' ) && ! $product->is_in_stock() ) ? ' is-out-of-stock' : ''; ?>">
                                    <div class="product-card__gallery">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php 
                                            if ( function_exists( 'woocommerce_get_product_thumbnail' ) ) {
                                                echo woocommerce_get_product_thumbnail('full', array('class' => 'img-primary', 'alt' => get_the_title())); 
                                            } else {
                                                echo has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'full', array('class' => 'img-primary', 'alt' => get_the_title()) ) : '';
                                            }
                                            $attachment_ids = ( is_a( $product, 'WC_Product' ) ) ? $product->get_gallery_image_ids() : array();

                                            if ( $attachment_ids ) {
                                                echo wp_get_attachment_image( $attachment_ids[0], 'full', false, array( 'class' => 'img-hover', 'alt' => get_the_title() ) );
                                            }
                                            ?>
                                        </a>
                                        <?php if ( is_a( $product, 'WC_Product' ) && ! $product->is_in_stock() ) : ?>
                                            <span class="product-badge product-badge--outofstock">ناموجود</span>
                                        <?php else : ?>
                                            <span class="product-badge product-badge--new">جدید</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-card__content">
                                        <h3 class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                         <div class="product-meta"><?php echo function_exists('wc_get_product_category_list') ? wc_get_product_category_list( $product->get_id(), ', ' ) : ''; ?></div>
                                        <div class="product-card__action-row">
                                            <div class="product-price"><?php echo method_exists( $product, 'get_price_html' ) ? $product->get_price_html() : ''; ?></div>
                                            <?php if ( is_a( $product, 'WC_Product' ) && ! $product->is_in_stock() ) : ?>
                                                <span class="product-card-cart-btn disabled" aria-disabled="true" title="این محصول ناموجود است">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                </span>
                                            <?php else : ?>
                                                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" data-quantity="1" class="product-card-cart-btn button product_type_<?php echo esc_attr( $product->get_type() ); ?> add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" aria-label="افزودن به سبد خرید" rel="nofollow">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="product-carousel-section--highlight">
        <div class="site-container">
            <div class="highlight-wrapper">
                
                <div class="highlight-sidebar">
                    <span class="highlight-tag">مجموعه برگزیده</span>
                    <h2>پیشنهادهای ویژه و یادبودها</h2>
                    <p>فرصتی استثنایی برای داشتن زیورآلات فاخر طلا و مروارید دست‌ساز با شرایط ویژه.</p>
                    <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="btn-highlight">مشاهده برگزیده‌ها</a>
                </div>

                <div class="carousel-wrapper carousel-wrapper--narrow">
                    <div class="carousel-track">
                        <?php
                        $sale_ids_inc = function_exists('wc_get_product_ids_on_sale') ? wc_get_product_ids_on_sale() : array();
                        $sale_args = array(
                            'post_type'      => 'product',
                            'posts_per_page' => 6,
                            'post__in'       => ! empty($sale_ids_inc) ? $sale_ids_inc : array(0),
                            'status'         => 'publish'
                        );
                        $sale_loop = new WP_Query( $sale_args );

                        if ( $sale_loop->have_posts() ) :
                            while ( $sale_loop->have_posts() ) : $sale_loop->the_post();
                                global $product;
                                ?>
                                <article class="carousel-card carousel-card--bg-white">
                                    <div class="product-card<?php echo ( is_a( $product, 'WC_Product' ) && ! $product->is_in_stock() ) ? ' is-out-of-stock' : ''; ?>">
                                        <div class="product-card__gallery">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php 
                                                if ( function_exists( 'woocommerce_get_product_thumbnail' ) ) {
                                                    echo woocommerce_get_product_thumbnail('full', array('class' => 'img-primary', 'alt' => get_the_title())); 
                                                } else {
                                                    echo has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'full', array('class' => 'img-primary', 'alt' => get_the_title()) ) : '';
                                                }
                                                $attachment_ids = ( is_a( $product, 'WC_Product' ) ) ? $product->get_gallery_image_ids() : array();
                                                if ( $attachment_ids ) {
                                                    echo wp_get_attachment_image( $attachment_ids[0], 'full', false, array( 'class' => 'img-hover', 'alt' => get_the_title() ) );
                                                }
                                                ?>
                                            </a>
                                            <?php if ( is_a( $product, 'WC_Product' ) && ! $product->is_in_stock() ) : ?>
                                                <span class="product-badge product-badge--outofstock">ناموجود</span>
                                            <?php else : ?>
                                                <span class="product-badge product-badge--discount">حراج</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="product-card__content">
                                            <h3 class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <div class="product-meta"><?php echo function_exists('wc_get_product_category_list') ? wc_get_product_category_list( $product->get_id(), ', ' ) : ''; ?></div>
                                            <div class="product-card__action-row">
                                                <div class="product-price"><?php echo method_exists( $product, 'get_price_html' ) ? $product->get_price_html() : ''; ?></div>
                                                <?php if ( is_a( $product, 'WC_Product' ) && ! $product->is_in_stock() ) : ?>
                                                    <span class="product-card-cart-btn disabled" aria-disabled="true" title="این محصول ناموجود است">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                    </span>
                                                <?php else : ?>
                                                    <a href="<?php echo esc_url( method_exists( $product, 'add_to_cart_url' ) ? $product->add_to_cart_url() : '#' ); ?>" data-quantity="1" class="product-card-cart-btn button product_type_<?php echo esc_attr( method_exists( $product, 'get_type' ) ? $product->get_type() : 'simple' ); ?> add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" aria-label="افزودن به سبد خرید" rel="nofollow">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <?php
                            endwhile;
                        else :
                            echo '<p style="padding:2rem;">در حال حاضر حراجی فعالی وجود ندارد.</p>';
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php
    // --- 5. CURATED ASYMMETRIC LUXURY CATEGORY MOSAIC ---
    get_template_part( 'template-parts/categories' );

    // --- 5.1 INTERACTIVE WORN-ON-MODEL STYLING SHOWCASE ---
    get_template_part( 'template-parts/styling-showcase' );

    // --- 6. ARTISAN ATELIER STORY & BESPOKE COMMISSION ---
    get_template_part( 'template-parts/atelier' );
    ?>

    <section class="promo-banner-section">
        <div class="site-container promo-grid">
            <div class="promo-card promo-card--delivery">
                <h3>ارسال رایگان و بیمه شده</h3>
                <p>تمامی سفارش‌های گالری رازجم با بسته‌بندی نفیس هدیه و بیمه کامل ارسال می‌شوند.</p>
                <a href="/terms" class="promo-btn">شرایط ارسال و بیمه</a>
            </div>
            <div class="promo-card promo-card--consult">
                <h3>راهنمای سایز و مشاوره تخصصی</h3>
                <p>راهنمای تعیین دقیق سایز انگشتر و مشاوره در ساخت سفارشی زیورآلات طلا.</p>
                <a href="/contact" class="promo-btn">مشاوره با کارشناس</a>
            </div>
        </div>
    </section>

    <section class="features-section">
        <div class="site-container features-grid">
            <div class="feature-card">
                <div class="feature-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg></div>
                <div class="feature-card__info">
                    <h3>بسته‌بندی فاخر و شناسنامه</h3>
                    <p>جعبه هدیه نفیس و شناسنامه اصالت</p>
                </div>
            </div>
            <div class="feature-card">
                <div class="feature-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></div>
                <div class="feature-card__info">
                    <h3>ارسال بیمه‌شده و اکسپرس</h3>
                    <p>پست پیشتاز ویژه با بیمه کامل</p>
                </div>
            </div>
            <div class="feature-card">
                <div class="feature-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></div>
                <div class="feature-card__info">
                    <h3>ضمانت اصالت طلا و مروارید</h3>
                    <p>طلای ۱۸ عیار و مروارید اصل باروک</p>
                </div>
            </div>
        </div>
    </section>

    <section class="magazine-section">
        <div class="site-container">
            <div class="section-header section-header--flex">
                <div>
                    <h2>مجله طلا و گوهرشناسی</h2>
                    <p>راهنمای شناخت و نگهداری مروارید، طلا و سنگ‌های قیمتی</p>
                </div>
                <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="view-all-link">آرشیو مجله <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg></a>
            </div>
            
            <div class="magazine-grid">
                <?php
                $mag_args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 4,
                    'status'         => 'publish'
                );
                $mag_loop = new WP_Query( $mag_args );

                if ( $mag_loop->have_posts() ) :
                    while ( $mag_loop->have_posts() ) : $mag_loop->the_post();
                        ?>
                        <article class="magazine-card">
                            <div class="magazine-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'medium_large', array( 'alt' => get_the_title() ) ); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/placeholder.jpg" alt="<?php echo esc_attr(get_the_title()); ?>">
                                    <?php endif; ?>
                                </a>
                                <?php
                                $categories = get_the_category();
                                if ( ! empty( $categories ) ) {
                                    echo '<span class="magazine-tag">' . esc_html( $categories[0]->name ) . '</span>';
                                }
                                ?>
                            </div>
                            <div class="magazine-body">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="magazine-excerpt">
                                    <?php echo wp_trim_words( get_the_excerpt(), 12, '...' ); ?>
                                </div>
                            </div>
                        </article>
                        <?php
                    endwhile;
                else :
                    echo '<p style="text-align:center; grid-column: 1/-1;">هنوز مقاله‌ای منتشر نشده است.</p>';
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>