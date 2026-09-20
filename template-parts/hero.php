<?php
/**
 * RazGem Haute-Joaillerie Spotlight Hero Template Part
 * Interactive Jewelry Spotlight & Editorial Hybrid
 *
 * @package RazGem
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$hero_badge     = get_theme_mod( 'hero_badge', 'کالکشن فاخر زیورآلات دست‌ساز' );
$hero_title     = get_theme_mod( 'hero_title', 'درخشش اصالت و هنر دست در تلفیق طلا و مروارید رازجم' );
$hero_subtitle  = get_theme_mod( 'hero_subtitle', 'طراحی و ساخت دست‌سازه‌های اختصاصی طلای ۱۸ عیار، مرواریدهای باروک طبیعی و سنگ‌های قیمتی' );
$hero_btn1_text = get_theme_mod( 'hero_btn1_text', 'مشاهده کالکشن زیورآلات' );
$hero_btn1_url  = get_theme_mod( 'hero_btn1_url', '/shop' );
$hero_btn2_text = get_theme_mod( 'hero_btn2_text', 'سفارش ساخت اختصاصی' );
$hero_btn2_url  = get_theme_mod( 'hero_btn2_url', '/contact' );
$hero_image_url = function_exists( 'razgem_get_hero_image_url' ) ? razgem_get_hero_image_url() : get_template_directory_uri() . '/assets/images/spotlight-pendant.jpg';

// Hotspot Pins Configuration
$pin1_enable = get_theme_mod( 'hero_pin1_enable', true );
$pin1_text   = get_theme_mod( 'hero_pin1_text', 'طلای ۱۸ عیار دست‌ساز' );
$pin1_x      = get_theme_mod( 'hero_pin1_x', 38 );
$pin1_y      = get_theme_mod( 'hero_pin1_y', 42 );

$pin2_enable = get_theme_mod( 'hero_pin2_enable', true );
$pin2_text   = get_theme_mod( 'hero_pin2_text', 'مروارید اصل باروک خلیج فارس' );
$pin2_x      = get_theme_mod( 'hero_pin2_x', 56 );
$pin2_y      = get_theme_mod( 'hero_pin2_y', 64 );
?>

<section class="razgem-hero-spotlight" aria-label="معرفی شاهکارهای گالری طلا و مروارید رازجم">
    <div class="site-container razgem-hero-grid">
        
        <!-- Hero Editorial Narrative (Right on RTL) -->
        <div class="razgem-hero-narrative">
            <?php if ( ! empty( $hero_badge ) ) : ?>
                <div class="razgem-hero-badge-wrap">
                    <span class="razgem-hero-badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="opacity:0.85;">
                            <path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.6-6.2 4.6 2.4-7.4-6.2-4.5h7.6z"/>
                        </svg>
                        <?php echo esc_html( $hero_badge ); ?>
                    </span>
                </div>
            <?php endif; ?>

            <h1 class="razgem-hero-title">
                <?php echo wp_kses_post( $hero_title ); ?>
            </h1>

            <p class="razgem-hero-subtitle">
                <?php echo esc_html( $hero_subtitle ); ?>
            </p>

            <div class="razgem-hero-cta-group">
                <?php if ( ! empty( $hero_btn1_text ) && ! empty( $hero_btn1_url ) ) : ?>
                    <a href="<?php echo esc_url( $hero_btn1_url ); ?>" class="btn-luxury-gold">
                        <span><?php echo esc_html( $hero_btn1_text ); ?></span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </a>
                <?php endif; ?>

                <?php if ( ! empty( $hero_btn2_text ) && ! empty( $hero_btn2_url ) ) : ?>
                    <a href="<?php echo esc_url( $hero_btn2_url ); ?>" class="btn-luxury-contour">
                        <span><?php echo esc_html( $hero_btn2_text ); ?></span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Trust Metrics Bar -->
            <div class="razgem-hero-trust-bar">
                <div class="razgem-trust-item">
                    <div class="trust-icon">✨</div>
                    <div class="trust-text">
                        <strong>طلای ۱۸ عیار</strong>
                        <span>شناسنامه رسمی و استاندارد</span>
                    </div>
                </div>
                <div class="razgem-trust-item">
                    <div class="trust-icon">🦪</div>
                    <div class="trust-text">
                        <strong>مروارید باروک طبیعی</strong>
                        <span>ارگانیک و دست‌چین شده</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Spotlight Centerpiece (Left on RTL) -->
        <div class="razgem-hero-showcase">
            <div class="razgem-spotlight-halo"></div>
            
            <div class="razgem-spotlight-frame">
                <img src="<?php echo esc_url( $hero_image_url ); ?>" 
                     alt="<?php echo esc_attr( $hero_title ); ?>" 
                     class="razgem-spotlight-img"
                     loading="eager"
                     onerror="this.src='<?php echo esc_url( get_template_directory_uri() . '/assets/images/spotlight-pendant.jpg' ); ?>'">

                <!-- Interactive Hotspot Pin 1 -->
                <?php if ( $pin1_enable && ! empty( $pin1_text ) ) : ?>
                    <div class="razgem-hotspot-pin pin-1" 
                         style="top: <?php echo esc_attr( $pin1_y ); ?>%; left: <?php echo esc_attr( $pin1_x ); ?>%;"
                         tabindex="0"
                         role="button"
                         aria-label="<?php echo esc_attr( $pin1_text ); ?>">
                        <span class="hotspot-pulse"></span>
                        <span class="hotspot-core"></span>
                        <div class="hotspot-tooltip">
                            <span class="tooltip-badge">اصالت گوهر</span>
                            <span class="tooltip-label"><?php echo esc_html( $pin1_text ); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Interactive Hotspot Pin 2 -->
                <?php if ( $pin2_enable && ! empty( $pin2_text ) ) : ?>
                    <div class="razgem-hotspot-pin pin-2" 
                         style="top: <?php echo esc_attr( $pin2_y ); ?>%; left: <?php echo esc_attr( $pin2_x ); ?>%;"
                         tabindex="0"
                         role="button"
                         aria-label="<?php echo esc_attr( $pin2_text ); ?>">
                        <span class="hotspot-pulse"></span>
                        <span class="hotspot-core"></span>
                        <div class="hotspot-tooltip">
                            <span class="tooltip-badge">طراحی دست‌ساز</span>
                            <span class="tooltip-label"><?php echo esc_html( $pin2_text ); ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>