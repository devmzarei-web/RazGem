<?php
/**
 * Order tracking output
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/tracking.php.
 * RazGem Coastal Haute-Joaillerie Edition
 *
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

$notes = $order->get_customer_order_notes();
$status_obj = wc_get_order_status_name( $order->get_status() );
$status_slug = $order->get_status();

// Map status to visual styles
$status_color = '#5A7B92';
$status_bg = '#F0F4F8';
$status_icon = '<circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>';

if ( $status_slug === 'completed' ) {
    $status_color = '#2c7a51';
    $status_bg = '#eef8f2';
    $status_icon = '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline>';
} elseif ( $status_slug === 'processing' ) {
    $status_color = '#d48806';
    $status_bg = '#fffbe6';
    $status_icon = '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>';
} elseif ( $status_slug === 'cancelled' || $status_slug === 'failed' ) {
    $status_color = '#c62828';
    $status_bg = '#ffebee';
    $status_icon = '<circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line>';
}
?>

<div class="razgem-order-tracking-result" style="max-width: 900px; margin: 3rem auto; background: #fff; border-radius: 24px; box-shadow: 0 12px 40px rgba(27, 51, 71, 0.05), 0 2px 10px rgba(27, 51, 71, 0.03); border: 1px solid rgba(229, 213, 194, 0.3); overflow: hidden;">
    
    <!-- Order Header Ribbon -->
    <div class="tracking-result-header" style="background: var(--color-marine-deep, #1B3347); color: #fff; padding: 2rem 2.5rem; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem;">
        <div>
            <h2 style="margin: 0 0 0.4rem; font-size: 1.4rem; font-weight: 800; color: #fff;">
                سفارش #<?php echo esc_html( $order->get_order_number() ); ?>
            </h2>
            <div style="font-size: 0.9rem; color: rgba(255,255,255,0.7); display: flex; align-items: center; gap: 0.5rem;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                ثبت شده در: <?php echo wc_format_datetime( $order->get_date_created() ); ?>
            </div>
        </div>
        
        <div class="tracking-status-badge" style="background: <?php echo esc_attr( $status_bg ); ?>; color: <?php echo esc_attr( $status_color ); ?>; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.95rem; display: flex; align-items: center; gap: 0.5rem;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <?php echo $status_icon; ?>
            </svg>
            <?php echo esc_html( $status_obj ); ?>
        </div>
    </div>

    <!-- Order Body -->
    <div class="tracking-result-body" style="padding: 2.5rem;">
        
        <?php if ( $notes ) : ?>
            <div class="tracking-notes-timeline" style="margin-bottom: 3rem;">
                <h3 style="font-size: 1.2rem; font-weight: 800; color: var(--color-marine-deep); margin-bottom: 1.5rem; padding-bottom: 0.8rem; border-bottom: 1px solid rgba(27,51,71,0.1);">
                    <?php esc_html_e( 'تاریخچه و وضعیت ارسال', 'woocommerce' ); ?>
                </h3>
                
                <div style="position: relative; padding-right: 1.5rem; border-right: 2px dashed rgba(229, 213, 194, 0.6);">
                    <?php foreach ( $notes as $index => $note ) : ?>
                        <div class="timeline-event" style="position: relative; margin-bottom: 1.5rem;">
                            <!-- Node -->
                            <div style="position: absolute; right: -1.9rem; top: 0.2rem; width: 14px; height: 14px; background: <?php echo $index === 0 ? 'var(--color-sand)' : '#fff'; ?>; border: 2px solid <?php echo $index === 0 ? 'var(--color-sand)' : 'rgba(229, 213, 194, 1)'; ?>; border-radius: 50%; box-shadow: 0 0 0 4px #fff;"></div>
                            
                            <div class="timeline-date" style="font-size: 0.8rem; color: #888; margin-bottom: 0.3rem;">
                                <?php echo date_i18n( esc_html__( 'l j F Y، ساعت H:i', 'woocommerce' ), strtotime( $note->comment_date ) ); ?>
                            </div>
                            <div class="timeline-content" style="background: var(--color-bg-base, #FBF8F2); padding: 1rem; border-radius: 12px; font-size: 0.95rem; color: var(--color-marine-deep); line-height: 1.6;">
                                <?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Order Details Injection -->
        <div class="tracking-order-details-wrapper coastal-themed-order-details">
            <?php do_action( 'woocommerce_view_order', $order->get_id() ); ?>
        </div>

        <div class="tracking-footer-actions" style="margin-top: 3rem; text-align: center; border-top: 1px solid rgba(27,51,71,0.1); padding-top: 2rem;">
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn-outline-marine" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.8rem 2rem; border: 1px solid var(--color-marine-deep); color: var(--color-marine-deep); border-radius: 99px; text-decoration: none; font-weight: 700; transition: all 0.3s ease;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                بازگشت به فروشگاه
            </a>
        </div>
    </div>
</div>

<style>
/* Reset some default woocommerce table styles inside our coastal wrapper */
.coastal-themed-order-details h2 {
    font-size: 1.2rem; font-weight: 800; color: var(--color-marine-deep); margin-bottom: 1.5rem; padding-bottom: 0.8rem; border-bottom: 1px solid rgba(27,51,71,0.1);
}
.coastal-themed-order-details table.shop_table {
    border: none !important; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.03); margin-bottom: 2.5rem;
}
.coastal-themed-order-details table.shop_table thead th {
    background: var(--color-bg-base, #FBF8F2); color: var(--color-marine-deep); font-weight: 800; border: none; padding: 1.2rem 1rem;
}
.coastal-themed-order-details table.shop_table tbody td, 
.coastal-themed-order-details table.shop_table tfoot td,
.coastal-themed-order-details table.shop_table tfoot th {
    border-top: 1px solid rgba(27,51,71,0.05); border-bottom: none; border-left: none; border-right: none; padding: 1.2rem 1rem; color: var(--color-marine-muted);
}
.coastal-themed-order-details table.shop_table tbody tr:last-child td {
    border-bottom: 2px solid rgba(27,51,71,0.1);
}
.coastal-themed-order-details table.shop_table tfoot th {
    font-weight: 700; color: var(--color-marine-deep);
}
.coastal-themed-order-details .wc-item-meta {
    font-size: 0.85rem; margin-top: 0.5rem;
}
.coastal-themed-order-details address {
    background: var(--color-bg-base, #FBF8F2); padding: 1.5rem; border-radius: 12px; font-style: normal; line-height: 1.8; color: var(--color-marine-deep); border: 1px solid rgba(229, 213, 194, 0.4);
}
.btn-outline-marine:hover {
    background: var(--color-marine-deep); color: #fff !important;
}
</style>
