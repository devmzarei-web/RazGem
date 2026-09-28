<?php
/**
 * Template Name: About Us Layout (داستان رازجم)
 *
 * @package RazGem
 * @version 2.0.0
 */
defined( 'ABSPATH' ) || exit;
get_header(); 
?>

<main class="site-container utility-page about-us-page" dir="rtl" role="main" style="padding-top: 3.5rem; padding-bottom: 5.5rem;">
    <div class="utility-page-wrapper" style="max-width: 980px; margin: 0 auto;">
        
        <header class="utility-header" style="text-align: center; margin-bottom: 3.5rem;">
            <div style="display: inline-block; background: rgba(212,175,55,0.15); color: #9E7D3B; padding: 0.4rem 1.4rem; border-radius: 999px; font-weight: 700; font-size: 0.88rem; margin-bottom: 1rem;">
                🦪 هنر دست، صدف طبیعی و مروارید باروک
            </div>
            <h1 class="utility-title" style="font-family: var(--font-heading); font-size: 2.8rem; font-weight: 800; color: var(--color-marine-deep); margin: 0 0 1rem 0;">
                داستان رازجم؛ نغمه جاودان دریا و طلا
            </h1>
            <p style="color: var(--color-marine-muted); font-size: 1.1rem; line-height: 2; max-width: 680px; margin: 0 auto;">
                رازجم روایتی از پیوند شاعرانه میان گوهرهای ارگانیک دریا و هنر دست زرگران ایرانی است؛ جایی که هر صدف با نقوش منحصر‌به‌فرد خود، اثری تکرارناپذیر می‌آفریند.
            </p>
        </header>

        <!-- Feature Spotlight Atelier Hero -->
        <div class="pebble-surface" style="overflow: hidden; border-radius: 28px; margin-bottom: 3.5rem; box-shadow: 0 15px 45px rgba(27,51,71,0.08);">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); align-items: center;">
                <div style="padding: 2.5rem 2rem;">
                    <span style="font-size: 0.82rem; font-weight: 700; color: var(--color-gold); letter-spacing: 0.5px;">اصالت بدون رنگ‌آمیزی شیمیایی</span>
                    <h2 style="font-family: var(--font-heading); font-size: 1.85rem; color: var(--color-marine-deep); margin: 0.6rem 0 1.2rem 0; line-height: 1.4;">
                        هر صدف، یک شناسنامه طبیعی از دل اقیانوس
                    </h2>
                    <p style="color: var(--color-marine-muted); font-size: 0.98rem; line-height: 1.9; margin-bottom: 1.5rem;">
                        ما معتقدیم زیبایی ناب در نقص‌های ارگانیک طبیعت نهفته است. در آتلیه رازجم، هیچ رنگ شیمیایی یا پوشش مصنوعی به صدف‌ها اضافه نمی‌شود. رنگ‌های صورتی، مرجانی، طلایی و شیری همگی بازتاب خالص املاح دریا و نور خورشید جنوب هستند.
                    </p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="btn-coastal-slate" style="padding: 0.75rem 1.6rem;">
                            <span>مشاهده شاهکارهای آتلیه</span>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-coastal-sand" style="padding: 0.75rem 1.6rem;">
                            <span>سفارش اختصاصی</span>
                        </a>
                    </div>
                </div>
                <div style="height: 100%; min-height: 340px; background: #FAF6F0; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/products/r001-main.jpg' ); ?>" 
                         alt="تراش دستی صدف طبیعی در آتلیه رازجم" 
                         style="width: 100%; height: 100%; object-fit: cover; max-height: 420px;">
                </div>
            </div>
        </div>

        <!-- 3 Pillars of RazGem -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.8rem; margin-bottom: 3.5rem;">
            
            <div class="pebble-surface" style="padding: 2rem; border-radius: 20px; text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🌊</div>
                <h3 style="font-family: var(--font-heading); font-size: 1.3rem; color: var(--color-marine-deep); margin: 0 0 0.8rem 0;">
                    ۱۰۰٪ صدف‌های دست‌چین طبیعی
                </h3>
                <p style="color: var(--color-marine-muted); font-size: 0.92rem; line-height: 1.8; margin: 0;">
                    صدف‌های بومی سواحل جنوب پس از پایش دقیق گوهرشناسی، با احترام به بوم‌سازگان دریایی انتخاب و پالایش می‌شوند.
                </p>
            </div>

            <div class="pebble-surface" style="padding: 2rem; border-radius: 20px; text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">✨</div>
                <h3 style="font-family: var(--font-heading); font-size: 1.3rem; color: var(--color-marine-deep); margin: 0 0 0.8rem 0;">
                    مرواریدهای باروک یکتا
                </h3>
                <p style="color: var(--color-marine-muted); font-size: 0.92rem; line-height: 1.8; margin: 0;">
                    مرواریدهای باروک با فرم‌های نامتقارن و تلألو نسترنی، نماد شکوه زنانه و هویت انحصاری هر قطعه می‌باشند.
                </p>
            </div>

            <div class="pebble-surface" style="padding: 2rem; border-radius: 20px; text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🛡️</div>
                <h3 style="font-family: var(--font-heading); font-size: 1.3rem; color: var(--color-marine-deep); margin: 0 0 0.8rem 0;">
                    شناسنامه و ضمانت مادام‌العمر اصالت
                </h3>
                <p style="color: var(--color-marine-muted); font-size: 0.92rem; line-height: 1.8; margin: 0;">
                    تمامی محصولات همراه با شناسنامه فیزیکی ممهور و بسته‌بندی نفیس هدیه تقدیم حضور مشتریان گرامی می‌گردد.
                </p>
            </div>

        </div>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php if ( get_the_content() ) : ?>
                <!-- Custom Editor Content from WordPress Admin -->
                <article class="utility-content-text" style="background: #FFFFFF; padding: 2.5rem; border-radius: 20px; border: 1px solid var(--color-pebble-light); line-height: 2; color: var(--color-marine-deep);">
                    <?php the_content(); ?>
                </article>
            <?php endif; ?>
        <?php endwhile; endif; ?>

    </div>
</main>

<?php get_footer(); ?>