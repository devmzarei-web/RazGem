<?php
/**
 * Template Name: Track Order Layout (پیگیری سفارش)
 *
 * @package RazGem
 * @version 2.0.0
 */
defined( 'ABSPATH' ) || exit;
get_header(); 
?>

<main class="site-container utility-page" dir="rtl" role="main" style="padding-top: 3rem; padding-bottom: 5rem;">
    <div class="utility-page-wrapper" style="max-width: 820px; margin: 0 auto;">
        
        <header class="utility-header" style="text-align: center; margin-bottom: 2.5rem;">
            <div style="display: inline-block; background: rgba(212,175,55,0.15); color: #9E7D3B; padding: 0.35rem 1.2rem; border-radius: 999px; font-weight: 700; font-size: 0.85rem; margin-bottom: 0.8rem;">
                📦 سامانه پیگیری محموله‌های پستی
            </div>
            <h1 class="utility-title" style="font-family: var(--font-heading); font-size: 2.2rem; color: var(--color-marine-deep); margin: 0 0 0.8rem 0;">
                پیگیری وضعیت سفارش و بسته پستی
            </h1>
            <p style="color: var(--color-marine-muted); font-size: 1rem; max-width: 600px; margin: 0 auto; line-height: 1.8;">
                تمامی بسته‌های گالری رازجم با پست پیشتاز و بیمه کامل به سراسر ایران ارسال می‌شوند. کد رهگیری ۲۴ رقمی پستی پس از ارسال، از طریق پیامک برای شما ارسال می‌گردد.
            </p>
        </header>

        <!-- Tracking Form Card -->
        <div class="pebble-surface" style="padding: 2.5rem; border-radius: 24px; box-shadow: 0 10px 30px rgba(27,51,71,0.06); margin-bottom: 2rem;">
            
            <!-- Iranian National Post Tracking Form (Always Active) -->
            <form action="https://tracking.post.ir/" method="get" target="_blank" rel="noopener noreferrer" style="display: flex; flex-direction: column; gap: 1.2rem;">
                <div>
                    <label for="postTrackingCode" style="display: block; font-weight: 700; margin-bottom: 0.5rem; color: var(--color-marine-deep);">
                        کد رهگیری ۲۴ رقمی پست پیشتاز:
                    </label>
                    <input type="text" 
                           id="postTrackingCode" 
                           name="id" 
                           placeholder="مثال: 123456789012345678901234" 
                           maxlength="24"
                           style="width: 100%; padding: 0.85rem 1.2rem; border: 1.5px solid var(--color-pebble); border-radius: 12px; font-size: 1.05rem; font-family: inherit; direction: ltr; text-align: center; letter-spacing: 2px;" 
                           required>
                </div>

                <button type="submit" class="btn-coastal-slate" style="width: 100%; padding: 0.9rem; font-size: 1rem;">
                    <span>رهگیری آنلاین در سامانه شرکت ملی پست ایران (tracking.post.ir)</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                </button>
            </form>

            <?php if ( function_exists( 'woocommerce_order_tracking' ) ) : ?>
                <!-- Optional WooCommerce Internal Order Status Tracking -->
                <div class="wc-tracking-embed" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--color-pebble-light);">
                    <h4 style="font-size: 0.95rem; margin-bottom: 1rem; color: var(--color-marine-deep);">یا پیگیری داخلی با شماره سفارش رازجم:</h4>
                    <?php echo do_shortcode( '[woocommerce_order_tracking]' ); ?>
                </div>
            <?php endif; ?>

            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px dashed var(--color-pebble-light); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.6rem;">
                    <span style="font-size: 1.3rem;">💬</span>
                    <span style="font-size: 0.92rem; color: var(--color-marine-muted);">کد رهگیری خود را دریافت نکرده‌اید؟</span>
                </div>
                <a href="<?php echo esc_url( 'https://wa.me/989120000000?text=' . urlencode( 'سلام، درخواست پیگیری سفارش از گالری رازجم را دارم.' ) ); ?>" target="_blank" rel="noopener noreferrer" class="btn-coastal-sand" style="font-size: 0.88rem; padding: 0.6rem 1.4rem;">
                    استعلام سریع در واتس‌اپ
                </a>
            </div>
        </div>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php if ( get_the_content() ) : ?>
                <div class="utility-content-text" style="background: #FFFFFF; padding: 2rem; border-radius: 16px; border: 1px solid var(--color-pebble-light); margin-top: 2rem;">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
        <?php endwhile; endif; ?>

    </div>
</main>

<?php get_footer(); ?>
