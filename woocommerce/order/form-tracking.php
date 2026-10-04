<?php
/**
 * Order tracking form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/form-tracking.php.
 * RazGem Coastal Haute-Joaillerie Edition
 *
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $post;
?>

<div class="razgem-order-tracking-wrapper" style="max-width: 600px; margin: 4rem auto; padding: 2.5rem; background: #fff; border-radius: 24px; box-shadow: 0 12px 40px rgba(27, 51, 71, 0.06), 0 2px 10px rgba(27, 51, 71, 0.04); border: 1px solid rgba(229, 213, 194, 0.3);">
    
    <div class="tracking-header" style="text-align: center; margin-bottom: 2.5rem;">
        <div class="tracking-icon" style="width: 56px; height: 56px; background: var(--color-bg-base, #FBF8F2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem; color: var(--color-marine-deep, #1B3347); border: 1px solid rgba(27, 51, 71, 0.08);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
            </svg>
        </div>
        <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--color-marine-deep, #1B3347); margin-bottom: 0.5rem;"><?php esc_html_e( 'پیگیری وضعیت سفارش', 'razgem' ); ?></h2>
        <p style="color: var(--color-marine-muted, #5A7B92); font-size: 0.95rem; line-height: 1.7;">
            <?php esc_html_e( 'برای اطلاع از وضعیت سفارش خود، لطفاً شماره سفارش و ایمیلی که هنگام خرید ثبت کرده‌اید را در کادرهای زیر وارد کنید.', 'razgem' ); ?>
        </p>
    </div>

    <form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="woocommerce-form woocommerce-form-track-order track_order razgem-tracking-form">

        <div class="razgem-form-grid" style="display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 2rem;">
            
            <div class="floating-label-group">
                <input class="floating-input" type="text" name="orderid" id="orderid" value="<?php echo isset( $_REQUEST['orderid'] ) ? esc_attr( wp_unslash( $_REQUEST['orderid'] ) ) : ''; ?>" placeholder=" " required />
                <label for="orderid" class="floating-label"><?php esc_html_e( 'شماره سفارش', 'razgem' ); ?></label>
                <span class="input-hint" style="font-size: 0.8rem; color: #888; margin-top: 0.4rem; display: block; padding-right: 0.5rem;">(رسید خرید یا ایمیل تاییدیه)</span>
            </div>

            <div class="floating-label-group">
                <input class="floating-input" type="email" name="order_email" id="order_email" value="<?php echo isset( $_REQUEST['order_email'] ) ? esc_attr( wp_unslash( $_REQUEST['order_email'] ) ) : ''; ?>" placeholder=" " required />
                <label for="order_email" class="floating-label"><?php esc_html_e( 'ایمیل صورتحساب', 'razgem' ); ?></label>
                <span class="input-hint" style="font-size: 0.8rem; color: #888; margin-top: 0.4rem; display: block; padding-right: 0.5rem;">(ایمیلی که در صفحه پرداخت وارد کردید)</span>
            </div>

        </div>

        <div class="form-actions" style="text-align: center;">
            <button type="submit" class="btn-coastal-slate" name="track" value="<?php esc_attr_e( 'Track', 'woocommerce' ); ?>" style="width: 100%; padding: 1.1rem; border-radius: 12px; font-size: 1.05rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem; border: none; cursor: pointer;">
                <span><?php esc_html_e( 'پیگیری سفارش', 'razgem' ); ?></span>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
        </div>
        
        <?php wp_nonce_field( 'woocommerce-order_tracking', 'woocommerce-order-tracking-nonce' ); ?>

    </form>
</div>
