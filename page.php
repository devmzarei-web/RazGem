<?php
/**
 * Standard Page Template (Used for Cart, Checkout, My Account, etc.)
 */
defined( 'ABSPATH' ) || exit;
get_header(); ?>

<main class="site-container standard-page" style="padding-top: 4rem; padding-bottom: 7rem; min-height: 60vh;" role="main">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <header class="page-header" style="margin-bottom: 3rem; text-align: center;">
            <h1 class="page-title" style="font-family: var(--font-heading); font-size: 2.5rem; color: var(--color-dark);"><?php the_title(); ?></h1>
        </header>
        
        <article class="page-content">
            <?php the_content(); ?>
        </article>
        <?php
    endwhile;
    ?>
</main>

<?php get_footer(); ?>