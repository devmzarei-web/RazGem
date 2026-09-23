<?php
/**
 * RazGem Coastal Seashell & Organic Nature Hero Template Part
 * Sunlit Linen Canvas, Pebble Vitrine & Undulating Wave Baseline
 *
 * @package RazGem
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$hero_badge     = get_theme_mod( 'hero_badge', 'کالکشن زیورآلات ارگانیک صدف و مروارید' );
$hero_title     = get_theme_mod( 'hero_title', 'درخشش اصالت دریا در تلفیق هنر دست، صدف و مروارید باروک' );
$hero_subtitle  = get_theme_mod( 'hero_subtitle', 'طراحی و ساخت زیورآلات دست‌ساز الهام‌گرفته از طبیعت، با صدف‌های طبیعی اصل خلیج فارس، مرواریدهای باروک وحشی و طلای ۱۸ عیار' );
$hero_btn1_text = get_theme_mod( 'hero_btn1_text', 'مشاهده زیورآلات صدف و مروارید' );
$hero_btn1_url  = get_theme_mod( 'hero_btn1_url', '/shop' );
$hero_btn2_text = get_theme_mod( 'hero_btn2_text', 'سفارش ساخت اختصاصی' );
$hero_btn2_url  = get_theme_mod( 'hero_btn2_url', '/contact' );

// Multi-slide images & labels
$slide1_img = function_exists( 'razgem_get_hero_slide_url' ) ? razgem_get_hero_slide_url( 1 ) : ( function_exists( 'razgem_get_hero_image_url' ) ? razgem_get_hero_image_url() : get_template_directory_uri() . '/assets/images/spotlight-pendant.jpg' );
$slide1_tag = get_theme_mod( 'hero_slide_1_tag', 'مدال صدف طبیعی و مروارید باروک' );

$slide2_img = function_exists( 'razgem_get_hero_slide_url' ) ? razgem_get_hero_slide_url( 2 ) : get_template_directory_uri() . '/assets/images/earrings-collection.jpg';
$slide2_tag = get_theme_mod( 'hero_slide_2_tag', 'گوشواره‌های دست‌ساز صدف و مروارید' );

$slide3_img = function_exists( 'razgem_get_hero_slide_url' ) ? razgem_get_hero_slide_url( 3 ) : get_template_directory_uri() . '/assets/images/atelier-story.jpg';
$slide3_tag = get_theme_mod( 'hero_slide_3_tag', 'آتلیه طراحی و ساخت ارگانیک' );

// Hotspot Pins Configuration (Slide 1)
$pin1_enable = get_theme_mod( 'hero_pin1_enable', true );
$pin1_text   = get_theme_mod( 'hero_pin1_text', 'صدف طبیعی دست‌تراش' );
$pin1_x      = get_theme_mod( 'hero_pin1_x', 38 );
$pin1_y      = get_theme_mod( 'hero_pin1_y', 42 );

$pin2_enable = get_theme_mod( 'hero_pin2_enable', true );
$pin2_text   = get_theme_mod( 'hero_pin2_text', 'مروارید باروک وحشی خلیج فارس' );
$pin2_x      = get_theme_mod( 'hero_pin2_x', 56 );
$pin2_y      = get_theme_mod( 'hero_pin2_y', 64 );
?>

<section class="razgem-coastal-hero" aria-label="معرفی شاهکارهای صدف و مروارید رازجم">
    <!-- Ambient Seafoam & Wave Shimmer Halo -->
    <div class="coastal-hero-ambient" aria-hidden="true">
        <div class="ambient-circle ambient-circle--1"></div>
        <div class="ambient-circle ambient-circle--2"></div>
        <svg class="ambient-wave-watermark" viewBox="0 0 600 600" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="300" cy="300" r="250" stroke="rgba(170, 205, 220, 0.28)" stroke-width="1.5" stroke-dasharray="8 10"/>
            <circle cx="300" cy="300" r="180" stroke="rgba(243, 227, 208, 0.45)" stroke-width="1.2"/>
            <circle cx="300" cy="300" r="110" stroke="rgba(129, 166, 198, 0.25)" stroke-width="1" stroke-dasharray="4 6"/>
            <path d="M300 20v60M300 520v60M20 300h60M520 300h60" stroke="rgba(129, 166, 198, 0.3)" stroke-width="1.5"/>
        </svg>
    </div>

    <div class="site-container coastal-hero-grid">
        
        <!-- Hero Narrative Column (Centered Alignment) -->
        <div class="coastal-hero-narrative">
            <?php if ( ! empty( $hero_badge ) ) : ?>
                <div class="hero-badge-wrap">
                    <span class="coastal-hero-badge">
                        <span class="badge-sea-icon">🦪</span>
                        <?php echo esc_html( $hero_badge ); ?>
                    </span>
                </div>
            <?php endif; ?>

            <h1 class="coastal-hero-title">
                <?php echo wp_kses_post( $hero_title ); ?>
            </h1>

            <p class="coastal-hero-subtitle">
                <?php echo esc_html( $hero_subtitle ); ?>
            </p>

            <div class="coastal-hero-cta-group">
                <?php if ( ! empty( $hero_btn1_text ) && ! empty( $hero_btn1_url ) ) : ?>
                    <a href="<?php echo esc_url( $hero_btn1_url ); ?>" class="btn-coastal-slate pearl-shimmer-hover">
                        <span><?php echo esc_html( $hero_btn1_text ); ?></span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </a>
                <?php endif; ?>

                <?php if ( ! empty( $hero_btn2_text ) && ! empty( $hero_btn2_url ) ) : ?>
                    <a href="<?php echo esc_url( $hero_btn2_url ); ?>" class="btn-coastal-sand">
                        <span><?php echo esc_html( $hero_btn2_text ); ?></span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Floating Nature Quality Chips -->
            <div class="coastal-hero-chips">
                <span class="nature-chip"><span class="chip-dot"></span> صدف طبیعی ۱۰۰٪ اصل</span>
                <span class="nature-chip"><span class="chip-dot"></span> مرواریدهای باروک یکتا</span>
                <span class="nature-chip"><span class="chip-dot"></span> طلای ۱۸ عیار دست‌ساز</span>
            </div>

            <!-- Trust Metrics Bar -->
            <div class="coastal-hero-trust-bar">
                <div class="coastal-trust-item">
                    <div class="trust-icon">🦪</div>
                    <div class="trust-text">
                        <strong>صدف طبیعی و مروارید</strong>
                        <span>شناسنامه اصالت و گوهرهای ارگانیک</span>
                    </div>
                </div>
                <div class="coastal-trust-item">
                    <div class="trust-icon">🌊</div>
                    <div class="trust-text">
                        <strong>الهام‌گرفته از دریا و طبیعت</strong>
                        <span>تک‌نسخه، دست‌ساز و تکرارناپذیر</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Spotlight Showcase (Pebble Vitrine) -->
        <div class="coastal-hero-showcase">
            <div class="coastal-pebble-vitrine razgem-hero-slider" id="razgemHeroSlider" role="region" aria-roledescription="carousel" aria-label="شاهکارهای منتخب رازجم">
                <div class="razgem-slider-track">
                    
                    <!-- Slide 1 -->
                    <div class="razgem-hero-slide is-active" data-index="0" role="group" aria-roledescription="slide" aria-label="اسلاید ۱ از ۳: <?php echo esc_attr( $slide1_tag ); ?>">
                        <img src="<?php echo esc_url( $slide1_img ); ?>" 
                             alt="<?php echo esc_attr( $slide1_tag ); ?>" 
                             class="coastal-vitrine-img"
                             loading="eager">
                        
                        <?php if ( ! empty( $slide1_tag ) ) : ?>
                            <div class="coastal-slide-badge">
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
                                    <span class="tooltip-badge">صدف طبیعی</span>
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
                                    <span class="tooltip-badge">مروارید باروک</span>
                                    <span class="tooltip-label"><?php echo esc_html( $pin2_text ); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Slide 2 -->
                    <div class="razgem-hero-slide" data-index="1" role="group" aria-roledescription="slide" aria-label="اسلاید ۲ از ۳: <?php echo esc_attr( $slide2_tag ); ?>">
                        <img src="<?php echo esc_url( $slide2_img ); ?>" 
                             alt="<?php echo esc_attr( $slide2_tag ); ?>" 
                             class="coastal-vitrine-img"
                             loading="lazy">
                        
                        <?php if ( ! empty( $slide2_tag ) ) : ?>
                            <div class="coastal-slide-badge">
                                <span><?php echo esc_html( $slide2_tag ); ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="razgem-hotspot-pin pin-1" 
                             style="top: 48%; left: 42%;"
                             tabindex="0"
                             role="button"
                             aria-label="مروارید اشکی باروک">
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
                             class="coastal-vitrine-img"
                             loading="lazy">
                        
                        <?php if ( ! empty( $slide3_tag ) ) : ?>
                            <div class="coastal-slide-badge">
                                <span><?php echo esc_html( $slide3_tag ); ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="razgem-hotspot-pin pin-1" 
                             style="top: 50%; left: 50%;"
                             tabindex="0"
                             role="button"
                             aria-label="آتلیه و ساخت اختصاصی">
                            <span class="hotspot-pulse"></span>
                            <span class="hotspot-core"></span>
                            <div class="hotspot-tooltip">
                                <span class="tooltip-badge">هنر دست</span>
                                <span class="tooltip-label">سفارش ساخت اختصاصی رازجم</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Slider Navigation & Dots Overlay -->
                <div class="coastal-slider-nav-bar">
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

    <!-- Undulating Organic Coastal Wave Baseline Transition -->
    <div class="hero-wave-baseline" aria-hidden="true">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,45 C280,110 520,10 760,65 C1000,120 1240,25 1440,70 L1440,120 L0,120 Z" fill="var(--color-canvas)"></path>
        </svg>
    </div>
</section>