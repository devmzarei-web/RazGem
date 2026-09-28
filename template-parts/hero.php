<?php
/**
 * RazGem Commercial Storefront Hero Template Part
 * 3-Part Asymmetric Grid: 1 Featured Wide Carousel (3 Slides) + 2 Stacked Static Promo Cards
 *
 * @package RazGem
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$banners = function_exists( 'razgem_get_hero_banners' ) ? razgem_get_hero_banners() : array();
if ( empty( $banners ) ) {
    $theme_uri = get_template_directory_uri();
    $banners = array(
        'slides' => array(
            array(
                'image' => $theme_uri . '/assets/images/products/r003-front.png',
                'url'   => home_url( '/product/r-003/' ),
                'alt'   => 'تابلو صدف دریایی طرح خورشید دست‌ساز کد R-003 - آتلیه رازجم',
            ),
            array(
                'image' => $theme_uri . '/assets/images/products/r001-main.jpg',
                'url'   => home_url( '/product/r-001/' ),
                'alt'   => 'گوشواره هنری دست‌ساز با صدف طبیعی و مروارید باروک کد R-001',
            ),
            array(
                'image' => $theme_uri . '/assets/images/products/r004-main.png',
                'url'   => home_url( '/product/r-004/' ),
                'alt'   => 'تابلو توتیای دریایی سه بعدی دست‌ساز کد R-004 - شاهکار طبیعی دریا',
            ),
        ),
        'promo_top' => array(
            'image' => $theme_uri . '/assets/images/products/r002-main.jpg',
            'url'   => home_url( '/product/r-002/' ),
            'alt'   => 'گوشواره صدف بادبزنی رگه‌دار طبیعی کد R-002',
        ),
        'promo_btm' => array(
            'image' => $theme_uri . '/assets/images/products/r007-main.jpg',
            'url'   => home_url( '/product/r-007/' ),
            'alt'   => 'چوکر مروارید باروک و صدف مخملی دست‌ساز کد R-007',
        ),
    );
}
?>

<section class="razgem-commercial-hero-section" aria-label="<?php esc_attr_e( 'ویترین اصلی فروشگاه رازجم', 'razgem' ); ?>">
    <!-- Ambient Seafoam Glow Background -->
    <div class="hero-ambient-glow" aria-hidden="true">
        <div class="ambient-orb ambient-orb--1"></div>
        <div class="ambient-orb ambient-orb--2"></div>
    </div>

    <div class="site-container">
        <div class="razgem-hero-3grid">
            
            <!-- Column 1: Wide 3-Slide Carousel Banner (~68% desktop width, right side in RTL) -->
            <div class="hero-carousel-col">
                <div class="hero-carousel" id="heroFeaturedCarousel" role="region" aria-roledescription="carousel" aria-label="<?php esc_attr_e( 'اسلایدر بنرهای اصلی رازجم', 'razgem' ); ?>">
                    <div class="hero-carousel-track">
                        <?php foreach ( $banners['slides'] as $index => $slide ) : ?>
                            <div class="hero-carousel-slide <?php echo 0 === $index ? 'is-active' : ''; ?>" 
                                 data-slide-index="<?php echo esc_attr( $index ); ?>" 
                                 role="group" 
                                 aria-roledescription="slide" 
                                 aria-label="<?php echo esc_attr( sprintf( 'اسلاید %d از %d: %s', $index + 1, count( $banners['slides'] ), $slide['alt'] ) ); ?>">
                                <a href="<?php echo esc_url( $slide['url'] ); ?>" 
                                   class="hero-slide-link" 
                                   title="<?php echo esc_attr( $slide['alt'] ); ?>">
                                    <img src="<?php echo esc_url( $slide['image'] ); ?>" 
                                         alt="<?php echo esc_attr( $slide['alt'] ); ?>" 
                                         width="880" 
                                         height="420" 
                                         loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>" 
                                         fetchpriority="<?php echo 0 === $index ? 'high' : 'auto'; ?>"
                                         class="hero-slide-img">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Slide Controls / Navigation Dots -->
                    <div class="hero-carousel-controls">
                        <button type="button" class="hero-carousel-arrow hero-carousel-prev" aria-label="<?php esc_attr_e( 'اسلاید قبلی', 'razgem' ); ?>">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </button>
                        
                        <div class="hero-carousel-dots" role="tablist" aria-label="<?php esc_attr_e( 'انتخاب اسلاید', 'razgem' ); ?>">
                            <?php foreach ( $banners['slides'] as $index => $slide ) : ?>
                                <button type="button" 
                                        role="tab" 
                                        class="hero-carousel-dot <?php echo 0 === $index ? 'is-active' : ''; ?>" 
                                        data-index="<?php echo esc_attr( $index ); ?>" 
                                        aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
                                        aria-label="<?php echo esc_attr( sprintf( 'رفتن به اسلاید %d', $index + 1 ) ); ?>">
                                </button>
                            <?php endforeach; ?>
                        </div>

                        <button type="button" class="hero-carousel-arrow hero-carousel-next" aria-label="<?php esc_attr_e( 'اسلاید بعدی', 'razgem' ); ?>">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Column 2: Stacked Static Promo Cards (~32% desktop width, left side in RTL) -->
            <div class="hero-promos-col">
                <!-- Promo Card 1 (Top) -->
                <div class="hero-promo-card hero-promo-card--top">
                    <a href="<?php echo esc_url( $banners['promo_top']['url'] ); ?>" 
                       class="hero-promo-link" 
                       title="<?php echo esc_attr( $banners['promo_top']['alt'] ); ?>">
                        <img src="<?php echo esc_url( $banners['promo_top']['image'] ); ?>" 
                             alt="<?php echo esc_attr( $banners['promo_top']['alt'] ); ?>" 
                             width="400" 
                             height="200" 
                             loading="eager" 
                             class="hero-promo-img">
                    </a>
                </div>

                <!-- Promo Card 2 (Bottom) -->
                <div class="hero-promo-card hero-promo-card--btm">
                    <a href="<?php echo esc_url( $banners['promo_btm']['url'] ); ?>" 
                       class="hero-promo-link" 
                       title="<?php echo esc_attr( $banners['promo_btm']['alt'] ); ?>">
                        <img src="<?php echo esc_url( $banners['promo_btm']['image'] ); ?>" 
                             alt="<?php echo esc_attr( $banners['promo_btm']['alt'] ); ?>" 
                             width="400" 
                             height="200" 
                             loading="eager" 
                             class="hero-promo-img">
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Living Ocean Wave Transition Divider -->
    <div class="hero-wave-baseline ocean-wave-animator ocean-wave--dominant ocean-wave--to-canvas" aria-hidden="true">
        <svg class="ocean-waves-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="hero-gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="ocean-parallax-waves">
                <use xlink:href="#hero-gentle-wave" x="48" y="0" class="wave-layer-deep" />
                <use xlink:href="#hero-gentle-wave" x="48" y="3" class="wave-layer-seafoam" />
                <use xlink:href="#hero-gentle-wave" x="48" y="5" class="wave-layer-sand" />
                <use xlink:href="#hero-gentle-wave" x="48" y="7" class="wave-layer-canvas" />
            </g>
        </svg>
    </div>
</section>