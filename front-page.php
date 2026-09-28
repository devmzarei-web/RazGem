<?php
/**
 * Front Page Template (High-Density Storefront & Living Waves Rhythm)
 *
 * @package RazGem
 * @version 2.1.0
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
         1.1 SLIM ARTISAN AUTHENTICITY GUARANTEE RIBBON (High-Density Confidence)
         ======================================================================= -->
    <section class="razgem-authenticity-ribbon" aria-label="ضمانت‌ها و اصالت گالری رازجم">
        <div class="site-container">
            <div class="ribbon-inner">
                <div class="ribbon-item">
                    <span class="ribbon-icon">🦪</span>
                    <span class="ribbon-text"><strong>صدف ۱۰۰٪ طبیعی</strong> خلیج فارس</span>
                </div>
                <div class="ribbon-divider" aria-hidden="true"></div>
                <div class="ribbon-item">
                    <span class="ribbon-icon">✨</span>
                    <span class="ribbon-text"><strong>مروارید باروک اصل</strong> با شناسنامه</span>
                </div>
                <div class="ribbon-divider" aria-hidden="true"></div>
                <div class="ribbon-item">
                    <span class="ribbon-icon">⚖️</span>
                    <span class="ribbon-text"><strong>طلای ۱۸ عیار</strong> و هنر دست</span>
                </div>
                <div class="ribbon-divider" aria-hidden="true"></div>
                <div class="ribbon-item">
                    <span class="ribbon-icon">📦</span>
                    <span class="ribbon-text"><strong>ارسال رایگان و بیمه‌شده</strong> سراسر کشور</span>
                </div>
            </div>
        </div>
    </section>

    <!-- =======================================================================
         2. HIGH-DENSITY ATELIER VITRINE (Compact 4-Column Grid with Category Tabs)
         ======================================================================= -->
    <div class="front-section-group section-palette-sand" style="padding-top: 2.2rem; padding-bottom: 2.8rem;">
        
        <section id="handcrafted-catalog" class="compact-vitrine-section" style="background: transparent;">
            <div class="site-container">
                <div class="section-header section-header--center" style="margin-bottom: 1.6rem;">
                    <span class="section-kicker">شاهکارهای منتخب آتلیه</span>
                    <h2 class="section-title">مجموعه دست‌سازه‌های صدف و مروارید</h2>
                    <p class="section-lead">تراش دست و تلألو ارگانیک طبیعت، با طلای ۱۸ عیار و مرواریدهای باروک خلیج فارس</p>
                    
                    <!-- Quick Category Filter Tabs -->
                    <div class="vitrine-category-tabs" role="tablist" aria-label="دسته‌بندی زیورآلات">
                        <button type="button" class="vitrine-tab is-active" data-filter="all" role="tab" aria-selected="true">همه آثار (۸)</button>
                        <button type="button" class="vitrine-tab" data-filter="earrings" role="tab" aria-selected="false">گوشواره صدف</button>
                        <button type="button" class="vitrine-tab" data-filter="necklaces" role="tab" aria-selected="false">گردنبند و چوکر</button>
                        <button type="button" class="vitrine-tab" data-filter="bracelets-rings" role="tab" aria-selected="false">دستبند و انگشتر</button>
                    </div>
                </div>

                <!-- Compact 4-Column Showcase Grid -->
                <div class="compact-vitrine-grid" id="razgemVitrineGrid">
                    <?php
                    $rendered_count = 0;

                    // 1. Try fetching published WooCommerce products
                    if ( function_exists( 'wc_get_products' ) ) {
                        $wc_catalog_query = new WP_Query( array(
                            'post_type'      => 'product',
                            'posts_per_page' => 12,
                            'orderby'        => 'menu_order title',
                            'order'          => 'ASC',
                            'status'         => 'publish',
                        ) );

                        if ( $wc_catalog_query->have_posts() ) {
                            while ( $wc_catalog_query->have_posts() ) : $wc_catalog_query->the_post();
                                global $product;
                                if ( ! is_object( $product ) ) continue;

                                $p_id        = $product->get_id();
                                $p_link      = get_permalink( $p_id );
                                $is_in_stock = $product->is_in_stock();
                                $is_variable = $product->is_type( 'variable' );
                                $sku         = $product->get_sku();
                                $gallery_ids = $product->get_gallery_image_ids();
                                $thumb_id    = $product->get_image_id();
                                $thumb_url   = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'full' ) : '';

                                // Determine category filter slug
                                $terms = get_the_terms( $p_id, 'product_cat' );
                                $cat_slug = 'all';
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                                    $first_cat = $terms[0]->slug;
                                    if ( strpos( $first_cat, 'earring' ) !== false || strpos( $first_cat, 'گوشواره' ) !== false ) {
                                        $cat_slug = 'earrings';
                                    } elseif ( strpos( $first_cat, 'necklace' ) !== false || strpos( $first_cat, 'choker' ) !== false || strpos( $first_cat, 'گردنبند' ) !== false || strpos( $first_cat, 'چوکر' ) !== false ) {
                                        $cat_slug = 'necklaces';
                                    } elseif ( strpos( $first_cat, 'bracelet' ) !== false || strpos( $first_cat, 'ring' ) !== false || strpos( $first_cat, 'دستبند' ) !== false || strpos( $first_cat, 'انگشتر' ) !== false ) {
                                        $cat_slug = 'bracelets-rings';
                                    }
                                }

                                // Fallback category by SKU
                                if ( 'all' === $cat_slug && ! empty( $sku ) ) {
                                    $clean_sku = strtoupper( str_replace( array( 'RG-', '-' ), '', $sku ) );
                                    if ( in_array( $clean_sku, array( 'R001', 'R002', 'R004' ), true ) ) {
                                        $cat_slug = 'earrings';
                                    } elseif ( in_array( $clean_sku, array( 'R003', 'R007' ), true ) ) {
                                        $cat_slug = 'necklaces';
                                    } elseif ( in_array( $clean_sku, array( 'R005', 'R006', 'R008' ), true ) ) {
                                        $cat_slug = 'bracelets-rings';
                                    }
                                }
                                ?>
                                <article class="vitrine-card-wrapper" data-category="<?php echo esc_attr( $cat_slug ); ?>">
                                    <div class="product-card pebble-surface<?php echo ( ! $is_in_stock ) ? ' is-out-of-stock' : ''; ?>">
                                        <div class="product-card__gallery">
                                            <a href="<?php echo esc_url( $p_link ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                                                <?php 
                                                if ( $thumb_id ) {
                                                    echo wp_get_attachment_image( $thumb_id, 'full', false, array( 'class' => 'img-primary', 'alt' => esc_attr( get_the_title() ) ) );
                                                } else {
                                                    echo function_exists('wc_placeholder_img') ? wc_placeholder_img( 'full', array( 'class' => 'img-primary', 'alt' => esc_attr( get_the_title() ) ) ) : '';
                                                }
                                                if ( ! empty( $gallery_ids ) ) {
                                                    echo wp_get_attachment_image( $gallery_ids[0], 'full', false, array( 'class' => 'img-hover', 'alt' => esc_attr( get_the_title() ) ) );
                                                }
                                                ?>
                                            </a>

                                            <?php if ( ! $is_in_stock ) : ?>
                                                <span class="product-badge product-badge--outofstock">ناموجود</span>
                                            <?php elseif ( $product->is_on_sale() ) : ?>
                                                <span class="product-badge product-badge--discount">ویژه</span>
                                            <?php else : ?>
                                                <span class="product-badge product-badge--nature">دست‌ساز</span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="product-card__content">
                                            <div class="product-authenticity-tag">
                                                <span class="auth-dot"></span>
                                                <span>صدف طبیعی و طلای ۱۸ عیار</span>
                                            </div>

                                            <h3 class="product-title">
                                                <a href="<?php echo esc_url( $p_link ); ?>"><?php the_title(); ?></a>
                                            </h3>

                                            <div class="product-meta">
                                                <?php echo function_exists( 'wc_get_product_category_list' ) ? wc_get_product_category_list( $p_id, ', ' ) : ''; ?>
                                                <?php if ( ! empty( $sku ) ) : ?> | کد: <?php echo esc_html( $sku ); ?><?php endif; ?>
                                            </div>

                                            <div class="product-card__action-row">
                                                <div class="product-price">
                                                    <?php echo method_exists( $product, 'get_price_html' ) ? $product->get_price_html() : ''; ?>
                                                </div>

                                                <?php if ( ! $is_in_stock ) : ?>
                                                    <span class="product-card-cart-btn disabled" aria-disabled="true" title="این اثر در حال حاضر ناموجود است">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                    </span>
                                                <?php elseif ( $is_variable ) : ?>
                                                    <?php
                                                    $variation_label = 'انتخاب گزینه';
                                                    $variation_options = array();
                                                    $attributes = $product->get_attributes();
                                                    if ( ! empty( $attributes ) ) {
                                                        $first_attr = reset( $attributes );
                                                        $variation_label = wc_attribute_label( $first_attr->get_name() );
                                                        $variation_options = $first_attr->get_options();
                                                    }
                                                    ?>
                                                    <button type="button" 
                                                            class="product-card-cart-btn btn-coastal-action razgem-open-variation-modal" 
                                                            data-product-id="<?php echo esc_attr( $p_id ); ?>"
                                                            data-product-title="<?php echo esc_attr( get_the_title() ); ?>"
                                                            data-product-price="<?php echo esc_attr( wp_strip_all_tags( $product->get_price_html() ) ); ?>"
                                                            data-product-image="<?php echo esc_url( $thumb_url ); ?>"
                                                            data-variation-label="<?php echo esc_attr( $variation_label ); ?>"
                                                            data-variations="<?php echo esc_attr( wp_json_encode( $variation_options ) ); ?>"
                                                            aria-label="انتخاب گزینه‌های <?php echo esc_attr( get_the_title() ); ?>"
                                                            title="انتخاب گزینه‌ها">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                    </button>
                                                <?php else : ?>
                                                    <button type="button" 
                                                            class="product-card-cart-btn btn-coastal-action razgem-ajax-add-to-cart ajax_add_to_cart btn-fly-trigger" 
                                                            data-product_id="<?php echo esc_attr( $p_id ); ?>" 
                                                            data-product-id="<?php echo esc_attr( $p_id ); ?>"
                                                            data-quantity="1"
                                                            aria-label="افزودن <?php echo esc_attr( get_the_title() ); ?> به سبد خرید" 
                                                            title="افزودن مستقیم به سبد خرید">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <?php
                                $rendered_count++;
                            endwhile;
                            wp_reset_postdata();
                        }
                    }

                    // 2. Fallback to full 8-piece mock catalog if no WooCommerce products are published
                    if ( $rendered_count === 0 && function_exists( 'razgem_get_mock_products' ) ) {
                        $all_mocks = razgem_get_mock_products();
                        foreach ( $all_mocks as $m_item ) {
                            $cat_slug = 'all';
                            if ( in_array( $m_item['id'], array( 'r-001', 'r-002', 'r-004' ), true ) ) {
                                $cat_slug = 'earrings';
                            } elseif ( in_array( $m_item['id'], array( 'r-003', 'r-007' ), true ) ) {
                                $cat_slug = 'necklaces';
                            } elseif ( in_array( $m_item['id'], array( 'r-005', 'r-006', 'r-008' ), true ) ) {
                                $cat_slug = 'bracelets-rings';
                            }
                            ?>
                            <div class="vitrine-card-wrapper" data-category="<?php echo esc_attr( $cat_slug ); ?>">
                                <?php razgem_render_mock_product_card( $m_item ); ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="vitrine-footer-cta" style="text-align: center; margin-top: 2rem;">
                    <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="btn-coastal-slate pearl-shimmer-hover" style="border-radius: 9999px; padding: 0.85rem 2.2rem;">
                        <span>مشاهده کلکسیون کامل فروشگاه (۸ اثر دست‌ساز)</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                    </a>
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
    <section class="product-carousel-section--highlight section-palette-slate" style="padding-top: 3rem; padding-bottom: 3.5rem;">
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
                                                        <?php elseif ( is_a( $product, 'WC_Product' ) && $product->is_type( 'variable' ) ) : ?>
                                                            <button type="button" 
                                                                    class="product-card-cart-btn btn-coastal-action razgem-open-variation-modal" 
                                                                    data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"
                                                                    data-product-title="<?php echo esc_attr( get_the_title() ); ?>"
                                                                    data-product-price="<?php echo esc_attr( wp_strip_all_tags( $product->get_price_html() ) ); ?>"
                                                                    data-product-image="<?php echo esc_url( wp_get_attachment_image_url( $product->get_image_id(), 'full' ) ); ?>"
                                                                    aria-label="انتخاب گزینه‌ها" 
                                                                    title="انتخاب گزینه‌ها">
                                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                            </button>
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
         5. MID-PAGE STORY CAPSULE & ARTISAN ATELIER (Pearlescent Ivory)
         ======================================================================= -->
    <div class="front-section-group section-palette-ivory" style="padding-top: 2rem; padding-bottom: 2.5rem;">
        
        <!-- Mid-Page Coastal Story Capsule Banner -->
        <section class="coastal-story-capsule-section" style="padding: 0 0 2.5rem;">
            <div class="site-container">
                <div class="coastal-story-capsule pebble-surface">
                    <div class="capsule-content">
                        <span class="capsule-tag">✨ اصالت دست‌سازه و هویت دریا</span>
                        <h3 class="capsule-title">شکوه گوهرهای ارگانیک خلیج فارس در آتلیه رازجم</h3>
                        <p class="capsule-desc">هر قطعه صدف طبیعی و مروارید باروک وحشی، داستانی تکرارناپذیر از اعماق دریاست که با هنر دست استادکاران ایرانی و طلای ۱۸ عیار جاودانه شده است. آیا به دنبال طراحی اختصاصی متناسب با سلیقه خود هستید؟</p>
                        <div class="capsule-actions">
                            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-coastal-slate pearl-shimmer-hover">مشاوره سفارش اختصاصی</a>
                            <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="btn-coastal-sand">مشاهده همه ۸ اثر</a>
                        </div>
                    </div>
                    <div class="capsule-badge-art" aria-hidden="true">
                        <span class="badge-sea-icon">🦪</span>
                    </div>
                </div>
            </div>
        </section>

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
    <div class="front-section-group section-palette-pebble" style="padding-top: 2.2rem; padding-bottom: 3.5rem;">
        
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

        <section class="features-section" style="background: transparent; margin-top: 2.5rem;">
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

        <section class="magazine-section" style="background: transparent; margin-top: 2.8rem;">
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

<?php
// In-Place Lightweight Variation Pop-out Modal (Variable Products: R-005, R-006, R-008)
get_template_part( 'template-parts/variation-modal' );
?>

<?php get_footer(); ?>