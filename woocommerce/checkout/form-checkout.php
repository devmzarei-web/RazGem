<?php
/**
 * RazGem Checkout Form Template Override
 *
 * Provides a clean 2-column RTL layout for luxury Iranian jewelry checkout.
 * Preserves 100% of standard WooCommerce checkout hooks for seamless compatibility
 * with Iranian payment gateways (ZarinPal, Mellat, سامان, پاسارگاد, etc.).
 *
 * @package RazGem
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'جهت تکمیل خرید ابتدا باید وارد حساب کاربری خود شوید.', 'razgem' ) ) );
    return;
}
?>

<div class="razgem-checkout-wrapper" dir="rtl">
    
    <div class="checkout-trust-banner">
        <div class="trust-banner-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            <span>ضمانت اصالت طلای ۱۸ عیار و سنگ‌های طبیعی</span>
        </div>
        <div class="trust-banner-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#27ae60" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
            <span>ارسال رایگان و بیمه شده به سراسر ایران</span>
        </div>
        <div class="trust-banner-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A67C1E" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            <span>اتصال امن به درگاه‌های رسمی شاپرک</span>
        </div>
    </div>

    <?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>

    <form name="checkout" method="post" class="checkout woocommerce-checkout razgem-checkout-form" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <div class="checkout-grid-layout">
            
            <!-- Customer Details Column (Right in RTL) -->
            <div class="checkout-col-details">
                <?php if ( $checkout->get_checkout_fields() ) : ?>

                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                    <div class="checkout-billing-fields" id="customer_details">
                        <div class="checkout-section-header">
                            <span class="step-num">۱</span>
                            <h3><?php esc_html_e( 'مشخصات تحویل‌گیرنده و آدرس ارسال', 'razgem' ); ?></h3>
                        </div>
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                    </div>

                    <div class="checkout-shipping-fields">
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                    </div>

                    <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                <?php endif; ?>
            </div>

            <!-- Order Review & Payment Gateway Column (Left in RTL) -->
            <div class="checkout-col-summary">
                <div class="checkout-summary-card">
                    <div class="checkout-section-header">
                        <span class="step-num">۲</span>
                        <h3 id="order_review_heading"><?php esc_html_e( 'خلاصه سفارش و پرداخت', 'razgem' ); ?></h3>
                    </div>

                    <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
                    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                    </div>

                    <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                </div>
            </div>

        </div>

    </form>

    <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

</div>
