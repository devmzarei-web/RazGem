<?php
/**
 * RazGem Promotional Collection Banner Grid (بنرهای سه‌گانه مجموعه‌ها)
 *
 * 3-Column curated promotional banners highlighting core collections:
 * Wall Art, Shell Earrings, and Baroque Pearl Chokers.
 *
 * @package RazGem
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$theme_uri = get_template_directory_uri();
$promos = array(
    array(
        'title'    => 'تابلوهای دکوراتیو صدف و توتیا',
        'subtitle' => 'طبیعت زنده خلیج فارس بر دیوار خانه شما',
        'image'    => $theme_uri . '/assets/images/products/r003-front.png',
        'url'      => home_url( '/shop/?category=ocean-wall-art' ),
        'alt'      => 'تابلوهای دکوراتیو صدف طبیعی و توتیای دریایی رازجم',
    ),
    array(
        'title'    => 'گوشواره‌های صدف طبیعی دست‌تراش',
        'subtitle' => 'درخشش رنگین‌کمانی و فرم‌های ارگانیک یکتا',
        'image'    => $theme_uri . '/assets/images/products/r001-main.jpg',
        'url'      => home_url( '/shop/?category=shell-earrings' ),
        'alt'      => 'گوشواره‌های دست‌ساز صدف طبیعی و مروارید رازجم',
    ),
    array(
        'title'    => 'شاهکارهای مروارید باروک و چوکر',
        'subtitle' => 'زیورآلات سلطنتی و فاخر دست‌ساز آتلیه',
        'image'    => $theme_uri . '/assets/images/products/r007-main.jpg',
        'url'      => home_url( '/shop/?category=necklaces-chokers' ),
        'alt'      => 'چوکر و گردنبندهای مروارید باروک اصل رازجم',
    ),
);
?>

<section class="razgem-promo-grid-section" aria-label="<?php esc_attr_e( 'مجموعه‌های برگزیده رازجم', 'razgem' ); ?>">
    <div class="site-container">
        <div class="razgem-promo-grid">
            <?php foreach ( $promos as $promo ) : ?>
                <div class="promo-grid-card">
                    <a href="<?php echo esc_url( $promo['url'] ); ?>" 
                       title="<?php echo esc_attr( $promo['title'] ); ?>">
                        <img src="<?php echo esc_url( $promo['image'] ); ?>" 
                             alt="<?php echo esc_attr( $promo['alt'] ); ?>" 
                             width="600" 
                             height="340" 
                             loading="lazy">
                        <div class="promo-grid-card-overlay">
                            <h3 class="promo-grid-card-title"><?php echo esc_html( $promo['title'] ); ?></h3>
                            <p class="promo-grid-card-subtitle"><?php echo esc_html( $promo['subtitle'] ); ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
