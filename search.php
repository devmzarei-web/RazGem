<?php
/**
 * The template for displaying search results pages.
 */
defined( 'ABSPATH' ) || exit;
get_header(); 
global $wp_query;
?>

<main class="site-container utility-page" dir="rtl" role="main">
    
    <div class="utility-page-wrapper" style="max-width: 1400px;">
        
        <header class="utility-header" style="margin-bottom: 4rem;">
            <h1 class="utility-title">نتایج جستجو</h1>
            <p class="utility-subtitle" style="margin-top: 1rem;">
                <?php printf( 'نمایش %s نتیجه برای عبـــارت: <strong style="color:var(--color-dark);">"%s"</strong>', $wp_query->found_posts, get_search_query() ); ?>
            </p>
        </header>

        <?php if ( have_posts() ) : ?>
            
            <?php 
            // Check if it is a WooCommerce product search
            $is_product_search = ( isset($_GET['post_type']) && $_GET['post_type'] === 'product' && class_exists( 'WooCommerce' ) ); 
            ?>

            <?php if ( $is_product_search ) : ?>
                <div class="woocommerce">
                    <ul class="products">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php wc_get_template_part( 'content', 'product' ); ?>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php else : ?>
                <div class="magazine-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article class="magazine-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="magazine-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/placeholder.jpg" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="magazine-body">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="magazine-excerpt">
                                    <?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

            <div class="woocommerce-pagination" style="margin-top: 4rem;">
                <?php
                echo paginate_links( array(
                    'prev_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>',
                    'next_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>',
                ) );
                ?>
            </div>

        <?php else : ?>
            
            <div class="error-404-wrapper" style="margin: 0 auto; text-align: center; max-width: 600px; padding: 4rem 2rem;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--color-gold)" stroke-width="1.5" style="margin-bottom:1.5rem;"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <h2 class="error-title" style="font-size: 1.8rem;">نتیجه‌ای یافت نشد</h2>
                <p class="error-desc">متاسفانه هیچ محصولی با عبارت <strong>"<?php echo get_search_query(); ?>"</strong> مطابقت نداشت. لطفاً با کلمات دیگری جستجو کنید.</p>
                <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="btn-primary error-btn" style="padding: 0.8rem 2.5rem;">بازگشت به فروشگاه</a>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>