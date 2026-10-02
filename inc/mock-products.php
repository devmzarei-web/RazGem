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
            'img_primary'    => $theme_uri . '/assets/images/products/Product-r001-testcard.png',
            'img_model'      => $theme_uri . '/assets/images/products/Product-r001-testcard.png',
            'img_hover'      => $theme_uri . '/assets/images/products/Product-r001-testcard.png',
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
            'img_primary'    => $theme_uri . '/assets/images/products/Product-r002-testcard.png',
            'img_model'      => $theme_uri . '/assets/images/products/Product-r002-testcard.png',
            'img_hover'      => $theme_uri . '/assets/images/products/Product-r002-testcard.png',
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
            'title'          => 'تابلو صدف دریایی طرح خورشید کد R-003',
            'short_title'    => 'تابلو صدف دریایی طرح خورشید',
            'category'       => 'تابلو و دکوراتیو دریا',
            'category_slug'  => 'ocean-wall-art',
            'price_raw'      => 2850000,
            'regular_price'  => 3200000,
            'price_formatted'=> '۲,۸۵۰,۰۰۰ تومان',
            'old_price'      => '۳,۲۰۰,۰۰۰ تومان',
            'dimensions'     => '۳۰ × ۳۰ × ۶ سانتی‌متر',
            'weight'         => '۱۸۰۰ گرم',
            'material'       => 'صدف‌های مخروطی طبیعی، پنل چوبی عمیق دست‌ساز با شاسی مستحکم',
            'color'          => 'طبیعی قهوه‌ای و کرم صدفی با قاب چوبی',
            'desc'           => 'تابلو صدف دریایی طرح خورشید دست‌ساز با صدف‌های مخروطی طبیعی خلیج فارس در آرایش هندسی خورشیدی. اثری لوکس و ارگانیک برای فضاهای مدرن و اصیل.',
            'img_primary'    => $theme_uri . '/assets/images/products/r003-front.png',
            'img_model'      => $theme_uri . '/assets/images/products/r003-main.jpg',
            'img_hover'      => $theme_uri . '/assets/images/products/r003-white.png',
            'tag'            => 'تابلو دکوراتیو صدف',
            'badge'          => 'دست‌ساز',
            'badge_type'     => 'atelier',
            'in_stock'       => true,
            'featured'       => true,
            'on_sale'        => true,
            'is_variable'    => true,
            'variation_label'=> 'رنگ قاب',
            'variations'     => array( 'قاب چوبی تیره (گردویی)', 'قاب چوبی سفید (عاجی)' ),
        ),
        'r-004' => array(
            'id'             => 'r-004',
            'code'           => 'R-004',
            'title'          => 'تابلو توتیای دریایی کد R-004',
            'short_title'    => 'تابلو توتیای دریایی',
            'category'       => 'تابلو و دکوراتیو دریا',
            'category_slug'  => 'ocean-wall-art',
            'price_raw'      => 2650000,
            'regular_price'  => 2950000,
            'price_formatted'=> '۲,۶۵۰,۰۰۰ تومان',
            'old_price'      => '۲,۹۵۰,۰۰۰ تومان',
            'dimensions'     => '۳۰ × ۳۰ × ۱۰ سانتی‌متر',
            'weight'         => '۱۴۰۵ گرم',
            'material'       => 'توتیای طبیعی دریایی دست‌چین، پنل چوبی عمیق دست‌ساز',
            'color'          => 'طبیعی عاجی، سبز سدری و خاکی با قاب چوبی',
            'desc'           => 'تابلو توتیای دریایی سه بعدی دست‌ساز با توتیاهای طبیعی خلیج فارس. جلوه‌ای بی‌نظیر از بافت و هندسه ارگانیک دریا.',
            'img_primary'    => $theme_uri . '/assets/images/products/r004-main.png',
            'img_model'      => $theme_uri . '/assets/images/products/r004-scale.png',
            'img_hover'      => $theme_uri . '/assets/images/products/r004-white.png',
            'tag'            => 'توتیای طبیعی دریا',
            'badge'          => 'ویژه',
            'badge_type'     => 'nature',
            'in_stock'       => true,
            'featured'       => true,
            'on_sale'        => true,
            'is_variable'    => true,
            'variation_label'=> 'رنگ قاب',
            'variations'     => array( 'قاب چوبی تیره (گردویی)', 'قاب چوبی سفید (عاجی)' ),
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
            'img_model'      => $theme_uri . '/assets/images/model-bracelet-pendant.jpg',
            'img_hover'      => $theme_uri . '/assets/images/products/r005-dimensions.jpg',
            'tag'            => 'صدف کائوری مرجانی',
            'badge'          => 'ظریف و ارگانیک',
            'badge_type'     => 'atelier',
            'in_stock'       => true,
            'featured'       => false,
            'on_sale'        => false,
            'is_variable'    => true,
            'variation_label'=> 'طول دستبند',
            'variations'     => array( '۱۶ سانتی‌متر (ظریف)', '۱۸ سانتی‌متر (استاندارد)', '۲۰ سانتی‌متر (آزاد)' ),
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
            'img_model'      => $theme_uri . '/assets/images/model-ring-r006.jpg',
            'img_hover'      => $theme_uri . '/assets/images/products/r006-dimensions.jpg',
            'tag'            => 'صدف ناتیلوس هفت‌رنگ',
            'badge'          => 'فری‌سایز',
            'badge_type'     => 'pearl',
            'in_stock'       => true,
            'featured'       => true,
            'on_sale'        => false,
            'is_variable'    => true,
            'variation_label'=> 'سایز رکاب',
            'variations'     => array( 'سایز ۵۲ تا ۵۴ (کوچک)', 'سایز ۵۵ تا ۵۷ (متوسط)', 'سایز ۵۸ تا ۶۰ (بزرگ)' ),
        ),
        'r-007' => array(
            'id'             => 'r-007',
            'code'           => 'R-007',
            'title'          => 'چوکر مروارید باروک و صدف مخملی دست‌ساز',
            'short_title'    => 'چوکر صدف و مروارید باروک',
            'category'       => 'گردنبند و چوکر',
            'category_slug'  => 'necklaces-chokers',
            'price_raw'      => 2890000,
            'regular_price'  => 3200000,
            'price_formatted'=> '۲,۸۹۰,۰۰۰ تومان',
            'old_price'      => '۳,۲۰۰,۰۰۰ تومان',
            'dimensions'     => 'طول ۳۶ تا ۴۰ سانتی‌متر (پلاک: ۴.۰ × ۳.۵ سانتی‌متر)',
            'material'       => 'صدف طبیعی بادبزنی، مروارید باروک درخشان، روبان مخمل کتان عاجی، اتصالات نقره ۹۲۵ با روکش طلای ۱۸ عیار',
            'color'          => 'سفید عاجی و تلألو مرواریدی ارگانیک',
            'desc'           => 'شاهکار اصیل از تلفیق صدف بادبزنی طبیعی و مروارید باروک بر بستر مخمل کتان عاجی. اثری فاخر با جلوه‌ای لوکس و وقار اشرافی.',
            'img_primary'    => $theme_uri . '/assets/images/products/r007-main.jpg',
            'img_model'      => $theme_uri . '/assets/images/model-necklace-seashell.jpg',
            'img_hover'      => $theme_uri . '/assets/images/products/r007-dimensions.jpg',
            'tag'            => 'چوکر مخمل و مروارید باروک',
            'badge'          => 'شاهکار آتلیه',
            'badge_type'     => 'pearl',
            'in_stock'       => true,
            'featured'       => true,
            'on_sale'        => true,
            'is_variable'    => false,
        ),
        'r-008' => array(
            'id'             => 'r-008',
            'code'           => 'R-008',
            'title'          => 'انگشتر صدف حلزونی هفت‌رنگ مرجانی دست‌ساز',
            'short_title'    => 'انگشتر صدف حلزونی هفت‌رنگ',
            'category'       => 'دستبند و انگشتر',
            'category_slug'  => 'bracelets-rings',
            'price_raw'      => 2150000,
            'regular_price'  => 2400000,
            'price_formatted'=> '۲,۱۵۰,۰۰۰ تومان',
            'old_price'      => '۲,۴۰۰,۰۰۰ تومان',
            'dimensions'     => 'ابعاد صدف: ۲.۸ × ۲.۲ سانتی‌متر (سایز قابل تنظیم)',
            'material'       => 'صدف حلزونی مینیاتوری هفت‌رنگ طبیعی، مرواریدهای باروک ریز، رکاب چکش‌خورده با روکش طلای ۱۸ عیار',
            'color'          => 'صدف طبیعی هفت‌رنگ با تلألو رنگین‌کمانی خلیج فارس',
            'desc'           => 'انگشتر استیتمنت با صدف حلزونی مینیاتوری طبیعی و مرواریدهای باروک ریز بر رکابی ارگانیک با روکش طلای ۱۸ عیار و قابلیت تنظیم سایز.',
            'img_primary'    => $theme_uri . '/assets/images/products/r008-main.jpg',
            'img_model'      => $theme_uri . '/assets/images/model-ring-r008.jpg',
            'img_hover'      => $theme_uri . '/assets/images/products/r008-dimensions.jpg',
            'tag'            => 'صدف حلزونی هفت‌رنگ',
            'badge'          => 'فری‌سایز',
            'badge_type'     => 'nature',
            'in_stock'       => true,
            'featured'       => true,
            'on_sale'        => false,
            'is_variable'    => true,
            'variation_label'=> 'پوشش رکاب',
            'variations'     => array( 'روکش طلای ۱۸ عیار', 'نقره استرلینگ ۹۲۵' ),
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
 * Retrieve model/lifestyle background image URL for dual-depth presentation.
 * Checks WooCommerce custom meta `_razgem_model_image`, then product gallery, then mock catalog.
 *
 * @param int|WC_Product $product_or_id
 * @param string $mock_id
 * @return string
 */
function razgem_get_product_model_image_url( $product_or_id = 0, $mock_id = '' ) {
    $theme_uri = get_template_directory_uri();
    $prod_id = 0;

    if ( is_object( $product_or_id ) && method_exists( $product_or_id, 'get_id' ) ) {
        $prod_id = $product_or_id->get_id();
    } elseif ( is_numeric( $product_or_id ) && $product_or_id > 0 ) {
        $prod_id = (int) $product_or_id;
    }

    if ( $prod_id > 0 ) {
        // 1. Check dedicated custom meta set via Seeder or Product Edit screen
        $meta_model = get_post_meta( $prod_id, '_razgem_model_image', true );
        if ( ! empty( $meta_model ) ) {
            if ( is_numeric( $meta_model ) ) {
                $url = wp_get_attachment_image_url( (int) $meta_model, 'large' );
                if ( $url ) {
                    return $url;
                }
            } else {
                return esc_url( $meta_model );
            }
        }

        // 2. Fallback to first gallery image in WooCommerce
        if ( function_exists( 'wc_get_product' ) ) {
            $product = wc_get_product( $prod_id );
            if ( $product ) {
                $gallery = $product->get_gallery_image_ids();
                if ( ! empty( $gallery ) ) {
                    $url = wp_get_attachment_image_url( $gallery[0], 'large' );
                    if ( $url ) {
                        return $url;
                    }
                }
            }
        }
    }

    // 3. Fallback to mock catalog by ID / slug
    if ( empty( $mock_id ) && $prod_id > 0 ) {
        $mock_id = get_post_field( 'post_name', $prod_id );
        if ( empty( $mock_id ) ) {
            $sku = get_post_meta( $prod_id, '_sku', true );
            $mock_id = strtolower( str_replace( array( 'RG-', '-' ), '', $sku ) );
        }
    }

    if ( ! empty( $mock_id ) ) {
        $mocks = razgem_get_mock_products();
        $clean_key = strtolower( trim( $mock_id ) );
        if ( isset( $mocks[ $clean_key ]['img_model'] ) ) {
            return $mocks[ $clean_key ]['img_model'];
        }
        if ( isset( $mocks[ 'r-' . $clean_key ]['img_model'] ) ) {
            return $mocks[ 'r-' . $clean_key ]['img_model'];
        }
    }

    return $theme_uri . '/assets/images/model-earrings-baroque.jpg';
}

/**
 * Renders a standardized luxury dual-depth coastal product card for mock products.
 * Layer 1 (Depth): Ambient lifestyle model wearing the piece in Mediterranean light.
 * Layer 2 (Focus): Arched white/nacre pedestal displaying isolated specimen in razor focus.
 *
 * @param array $p Product data array.
 * @param string $extra_classes
 */
function razgem_render_mock_product_card( $p, $extra_classes = '' ) {
    $product_url = razgem_product_url( $p['id'] );
    $wc_id       = razgem_get_wc_product_id( $p['id'] );
    $model_url   = ! empty( $p['img_model'] ) ? $p['img_model'] : razgem_get_product_model_image_url( $wc_id, $p['id'] );
    $badge_text  = ! empty( $p['badge'] ) ? $p['badge'] : ( ! empty( $p['on_sale'] ) ? 'ویژه' : 'دست‌ساز' );
    $badge_type  = ! empty( $p['badge_type'] ) ? $p['badge_type'] : 'nature';
    ?>
    <article class="stella-product-card <?php echo esc_attr( $extra_classes ); ?>" data-product-id="<?php echo esc_attr( $p['id'] ); ?>">
        <div class="stella-card-inner">
            <!-- Top Half: Single Image with Arch Overlay Effect -->
            <a href="<?php echo esc_url( $product_url ); ?>" class="stella-media-arch" title="<?php echo esc_attr( $p['title'] ); ?>">
                <img src="<?php echo esc_url( $p['img_primary'] ); ?>" 
                     alt="<?php echo esc_attr( $p['title'] ); ?>" 
                     class="stella-img-main" 
                     loading="lazy">
                
                <?php if ( ! empty( $p['badge'] ) || ! empty( $p['on_sale'] ) ) : ?>
                    <span class="stella-badge">
                        <?php echo esc_html( $badge_text ); ?>
                    </span>
                <?php endif; ?>

                <div class="stella-media-actions">
                    <!-- Wishlist -->
                    <button type="button" class="stella-btn-action stella-wishlist-btn" aria-label="افزودن به علاقه‌مندی‌ها">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </button>
                    <!-- Cart -->
                    <?php if ( ! empty( $p['is_variable'] ) ) : ?>
                        <button type="button" 
                                class="stella-btn-action razgem-open-variation-modal" 
                                data-product-id="<?php echo esc_attr( $wc_id > 0 ? $wc_id : $p['id'] ); ?>"
                                data-product-title="<?php echo esc_attr( $p['title'] ); ?>"
                                data-product-price="<?php echo esc_attr( $p['price_formatted'] ); ?>"
                                data-product-image="<?php echo esc_url( $p['img_primary'] ); ?>"
                                data-variation-label="<?php echo esc_attr( $p['variation_label'] ?? 'انتخاب گزینه' ); ?>"
                                data-variations="<?php echo esc_attr( wp_json_encode( $p['variations'] ?? array() ) ); ?>"
                                aria-label="انتخاب گزینه‌های <?php echo esc_attr( $p['title'] ); ?>">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                        </button>
                    <?php elseif ( $wc_id > 0 ) : ?>
                        <button type="button" 
                                class="stella-btn-action razgem-ajax-add-to-cart ajax_add_to_cart" 
                                data-product_id="<?php echo esc_attr( $wc_id ); ?>"
                                data-quantity="1"
                                aria-label="افزودن <?php echo esc_attr( $p['title'] ); ?> به سبد خرید">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                        </button>
                    <?php else : ?>
                        <a href="<?php echo esc_url( $product_url ); ?>" 
                           class="stella-btn-action" 
                           aria-label="خرید <?php echo esc_attr( $p['title'] ); ?>">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                        </a>
                    <?php endif; ?>
                </div>
                <!-- Simulated White Arch Overlay from Bottom -->
                <div class="stella-arch-overlay"></div>
            </a>

            <!-- Bottom Half: Content Details -->
            <div class="stella-card-body">
                <h3 class="stella-title">
                    <a href="<?php echo esc_url( $product_url ); ?>">
                        <?php echo esc_html( $p['short_title'] ?? $p['title'] ); ?>
                    </a>
                </h3>

                <div class="stella-rating-row">
                    <div class="stella-stars">
                        <span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span><span class="star filled">★</span>
                    </div>
                    <div class="stella-comments">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#C59B27" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        <span>۱۲</span>
                    </div>
                </div>

                <div class="stella-attributes">
                    <div class="stella-attr">
                        <span class="attr-label">دسته:</span>
                        <span class="attr-value"><?php echo esc_html( $p['category'] ); ?></span>
                    </div>
                    <?php if ( ! empty( $p['dimensions'] ) ) : ?>
                    <div class="stella-attr">
                        <span class="attr-label">ابعاد:</span>
                        <span class="attr-value"><?php echo esc_html( mb_strimwidth( $p['dimensions'], 0, 30, '...' ) ); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $p['material'] ) ) : ?>
                    <div class="stella-attr">
                        <span class="attr-label">جنس:</span>
                        <span class="attr-value"><?php echo esc_html( mb_strimwidth( $p['material'], 0, 30, '...' ) ); ?></span>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="stella-footer">
                    <div class="stella-price-wrap">
                        <?php if ( ! empty( $p['old_price'] ) ) : ?>
                            <span class="stella-old-price"><?php echo esc_html( $p['old_price'] ); ?></span>
                        <?php endif; ?>
                        <span class="stella-current-price"><?php echo esc_html( $p['price_formatted'] ); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <?php
}

/**
 * Returns the 6 core visual categories with icons/thumbnails for bubbles & navigation.
 *
 * @return array
 */
function razgem_get_store_categories() {
    $theme_uri = get_template_directory_uri();
    return array(
        array(
            'slug'        => 'shell-earrings',
            'name'        => 'گوشواره صدف طبیعی',
            'short_name'  => 'گوشواره صدف',
            'count'       => '۲ اثر دست‌ساز',
            'image'       => $theme_uri . '/assets/images/products/r001-main.jpg',
            'url'         => function_exists('get_term_link') && term_exists('shell-earrings', 'product_cat') ? get_term_link('shell-earrings', 'product_cat') : home_url('/shop/?category=shell-earrings'),
        ),
        array(
            'slug'        => 'ocean-wall-art',
            'name'        => 'تابلو و دکوراتیو دریا',
            'short_name'  => 'تابلو و دکوراتیو',
            'count'       => '۲ شاهکار دیواری',
            'image'       => $theme_uri . '/assets/images/products/r003-front.png',
            'url'         => function_exists('get_term_link') && term_exists('ocean-wall-art', 'product_cat') ? get_term_link('ocean-wall-art', 'product_cat') : home_url('/shop/?category=ocean-wall-art'),
        ),
        array(
            'slug'        => 'necklaces-chokers',
            'name'        => 'گردنبند و چوکر مروارید',
            'short_name'  => 'گردنبند و چوکر',
            'count'       => '۱ شاهکار مروارید',
            'image'       => $theme_uri . '/assets/images/products/r007-main.jpg',
            'url'         => function_exists('get_term_link') && term_exists('necklaces-chokers', 'product_cat') ? get_term_link('necklaces-chokers', 'product_cat') : home_url('/shop/?category=necklaces-chokers'),
        ),
        array(
            'slug'        => 'shell-rings',
            'name'        => 'انگشتر صدف و گوهر',
            'short_name'  => 'انگشتر و حلقه',
            'count'       => '۲ اثر ارگانیک',
            'image'       => $theme_uri . '/assets/images/products/r006-main.jpg',
            'url'         => function_exists('get_term_link') && term_exists('shell-rings', 'product_cat') ? get_term_link('shell-rings', 'product_cat') : home_url('/shop/?category=shell-rings'),
        ),
        array(
            'slug'        => 'bracelets-anklets',
            'name'        => 'دستبند و پابند صدف',
            'short_name'  => 'دستبند صدف',
            'count'       => '۱ دست‌سازه بوهو',
            'image'       => $theme_uri . '/assets/images/products/r005-main.jpg',
            'url'         => function_exists('get_term_link') && term_exists('bracelets-anklets', 'product_cat') ? get_term_link('bracelets-anklets', 'product_cat') : home_url('/shop/?category=bracelets-anklets'),
        ),
        array(
            'slug'        => 'bespoke',
            'name'        => 'سفارش ساخت اختصاصی',
            'short_name'  => 'سفارش اختصاصی',
            'count'       => 'تک‌نسخه هنری',
            'image'       => $theme_uri . '/assets/images/products/r002-main.jpg',
            'url'         => home_url('/contact/'),
        ),
    );
}
