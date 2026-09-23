<?php
/**
 * RazGem Nature & Seashell Product Grid Template Part
 * Specimen Cards with Pebble Curvature & Nature Authenticity Badges
 *
 * @package RazGem
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$theme_uri = get_template_directory_uri();
?>
<section class="products-section razgem-products-nature" aria-label="جدیدترین زیورآلات ارگانیک صدف و مروارید">
    <div class="site-container">
        <div class="section-header">
            <span class="heading-eyebrow">هنر دست و شگفتی طبیعت</span>
            <h2 class="heading-title">جدیدترین زیورآلات صدف و مروارید رازجم</h2>
            <p class="heading-desc">طراحی ارگانیک، اصالت صدف طبیعی خلیج فارس و درخشش تکرارناپذیر مرواریدهای باروک</p>
        </div>
        
        <div class="products-grid">
            <!-- Product Specimen 1 -->
            <article class="product-card pebble-surface">
                <div class="product-card__gallery">
                    <span class="product-badge product-badge--nature">صدف طبیعی اصل</span>
                    <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/spotlight-pendant.jpg" class="img-primary" alt="مدال دست‌ساز صدف طبیعی و مروارید باروک">
                    <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/model-necklace-seashell.jpg" class="img-hover" alt="نمای بر تن مدال صدف">
                </div>
                <div class="product-card__content">
                    <div class="product-authenticity-tag">
                        <span class="auth-dot"></span>
                        <span>شناسنامه اصالت صدف و طلا</span>
                    </div>
                    <h3 class="product-title"><a href="/shop">مدال دست‌ساز صدف طبیعی و مروارید باروک</a></h3>
                    <div class="product-meta">صدف طبیعی خلیج فارس | طلای ۱۸ عیار دست‌ساز</div>
                    <div class="product-price">۴,۸۵۰,۰۰۰ <span>تومان</span></div>
                </div>
            </article>

            <!-- Product Specimen 2 -->
            <article class="product-card pebble-surface">
                <div class="product-card__gallery">
                    <span class="product-badge product-badge--pearl">مروارید باروک یکتا</span>
                    <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/earrings-collection.jpg" class="img-primary" alt="گوشواره آویز صدف بادبزنی و مروارید">
                    <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/model-earrings-baroque.jpg" class="img-hover" alt="نمای گوشواره بر گوش مدل">
                </div>
                <div class="product-card__content">
                    <div class="product-authenticity-tag">
                        <span class="auth-dot"></span>
                        <span>تک‌نسخه در طبیعت</span>
                    </div>
                    <h3 class="product-title"><a href="/shop">گوشواره آویز دست‌ساز صدف بادبزنی و مروارید</a></h3>
                    <div class="product-meta">مروارید اشکی باروک | سبک‌وزن و ارگانیک</div>
                    <div class="product-price">
                        <span class="price-old">۴,۱۰۰,۰۰۰</span>
                        ۳,۴۰۰,۰۰۰ <span>تومان</span>
                    </div>
                </div>
            </article>

            <!-- Product Specimen 3 -->
            <article class="product-card pebble-surface">
                <div class="product-card__gallery">
                    <span class="product-badge product-badge--atelier">دست‌ساز آتلیه</span>
                    <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/coastal-wave-shoreline.jpg" class="img-primary" alt="دستبند زنجیری صدف و سنگ‌های ساحلی">
                    <img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/model-bracelet-pendant.jpg" class="img-hover" alt="نمای دستبند صدف در مچ دست">
                </div>
                <div class="product-card__content">
                    <div class="product-authenticity-tag">
                        <span class="auth-dot"></span>
                        <span>فرم طبیعی تراش‌خورده</span>
                    </div>
                    <h3 class="product-title"><a href="/shop">دستبند دست‌ساز صدف مینیاتوری و سنگ ساحلی</a></h3>
                    <div class="product-meta">صدف‌های تراش‌خورده طبیعی | قفل طلای ۱۸ عیار</div>
                    <div class="product-price">۲,۷۵۰,۰۰۰ <span>تومان</span></div>
                </div>
            </article>
        </div>
    </div>
</section>