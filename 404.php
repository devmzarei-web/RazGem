<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
defined( 'ABSPATH' ) || exit;
get_header(); ?>

<main class="site-container error-404-page" dir="rtl" role="main">
    <div class="error-404-wrapper">
        <div class="error-404-content">
            <h1 class="error-code">۴۰۴</h1>
            <h2 class="error-title">مسیر را گم کرده‌اید؟</h2>
            <p class="error-desc">صفحه‌ای که به دنبال آن بودید پیدا نشد. ممکن است آدرس را اشتباه وارد کرده باشید یا این محصول از سایت حذف شده باشد.</p>
            <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="btn-primary error-btn">بازگشت به فروشگاه</a>
        </div>
    </div>
</main>

<?php get_footer(); ?>