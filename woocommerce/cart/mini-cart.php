<?php
/**
 * RazGem Mini-cart Template Override
 *
 * Provides a luxury Persian artisanal slide-out mini-cart with live quantity
 * adjusters (+ / -), Toman pricing, free shipping indicator, and direct checkout CTA.
 *
 * @package RazGem
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

    <ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ?? '' ); ?>">
        <?php
        do_action( 'woocommerce_before_mini_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( array( 64, 64 ) ), $cart_item, $cart_item_key );
                $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                $variation_id      = isset( $cart_item['variation_id'] ) ? $cart_item['variation_id'] : 0;
                $qty               = $cart_item['quantity'];
                $qty_display       = function_exists('razgem_persian_numbers') ? razgem_persian_numbers( (string) $qty ) : $qty;
                ?>
                <li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <div class="mini-cart-item-thumb">
                        <?php if ( empty( $product_permalink ) ) : ?>
                            <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url( $product_permalink ); ?>">
                                <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="mini-cart-item-details">
                        <div class="mini-cart-item-top">
                            <h4 class="mini-cart-item-title">
                                <?php if ( empty( $product_permalink ) ) : ?>
                                    <?php echo wp_kses_post( $product_name ); ?>
                                <?php else : ?>
                                    <a href="<?php echo esc_url( $product_permalink ); ?>">
                                        <?php echo wp_kses_post( $product_name ); ?>
                                    </a>
                                <?php endif; ?>
                            </h4>

                            <?php
                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                'woocommerce_cart_item_remove_link',
                                sprintf(
                                    '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></a>',
                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                    esc_attr__( 'حذف این محصول از سبد خرید', 'razgem' ),
                                    esc_attr( $product_id ),
                                    esc_attr( $cart_item_key ),
                                    esc_attr( $_product->get_sku() )
                                ),
                                $cart_item_key
                            );
                            ?>
                        </div>

                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

                        <div class="mini-cart-item-bottom">
                            <div class="mini-cart-qty-controls">
                                <button type="button" class="mini-cart-qty-btn minus" data-product-id="<?php echo esc_attr( $product_id ); ?>" data-variation-id="<?php echo esc_attr( $variation_id ); ?>" data-current-qty="<?php echo esc_attr( $qty ); ?>" aria-label="کاهش تعداد">-</button>
                                <span class="mini-cart-qty-val"><?php echo esc_html( $qty_display ); ?></span>
                                <button type="button" class="mini-cart-qty-btn plus" data-product-id="<?php echo esc_attr( $product_id ); ?>" data-variation-id="<?php echo esc_attr( $variation_id ); ?>" data-current-qty="<?php echo esc_attr( $qty ); ?>" aria-label="افزایش تعداد">+</button>
                            </div>

                            <div class="mini-cart-item-price">
                                <?php echo $product_price; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </div>
                        </div>
                    </div>
                </li>
                <?php
            }
        }

        do_action( 'woocommerce_mini_cart_contents' );
        ?>
    </ul>

    <div class="mini-cart-footer">
        <div class="mini-cart-subtotal-row">
            <span class="subtotal-label"><?php esc_html_e( 'مجموع سبد خرید:', 'razgem' ); ?></span>
            <span class="subtotal-amount"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
        </div>

        <div class="mini-cart-trust-note">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            <span>ارسال رایگان، بیمه‌نامه اصالت و بسته‌بندی نفیس هدیه</span>
        </div>

        <div class="mini-cart-actions">
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn-mini-cart-checkout">
                <span>تکمیل سفارش و تسویه حساب</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn-mini-cart-view">
                مشاهده و ویرایش سبد خرید
            </a>
        </div>
    </div>

<?php else : ?>

    <div class="woocommerce-mini-cart__empty-message mini-cart-empty-state">
        <div class="empty-cart-icon">
            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
        </div>
        <h4>سبد خرید شما در حال حاضر خالی است</h4>
        <p>از کالکشن‌های دست‌ساز طلا، مروارید باروک و سنگ‌های قیمتی دیدن فرمایید.</p>
        <a href="<?php echo esc_url( function_exists('wc_get_page_permalink') ? wc_get_page_permalink( 'shop' ) : home_url('/shop') ); ?>" class="btn-empty-cart-shop">
            مشاهده گالری زیورآلات
        </a>
    </div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
