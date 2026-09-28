<?php
/**
 * Empty cart page
 *
 * @package RazGem
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
?>
<div class="site-container" style="padding-top: 4rem; padding-bottom: 6rem; text-align: center;">
    <div class="pebble-surface" style="max-width: 620px; margin: 0 auto; padding: 3.5rem 2rem; border-radius: 28px; box-shadow: 0 15px 40px rgba(27,51,71,0.06);">
        <div style="font-size: 3.5rem; margin-bottom: 1.2rem;">
            🦪
        </div>
        
        <h2 style="font-family: var(--font-heading); font-size: 1.85rem; color: var(--color-marine-deep); margin: 0 0 1rem 0;">
            سبد خرید شما در حال حاضر خالی است
        </h2>
        
        <p style="color: var(--color-marine-muted); font-size: 1rem; line-height: 1.9; margin: 0 auto 2rem auto; max-width: 440px;">
            هنوز اثری از صدف‌های طبیعی یا مرواریدهای باروک آتلیه رازجم را به سبد خرید خود اضافه نکرده‌اید.
        </p>
        
        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
            <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="btn-coastal-slate" style="padding: 0.85rem 2.2rem; font-size: 0.95rem;">
                <span>مشاهده و انتخاب زیورآلات</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
        </div>
    </div>
</div>
