<?php
/**
 * Front Page Template (Products Prioritized & Organic Wave Rhythm)
 *
 * @package RazGem
 * @version 2.0.0
 */
defined( 'ABSPATH' ) || exit;
get_header(); ?>

<main id="primary" class="site-main" role="main">

    <?php
    // =========================================================================
    // 1. HAUTE-JOAILLERIE SPOTLIGHT HERO & INTERACTIVE SHOWCASE (Ivory Canvas)
    // =========================================================================
    get_template_part( 'template-parts/hero' );
    ?>

    <!-- =======================================================================
         2. CURATED ATELIER PIECES (Soft Sand Linen Background)
         ======================================================================= -->
    <div class="front-section-group section-palette-sand" style="padding-top: 2rem; padding-bottom: 3rem;">
        
        <?php
        // 2.1 SUGGESTED PRODUCTS CAROUSEL (پیشنهاد گالری رازجم)
        $suggested_products = array();

        if ( function_exists( 'wc_get_products' ) ) {
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
                    'orderby'    => 'date',
                    'order'      => 'DESC',
                ) );
            }
        }

        $has_suggested  = ! empty( $suggested_products );
        $mock_suggested = function_exists( 'razgem_get_filtered_mock_products' ) ? razgem_get_filtered_mock_products( array( 'featured' => true, 'limit' => 4 ) ) : array();

        if ( $has_suggested || ! empty( $mock_suggested ) ) :
        ?>
        <section id="suggested-products" class="product-carousel-section product-carousel-section--suggested" style="background: transparent;">
            <div class="site-container">
                <div class="section-header section-header--flex">
                    <div>
                        <h2>پیشنهاد گالری رازجم</h2>
                        <p>شاهکارهای دست‌ساز برگزیده از صدف طبیعی، مروارید باروک و یراق طلایی</p>
                    </div>
                    <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="view-all-link">مشاهده همه فروشگاه <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg></a>
                </div>

                <div class="carousel-wrapper">
                    <div class="carousel-track">
                        <?php
                        if ( $has_suggested ) :
                            foreach ( $suggested_products as $s_prod ) :
                                if ( ! is_object( $s_prod ) || ! method_exists( $s_prod, 'is_visible' ) || ! $s_prod->is_visible() ) continue;
                                $s_id   = $s_prod->get_id();
                                $s_link = get_permalink( $s_id );
                                $attachment_ids = $s_prod->get_gallery_image_ids();
                                ?>
                                <article class="carousel-card">
                                    <div class="product-card pebble-surface<?php echo ( is_a( $s_prod, 'WC_Product' ) && ! $s_prod->is_in_stock() ) ? ' is-out-of-stock' : ''; ?>">
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
                                                    <button type="button" 
                                                            class="product-card-cart-btn btn-coastal-action razgem-ajax-add-to-cart ajax_add_to_cart btn-fly-trigger" 
                                                            data-product_id="<?php echo esc_attr( $s_id ); ?>" 
                                                            data-product-id="<?php echo esc_attr( $s_id ); ?>"
                                                            data-quantity="1"
                                                            aria-label="افزودن به سبد خرید" 
                                                            title="افزودن به سبد خرید">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach;
                        else :
                            foreach ( $mock_suggested as $mock_p ) :
                                razgem_render_mock_product_card( $mock_p );
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- 2.2 NEW ARRIVALS CAROUSEL -->
        <section id="new-arrivals" class="product-carousel-section" style="background: transparent; margin-top: 1.5rem;">
            <div class="site-container">
                <div class="section-header section-header--flex">
                    <div>
                        <h2>جدیدترین دست‌سازه‌ها</h2>
                        <p>تازه‌ترین تراش‌های صدف طبیعی و مروارید باروک در کارگاه رازجم</p>
                    </div>
                    <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="view-all-link">مشاهده همه فروشگاه <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg></a>
                </div>

                <div class="carousel-wrapper">
                    <div class="carousel-track">
                        <?php
                        $has_wc_new = false;
                        if ( function_exists( 'wc_get_products' ) ) {
                            $wc_new_query = new WP_Query( array(
                                'post_type'      => 'product',
                                'posts_per_page' => 8,
                                'orderby'        => 'date',
                                'order'          => 'DESC',
                                'status'         => 'publish',
                            ) );

                            if ( $wc_new_query->have_posts() ) {
                                $has_wc_new = true;
                                while ( $wc_new_query->have_posts() ) : $wc_new_query->the_post();
                                    global $product;
                                    ?>
                                    <article class="carousel-card">
                                        <div class="product-card pebble-surface<?php echo ( is_a( $product, 'WC_Product' ) && ! $product->is_in_stock() ) ? ' is-out-of-stock' : ''; ?>">
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
                                                        <button type="button" 
                                                                class="product-card-cart-btn btn-coastal-action razgem-ajax-add-to-cart ajax_add_to_cart btn-fly-trigger" 
                                                                data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
                                                                data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"
                                                                data-quantity="1"
                                                                aria-label="افزودن به سبد خرید" 
                                                                title="افزودن به سبد خرید">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            }
                        }

                        if ( ! $has_wc_new && function_exists( 'razgem_get_mock_products' ) ) {
                            $mock_products = razgem_get_mock_products();
                            foreach ( $mock_products as $mock_p ) {
                                razgem_render_mock_product_card( $mock_p );
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <?php
    // Wave transition: from Sand (#FAF6F0) into Deep Coastal Slate (#2F597A)
    razgem_render_wave_divider( array(
        'fill_color'   => '#2F597A',
        'bg_color'     => '#FAF6F0',
        'layer1_color' => 'rgba(47, 89, 122, 0.40)',
        'layer2_color' => 'rgba(129, 166, 198, 0.65)',
        'layer3_color' => 'rgba(212, 175, 55, 0.75)',
        'height_pc'    => 165,
    ) );
    ?>

    <!-- =======================================================================
         3. SPECIAL OFFERS & BESPOKE MEMORIALS (Deep Coastal Slate Background)
         ======================================================================= -->
    <section class="product-carousel-section--highlight section-palette-slate" style="padding-top: 3.5rem; padding-bottom: 4rem;">
        <div class="site-container">
            <div class="highlight-wrapper">
                
                <div class="highlight-sidebar">
                    <span class="highlight-tag" style="background: rgba(212,175,55,0.25); color: #FAF8F5; border: 1px solid #D4AF37;">مجموعه برگزیده</span>
                    <h2 style="color: #FFFFFF;">پیشنهادهای ویژه و یادبودها</h2>
                    <p style="color: #F3E3D0;">فرصتی استثنایی برای داشتن زیورآلات فاخر صدف طبیعی و مروارید باروک با شرایط ویژه و شناسنامه اصالت.</p>
                    <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="btn-contrast-sand" style="border-radius: 999px; padding: 0.8rem 1.8rem; text-decoration: none; display: inline-block;">مشاهده برگزیده‌ها</a>
                </div>

                <div class="carousel-wrapper carousel-wrapper--narrow">
                    <div class="carousel-track">
                        <?php
                        $has_sale_wc = false;
                        if ( function_exists( 'wc_get_products' ) ) {
                            $sale_ids_inc = function_exists('wc_get_product_ids_on_sale') ? wc_get_product_ids_on_sale() : array();
                            if ( ! empty( $sale_ids_inc ) ) {
                                $sale_args = array(
                                    'post_type'      => 'product',
                                    'posts_per_page' => 6,
                                    'post__in'       => $sale_ids_inc,
                                    'status'         => 'publish'
                                );
                                $sale_loop = new WP_Query( $sale_args );
                                if ( $sale_loop->have_posts() ) {
                                    $has_sale_wc = true;
                                    while ( $sale_loop->have_posts() ) : $sale_loop->the_post();
                                        global $product;
                                        ?>
                                        <article class="carousel-card carousel-card--bg-white">
                                            <div class="product-card pebble-surface<?php echo ( is_a( $product, 'WC_Product' ) && ! $product->is_in_stock() ) ? ' is-out-of-stock' : ''; ?>">
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
                                                            <button type="button" 
                                                                    class="product-card-cart-btn btn-coastal-action razgem-ajax-add-to-cart ajax_add_to_cart btn-fly-trigger" 
                                                                    data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
                                                                    data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"
                                                                    data-quantity="1"
                                                                    aria-label="افزودن به سبد خرید" 
                                                                    title="افزودن به سبد خرید">
                                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                }
                            }
                        }

                        if ( ! $has_sale_wc && function_exists( 'razgem_get_filtered_mock_products' ) ) {
                            $mock_sales = razgem_get_filtered_mock_products( array( 'on_sale' => true ) );
                            foreach ( $mock_sales as $mock_p ) {
                                razgem_render_mock_product_card( $mock_p, 'carousel-card--bg-white' );
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php
    // Wave transition: from Deep Coastal Slate (#2F597A) into Seafoam Mist (#EAF3F7)
    razgem_render_wave_divider( array(
        'fill_color'   => '#EAF3F7',
        'bg_color'     => '#2F597A',
        'layer1_color' => 'rgba(129, 166, 198, 0.50)',
        'layer2_color' => 'rgba(212, 175, 55, 0.65)',
        'layer3_color' => 'rgba(255, 255, 255, 0.85)',
        'height_pc'    => 165,
    ) );
    ?>

    <!-- =======================================================================
         4. CATEGORY MOSAIC & LIVING STYLING SHOWCASE (Seafoam Mist Background)
         ======================================================================= -->
    <div class="front-section-group section-palette-seafoam" style="padding-top: 2rem; padding-bottom: 2.5rem;">
        <?php
        // 4.1 CURATED ASYMMETRIC LUXURY CATEGORY MOSAIC
        get_template_part( 'template-parts/categories' );

        // 4.2 INTERACTIVE WORN-ON-MODEL STYLING SHOWCASE
        get_template_part( 'template-parts/styling-showcase' );
        ?>
    </div>

    <?php
    // Wave transition: from Seafoam Mist (#EAF3F7) into Pearlescent Ivory (#FAF8F5)
    razgem_render_wave_divider( array(
        'fill_color'   => '#FAF8F5',
        'bg_color'     => '#EAF3F7',
        'layer1_color' => 'rgba(47, 89, 122, 0.35)',
        'layer2_color' => 'rgba(170, 205, 220, 0.65)',
        'layer3_color' => 'rgba(243, 227, 208, 0.85)',
        'height_pc'    => 165,
    ) );
    ?>

    <!-- =======================================================================
         5. ARTISAN ATELIER STORY & BESPOKE COMMISSION (Pearlescent Ivory)
         ======================================================================= -->
    <div class="front-section-group section-palette-ivory" style="padding-top: 2rem; padding-bottom: 2.5rem;">
        <?php
        get_template_part( 'template-parts/atelier' );
        ?>
    </div>

    <?php
    // Wave transition: from Ivory (#FAF8F5) into Soft Pebble Taupe (#F5EFEB)
    razgem_render_wave_divider( array(
        'fill_color'   => '#F5EFEB',
        'bg_color'     => '#FAF8F5',
        'layer1_color' => 'rgba(129, 166, 198, 0.40)',
        'layer2_color' => 'rgba(212, 175, 55, 0.60)',
        'layer3_color' => 'rgba(235, 225, 215, 0.85)',
        'height_pc'    => 165,
    ) );
    ?>

    <!-- =======================================================================
         6. VALUES, TRUST, PROMOS & MAGAZINE (Soft Pebble Taupe Background)
         ======================================================================= -->
    <div class="front-section-group section-palette-pebble" style="padding-top: 2.5rem; padding-bottom: 4rem;">
        
        <section class="promo-banner-section" style="background: transparent;">
            <div class="site-container promo-grid">
                <div class="promo-card promo-card--delivery pebble-surface">
                    <h3>ارسال رایگان و بیمه شده</h3>
                    <p>تمامی سفارش‌های گالری رازجم با بسته‌بندی نفیس هدیه و بیمه کامل پستی در سراسر ایران ارسال می‌شوند.</p>
                    <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>" class="btn-coastal-slate" style="font-size:0.85rem; padding:0.6rem 1.4rem;">شرایط ارسال و بیمه</a>
                </div>
                <div class="promo-card promo-card--consult pebble-surface">
                    <h3>راهنمای سایز و مشاوره تخصصی</h3>
                    <p>راهنمای انتخاب ابعاد صدف طبیعی، مرواریدهای باروک و ثبت سفارش ساخت اختصاصی با طراحان رازجم.</p>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-coastal-sand" style="font-size:0.85rem; padding:0.6rem 1.4rem;">مشاوره مستقیم</a>
                </div>
            </div>
        </section>

        <section class="features-section" style="background: transparent; margin-top: 3rem;">
            <div class="site-container features-grid">
                <div class="feature-card pebble-surface">
                    <div class="feature-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg></div>
                    <div class="feature-card__info">
                        <h3>بسته‌بندی فاخر و شناسنامه</h3>
                        <p>جعبه هدیه نفیس و شناسنامه اصالت فیزیکی اثر</p>
                    </div>
                </div>
                <div class="feature-card pebble-surface">
                    <div class="feature-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></div>
                    <div class="feature-card__info">
                        <h3>ارسال بیمه‌شده و اکسپرس</h3>
                        <p>ارسال به سراسر کشور با پوشش بیمه کامل محموله</p>
                    </div>
                </div>
                <div class="feature-card pebble-surface">
                    <div class="feature-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></div>
                    <div class="feature-card__info">
                        <h3>ضمانت اصالت گوهر و دریا</h3>
                        <p>صدف ۱۰۰٪ طبیعی، مروارید اصل و طلای ۱۸ عیار</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="magazine-section" style="background: transparent; margin-top: 3.5rem;">
            <div class="site-container">
                <div class="section-header section-header--flex">
                    <div>
                        <h2>مجله طلا و گوهرشناسی دریا</h2>
                        <p>راهنمای شناخت و نگهداری مرواریدهای باروک، صدف‌های طبیعی و فلزات گرانبها</p>
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
                            <article class="magazine-card pebble-surface">
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
                        echo '<p style="text-align:center; grid-column: 1/-1; color: var(--color-marine-muted);">به زودی مقالات جدید مجله گوهرشناسی منتشر خواهد شد.</p>';
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>

    </div>

    <?php
    // Wave transition: from Pebble Taupe (#F5EFEB) into Deep Coastal Slate Footer (#1B3347)
    razgem_render_wave_divider( array(
        'fill_color'   => '#1B3347',
        'bg_color'     => '#F5EFEB',
        'layer1_color' => 'rgba(47, 89, 122, 0.45)',
        'layer2_color' => 'rgba(129, 166, 198, 0.65)',
        'layer3_color' => 'rgba(35, 70, 97, 0.85)',
        'height_pc'    => 165,
    ) );
    ?>

</main>

<?php get_footer(); ?>