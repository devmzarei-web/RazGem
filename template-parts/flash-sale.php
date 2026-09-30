<?php
/**
 * RazGem "پیشنهاد شگفت‌انگیز" (Wonder Deals) & Real-Time Countdown Module
 *
 * Displays on-sale authentic handcrafted seashell & pearl pieces with live countdown timer,
 * discount badges, strikethrough original prices, and variation pop-out modal support.
 *
 * @package RazGem
 * @version 1.0.0
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
            $prod_id = $wc_prod->get_id();
            $reg_p   = (float) $wc_prod->get_regular_price();
            $sale_p  = (float) $wc_prod->get_sale_price();
            $disc    = $reg_p > 0 ? round( ( ( $reg_p - $sale_p ) / $reg_p ) * 100 ) : 15;

            $on_sale_products[] = array(
                'id'          => $prod_id,
                'slug'        => $wc_prod->get_slug(),
                'title'       => $wc_prod->get_name(),
                'url'         => get_permalink( $prod_id ),
                'price'       => number_format_i18n( $sale_p ) . ' تومان',
                'old_price'   => number_format_i18n( $reg_p ) . ' تومان',
                'discount'    => $disc,
                'category'    => wp_strip_all_tags( wc_get_product_category_list( $prod_id, '، ' ) ),
                'img'         => wp_get_attachment_image_url( $wc_prod->get_image_id(), 'medium' ) ?: '',
                'is_variable' => $wc_prod->is_type( 'variable' ) || 'yes' === get_post_meta( $prod_id, '_razgem_is_variable', true ),
            );
        }
    }
}

// Fallback to authentic mock catalog if no WooCommerce database products returned
if ( empty( $on_sale_products ) && function_exists( 'razgem_get_mock_products' ) ) {
    $all_mock = razgem_get_mock_products();
    $count = 0;
    foreach ( $all_mock as $key => $mock ) {
        if ( ! empty( $mock['on_sale'] ) && $count < 4 ) {
            $reg_p  = isset( $mock['regular_price'] ) ? (float) $mock['regular_price'] : 0;
            $sale_p = isset( $mock['price_raw'] ) ? (float) $mock['price_raw'] : 0;
            $disc   = ( $reg_p > 0 && $sale_p > 0 ) ? round( ( ( $reg_p - $sale_p ) / $reg_p ) * 100 ) : 12;

            $on_sale_products[] = array(
                'id'          => $key,
                'slug'        => $key,
                'title'       => $mock['title'],
                'url'         => function_exists( 'razgem_product_url' ) ? razgem_product_url( $key ) : home_url( '/product/' . $key . '/' ),
                'price'       => $mock['price_formatted'],
                'old_price'   => $mock['old_price'],
                'discount'    => $disc,
                'category'    => $mock['category'],
                'img'         => $mock['img_primary'],
                'is_variable' => ! empty( $mock['is_variable'] ),
            );
            $count++;
        }
    }
}
?>

<section class="razgem-wonder-deals-section" aria-label="<?php echo esc_attr( $title ); ?>">
    <!-- Top Living Wave Transition Divider: Canvas Ivory into Deep Coastal Slate -->
    <div class="wonder-deals-wave-top ocean-wave-animator ocean-wave--light-to-dark" aria-hidden="true">
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
        <!-- Section Header with Title & Real-time Countdown Tiles -->
        <div class="wonder-deals-header">
            <div class="wonder-deals-title-group">
                <span class="wonder-deals-badge">
                    <span aria-hidden="true">🔥</span>
                    <?php esc_html_e( 'پیشنهاد ویژه', 'razgem' ); ?>
                </span>
                <div>
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

        <!-- Deals Products Grid -->
        <div class="wonder-deals-grid">
            <?php foreach ( $on_sale_products as $deal ) : 
                $persian_discount = function_exists( 'razgem_to_persian_num' ) ? razgem_to_persian_num( $deal['discount'] ) : $deal['discount'];
            ?>
                <article class="wonder-deal-card" data-product-id="<?php echo esc_attr( $deal['id'] ); ?>">
                    <div class="wonder-deal-media">
                        <span class="wonder-deal-discount-pill"><?php echo esc_html( $persian_discount ); ?>٪ تخفیف</span>
                        <a href="<?php echo esc_url( $deal['url'] ); ?>" tabindex="-1" aria-hidden="true">
                            <img src="<?php echo esc_url( $deal['img'] ); ?>" 
                                 alt="<?php echo esc_attr( $deal['title'] ); ?>" 
                                 width="300" 
                                 height="300" 
                                 loading="lazy" 
                                 class="wonder-deal-img">
                        </a>
                    </div>
                    <div class="wonder-deal-body">
                        <span class="wonder-deal-cat"><?php echo esc_html( $deal['category'] ); ?></span>
                        <h3 class="wonder-deal-title">
                            <a href="<?php echo esc_url( $deal['url'] ); ?>">
                                <?php echo esc_html( $deal['title'] ); ?>
                            </a>
                        </h3>
                        <div class="wonder-deal-pricing">
                            <span class="wonder-deal-old-price"><?php echo esc_html( $deal['old_price'] ); ?></span>
                            <span class="wonder-deal-price"><?php echo esc_html( $deal['price'] ); ?></span>
                        </div>
                        <div class="wonder-deal-action">
                            <?php if ( ! empty( $deal['is_variable'] ) ) : ?>
                                <button type="button" 
                                        class="wonder-deal-btn open-variation-modal" 
                                        data-product-id="<?php echo esc_attr( $deal['id'] ); ?>"
                                        aria-label="<?php echo esc_attr( 'انتخاب مشخصات و قاب ' . $deal['title'] ); ?>">
                                    <span aria-hidden="true">⚙️</span>
                                    <span><?php esc_html_e( 'انتخاب قاب و خرید', 'razgem' ); ?></span>
                                </button>
                            <?php else : ?>
                                <a href="<?php echo esc_url( $deal['url'] ); ?>" 
                                   class="wonder-deal-btn"
                                   aria-label="<?php echo esc_attr( 'مشاهده و خرید ' . $deal['title'] ); ?>">
                                    <span aria-hidden="true">🛍️</span>
                                    <span><?php esc_html_e( 'مشاهده اثر', 'razgem' ); ?></span>
                                </a>
                            <?php endif; ?>
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
