<?php
/**
 * RazGem Artisan Atelier Story Template Part
 * کارگاه زرگری و دست‌سازه‌های اختصاصی طلا و مروارید رازجم
 *
 * @package RazGem
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$atelier_badge    = get_theme_mod( 'atelier_badge', 'کارگاه زرگری و دست‌سازه‌ها' );
$atelier_title    = get_theme_mod( 'atelier_title', 'داستان هنر و ظرافت در گالری طلا و مروارید رازجم' );
$atelier_desc     = get_theme_mod( 'atelier_desc', 'هر اثر در گالری رازجم روایتی یگانه از تلاقی دستان هنرمند و طبیعت است. از گزینش اصیل‌ترین مرواریدهای باروک تا ریخته‌گری طلای ۱۸ عیار و ساخت زیورآلات سفارشی با وسواس در جزئیات.' );
$atelier_btn_text = get_theme_mod( 'atelier_btn_text', 'مشاوره و ساخت سفارش اختصاصی' );
$atelier_btn_url  = get_theme_mod( 'atelier_btn_url', '/contact' );
$atelier_image    = function_exists( 'razgem_get_atelier_image_url' ) ? razgem_get_atelier_image_url() : get_template_directory_uri() . '/assets/images/atelier-story.jpg';
?>

<section class="razgem-atelier-section" aria-label="<?php echo esc_attr( $atelier_title ); ?>">
    <div class="site-container razgem-atelier-grid">
        
        <!-- Atelier Visual Showcase -->
        <div class="razgem-atelier-media-wrap">
            <div class="razgem-atelier-frame">
                <img src="<?php echo esc_url( $atelier_image ); ?>" 
                     alt="<?php echo esc_attr( $atelier_title ); ?>" 
                     class="razgem-atelier-img"
                     loading="lazy"
                     onerror="this.src='<?php echo esc_url( get_template_directory_uri() . '/assets/images/atelier-story.jpg' ); ?>'">
                
                <div class="razgem-atelier-badge-stamp">
                    <span class="stamp-year">EST. ۲۰۲۳</span>
                    <span class="stamp-text">رازجم | هنر اصیل دست‌ساز</span>
                </div>
            </div>
        </div>

        <!-- Atelier Narrative & Craftsmanship Values -->
        <div class="razgem-atelier-content">
            <?php if ( ! empty( $atelier_badge ) ) : ?>
                <div class="razgem-atelier-badge-wrap">
                    <span class="razgem-atelier-badge"><?php echo esc_html( $atelier_badge ); ?></span>
                </div>
            <?php endif; ?>

            <h2 class="razgem-atelier-title">
                <?php echo esc_html( $atelier_title ); ?>
            </h2>

            <p class="razgem-atelier-desc">
                <?php echo nl2br( esc_html( $atelier_desc ) ); ?>
            </p>

            <div class="razgem-atelier-features">
                <div class="atelier-feature-pill">
                    <div class="pill-dot"></div>
                    <div class="pill-body">
                        <strong>ریخته‌گری دقیق طلای ۱۸ عیار</strong>
                        <p>تولید محدود با نظارت دقیق عیارسنجی اتحادیه طلا و جواهر</p>
                    </div>
                </div>

                <div class="atelier-feature-pill">
                    <div class="pill-dot"></div>
                    <div class="pill-body">
                        <strong>مرواریدهای باروک منفرد و طبیعی</strong>
                        <p>هیچ دو مرواریدی در جهان یکسان نیستند؛ اثری منحصربه‌فرد برای شما</p>
                    </div>
                </div>

                <div class="atelier-feature-pill">
                    <div class="pill-dot"></div>
                    <div class="pill-body">
                        <strong>سفارش‌سازی نام، تاریخ و نشان دلخواه</strong>
                        <p>تبدیل ایده و طرح ذهنی شما به یک شاهکار طلا با مدل‌سازی سه‌بعدی</p>
                    </div>
                </div>
            </div>

            <?php if ( ! empty( $atelier_btn_text ) && ! empty( $atelier_btn_url ) ) : ?>
                <div class="razgem-atelier-actions">
                    <a href="<?php echo esc_url( $atelier_btn_url ); ?>" class="btn-luxury-gold">
                        <span><?php echo esc_html( $atelier_btn_text ); ?></span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>
