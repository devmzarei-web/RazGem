<?php
/**
 * RazGem Circular Visual Category Bubbles Strip (حباب‌های تصویری دسته‌بندی)
 *
 * Displays the 6 core handcrafted seashell and ocean art categories in horizontal circular bubbles
 * with delicate gold borders, hover zoom, and category archive navigation.
 *
 * @package RazGem
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$categories = function_exists( 'razgem_get_store_categories' ) ? razgem_get_store_categories() : array();
if ( empty( $categories ) ) {
    return;
}
?>

<section class="razgem-category-bubbles-strip" aria-label="<?php esc_attr_e( 'دسته‌بندی‌های اصلی دست‌سازه‌های صدف و مروارید', 'razgem' ); ?>">
    <div class="site-container">
        <nav class="category-bubbles-container" aria-label="<?php esc_attr_e( 'مرور بر اساس دسته‌بندی آثار', 'razgem' ); ?>">
            <?php foreach ( $categories as $cat ) : ?>
                <a href="<?php echo esc_url( $cat['url'] ); ?>" 
                   class="category-bubble-item" 
                   title="<?php echo esc_attr( 'مشاهده کالکشن ' . $cat['name'] ); ?>">
                    <div class="category-bubble-avatar">
                        <img src="<?php echo esc_url( $cat['image'] ); ?>" 
                             alt="<?php echo esc_attr( $cat['name'] . ' - دست‌سازه‌های رازجم' ); ?>" 
                             width="90" 
                             height="90" 
                             loading="lazy">
                    </div>
                    <span class="category-bubble-title"><?php echo esc_html( $cat['short_name'] ); ?></span>
                    <?php if ( ! empty( $cat['count'] ) ) : ?>
                        <span class="category-bubble-count"><?php echo esc_html( $cat['count'] ); ?></span>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
</section>
