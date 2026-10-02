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
                'price'       => number_format_i18n( $sale_p ) . ' تومان',
                'old_price'   => number_format_i18n( $reg_p ) . ' تومان',
                'discount'    => $disc,
                'category'    => wp_strip_all_tags( wc_get_product_category_list( $prod_id, '، ' ) ),
                'img'         => wp_get_attachment_image_url( $wc_prod->get_image_id(), 'medium' ) ?: '',
                'model_img'   => $model_url,
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
            $reg_p     = isset( $mock['regular_price'] ) ? (float) $mock['regular_price'] : 0;
            $sale_p    = isset( $mock['price_raw'] ) ? (float) $mock['price_raw'] : 0;
            $disc      = ( $reg_p > 0 && $sale_p > 0 ) ? round( ( ( $reg_p - $sale_p ) / $reg_p ) * 100 ) : 12;
            $model_url = ! empty( $mock['img_model'] ) 
                ? $mock['img_model'] 
                : ( function_exists( 'razgem_get_product_model_image_url' ) ? razgem_get_product_model_image_url( 0, $key ) : '' );

            $on_sale_products[] = array(
                'id'          => $key,
                'slug'        => $key,
                'sku'         => $mock['code'] ?? '',
                'title'       => $mock['title'],
                'url'         => function_exists( 'razgem_product_url' ) ? razgem_product_url( $key ) : home_url( '/product/' . $key . '/' ),
                'price'       => $mock['price_formatted'],
                'old_price'   => $mock['old_price'],
                'discount'    => $disc,
                'category'    => $mock['category'],
                'img'         => $mock['img_primary'],
                'model_img'   => $model_url,
                'is_variable' => ! empty( $mock['is_variable'] ),
            );
            $count++;
        }
    }
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
                <article class="wonder-deal-card luxury-dual-card" data-product-id="<?php echo esc_attr( $deal['id'] ); ?>">
                    <!-- Dual-Depth Layered Media: Model in depth + Pedestal Focus Arch in front -->
                    <div class="dual-depth-media">
                        <!-- Background Layer: Model Lifestyle Wearing the Piece -->
                        <div class="dual-depth-bg">
                            <img src="<?php echo esc_url( $deal['model_img'] ); ?>" 
                                 alt="<?php echo esc_attr( $deal['title'] . ' - تن‌پوش بر مدل' ); ?>" 
                                 class="dual-img-model" 
                                 loading="lazy">
                        </div>

                        <!-- Center Foreground Pedestal Arch: Isolated Jewelry Specimen -->
                        <a href="<?php echo esc_url( $deal['url'] ); ?>" class="dual-depth-focus-arch" title="<?php echo esc_attr( $deal['title'] ); ?>">
                            <img src="<?php echo esc_url( $deal['img'] ); ?>" 
                                 alt="<?php echo esc_attr( $deal['title'] ); ?>" 
                                 class="dual-img-focus" 
                                 loading="lazy">
                        </a>

                        <span class="wonder-deal-discount-pill"><?php echo esc_html( $persian_discount ); ?>٪ تخفیف</span>
                    </div>

                    <!-- Card Body -->
                    <div class="wonder-deal-body dual-card-body">
                        <div class="dual-card-top-meta">
                            <span class="wonder-deal-cat"><?php echo esc_html( $deal['category'] ); ?></span>
                            <?php if ( ! empty( $deal['sku'] ) ) : ?>
                                <span class="product-sku-pill"><?php echo esc_html( $deal['sku'] ); ?></span>
                            <?php endif; ?>
                        </div>

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
                                        class="wonder-deal-btn open-variation-modal razgem-open-variation-modal" 
                                        data-product-id="<?php echo esc_attr( $deal['id'] ); ?>"
                                        data-product-title="<?php echo esc_attr( $deal['title'] ); ?>"
                                        data-product-price="<?php echo esc_attr( $deal['price'] ); ?>"
                                        data-product-image="<?php echo esc_url( $deal['img'] ); ?>"
                                        aria-label="<?php echo esc_attr( 'انتخاب مشخصات و قاب ' . $deal['title'] ); ?>">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    <span><?php esc_html_e( 'انتخاب قاب و خرید', 'razgem' ); ?></span>
                                </button>
                            <?php else : ?>
                                <a href="<?php echo esc_url( $deal['url'] ); ?>" 
                                   class="wonder-deal-btn"
                                   aria-label="<?php echo esc_attr( 'مشاهده و خرید ' . $deal['title'] ); ?>">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
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
