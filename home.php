<?php
/**
 * The Blog / Magazine Archive Template
 */
defined( 'ABSPATH' ) || exit;
get_header(); ?>

<main class="site-container magazine-archive-page" dir="rtl" role="main">
    
    <header class="magazine-archive-header">
        <h1 class="page-title">مجله دکوراسیون گلخانه</h1>
        <p>الهام‌بخش شما در چیدمان و طراحی فضاهای لوکس</p>
    </header>

    <div class="magazine-grid">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="magazine-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <div class="magazine-thumb">
                        <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/placeholder.jpg" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        </a>
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            echo '<span class="magazine-tag">' . esc_html( $categories[0]->name ) . '</span>';
                        }
                        ?>
                    </div>
                    
                    <div class="magazine-body">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="magazine-excerpt">
                            <?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="read-more-link">
                            مطالعه مقاله 
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                        </a>
                    </div>

                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p style="text-align: center; width: 100%; grid-column: 1 / -1; padding: 3rem;">مقاله‌ای برای نمایش یافت نشد.</p>
        <?php endif; ?>
    </div>

    <div class="magazine-pagination">
        <?php
        echo paginate_links( array(
            'prev_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>',
            'next_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>',
        ) );
        ?>
    </div>

</main>

<?php get_footer(); ?>