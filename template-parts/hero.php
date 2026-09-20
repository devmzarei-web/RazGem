<?php
/**
 * RazGem Haute-Joaillerie Spotlight Hero Template Part
 * Interactive Jewelry Spotlight & Editorial Hybrid with Multi-Item Carousel
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

// Multi-slide images & labels
$slide1_img = function_exists( 'razgem_get_hero_slide_url' ) ? razgem_get_hero_slide_url( 1 ) : ( function_exists( 'razgem_get_hero_image_url' ) ? razgem_get_hero_image_url() : get_template_directory_uri() . '/assets/images/spotlight-pendant.jpg' );
$slide1_tag = get_theme_mod( 'hero_slide_1_tag', 'مدال و آویز طلای ۱۸ عیار و مروارید باروک' );

$slide2_img = function_exists( 'razgem_get_hero_slide_url' ) ? razgem_get_hero_slide_url( 2 ) : get_template_directory_uri() . '/assets/images/earrings-collection.jpg';
$slide2_tag = get_theme_mod( 'hero_slide_2_tag', 'گوشواره‌های دست‌ساز مروارید و طلا' );

$slide3_img = function_exists( 'razgem_get_hero_slide_url' ) ? razgem_get_hero_slide_url( 3 ) : get_template_directory_uri() . '/assets/images/atelier-story.jpg';
$slide3_tag = get_theme_mod( 'hero_slide_3_tag', 'آتلیه و ساخت اختصاصی زیورآلات' );

// Hotspot Pins Configuration (Slide 1)
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
    <!-- Ambient Jewelry Maison Sunburst Motif -->
    <div class="razgem-hero-bg-motif" aria-hidden="true">
        <svg viewBox="0 0 600 600" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="300" cy="300" r="240" stroke="rgba(229, 219, 199, 0.07)" stroke-width="1.5" stroke-dasharray="6 8"/>
            <circle cx="300" cy="300" r="170" stroke="rgba(197, 155, 39, 0.12)" stroke-width="1"/>
            <circle cx="300" cy="300" r="100" stroke="rgba(133, 150, 107, 0.14)" stroke-width="1" stroke-dasharray="4 6"/>
            <path d="M300 20v70M300 510v70M20 300h70M510 300h70M102 102l50 50M448 448l50 50M102 498l50-50M448 152l50-50" stroke="rgba(212, 175, 55, 0.18)" stroke-width="1.5"/>
        </svg>
    </div>

    <div class="site-container razgem-hero-grid">
        
        <!-- Hero Editorial Narrative (Right on RTL, Centered) -->
        <div class="razgem-hero-narrative">
            <?php if ( ! empty( $hero_badge ) ) : ?>
                <div class="razgem-hero-badge-wrap">
                    <span class="razgem-hero-badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="opacity:0.9;">
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

            <!-- Floating Maison Quality Chips -->
            <div class="razgem-hero-chips">
                <span class="razgem-chip"><span class="chip-dot"></span> طلای ۱۸ عیار استاندارد</span>
                <span class="razgem-chip"><span class="chip-dot"></span> مروارید باروک اصل خلیج فارس</span>
                <span class="razgem-chip"><span class="chip-dot"></span> ارسال بیمه‌شده به سراسر کشور</span>
            </div>

            <!-- Trust Metrics Bar -->
            <div class="razgem-hero-trust-bar">
                <div class="razgem-trust-item">
                    <div class="trust-icon">✨</div>
                    <div class="trust-text">
                        <strong>طلای ۱۸ عیار دست‌ساز</strong>
                        <span>شناسنامه رسمی و فاکتور استاندارد</span>
                    </div>
                </div>
                <div class="razgem-trust-item">
                    <div class="trust-icon">🦪</div>
                    <div class="trust-text">
                        <strong>مروارید باروک طبیعی</strong>
                        <span>گوهرهای ارگانیک و دست‌چین شده</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Spotlight Centerpiece (Left on RTL) - Multi-Slide Carousel -->
        <div class="razgem-hero-showcase">
            <div class="razgem-spotlight-halo"></div>
            
            <div class="razgem-spotlight-frame razgem-hero-slider" id="razgemHeroSlider" role="region" aria-roledescription="carousel" aria-label="شاهکارهای منتخب رازجم">
                <div class="razgem-slider-track">
                    
                    <!-- Slide 1 -->
                    <div class="razgem-hero-slide is-active" data-index="0" role="group" aria-roledescription="slide" aria-label="اسلاید ۱ از ۳: <?php echo esc_attr( $slide1_tag ); ?>">
                        <img src="<?php echo esc_url( $slide1_img ); ?>" 
                             alt="<?php echo esc_attr( $slide1_tag ); ?>" 
                             class="razgem-spotlight-img"
                             loading="eager">
                        
                        <?php if ( ! empty( $slide1_tag ) ) : ?>
                            <div class="razgem-slide-badge">
                                <span><?php echo esc_html( $slide1_tag ); ?></span>
                            </div>
                        <?php endif; ?>

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

                    <!-- Slide 2 -->
                    <div class="razgem-hero-slide" data-index="1" role="group" aria-roledescription="slide" aria-label="اسلاید ۲ از ۳: <?php echo esc_attr( $slide2_tag ); ?>">
                        <img src="<?php echo esc_url( $slide2_img ); ?>" 
                             alt="<?php echo esc_attr( $slide2_tag ); ?>" 
                             class="razgem-spotlight-img"
                             loading="lazy">
                        
                        <?php if ( ! empty( $slide2_tag ) ) : ?>
                            <div class="razgem-slide-badge">
                                <span><?php echo esc_html( $slide2_tag ); ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Slide 2 Hotspot Pin -->
                        <div class="razgem-hotspot-pin pin-1" 
                             style="top: 48%; left: 42%;"
                             tabindex="0"
                             role="button"
                             aria-label="مروارید اشکی طبیعی">
                            <span class="hotspot-pulse"></span>
                            <span class="hotspot-core"></span>
                            <div class="hotspot-tooltip">
                                <span class="tooltip-badge">مروارید باروک</span>
                                <span class="tooltip-label">دست‌چین طبیعی خلیج فارس</span>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="razgem-hero-slide" data-index="2" role="group" aria-roledescription="slide" aria-label="اسلاید ۳ از ۳: <?php echo esc_attr( $slide3_tag ); ?>">
                        <img src="<?php echo esc_url( $slide3_img ); ?>" 
                             alt="<?php echo esc_attr( $slide3_tag ); ?>" 
                             class="razgem-spotlight-img"
                             loading="lazy">
                        
                        <?php if ( ! empty( $slide3_tag ) ) : ?>
                            <div class="razgem-slide-badge">
                                <span><?php echo esc_html( $slide3_tag ); ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Slide 3 Hotspot Pin -->
                        <div class="razgem-hotspot-pin pin-1" 
                             style="top: 50%; left: 50%;"
                             tabindex="0"
                             role="button"
                             aria-label="کارگاه و ریخته‌گری طلا">
                            <span class="hotspot-pulse"></span>
                            <span class="hotspot-core"></span>
                            <div class="hotspot-tooltip">
                                <span class="tooltip-badge">هنر زرگری</span>
                                <span class="tooltip-label">سفارش ساخت اختصاصی رازجم</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Slider Navigation & Dots Overlay -->
                <div class="razgem-slider-nav-bar">
                    <button type="button" class="razgem-slider-btn prev" aria-label="اسلاید قبلی">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>

                    <div class="razgem-slider-dots">
                        <button type="button" class="razgem-dot is-active" data-go-to="0" aria-label="اسلاید ۱"></button>
                        <button type="button" class="razgem-dot" data-go-to="1" aria-label="اسلاید ۲"></button>
                        <button type="button" class="razgem-dot" data-go-to="2" aria-label="اسلاید ۳"></button>
                    </div>

                    <button type="button" class="razgem-slider-btn next" aria-label="اسلاید بعدی">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>