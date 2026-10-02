<?php
/**
 * Front Page Template - RazGem Commercial Luxury Storefront
 *
 * Sequence of Sections:
 * 1. Commercial 3-Part Hero Grid (Wide 3-Slide Carousel + 2 Stacked Static Promo Cards)
 * 2. "پیشنهاد شگفت‌انگیز" (Wonder Deals) Deep Coastal Slate Container & Live Real-Time Countdown
 * 3. Circular Visual Category Bubbles (حباب‌های تصویری دسته‌بندی)
 * 4. Slim Artisan Authenticity Guarantee Ribbon
 * 5. Multi-Category Tabbed Vitrine (Instant Client-Side Filtering + In-Place Variation Modal)
 * 6. 3-Column Curated Promotional Collection Banners
 * 7. Interactive Styling Showcase & Artisan Atelier Story
 * 8. Trust Metrics, Value Pillars & Magazine Articles
 * 9. In-Place Variation Pop-Out Modal
 *
 * @package RazGem
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;
get_header(); ?>

<main id="primary" class="site-main" role="main">

    <?php
    // =========================================================================
    // 1. COMMERCIAL 3-PART HERO GRID (Featured Carousel + 2 Static Promos)
    // =========================================================================
    get_template_part( 'template-parts/hero' );
    ?>

    <?php
    // =========================================================================
    // 2. "پیشنهاد شگفت‌انگیز" (WONDER DEALS) & LIVE COUNTDOWN TIMER
    // =========================================================================
    get_template_part( 'template-parts/flash-sale' );
    ?>

    <?php
    // =========================================================================
    // 3. CIRCULAR VISUAL CATEGORY BUBBLES STRIP (حباب‌های تصویری دسته‌بندی)
    // =========================================================================
    get_template_part( 'template-parts/category-bubbles' );
    ?>

    <!-- =======================================================================
         4. SLIM ARTISAN AUTHENTICITY GUARANTEE RIBBON
         ======================================================================= -->
    <section class="razgem-authenticity-ribbon" aria-label="<?php esc_attr_e( 'ضمانت‌ها و اصالت گالری رازجم', 'razgem' ); ?>">
        <div class="site-container">
            <div class="ribbon-inner">
                <div class="ribbon-item">
                    <span class="ribbon-icon" aria-hidden="true">🦪</span>
                    <span class="ribbon-text"><strong>صدف ۱۰۰٪ طبیعی</strong> خلیج فارس</span>
                </div>
                <div class="ribbon-divider" aria-hidden="true"></div>
                <div class="ribbon-item">
                    <span class="ribbon-icon" aria-hidden="true">✨</span>
                    <span class="ribbon-text"><strong>مروارید باروک اصل</strong> با شناسنامه اصالت</span>
                </div>
                <div class="ribbon-divider" aria-hidden="true"></div>
                <div class="ribbon-item">
                    <span class="ribbon-icon" aria-hidden="true">⚖️</span>
                    <span class="ribbon-text"><strong>طلای ۱۸ عیار</strong> و اتصالات مقاوم</span>
                </div>
                <div class="ribbon-divider" aria-hidden="true"></div>
                <div class="ribbon-item">
                    <span class="ribbon-icon" aria-hidden="true">📦</span>
                    <span class="ribbon-text"><strong>ارسال رایگان و بیمه‌شده</strong> به سراسر کشور</span>
                </div>
            </div>
        </div>
    </section>

    <!-- =======================================================================
         5. MULTI-CATEGORY TABBED VITRINE (Instant Client-Side Filtering)
         ======================================================================= -->
    <section id="handcrafted-catalog" class="razgem-vitrine-section">
        <div class="site-container">
            <div class="vitrine-header">
                <span class="vitrine-badge"><?php esc_html_e( 'شاهکارهای دست‌ساز رازجم', 'razgem' ); ?></span>
                <h2 class="vitrine-title"><?php esc_html_e( 'جدیدترین دست‌سازه‌ها و تابلوهای صدف', 'razgem' ); ?></h2>
                
                <!-- Quick Category Filter Tabs -->
                <div class="vitrine-tabs" role="tablist" aria-label="<?php esc_attr_e( 'فیلتر دسته‌بندی آثار', 'razgem' ); ?>">
                    <button type="button" class="vitrine-tab-btn is-active" data-category="all" role="tab" aria-selected="true"><?php esc_html_e( 'همه آثار', 'razgem' ); ?></button>
                    <button type="button" class="vitrine-tab-btn" data-category="earrings" role="tab" aria-selected="false"><?php esc_html_e( 'گوشواره صدف', 'razgem' ); ?></button>
                    <button type="button" class="vitrine-tab-btn" data-category="ocean-wall-art" role="tab" aria-selected="false"><?php esc_html_e( 'تابلو و دکوراتیو', 'razgem' ); ?></button>
                    <button type="button" class="vitrine-tab-btn" data-category="necklaces" role="tab" aria-selected="false"><?php esc_html_e( 'گردنبند و چوکر', 'razgem' ); ?></button>
                    <button type="button" class="vitrine-tab-btn" data-category="bracelets-rings" role="tab" aria-selected="false"><?php esc_html_e( 'دستبند و انگشتر', 'razgem' ); ?></button>
                </div>
            </div>

            <!-- 4-Column Showcase Grid -->
            <div class="vitrine-grid" id="razgemVitrineGrid">
                <?php
                $rendered_count = 0;

                // 1. Check if WooCommerce products exist
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
                            $is_variable = $product->is_type( 'variable' ) || 'yes' === get_post_meta( $p_id, '_razgem_is_variable', true );
                            $sku         = $product->get_sku();
                            $gallery_ids = $product->get_gallery_image_ids();
                            $thumb_id    = $product->get_image_id();
                            $thumb_url   = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium' ) : '';

                            // Categorization for client-side tabs
                            $terms = get_the_terms( $p_id, 'product_cat' );
                            $cat_slug = 'all';
                            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                                foreach ( $terms as $t ) {
                                    if ( strpos( $t->slug, 'earring' ) !== false ) {
                                        $cat_slug = 'earrings'; break;
                                    } elseif ( strpos( $t->slug, 'wall-art' ) !== false || strpos( $t->slug, 'ocean' ) !== false ) {
                                        $cat_slug = 'ocean-wall-art'; break;
                                    } elseif ( strpos( $t->slug, 'necklace' ) !== false || strpos( $t->slug, 'choker' ) !== false ) {
                                        $cat_slug = 'necklaces'; break;
                                    } elseif ( strpos( $t->slug, 'ring' ) !== false || strpos( $t->slug, 'bracelet' ) !== false ) {
                                        $cat_slug = 'bracelets-rings'; break;
                                    }
                                }
                            }

                            // Fallback category by SKU
                            if ( 'all' === $cat_slug && ! empty( $sku ) ) {
                                $clean_sku = strtoupper( str_replace( array( 'RG-', '-' ), '', $sku ) );
                                if ( in_array( $clean_sku, array( 'R001', 'R002' ), true ) ) {
                                    $cat_slug = 'earrings';
                                } elseif ( in_array( $clean_sku, array( 'R003', 'R004' ), true ) ) {
                                    $cat_slug = 'ocean-wall-art';
                                } elseif ( in_array( $clean_sku, array( 'R007' ), true ) ) {
                                    $cat_slug = 'necklaces';
                                } elseif ( in_array( $clean_sku, array( 'R005', 'R006', 'R008' ), true ) ) {
                                    $cat_slug = 'bracelets-rings';
                                }
                            }
                            ?>
                            $model_url = function_exists( 'razgem_get_product_model_image_url' ) 
                                ? razgem_get_product_model_image_url( $p_id, get_post_field( 'post_name', $p_id ) ) 
                                : ( ! empty( $gallery_ids ) ? wp_get_attachment_image_url( $gallery_ids[0], 'large' ) : $thumb_url );
                            ?>
                            <div class="product-card-wrap" data-category="<?php echo esc_attr( $cat_slug ); ?>">
                                <article class="product-card luxury-dual-card pebble-surface<?php echo ( ! $is_in_stock ) ? ' is-out-of-stock' : ''; ?>">
                                    <!-- Dual-Depth Layered Media: Model in depth + Pedestal Focus Arch in front -->
                                    <div class="dual-depth-media">
                                        <!-- Background Layer: Model Lifestyle Wearing the Piece -->
                                        <div class="dual-depth-bg">
                                            <img src="<?php echo esc_url( $model_url ); ?>" 
                                                 alt="<?php echo esc_attr( get_the_title() . ' - تن‌پوش بر مدل' ); ?>" 
                                                 class="dual-img-model" 
                                                 loading="lazy">
                                        </div>

                                        <!-- Center Foreground Pedestal Arch: Isolated Specimen -->
                                        <a href="<?php echo esc_url( $p_link ); ?>" class="dual-depth-focus-arch" title="<?php echo esc_attr( get_the_title() ); ?>">
                                            <?php if ( $thumb_url ) : ?>
                                                <img src="<?php echo esc_url( $thumb_url ); ?>" 
                                                     alt="<?php echo esc_attr( get_the_title() ); ?>" 
                                                     class="dual-img-focus" 
                                                     loading="lazy">
                                            <?php else : ?>
                                                <?php echo function_exists('wc_placeholder_img') ? wc_placeholder_img( 'medium', array( 'class' => 'dual-img-focus', 'alt' => esc_attr( get_the_title() ) ) ) : ''; ?>
                                            <?php endif; ?>
                                        </a>

                                        <?php if ( ! $is_in_stock ) : ?>
                                            <span class="product-badge product-badge--outofstock"><?php esc_html_e( 'ناموجود', 'razgem' ); ?></span>
                                        <?php elseif ( $product->is_on_sale() ) : ?>
                                            <span class="product-badge product-badge--discount"><?php esc_html_e( 'ویژه', 'razgem' ); ?></span>
                                        <?php else : ?>
                                            <span class="product-badge product-badge--nature"><?php esc_html_e( 'دست‌ساز', 'razgem' ); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="product-card__content dual-card-body">
                                        <div class="dual-card-top-meta">
                                            <div class="product-authenticity-tag">
                                                <span class="auth-dot" aria-hidden="true"></span>
                                                <span><?php esc_html_e( 'صدف طبیعی و گوهر دریا', 'razgem' ); ?></span>
                                            </div>
                                            <?php if ( ! empty( $sku ) ) : ?>
                                                <span class="product-sku-pill"><?php echo esc_html( $sku ); ?></span>
                                            <?php endif; ?>
                                        </div>

                                        <h3 class="product-title">
                                            <a href="<?php echo esc_url( $p_link ); ?>"><?php the_title(); ?></a>
                                        </h3>

                                        <div class="product-meta">
                                            <?php echo function_exists( 'wc_get_product_category_list' ) ? wc_get_product_category_list( $p_id, '، ' ) : ''; ?>
                                        </div>

                                        <div class="product-card__action-row">
                                            <div class="product-price">
                                                <?php echo method_exists( $product, 'get_price_html' ) ? $product->get_price_html() : ''; ?>
                                            </div>

                                            <?php if ( ! $is_in_stock ) : ?>
                                                <span class="product-card-cart-btn disabled" aria-disabled="true" title="<?php esc_attr_e( 'این اثر در حال حاضر ناموجود است', 'razgem' ); ?>">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                </span>
                                            <?php elseif ( $is_variable ) : ?>
                                                <?php
                                                $variation_label = 'انتخاب گزینه';
                                                $variation_options = array( 'قاب چوبی تیره (گردویی)', 'قاب چوبی سفید (عاجی)' );
                                                $attributes = $product->get_attributes();
                                                if ( ! empty( $attributes ) ) {
                                                    $first_attr = reset( $attributes );
                                                    if ( is_object( $first_attr ) && method_exists( $first_attr, 'get_name' ) ) {
                                                        $variation_label = wc_attribute_label( $first_attr->get_name() );
                                                        $variation_options = $first_attr->get_options();
                                                    }
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
                                                        aria-label="<?php echo esc_attr( sprintf( 'انتخاب گزینه‌های %s', get_the_title() ) ); ?>"
                                                        title="<?php esc_attr_e( 'انتخاب گزینه‌ها', 'razgem' ); ?>">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                </button>
                                            <?php else : ?>
                                                <button type="button" 
                                                        class="product-card-cart-btn btn-coastal-action razgem-ajax-add-to-cart ajax_add_to_cart btn-fly-trigger" 
                                                        data-product_id="<?php echo esc_attr( $p_id ); ?>" 
                                                        data-product-id="<?php echo esc_attr( $p_id ); ?>"
                                                        data-quantity="1"
                                                        aria-label="<?php echo esc_attr( sprintf( 'افزودن %s به سبد خرید', get_the_title() ) ); ?>" 
                                                        title="<?php esc_attr_e( 'افزودن مستقیم به سبد خرید', 'razgem' ); ?>">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <?php
                            $rendered_count++;
                        endwhile;
                        wp_reset_postdata();
                    }
                }

                // 2. Fallback to authentic 8-piece handcrafted catalog
                if ( 0 === $rendered_count && function_exists( 'razgem_get_mock_products' ) ) {
                    $all_mocks = razgem_get_mock_products();
                    foreach ( $all_mocks as $m_item ) {
                        $cat_slug = 'all';
                        if ( in_array( $m_item['id'], array( 'r-001', 'r-002' ), true ) ) {
                            $cat_slug = 'earrings';
                        } elseif ( in_array( $m_item['id'], array( 'r-003', 'r-004' ), true ) ) {
                            $cat_slug = 'ocean-wall-art';
                        } elseif ( in_array( $m_item['id'], array( 'r-007' ), true ) ) {
                            $cat_slug = 'necklaces';
                        } elseif ( in_array( $m_item['id'], array( 'r-005', 'r-006', 'r-008' ), true ) ) {
                            $cat_slug = 'bracelets-rings';
                        }
                        ?>
                        <div class="product-card-wrap" data-category="<?php echo esc_attr( $cat_slug ); ?>">
                            <?php razgem_render_mock_product_card( $m_item ); ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <div class="vitrine-footer-cta" style="text-align: center; margin-top: 2.5rem;">
                <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="btn-coastal-slate pearl-shimmer-hover" style="border-radius: 9999px; padding: 0.85rem 2.2rem;">
                    <span><?php esc_html_e( 'مشاهده کلکسیون کامل فروشگاه (۸ شاهکار دست‌ساز)', 'razgem' ); ?></span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
                </a>
            </div>
        </div>
    </section>

    <?php
    // =========================================================================
    // 6. PROMOTIONAL COLLECTION BANNER GRID (3-Column Curated Banners)
    // =========================================================================
    get_template_part( 'template-parts/promo-banners' );
    ?>

    <!-- =======================================================================
         7. ARTISAN ATELIER STORY
         ======================================================================= -->
    <div class="front-section-group section-palette-ivory" style="padding-top: 1.5rem; padding-bottom: 1.5rem;">
        <?php
        get_template_part( 'template-parts/atelier' );
        ?>
    </div>

    <!-- =======================================================================
         8. VALUES, TRUST, PROMOS & MAGAZINE
         ======================================================================= -->
    <div class="front-section-group section-palette-pebble" style="padding-top: 1.5rem; padding-bottom: 2rem;">
        
        <section class="features-section" style="background: transparent;">
            <div class="site-container features-grid">
                <div class="feature-card pebble-surface">
                    <div class="feature-card__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg></div>
                    <div class="feature-card__info">
                        <h3><?php esc_html_e( 'بسته‌بندی فاخر و شناسنامه', 'razgem' ); ?></h3>
                        <p><?php esc_html_e( 'جعبه هدیه نفیس و شناسنامه اصالت فیزیکی اثر', 'razgem' ); ?></p>
                    </div>
                </div>
                <div class="feature-card pebble-surface">
                    <div class="feature-card__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></div>
                    <div class="feature-card__info">
                        <h3><?php esc_html_e( 'ارسال بیمه‌شده و اکسپرس', 'razgem' ); ?></h3>
                        <p><?php esc_html_e( 'ارسال به سراسر کشور با پوشش بیمه کامل محموله', 'razgem' ); ?></p>
                    </div>
                </div>
                <div class="feature-card pebble-surface">
                    <div class="feature-card__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></div>
                    <div class="feature-card__info">
                        <h3><?php esc_html_e( 'ضمانت اصالت گوهر و دریا', 'razgem' ); ?></h3>
                        <p><?php esc_html_e( 'صدف ۱۰۰٪ طبیعی، مروارید اصل و طلای ۱۸ عیار', 'razgem' ); ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="magazine-section" style="background: transparent; margin-top: 2.8rem;">
            <div class="site-container">
                <div class="section-header section-header--flex">
                    <div>
                        <h2><?php esc_html_e( 'مجله طلا و گوهرشناسی دریا', 'razgem' ); ?></h2>
                        <p><?php esc_html_e( 'راهنمای شناخت و نگهداری مرواریدهای باروک، صدف‌های طبیعی و فلزات گرانبها', 'razgem' ); ?></p>
                    </div>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="view-all-link">
                        <?php esc_html_e( 'آرشیو مجله', 'razgem' ); ?>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
                    </a>
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
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/placeholder.jpg" alt="<?php echo esc_attr( get_the_title() ); ?>" width="400" height="250" loading="lazy">
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
                        echo '<p style="text-align:center; grid-column: 1/-1; color: var(--color-marine-muted);">' . esc_html__( 'به زودی مقالات جدید مجله گوهرشناسی منتشر خواهد شد.', 'razgem' ) . '</p>';
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>

    </div>

</main>

<?php
// In-Place Lightweight Variation Pop-out Modal (Variable Products: R-003, R-004, etc.)
get_template_part( 'template-parts/variation-modal' );
?>

<?php get_footer(); ?>