<?php
/**
 * RazGem Asymmetric Luxury Category Mosaic Template Part
 * Curated Haute-Joaillerie Collection Categories
 *
 * @package RazGem
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$categories_data = array();
if ( taxonomy_exists( 'product_cat' ) ) {
    $terms = get_terms( array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
        'parent'     => 0,
        'orderby'    => 'count',
        'order'      => 'DESC',
    ) );
    if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
        foreach ( $terms as $term ) {
            // Exclude Uncategorized
            if ( $term->slug === 'uncategorized' || $term->slug === 'بدون-دسته‌بندی' ) continue;
            $thumb_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
            $img_url  = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'large' ) : '';
            $categories_data[] = array(
                'name'  => $term->name,
                'count' => $term->count,
                'link'  => get_term_link( $term ),
                'image' => $img_url,
            );
        }
    }
}

// Fallback high-end jewelry curated categories if WooCommerce categories are sparse
if ( count( $categories_data ) < 3 ) {
    $categories_data = array(
        array(
            'name'  => 'گردنبند و آویز طلا و مروارید باروک',
            'count' => 'کالکشن فاخر',
            'link'  => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : '/shop',
            'image' => get_template_directory_uri() . '/assets/images/spotlight-pendant.jpg',
            'badge' => 'ویژه فصل',
        ),
        array(
            'name'  => 'گوشواره‌های دست‌ساز طلا و صدف',
            'count' => 'طراحی اختصاصی',
            'link'  => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : '/shop',
            'image' => get_template_directory_uri() . '/assets/images/earrings-collection.jpg',
            'badge' => 'هنر دست',
        ),
        array(
            'name'  => 'انگشترهای فاخر طلای ۱۸ عیار',
            'count' => 'سنگ‌های قیمتی',
            'link'  => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : '/shop',
            'image' => get_template_directory_uri() . '/assets/images/atelier-story.jpg',
            'badge' => 'سفارشی',
        ),
    );
}
?>

<section class="razgem-categories-section" aria-label="کالکشن‌های زیورآلات رازجم">
    <div class="site-container">
        
        <div class="razgem-section-heading">
            <span class="heading-eyebrow">دنیای ظرافت و هنر دست</span>
            <h2 class="heading-title">کالکشن‌های اختصاصی طلا و مروارید رازجم</h2>
            <p class="heading-desc">انتخاب بر اساس سبک، نوع گوهر و طراحی منحصربه‌فرد دست‌ساز</p>
        </div>

        <div class="razgem-category-mosaic">
            <?php 
            $index = 0;
            foreach ( array_slice( $categories_data, 0, 3 ) as $cat ) : 
                $is_hero_card = ( $index === 0 );
                $card_class   = $is_hero_card ? 'mosaic-card mosaic-card--featured' : 'mosaic-card';
                $img_url      = ! empty( $cat['image'] ) ? $cat['image'] : get_template_directory_uri() . '/assets/images/spotlight-pendant.jpg';
                $badge        = ! empty( $cat['badge'] ) ? $cat['badge'] : ( is_numeric( $cat['count'] ) ? $cat['count'] . ' شاهکار' : $cat['count'] );
            ?>
                <a href="<?php echo esc_url( $cat['link'] ); ?>" class="<?php echo esc_attr( $card_class ); ?>">
                    <div class="mosaic-card__media">
                        <img src="<?php echo esc_url( $img_url ); ?>" 
                             alt="<?php echo esc_attr( $cat['name'] ); ?>" 
                             loading="lazy" 
                             class="mosaic-card__img">
                        <div class="mosaic-card__sheen"></div>
                        <div class="mosaic-card__overlay"></div>
                    </div>
                    
                    <div class="mosaic-card__content">
                        <span class="mosaic-card__badge"><?php echo esc_html( $badge ); ?></span>
                        <h3 class="mosaic-card__title"><?php echo esc_html( $cat['name'] ); ?></h3>
                        <span class="mosaic-card__action">
                            <span>کشف کالکشن</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                        </span>
                    </div>
                </a>
            <?php 
                $index++;
            endforeach; 
            ?>
        </div>

    </div>
</section>