<?php
/**
 * The template for displaying 404 pages (Not Found)
 * RazGem Coastal Atelier Edition
 *
 * @package RazGem
 * @version 2.0.0
 */
defined( 'ABSPATH' ) || exit;
get_header(); ?>

<main class="site-container error-404-page" dir="rtl" role="main" style="padding-top: 4.5rem; padding-bottom: 6rem; text-align: center; min-height: 70vh; display: flex; align-items: center; justify-content: center;">
    <div class="pebble-surface" style="max-width: 680px; width: 100%; padding: 3.5rem 2rem; border-radius: 28px; box-shadow: 0 15px 40px rgba(27, 51, 71, 0.08);">
        
        <div style="font-size: 3.5rem; margin-bottom: 1rem; filter: drop-shadow(0 4px 10px rgba(212,175,55,0.3));">
            🦪
        </div>

        <h1 class="error-code" style="font-family: var(--font-heading); font-size: 3.8rem; font-weight: 800; color: var(--color-slate-dark); margin: 0 0 0.5rem 0; letter-spacing: 2px;">
            ۴۰۴
        </h1>

        <h2 class="error-title" style="font-family: var(--font-heading); font-size: 1.8rem; color: var(--color-marine-deep); margin: 0 0 1rem 0;">
            در امواج دریا گم شده‌اید؟
        </h2>

        <p class="error-desc" style="color: var(--color-marine-muted); font-size: 1.05rem; line-height: 1.9; margin: 0 auto 2rem auto; max-width: 480px;">
            صفحه‌ای که به دنبال آن بودید پیدا نشد. ممکن است این اثر تک‌نسخه واگذار شده یا نشانی اینترنتی تغییر کرده باشد.
        </p>

        <!-- Search Form -->
        <div style="max-width: 420px; margin: 0 auto 2.2rem auto;">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="position: relative;">
                <input type="search" class="search-input" placeholder="جستجوی گوشواره، گردنبند یا صدف..." value="<?php echo get_search_query(); ?>" name="s" style="padding: 0.8rem 1.2rem; width: 100%; border-radius: 999px; border: 1.5px solid var(--color-pebble);">
                <button type="submit" class="search-submit" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--color-slate);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </button>
            </form>
        </div>

        <!-- Quick Navigation Chips -->
        <div style="display: flex; justify-content: center; gap: 0.8rem; flex-wrap: wrap; margin-bottom: 2rem;">
            <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="btn-coastal-slate" style="padding: 0.7rem 1.6rem; font-size: 0.92rem;">
                <span>مشاهده همه آثار فروشگاه</span>
            </a>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-coastal-sand" style="padding: 0.7rem 1.6rem; font-size: 0.92rem;">
                <span>بازگشت به صفحه اصلی</span>
            </a>
        </div>

        <div style="font-size: 0.85rem; color: var(--color-marine-muted); border-top: 1px dashed var(--color-pebble-light); padding-top: 1.2rem;">
            نیاز به راهنمایی دارید؟ با کارشناسان آتلیه در <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" style="color: var(--color-gold); font-weight: bold; text-decoration: none;">بخش تماس با ما</a> گفتگو کنید.
        </div>

    </div>
</main>

<?php get_footer(); ?>