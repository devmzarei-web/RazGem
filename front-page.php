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
            <div class="vitrine-header" style="margin-bottom: 1.5rem;">
                <!-- Titles removed to reduce words before products based on user feedback -->
                
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
                            $thumb_url   = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'large' ) : '';

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
                            $model_url = function_exists( 'razgem_get_product_model_image_url' ) 
                                ? razgem_get_product_model_image_url( $p_id, get_post_field( 'post_name', $p_id ) ) 
                                : ( ! empty( $gallery_ids ) ? wp_get_attachment_image_url( $gallery_ids[0], 'large' ) : $thumb_url );
                            ?>
                            <div class="product-card-wrap" data-category="<?php echo esc_attr( $cat_slug ); ?>">
                                <article class="stella-product-card<?php echo ( ! $is_in_stock ) ? ' is-out-of-stock' : ''; ?>" data-product-id="<?php echo esc_attr( $p_id ); ?>">
                                    <div class="stella-card-inner">
                                        <a href="<?php echo esc_url( $p_link ); ?>" class="stella-media-arch" title="<?php echo esc_attr( get_the_title() ); ?>">
                                            <?php if ( $thumb_url ) : ?>
                                                <img src="<?php echo esc_url( $thumb_url ); ?>" 
                                                     alt="<?php echo esc_attr( get_the_title() ); ?>" 
                                                     class="stella-img-main" 
                                                     loading="lazy">
                                            <?php else : ?>
                                                <?php echo function_exists('wc_placeholder_img') ? wc_placeholder_img( 'large', array( 'class' => 'stella-img-main', 'alt' => esc_attr( get_the_title() ) ) ) : ''; ?>
                                            <?php endif; ?>
                                            
                                            <?php if ( ! $is_in_stock ) : ?>
                                                <span class="stella-badge" style="background:#6c757d;"><?php esc_html_e( 'ناموجود', 'razgem' ); ?></span>
                                            <?php elseif ( $product->is_on_sale() ) : ?>
                                                <span class="stella-badge"><?php esc_html_e( 'ویژه', 'razgem' ); ?></span>
                                            <?php else : ?>
                                                <span class="stella-badge" style="background:#2F597A;"><?php esc_html_e( 'دست‌ساز', 'razgem' ); ?></span>
                                            <?php endif; ?>

                                                <div class="stella-media-actions">
                                                <!-- Wishlist -->
                                                <button type="button" class="stella-btn-action stella-wishlist-btn" aria-label="افزودن به علاقه‌مندی‌ها">
                                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                </button>
                                            </div>
                                        </a>

                                        <div class="stella-card-body">
                                            <h3 class="stella-title">
                                                <a href="<?php echo esc_url( $p_link ); ?>"><?php the_title(); ?></a>
                                            </h3>

                                            <div class="stella-rating-row">
                                                <div class="stella-stars">
                                                    <span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span>
                                                </div>
                                                
                                            </div>

                                            <div class="stella-attributes">
                                                <div class="stella-attr">
                                                    <span class="attr-label">دسته:</span>
                                                    <span class="attr-value"><?php echo wp_strip_all_tags( function_exists( 'wc_get_product_category_list' ) ? wc_get_product_category_list( $p_id, '، ' ) : '' ); ?></span>
                                                </div>
                                                <?php if ( ! empty( $sku ) ) : ?>
                                                <div class="stella-attr">
                                                    <span class="attr-label">کد اثر:</span>
                                                    <span class="attr-value" style="direction:ltr;"><?php echo esc_html( $sku ); ?></span>
                                                </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="stella-footer">
                                                <div class="stella-price-wrap">
                                                    <span class="stella-current-price"><?php echo method_exists( $product, 'get_price_html' ) ? $product->get_price_html() : ''; ?></span>
                                                </div>
                                                <div class="stella-action-overlay">
                                                    <?php if ( ! $is_in_stock ) : ?>
                                                        <!-- disabled cart button -->
                                                    <?php elseif ( $is_variable ) : ?>
                                                        <a href="<?php echo esc_url( $p_link ); ?>" class="btn-stella-cart">مشاهده و انتخاب</a>
                                                    <?php else : ?>
                                                        <a href="?add-to-cart=<?php echo esc_attr( $p_id ); ?>" data-quantity="1" class="btn-stella-cart ajax_add_to_cart add_to_cart_button" data-product_id="<?php echo esc_attr( $p_id ); ?>" aria-label="افزودن به سبد خرید" rel="nofollow">افزودن به سبد خرید</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
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
    <div class="front-section-group" style="padding-top: 1.5rem; padding-bottom: 1.5rem;">
        <?php
        get_template_part( 'template-parts/atelier' );
        ?>
    </div>

    

</main>

<?php
// In-Place Lightweight Variation Pop-out Modal (Variable Products: R-003, R-004, etc.)
get_template_part( 'template-parts/variation-modal' );
?>

<?php get_footer(); ?>


