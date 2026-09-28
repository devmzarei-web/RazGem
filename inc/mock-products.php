<?php
/**
 * RazGem Mock Product Catalog Provider
 * Features authentic handcrafted seashell and baroque pearl products (R-001, R-002, etc.)
 *
 * @package RazGem
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Returns the definitive array of RazGem handcrafted mock products.
 *
 * @return array
 */
function razgem_get_mock_products() {
    $theme_uri = get_template_directory_uri();

    return array(
        'r-001' => array(
            'id'             => 'r-001',
            'code'           => 'R-001',
            'title'          => 'گوشواره هنری دست‌ساز با صدف طبیعی کد R-001',
            'short_title'    => 'گوشواره صدف طبیعی کد R-001',
            'category'       => 'گوشواره صدف طبیعی',
            'category_slug'  => 'earrings',
            'price_raw'      => 1850000,
            'regular_price'  => 2100000,
            'price_formatted'=> '۱,۸۵۰,۰۰۰ تومان',
            'old_price'      => '۲,۱۰۰,۰۰۰ تومان',
            'dimensions'     => '4.8 × 4.3 سانتی‌متر',
            'material'       => 'صدف طبیعی دست‌تراش و جلاخورده، یراق برنجی طلایی',
            'color'          => 'طبیعی، بدون رنگ‌آمیزی (مرجانی/نارنجی طبیعی)',
            'desc'           => 'قطعه‌ای منحصربه‌فرد از دل طبیعت، شکل‌گرفته با هنر دست. صدف طبیعی با تراش و جلای دست‌ساز که بدون رنگ‌آمیزی شیمیایی، درخشش و بافت طبیعی خود را حفظ کرده است.',
            'img_primary'    => $theme_uri . '/assets/images/products/r001-main.jpg',
            'img_hover'      => $theme_uri . '/assets/images/products/r001-dimensions.jpg',
            'tag'            => 'صدف طبیعی اصل',
            'badge'          => 'دست‌ساز',
            'badge_type'     => 'nature',
            'in_stock'       => true,
            'featured'       => true,
            'on_sale'        => true,
        ),
        'r-002' => array(
            'id'             => 'r-002',
            'code'           => 'R-002',
            'title'          => 'گوشواره هنری دست‌ساز با صدف طبیعی کد R-002',
            'short_title'    => 'گوشواره صدف بادبزنی رگه‌دار کد R-002',
            'category'       => 'گوشواره صدف طبیعی',
            'category_slug'  => 'earrings',
            'price_raw'      => 1950000,
            'regular_price'  => 2250000,
            'price_formatted'=> '۱,۹۵۰,۰۰۰ تومان',
            'old_price'      => '۲,۲۵۰,۰۰۰ تومان',
            'dimensions'     => '5.0 × 4.5 سانتی‌متر',
            'material'       => 'صدف طبیعی دست‌تراش و جلاخورده، اتصالات برنجی طلایی',
            'color'          => 'نقش‌های طبیعی سفید، صورتی و زرشکی',
            'desc'           => 'ترکیبی از نقش‌های طبیعی دریا و ظرافت هنر دست. طیف رنگی سفید، صورتی و زرشکی کاملاً طبیعی با جلای هنرمندانه و یراق‌های طلایی گرم.',
            'img_primary'    => $theme_uri . '/assets/images/products/r002-main.jpg',
            'img_hover'      => $theme_uri . '/assets/images/products/r002-dimensions.jpg',
            'tag'            => 'نقش طبیعی دریا',
            'badge'          => 'ویژه',
            'badge_type'     => 'nature',
            'in_stock'       => true,
            'featured'       => true,
            'on_sale'        => true,
        ),
        'r-003' => array(
            'id'             => 'r-003',
            'code'           => 'R-003',
            'title'          => 'گردنبند پلاک صدف و مروارید باروک کد R-003',
            'short_title'    => 'گردنبند پلاک صدف و مروارید باروک',
            'category'       => 'گردنبند و چوکر',
            'category_slug'  => 'necklaces',
            'price_raw'      => 2650000,
            'regular_price'  => 2650000,
            'price_formatted'=> '۲,۶۵۰,۰۰۰ تومان',
            'old_price'      => '',
            'dimensions'     => '۴.۲ × ۳.۸ سانتی‌متر (زنجیر ۴۵ سانتی‌متر)',
            'material'       => 'صدف طبیعی شیاردار، مروارید اشکی باروک، قاب نقره استرلینگ با روکش طلای ۱۸ عیار',
            'color'          => 'طلایی گرم و سفید درخشان صدفی',
            'desc'           => 'گردنبند پلاک مجلل دست‌ساز با قاب اسکلت زرین صدف و مروارید باروک اشکی ارگانیک با زنجیر بافت ظریف.',
            'img_primary'    => $theme_uri . '/assets/images/products/r003-main.jpg',
            'img_hover'      => $theme_uri . '/assets/images/products/r003-dimensions.jpg',
            'tag'            => 'مروارید باروک و صدف',
            'badge'          => 'شاهکار دست‌ساز',
            'badge_type'     => 'pearl',
            'in_stock'       => true,
            'featured'       => true,
            'on_sale'        => false,
        ),
        'r-004' => array(
            'id'             => 'r-004',
            'code'           => 'R-004',
            'title'          => 'گوشواره آویز صدف حلزونی زرین کد R-004',
            'short_title'    => 'گوشواره آویز صدف حلزونی زرین',
            'category'       => 'گوشواره صدف طبیعی',
            'category_slug'  => 'earrings',
            'price_raw'      => 1980000,
            'regular_price'  => 2250000,
            'price_formatted'=> '۱,۹۸۰,۰۰۰ تومان',
            'old_price'      => '۲,۲۵۰,۰۰۰ تومان',
            'dimensions'     => '۵.۲ × ۳.۵ سانتی‌متر',
            'material'       => 'صدف حلزونی ارگانیک، مروارید گرد پرورشی، مفتول‌پیچی با طلای ۱۸ عیار',
            'color'          => 'شنی طبیعی با خطوط قهوه‌ای و مروارید سفید',
            'desc'           => 'گوشواره آویز دو تکه با پیچ و تاب هنرمندانه صدف حلزونی و مروارید درخشان احاطه‌شده در مفتول طلایی.',
            'img_primary'    => $theme_uri . '/assets/images/products/r004-main.jpg',
            'img_hover'      => $theme_uri . '/assets/images/products/r004-dimensions.jpg',
            'tag'            => 'صدف حلزونی طبیعی',
            'badge'          => 'جدید',
            'badge_type'     => 'nature',
            'in_stock'       => true,
            'featured'       => true,
            'on_sale'        => true,
        ),
        'r-005' => array(
            'id'             => 'r-005',
            'code'           => 'R-005',
            'title'          => 'دستبند صدف کائوری و مروارید طبیعی کد R-005',
            'short_title'    => 'دستبند صدف کائوری و مروارید',
            'category'       => 'دستبند و انگشتر',
            'category_slug'  => 'bracelets',
            'price_raw'      => 1450000,
            'regular_price'  => 1450000,
            'price_formatted'=> '۱,۴۵۰,۰۰۰ تومان',
            'old_price'      => '',
            'dimensions'     => 'طول: ۱۸ سانتی‌متر (رگلاژ ۳ سانتی‌متر)',
            'material'       => 'صدف کائوری پولیش خورده، مروارید آب شیرین نامنظم، مهره‌های طلایی مات',
            'color'          => 'طبیعی شیری و طلایی برنجی',
            'desc'           => 'دستبند ظریف بوهو-لوکس ترکیب صدف‌های مینیاتوری کائوری و مرواریدهای طبیعی نامنظم با اتصالات زرین.',
            'img_primary'    => $theme_uri . '/assets/images/products/r005-main.jpg',
            'img_hover'      => $theme_uri . '/assets/images/products/r005-dimensions.jpg',
            'tag'            => 'صدف کائوری مرجانی',
            'badge'          => 'ظریف و ارگانیک',
            'badge_type'     => 'atelier',
            'in_stock'       => true,
            'featured'       => false,
            'on_sale'        => false,
        ),
        'r-006' => array(
            'id'             => 'r-006',
            'code'           => 'R-006',
            'title'          => 'انگشتر صدف ناتیلوس و مروارید کشی کد R-006',
            'short_title'    => 'انگشتر صدف ناتیلوس و مروارید کشی',
            'category'       => 'دستبند و انگشتر',
            'category_slug'  => 'rings',
            'price_raw'      => 1680000,
            'regular_price'  => 1680000,
            'price_formatted'=> '۱,۶۸۰,۰۰۰ تومان',
            'old_price'      => '',
            'dimensions'     => 'سایز قابل تنظیم (فری‌سایز)',
            'material'       => 'مقطع مینیاتوری صدف ناتیلوس هفت‌رنگ، مروارید کشی، رکاب چکش‌خورده طلای ۲۴ عیار',
            'color'          => 'رنگین‌کمانی فیروزه‌ای، بنفش و مرواریدی',
            'desc'           => 'هندسه مقدس مارپیچ فیبوناچی در مقطع صدف طبیعی ناتیلوس در کنار مروارید باروک کشی و رکاب باز قابل تنظیم.',
            'img_primary'    => $theme_uri . '/assets/images/products/r006-main.jpg',
            'img_hover'      => $theme_uri . '/assets/images/products/r006-dimensions.jpg',
            'tag'            => 'صدف ناتیلوس هفت‌رنگ',
            'badge'          => 'فری‌سایز',
            'badge_type'     => 'pearl',
            'in_stock'       => true,
            'featured'       => true,
            'on_sale'        => false,
        ),
        'r-007' => array(
            'id'             => 'r-007',
            'code'           => 'R-007',
            'title'          => 'انگشتر ارگانیک صدف مرواریدساز با پایه برنجی',
            'short_title'    => 'انگشتر ارگانیک صدف مرواریدساز',
            'category'       => 'دستبند و انگشتر',
            'category_slug'  => 'rings',
            'price_raw'      => 1650000,
            'regular_price'  => 1650000,
            'price_formatted'=> '۱,۶۵۰,۰۰۰ تومان',
            'old_price'      => '',
            'dimensions'     => 'فری‌سایز (قابل تنظیم)',
            'material'       => 'صدف طبیعی خلیج فارس، پایه برنجی طلایی مقاوم',
            'color'          => 'صدف طبیعی نسترن با جلای آینه‌ای',
            'desc'           => 'تراش دست‌ساز از ضخیم‌ترین بخش صدف طبیعی مرواریدساز، نشسته بر پایه‌ای ارگانیک و تنظیم‌پذیر.',
            'img_primary'    => $theme_uri . '/assets/images/model-bracelet-pendant.jpg',
            'img_hover'      => $theme_uri . '/assets/images/model-necklace-seashell.jpg',
            'tag'            => 'صدف مرواریدساز',
            'badge'          => 'فری‌سایز',
            'badge_type'     => 'nature',
            'in_stock'       => true,
            'featured'       => false,
            'on_sale'        => false,
        ),
        'r-008' => array(
            'id'             => 'r-008',
            'code'           => 'R-008',
            'title'          => 'چوکر ساحلی صدف طبیعی و مرواریدهای وحشی',
            'short_title'    => 'چوکر ساحلی صدف و مروارید وحشی',
            'category'       => 'گردنبند و مدال',
            'category_slug'  => 'necklaces',
            'price_raw'      => 3400000,
            'regular_price'  => 3800000,
            'price_formatted'=> '۳,۴۰۰,۰۰۰ تومان',
            'old_price'      => '۳,۸۰۰,۰۰۰ تومان',
            'dimensions'     => 'طول ۳۸ تا ۴۲ سانتی‌متر',
            'material'       => 'صدف‌های تراش‌خورده طبیعی، مرواریدهای باروک ریز، قفل طلایی',
            'color'          => 'سفید عاجی و عسلی طبیعی',
            'desc'           => 'چوکر ظریف ساحلی با ریتم موزون از صدف‌های دست‌تراش و مرواریدهای باروک که بر گردن جلوه‌ای چشم‌نواز دارد.',
            'img_primary'    => $theme_uri . '/assets/images/model-necklace-seashell.jpg',
            'img_hover'      => $theme_uri . '/assets/images/coastal-wave-shoreline.jpg',
            'tag'            => 'کالکشن دریا',
            'badge'          => 'حراج',
            'badge_type'     => 'discount',
            'in_stock'       => true,
            'featured'       => true,
            'on_sale'        => true,
        ),
    );
}

/**
 * Filter mock products by criteria.
 *
 * @param array $args
 * @return array
 */
function razgem_get_filtered_mock_products( $args = array() ) {
    $products = razgem_get_mock_products();

    if ( ! empty( $args['category'] ) && 'all' !== $args['category'] ) {
        $cat = sanitize_text_field( $args['category'] );
        $products = array_filter( $products, function( $p ) use ( $cat ) {
            return $p['category_slug'] === $cat;
        } );
    }

    if ( ! empty( $args['on_sale'] ) ) {
        $products = array_filter( $products, function( $p ) {
            return ! empty( $p['on_sale'] );
        } );
    }

    if ( ! empty( $args['featured'] ) ) {
        $products = array_filter( $products, function( $p ) {
            return ! empty( $p['featured'] );
        } );
    }

    if ( ! empty( $args['limit'] ) ) {
        $products = array_slice( $products, 0, intval( $args['limit'] ) );
    }

    return $products;
}

/**
 * Retrieve a single mock product by its ID or code.
 *
 * @param string $id Mock product identifier (e.g. 'r-001', 'R-001', 'r001').
 * @return array|null Product array if found, null otherwise.
 */
function razgem_get_mock_product( $id ) {
    if ( empty( $id ) ) {
        return null;
    }
    $products = razgem_get_mock_products();
    $clean_id = strtolower( trim( (string) $id ) );

    // Direct match
    if ( isset( $products[ $clean_id ] ) ) {
        return $products[ $clean_id ];
    }

    // Match code format like r001 -> r-001
    if ( preg_match( '/^r0*([1-9][0-9]*)$/', $clean_id, $matches ) ) {
        $hyphen_id = 'r-' . str_pad( $matches[1], 3, '0', STR_PAD_LEFT );
        if ( isset( $products[ $hyphen_id ] ) ) {
            return $products[ $hyphen_id ];
        }
    }

    // Match in loop
    foreach ( $products as $key => $p ) {
        if ( strtolower( $p['id'] ) === $clean_id || strtolower( $p['code'] ) === $clean_id ) {
            return $p;
        }
    }

    return null;
}

/**
 * Resolves the real WooCommerce product ID in the WordPress database if available.
 *
 * @param string $id Product ID or SKU (e.g. 'r-001', 'RG-R001')
 * @return int
 */
function razgem_get_wc_product_id( $id ) {
    static $cache = array();
    $clean_id = strtolower( trim( (string) $id ) );
    if ( isset( $cache[ $clean_id ] ) ) {
        return $cache[ $clean_id ];
    }

    if ( ! class_exists( 'WooCommerce' ) ) {
        return 0;
    }

    global $wpdb;
    $sku = 'RG-' . strtoupper( str_replace( '-', '', $clean_id ) );
    
    // 1. Check by _sku meta
    $post_id = $wpdb->get_var( $wpdb->prepare(
        "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_sku' AND (meta_value = %s OR meta_value = %s) LIMIT 1",
        $sku,
        strtoupper( $clean_id )
    ) );

    // 2. Check by slug (post_name)
    if ( ! $post_id ) {
        $post = get_page_by_path( $clean_id, OBJECT, 'product' );
        if ( $post ) {
            $post_id = $post->ID;
        }
    }

    $cache[ $clean_id ] = $post_id ? (int) $post_id : 0;
    return $cache[ $clean_id ];
}

/**
 * Generates the clean, canonical single product URL for a mock or WC product.
 *
 * @param string $id Product ID or slug (e.g. 'r-001', 'r-002').
 * @return string
 */
function razgem_product_url( $id ) {
    $wc_id = razgem_get_wc_product_id( $id );
    if ( $wc_id > 0 && function_exists( 'get_permalink' ) ) {
        return get_permalink( $wc_id );
    }

    return add_query_arg( array(
        'post_type'    => 'product',
        'view_product' => strtolower( trim( (string) $id ) ),
    ), home_url( '/' ) );
}

/**
 * Renders a standardized coastal product specimen card for mock products.
 *
 * @param array $p Product data array.
 * @param string $extra_classes
 */
function razgem_render_mock_product_card( $p, $extra_classes = '' ) {
    $product_url = razgem_product_url( $p['id'] );
    $wc_id       = razgem_get_wc_product_id( $p['id'] );
    ?>
    <article class="carousel-card <?php echo esc_attr( $extra_classes ); ?>">
        <div class="product-card pebble-surface">
            <div class="product-card__gallery">
                <a href="<?php echo esc_url( $product_url ); ?>">
                    <img src="<?php echo esc_url( $p['img_primary'] ); ?>" 
                         alt="<?php echo esc_attr( $p['title'] ); ?>" 
                         class="img-primary" 
                         loading="lazy">
                    <?php if ( ! empty( $p['img_hover'] ) ) : ?>
                        <img src="<?php echo esc_url( $p['img_hover'] ); ?>" 
                             alt="<?php echo esc_attr( $p['title'] ); ?> - نمای ابعاد یا استایل" 
                             class="img-hover" 
                             loading="lazy">
                    <?php endif; ?>
                </a>

                <?php if ( ! empty( $p['badge'] ) ) : ?>
                    <span class="product-badge product-badge--<?php echo esc_attr( $p['badge_type'] ); ?>">
                        <?php echo esc_html( $p['badge'] ); ?>
                    </span>
                <?php endif; ?>

                <?php if ( ! empty( $p['dimensions'] ) ) : ?>
                    <span class="product-dimension-chip" title="ابعاد قطعه">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
                        <?php echo esc_html( $p['dimensions'] ); ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="product-card__content">
                <div class="product-authenticity-tag">
                    <span class="auth-dot"></span>
                    <span><?php echo esc_html( $p['tag'] ); ?></span>
                </div>

                <h3 class="product-title">
                    <a href="<?php echo esc_url( $product_url ); ?>">
                        <?php echo esc_html( $p['title'] ); ?>
                    </a>
                </h3>

                <div class="product-meta">
                    <?php echo esc_html( $p['category'] ); ?> | کد: <?php echo esc_html( $p['code'] ); ?>
                </div>

                <div class="product-card__action-row">
                    <div class="product-price">
                        <?php if ( ! empty( $p['old_price'] ) ) : ?>
                            <span class="price-old"><?php echo esc_html( $p['old_price'] ); ?></span>
                        <?php endif; ?>
                        <span class="price-current"><?php echo esc_html( $p['price_formatted'] ); ?></span>
                    </div>

                    <?php if ( $wc_id > 0 ) : ?>
                        <button type="button" 
                                class="product-card-cart-btn btn-coastal-action razgem-ajax-add-to-cart ajax_add_to_cart btn-fly-trigger" 
                                data-product_id="<?php echo esc_attr( $wc_id ); ?>"
                                data-product-id="<?php echo esc_attr( $wc_id ); ?>"
                                data-product_sku="<?php echo esc_attr( $p['code'] ); ?>"
                                data-quantity="1"
                                aria-label="افزودن <?php echo esc_attr( $p['title'] ); ?> به سبد خرید"
                                title="افزودن مستقیم به سبد خرید">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        </button>
                    <?php else : ?>
                        <a href="<?php echo esc_url( $product_url ); ?>" 
                           class="product-card-cart-btn btn-coastal-action" 
                           aria-label="مشاهده و خرید <?php echo esc_attr( $p['title'] ); ?>"
                           title="مشاهده مشخصات و خرید">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </article>
    <?php
}
