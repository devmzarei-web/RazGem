<?php
/**
 * RazGem Luxury Cart Template
 *
 * Clean 2-column RTL layout for luxury jewelry cart experience.
 * 100% compatible with standard WooCommerce hooks, coupons, and AJAX updates.
 *
 * @package RazGem
 * @version 10.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="razgem-cart-page" dir="rtl">

    <!-- Shopping Process Steps Bar -->
    <div class="checkout-process-steps">
        <div class="process-step is-active">
            <span class="step-badge">۱</span>
            <span class="step-title"><?php esc_html_e( 'سبد خرید', 'razgem' ); ?></span>
        </div>
        <div class="step-divider"></div>
        <div class="process-step">
            <span class="step-badge">۲</span>
            <span class="step-title"><?php esc_html_e( 'مشخصات و آدرس تحویل', 'razgem' ); ?></span>
        </div>
        <div class="step-divider"></div>
        <div class="process-step">
            <span class="step-badge">۳</span>
            <span class="step-title"><?php esc_html_e( 'پرداخت و ثبت نهایی', 'razgem' ); ?></span>
        </div>
    </div>

    <!-- Trust Mini Bar -->
    <div class="cart-trust-ribbon">
        <div class="trust-ribbon-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <span>ضمانت اصالت ۱۰۰٪ صدف طبیعی و مروارید باروک</span>
        </div>
        <div class="trust-ribbon-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#27ae60" stroke-width="2.2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
            <span>ارسال رایگان و بیمه‌شده سراسر کشور</span>
        </div>
        <div class="trust-ribbon-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A67C1E" stroke-width="2.2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            <span>پرداخت امن متصل به درگاه شاپرک زیبال</span>
        </div>
    </div>

    <div class="cart-main-grid">
        
        <!-- Cart Items Column (Right) -->
        <div class="cart-items-column">
            <form class="woocommerce-cart-form razgem-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                <?php do_action( 'woocommerce_before_cart_table' ); ?>

                <div class="cart-items-card">
                    <div class="cart-card-header">
                        <div class="cart-header-title">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                            <h2><?php esc_html_e( 'اقلام سبد خرید شما', 'razgem' ); ?></h2>
                        </div>
                        <span class="cart-items-count"><?php echo esc_html( function_exists('razgem_format_persian_number') ? razgem_format_persian_number( WC()->cart->get_cart_contents_count() ) : WC()->cart->get_cart_contents_count() ); ?> کالا</span>
                    </div>

                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents razgem-cart-table" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-remove"><span class="screen-reader-text"><?php esc_html_e( 'حذف', 'razgem' ); ?></span></th>
                                <th class="product-thumbnail"><span class="screen-reader-text"><?php esc_html_e( 'تصویر محصول', 'razgem' ); ?></span></th>
                                <th class="product-name"><?php esc_html_e( 'محصول', 'razgem' ); ?></th>
                                <th class="product-price"><?php esc_html_e( 'قیمت واحد', 'razgem' ); ?></th>
                                <th class="product-quantity"><?php esc_html_e( 'تعداد', 'razgem' ); ?></th>
                                <th class="product-subtotal"><?php esc_html_e( 'قیمت کل', 'razgem' ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                            <?php
                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                $visible = apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key );

                                if ( $_product instanceof WC_Product && $_product->exists() && $cart_item['quantity'] > 0 && $visible ) {
                                    $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                    ?>
                                    <tr class="woocommerce-cart-form__cart-item cart_item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                                        <td class="product-remove">
                                            <?php
                                                echo apply_filters(
                                                    'woocommerce_cart_item_remove_link',
                                                    sprintf(
                                                        '<a href="%s" class="remove razgem-remove-item" aria-label="%s" data-product_id="%s" data-product_sku="%s" title="حذف این محصول">&times;</a>',
                                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                        esc_attr( sprintf( __( 'حذف %s از سبد خرید', 'razgem' ), wp_strip_all_tags( $product_name ) ) ),
                                                        esc_attr( $product_id ),
                                                        esc_attr( $_product->get_sku() )
                                                    ),
                                                    $cart_item_key
                                                );
                                            ?>
                                        </td>

                                        <td class="product-thumbnail">
                                            <?php
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                            if ( ! $product_permalink ) {
                                                echo $thumbnail;
                                            } else {
                                                printf( '<a href="%s" class="cart-thumb-link">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                            }
                                            ?>
                                        </td>

                                        <td class="product-name" data-title="<?php esc_attr_e( 'محصول', 'razgem' ); ?>">
                                            <div class="cart-product-title-wrap">
                                                <?php
                                                if ( ! $product_permalink ) {
                                                    echo wp_kses_post( '<h4 class="cart-item-title">' . $product_name . '</h4>' );
                                                } else {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="cart-item-title">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                                }

                                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                                // Meta data (Variations, Attributes)
                                                echo '<div class="cart-item-meta">' . wc_get_formatted_cart_item_data( $cart_item ) . '</div>';

                                                // Backorder notification
                                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'موجود در انبار جهت ساخت سفارشی', 'razgem' ) . '</p>', $product_id ) );
                                                }
                                                ?>
                                            </div>
                                        </td>

                                        <td class="product-price" data-title="<?php esc_attr_e( 'قیمت واحد', 'razgem' ); ?>">
                                            <?php
                                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                            ?>
                                        </td>

                                        <td class="product-quantity" data-title="<?php esc_attr_e( 'تعداد', 'razgem' ); ?>">
                                            <?php
                                            if ( $_product->is_sold_individually() ) {
                                                $min_quantity = 1;
                                                $max_quantity = 1;
                                            } else {
                                                $min_quantity = 0;
                                                $max_quantity = $_product->get_max_purchase_quantity();
                                            }

                                            $product_quantity = woocommerce_quantity_input(
                                                array(
                                                    'input_name'   => "cart[{$cart_item_key}][qty]",
                                                    'input_value'  => $cart_item['quantity'],
                                                    'max_value'    => $max_quantity,
                                                    'min_value'    => $min_quantity,
                                                    'product_name' => $product_name,
                                                ),
                                                $_product,
                                                false
                                            );

                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                            ?>
                                        </td>

                                        <td class="product-subtotal" data-title="<?php esc_attr_e( 'قیمت کل', 'razgem' ); ?>">
                                            <?php
                                                echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            <?php do_action( 'woocommerce_cart_contents' ); ?>

                            <tr class="cart-actions-row">
                                <td colspan="6" class="actions">
                                    <div class="cart-actions-wrapper">
                                        <?php if ( wc_coupons_enabled() ) { ?>
                                            <div class="coupon razgem-coupon-box">
                                                <input type="text" name="coupon_code" class="input-text coupon-input" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'کد تخفیف دارید؟ وارد کنید...', 'razgem' ); ?>" />
                                                <button type="submit" class="button btn-apply-coupon" name="apply_coupon" value="<?php esc_attr_e( 'اعمال تخفیف', 'razgem' ); ?>">
                                                    <span><?php esc_html_e( 'اعمال کد', 'razgem' ); ?></span>
                                                </button>
                                                <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                            </div>
                                        <?php } ?>

                                        <div class="cart-update-box">
                                            <button type="submit" class="button btn-update-cart" name="update_cart" value="<?php esc_attr_e( 'به‌روزرسانی سبد خرید', 'razgem' ); ?>">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 4v6h-6"></path><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                                                <span><?php esc_html_e( 'به‌روزرسانی سبد', 'razgem' ); ?></span>
                                            </button>
                                        </div>
                                    </div>

                                    <?php do_action( 'woocommerce_cart_actions' ); ?>
                                    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                </td>
                            </tr>

                            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                        </tbody>
                    </table>
                </div>

                <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </form>
        </div>

        <!-- Cart Totals & Checkout Column (Left) -->
        <div class="cart-sidebar-column">
            <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

            <div class="cart-collaterals">
                <?php
                    /**
                     * Cart collaterals hook.
                     *
                     * @hooked woocommerce_cross_sell_display
                     * @hooked woocommerce_cart_totals - 10
                     */
                    do_action( 'woocommerce_cart_collaterals' );
                ?>
            </div>

            <!-- Guarantee Box -->
            <div class="cart-guarantee-card">
                <div class="guarantee-header">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 8v4l3 3"></path></svg>
                    <h4><?php esc_html_e( 'ارسال سریع و مطمئن', 'razgem' ); ?></h4>
                </div>
                <p><?php esc_html_e( 'تمامی سفارش‌های گالری رازجم با بسته‌بندی امن، جعبه هاردباکس لوکس کادویی و شناسنامه اصالت کالا ارسال می‌شوند.', 'razgem' ); ?></p>
            </div>
        </div>

    </div>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
