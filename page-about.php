<?php
/**
 * Template Name: About Us Layout
 */
defined( 'ABSPATH' ) || exit;
get_header(); 

// Fetch from Customizer
$v1_title = get_theme_mod('about_v1_title', 'طراحی مینیمال');
$v1_desc = get_theme_mod('about_v1_desc', 'حذف زواید و تمرکز بر فرم خالص');
$v2_title = get_theme_mod('about_v2_title', 'متریال ارگانیک');
$v2_desc = get_theme_mod('about_v2_desc', 'احترام به طبیعت و استفاده از مواد پایدار');
?>

<main class="site-container utility-page" dir="rtl" role="main">
    <div class="utility-page-wrapper">
        <header class="utility-header">
            <h1 class="utility-title"><?php the_title(); ?></h1>
        </header>

        <div class="about-grid-layout">
            <div class="about-image">
                <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) );
                } else {
                    echo '<img src="' . esc_url(get_template_directory_uri()) . '/assets/images/hero-main.jpg" alt="درباره گالری طلا و مروارید رازجم">';
                }
                ?>
            </div>
            
            <div class="about-text">
                
                <div class="utility-content-text">
                    <?php the_content(); ?>
                </div>
                
                <div class="about-values">
                    <div class="value-item">
                        <div class="val-icon">✨</div>
                        <strong><?php echo esc_html($v1_title); ?></strong>
                        <span><?php echo esc_html($v1_desc); ?></span>
                    </div>
                    <div class="value-item">
                        <div class="val-icon">🌿</div>
                        <strong><?php echo esc_html($v2_title); ?></strong>
                        <span><?php echo esc_html($v2_desc); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>