<?php
/**
 * The Template for displaying all single posts (Magazine Articles)
 * Full width layout with compact pink header.
 */
defined( 'ABSPATH' ) || exit;
get_header(); ?>

<main class="site-container single-editorial-page" dir="rtl" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
        
        <nav class="shop-breadcrumbs" aria-label="Breadcrumb" style="margin-bottom: 2rem;">
            <a href="<?php echo esc_url(home_url('/')); ?>">خانه</a>
            <span class="divider">/</span>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">مجله</a>
            <?php 
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                $display_cat = null;
                // Loop through categories and pick the first one that IS NOT named "مجله"
                foreach ( $categories as $cat ) {
                    if ( $cat->name !== 'مجله' ) {
                        $display_cat = $cat;
                        break;
                    }
                }
                
                // If a valid category was found, display it
                if ( $display_cat ) {
                    echo '<span class="divider">/</span>';
                    echo '<a href="' . esc_url( get_category_link( $display_cat->term_id ) ) . '">' . esc_html( $display_cat->name ) . '</a>';
                }
            }
            ?>
        </nav>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'editorial-article-full' ); ?>>
            
            <header class="editorial-header-compact-full">
                <h1 class="editorial-title-compact"><?php the_title(); ?></h1>
                <div class="editorial-date-compact">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> 
                    <?php echo function_exists('razgem_get_shamsi_date') ? razgem_get_shamsi_date(get_post_time('U', true)) : get_the_date(); ?>
                </div>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="editorial-hero-full">
                    <?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
                </div>
            <?php endif; ?>

            <div class="editorial-content-full">
                <?php the_content(); ?>
            </div>

            <footer class="editorial-footer-full">
                <div class="editorial-tags">
                    <?php
                    $tags_list = get_the_tag_list( 'برچسب‌ها: ', ' ' );
                    if ( $tags_list ) {
                        echo $tags_list;
                    }
                    ?>
                </div>
                
                <div class="editorial-share">
                    <span>اشتراک‌گذاری مقاله:</span>
                    <div class="share-icons">
                        <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on Telegram">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        </a>
                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on WhatsApp">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        </a>
                    </div>
                </div>
            </footer>

        </article>

        <?php
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>