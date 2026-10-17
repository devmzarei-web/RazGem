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

            <div class="track-support-bar" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px dashed var(--color-pebble-light); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.6rem;">
                    <span style="font-size: 1.3rem;">💬</span>
                    <span style="font-size: 0.92rem; font-weight: 600; color: var(--color-marine-muted);">کد رهگیری خود را دریافت نکرده‌اید؟ استعلام مستقیم:</span>
                </div>
                <?php
                $track_telegram  = get_theme_mod( 'social_telegram', 'https://t.me/+989007423055' );
                $track_instagram = get_theme_mod( 'social_instagram', 'https://instagram.com/razgem.ir' );
                $track_rubika    = get_theme_mod( 'social_rubika', 'https://rubika.ir/raz_gem' );
                $track_icon_dir  = get_template_directory_uri() . '/assets/icons/';
                ?>
                <div class="track-social-buttons" style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                    <a href="<?php echo esc_url( $track_telegram ); ?>" target="_blank" rel="noopener noreferrer" class="track-channel-btn track-channel--telegram" style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.45rem 0.95rem; border-radius: 20px; font-size: 0.82rem; font-weight: 700; text-decoration: none; color: #FFFFFF !important; background: linear-gradient(135deg, #0088cc, #24A1DE); box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                        <img src="<?php echo esc_url( $track_icon_dir . 'telegram.png?v=3' ); ?>" alt="تلگرام" width="18" height="18" style="width: 18px !important; height: 18px !important; min-width: 18px !important; max-width: 18px !important; object-fit: contain !important; vertical-align: middle !important; display: inline-block !important;">
                        <span>تلگرام</span>
                    </a>
                    <a href="<?php echo esc_url( $track_instagram ); ?>" target="_blank" rel="noopener noreferrer" class="track-channel-btn track-channel--instagram" style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.45rem 0.95rem; border-radius: 20px; font-size: 0.82rem; font-weight: 700; text-decoration: none; color: #FFFFFF !important; background: linear-gradient(135deg, #833AB4, #FD1D1D, #FCB045); box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                        <img src="<?php echo esc_url( $track_icon_dir . 'instagram.png?v=3' ); ?>" alt="اینستاگرام" width="18" height="18" style="width: 18px !important; height: 18px !important; min-width: 18px !important; max-width: 18px !important; object-fit: contain !important; vertical-align: middle !important; display: inline-block !important;">
                        <span>اینستاگرام</span>
                    </a>
                    <a href="<?php echo esc_url( $track_rubika ); ?>" target="_blank" rel="noopener noreferrer" class="track-channel-btn track-channel--rubika" style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.45rem 0.95rem; border-radius: 20px; font-size: 0.82rem; font-weight: 700; text-decoration: none; color: #FFFFFF !important; background: linear-gradient(135deg, #4A148C, #7B1FA2); box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                        <img src="<?php echo esc_url( $track_icon_dir . 'Rubika.png?v=3' ); ?>" alt="روبیکا" width="18" height="18" style="width: 18px !important; height: 18px !important; min-width: 18px !important; max-width: 18px !important; object-fit: contain !important; vertical-align: middle !important; display: inline-block !important;">
                        <span>روبیکا</span>
                    </a>
                </div>
            </div>
        </div>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php
            $raw_content = get_the_content();
            // Suppress duplicate woocommerce tracking shortcodes seeded in the post content
            $filtered_content = str_replace( array( '[woocommerce_order_tracking]', '<!-- wp:woocommerce/order-tracking /-->', 'woocommerce_order_tracking' ), '', $raw_content );
            $filtered_content = trim( apply_filters( 'the_content', $filtered_content ) );
            if ( ! empty( $filtered_content ) ) : ?>
                <div class="utility-content-text" style="background: #FFFFFF; padding: 2rem; border-radius: 16px; border: 1px solid var(--color-pebble-light); margin-top: 2rem;">
                    <?php echo $filtered_content; ?>
                </div>
            <?php endif; ?>
        <?php endwhile; endif; ?>

    </div>
</main>

<style>
.track-channel-btn {
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.45rem !important;
    padding: 0.45rem 0.95rem !important;
    border-radius: 20px !important;
    font-size: 0.82rem !important;
    font-weight: 700 !important;
    text-decoration: none !important;
    color: #FFFFFF !important;
    transition: all 0.25s ease !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06) !important;
}
.track-channel-btn img {
    width: 18px !important;
    height: 18px !important;
    max-width: 18px !important;
    max-height: 18px !important;
    min-width: 18px !important;
    min-height: 18px !important;
    object-fit: contain !important;
    flex-shrink: 0 !important;
    display: inline-block !important;
    vertical-align: middle !important;
}
.track-channel--telegram {
    background: linear-gradient(135deg, #0088cc, #24A1DE) !important;
}
.track-channel--telegram:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(36, 161, 222, 0.35) !important;
}
.track-channel--instagram {
    background: linear-gradient(135deg, #833AB4, #FD1D1D, #FCB045) !important;
}
.track-channel--instagram:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(225, 48, 108, 0.35) !important;
}
.track-channel--rubika {
    background: linear-gradient(135deg, #4A148C, #7B1FA2) !important;
}
.track-channel--rubika:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(123, 31, 162, 0.35) !important;
}
@media (max-width: 600px) {
    .track-support-bar {
        flex-direction: column !important;
        align-items: flex-start !important;
    }
    .track-social-buttons {
        width: 100% !important;
        justify-content: flex-start !important;
    }
}
</style>

<?php get_footer(); ?>
