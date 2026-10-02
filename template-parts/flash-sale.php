<?php
/**
 * RazGem "پیشنهاد شگفت‌انگیز" (Wonder Deals) & Real-Time Countdown Module
 *
 * Displays on-sale authentic handcrafted seashell & pearl pieces with live countdown timer,
 * compact dual-depth cards (model in depth, focus arch in front), and seamless wave transitions.
 *
 * @package RazGem
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$enabled = get_theme_mod( 'flash_sale_enable', true );
if ( ! $enabled ) {
    return;
}

$title       = get_theme_mod( 'flash_sale_title', 'پیشنهاد شگفت‌انگیز صدف و مروارید' );
$subtitle    = get_theme_mod( 'flash_sale_subtitle', 'تخفیف‌های استثنایی و محدود شاهکارهای دست‌ساز رازجم' );
$end_time    = get_theme_mod( 'flash_sale_end', '' );

// Retrieve products with on_sale = true
$on_sale_products = array();

if ( function_exists( 'wc_get_products' ) ) {
    $wc_products = wc_get_products( array(
        'on_sale' => true,
        'limit'   => 4,
        'status'  => 'publish',
    ) );

    if ( ! empty( $wc_products ) ) {
        foreach ( $wc_products as $wc_prod ) {
            $prod_id   = $wc_prod->get_id();
            $reg_p     = (float) $wc_prod->get_regular_price();
            $sale_p    = (float) $wc_prod->get_sale_price();
            $disc      = $reg_p > 0 ? round( ( ( $reg_p - $sale_p ) / $reg_p ) * 100 ) : 15;
            $model_url = function_exists( 'razgem_get_product_model_image_url' ) 
                ? razgem_get_product_model_image_url( $prod_id, $wc_prod->get_slug() ) 
                : '';

            $on_sale_products[] = array(
                'id'          => $prod_id,
                'slug'        => $wc_prod->get_slug(),
                'sku'         => $wc_prod->get_sku(),
                'title'       => $wc_prod->get_name(),
                'url'         => get_permalink( $prod_id ),
                'price_html'  => $wc_prod->get_price_html(),
                'discount'    => $disc,
                'category'    => wp_strip_all_tags( wc_get_product_category_list( $prod_id, '، ' ) ),
                'img'         => wp_get_attachment_image_url( $wc_prod->get_image_id(), 'large' ) ?: '',
                'model_img'   => $model_url,
                'is_variable' => $wc_prod->is_type( 'variable' ) || 'yes' === get_post_meta( $prod_id, '_razgem_is_variable', true ),
            );
        }
    }
}

// If no actual WooCommerce products are on sale, don't show the section.
if ( empty( $on_sale_products ) ) {
    return;
}
?>

<section class="razgem-wonder-deals-section" aria-label="<?php echo esc_attr( $title ); ?>">
    <!-- Top Living Wave Transition: Sand Beige (#EBE1D4) flows directly under living wave crests into Slate Dark (#1B3347) with zero white band -->
    <div class="wonder-deals-wave-top ocean-wave-animator" aria-hidden="true">
        <svg class="ocean-waves-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="deals-wave-top-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="ocean-parallax-waves">
                <use xlink:href="#deals-wave-top-path" x="48" y="0" class="wave-layer-deep" />
                <use xlink:href="#deals-wave-top-path" x="48" y="3" class="wave-layer-seafoam" />
                <use xlink:href="#deals-wave-top-path" x="48" y="5" class="wave-layer-sand" />
                <use xlink:href="#deals-wave-top-path" x="48" y="7" class="wave-layer-solid" />
            </g>
        </svg>
    </div>

    <div class="site-container wonder-deals-inner">
        <!-- Section Header: Sleek, compact inline alignment -->
        <div class="wonder-deals-header">
            <div class="wonder-deals-title-group">
                <span class="wonder-deals-badge">
                    <span aria-hidden="true">🔥</span>
                    <?php esc_html_e( 'پیشنهاد شگفت‌انگیز', 'razgem' ); ?>
                </span>
                <div class="wonder-deals-headings">
                    <h2 class="wonder-deals-title"><?php echo esc_html( $title ); ?></h2>
                    <?php if ( ! empty( $subtitle ) ) : ?>
                        <p class="wonder-deals-subtitle"><?php echo esc_html( $subtitle ); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Live Real-Time Digital Countdown -->
            <div class="flash-sale-countdown" 
                 id="razgemFlashSaleTimer" 
                 data-countdown-end="<?php echo esc_attr( $end_time ); ?>" 
                 role="timer" 
                 aria-label="<?php esc_attr_e( 'زمان باقی‌مانده تا پایان پیشنهاد شگفت‌انگیز', 'razgem' ); ?>">
                <div class="countdown-tile">
                    <span class="countdown-val" data-unit="days">۰۱</span>
                    <span class="countdown-label"><?php esc_html_e( 'روز', 'razgem' ); ?></span>
                </div>
                <span class="countdown-separator">:</span>
                <div class="countdown-tile">
                    <span class="countdown-val" data-unit="hours">۱۴</span>
                    <span class="countdown-label"><?php esc_html_e( 'ساعت', 'razgem' ); ?></span>
                </div>
                <span class="countdown-separator">:</span>
                <div class="countdown-tile">
                    <span class="countdown-val" data-unit="minutes">۳۵</span>
                    <span class="countdown-label"><?php esc_html_e( 'دقیقه', 'razgem' ); ?></span>
                </div>
                <span class="countdown-separator">:</span>
                <div class="countdown-tile">
                    <span class="countdown-val" data-unit="seconds">۴۲</span>
                    <span class="countdown-label"><?php esc_html_e( 'ثانیه', 'razgem' ); ?></span>
                </div>
            </div>
        </div>

        <!-- Deals Products Grid: Compact Dual-Depth Luxury Cards -->
        <div class="wonder-deals-grid">
            <?php foreach ( $on_sale_products as $deal ) : 
                $persian_discount = function_exists( 'razgem_to_persian_num' ) ? razgem_to_persian_num( $deal['discount'] ) : $deal['discount'];
            ?>
                <article class="stella-product-card wonder-deal-stella" data-product-id="<?php echo esc_attr( $deal['id'] ); ?>">
                    <div class="stella-card-inner">
                        <a href="<?php echo esc_url( $deal['url'] ); ?>" class="stella-media-arch" title="<?php echo esc_attr( $deal['title'] ); ?>">
                            <img src="<?php echo esc_url( $deal['img'] ); ?>" 
                                 alt="<?php echo esc_attr( $deal['title'] ); ?>" 
                                 class="stella-img-main" 
                                 loading="lazy">
                            
                            <span class="stella-badge"><?php echo esc_html( $persian_discount ); ?>٪ تخفیف</span>

                            <div class="stella-media-actions">
                                <button type="button" class="stella-btn-action stella-wishlist-btn" aria-label="افزودن به علاقه‌مندی‌ها">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                </button>
                            </div>
                            
                        </a>

                        <div class="stella-card-body">
                            <h3 class="stella-title">
                                <a href="<?php echo esc_url( $deal['url'] ); ?>">
                                    <?php echo esc_html( $deal['title'] ); ?>
                                </a>
                            </h3>

                            <div class="stella-rating-row">
                                <div class="stella-stars">
                                    <span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span>
                                </div>
                                
                            </div>

                            <div class="stella-attributes">
                                <div class="stella-attr">
                                    <span class="attr-label">دسته:</span>
                                    <span class="attr-value"><?php echo esc_html( $deal['category'] ); ?></span>
                                </div>
                                <?php if ( ! empty( $deal['sku'] ) ) : ?>
                                <div class="stella-attr">
                                    <span class="attr-label">کد اثر:</span>
                                    <span class="attr-value" style="direction:ltr;"><?php echo esc_html( $deal['sku'] ); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="stella-footer">
                                <div class="stella-price-wrap">
                                    <span class="stella-current-price"><?php echo wp_kses_post( $deal['price_html'] ); ?></span>
                                </div>
                                <div class="stella-action-overlay">
                                    <?php if ( ! empty( $deal['is_variable'] ) ) : ?>
                                        <a href="<?php echo esc_url( $deal['url'] ); ?>" class="btn-stella-cart">مشاهده و انتخاب</a>
                                    <?php else : ?>
                                        <a href="?add-to-cart=<?php echo esc_attr( $deal['id'] ); ?>" data-quantity="1" class="btn-stella-cart ajax_add_to_cart add_to_cart_button" data-product_id="<?php echo esc_attr( $deal['id'] ); ?>" aria-label="افزودن به سبد خرید" rel="nofollow">افزودن به سبد خرید</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bottom Living Wave Transition Divider: Deep Coastal Slate returning into Canvas Ivory -->
    <div class="wonder-deals-wave-btm ocean-wave-animator ocean-wave--dark-to-light" aria-hidden="true">
        <svg class="ocean-waves-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="deals-wave-btm-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="ocean-parallax-waves">
                <use xlink:href="#deals-wave-btm-path" x="48" y="0" class="wave-layer-deep" />
                <use xlink:href="#deals-wave-btm-path" x="48" y="3" class="wave-layer-seafoam" />
                <use xlink:href="#deals-wave-btm-path" x="48" y="5" class="wave-layer-sand" />
                <use xlink:href="#deals-wave-btm-path" x="48" y="7" class="wave-layer-solid" />
            </g>
        </svg>
    </div>
</section>


