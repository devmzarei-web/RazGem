<?php
defined( 'ABSPATH' ) || exit;

/* =========================================================================
   1. THEME SETUP & ASSETS
   ========================================================================= */
function razgem_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    load_theme_textdomain('razgem', get_template_directory() . '/languages');

    register_nav_menus(array(
        'primary' => 'منوی اصلی (Main Header Menu)',
        'footer'  => 'منوی فوتر (Footer Quick Links)'
    ));
}
add_action('after_setup_theme', 'razgem_theme_setup');

// Include dedicated asset enqueuing (Constitution Principle I: Zero-CDN)
require_once get_template_directory() . '/inc/enqueue.php';

/* =========================================================================
   1.1 SAFE WOOCOMMERCE FALLBACK HELPERS (Defensive Theme Architecture)
   ========================================================================= */
if ( ! function_exists( 'razgem_shop_url' ) ) {
    function razgem_shop_url() {
        return function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop' );
    }
}

if ( ! function_exists( 'razgem_cart_url' ) ) {
    function razgem_cart_url() {
        return function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart' );
    }
}

if ( ! function_exists( 'razgem_account_url' ) ) {
    function razgem_account_url( $endpoint = '' ) {
        if ( function_exists( 'wc_get_account_endpoint_url' ) && ! empty( $endpoint ) ) {
            return wc_get_account_endpoint_url( $endpoint );
        }
        if ( function_exists( 'wc_get_page_permalink' ) ) {
            return wc_get_page_permalink( 'myaccount' );
        }
        return home_url( '/my-account' );
    }
}

if ( ! function_exists( 'razgem_cart_count' ) ) {
    function razgem_cart_count() {
        return ( function_exists( 'WC' ) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
    }
}

if ( ! function_exists( 'razgem_placeholder_img_src' ) ) {
    function razgem_placeholder_img_src( $size = 'woocommerce_single' ) {
        if ( function_exists( 'wc_placeholder_img_src' ) ) {
            return wc_placeholder_img_src( $size );
        }
        return get_template_directory_uri() . '/assets/images/placeholder.jpg';
    }
}

/* =========================================================================
   2. WOOCOMMERCE OPTIMIZATIONS & BLOAT REMOVAL
   ========================================================================= */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_filter( 'woocommerce_admin_disabled', '__return_true' );
add_filter( 'woocommerce_marketing_menu_items', '__return_empty_array' );
add_filter( 'woocommerce_allow_marketplace_suggestions', '__return_false' );
add_filter( 'woocommerce_helper_suppress_admin_notices', '__return_true' );
add_filter( 'use_widgets_block_editor', '__return_false' );
add_filter( 'woocommerce_show_page_title', '__return_false' );
add_filter( 'woocommerce_enable_tracking', '__return_false' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_action('wp_dashboard_setup', function() {
    remove_meta_box('woocommerce_dashboard_status', 'dashboard', 'normal');
});

/* =========================================================================
   3. SINGLE PRODUCT LAYOUT OVERRIDE (Clean Tabs & Reviews)
   ========================================================================= */
add_filter( 'woocommerce_product_tabs', 'razgem_reorder_tabs', 98 );
function razgem_reorder_tabs( $tabs ) {
    if ( isset( $tabs['reviews'] ) ) unset( $tabs['reviews'] );
    
    if ( isset( $tabs['description'] ) ) $tabs['description']['title'] = 'معرفی محصول';
    if ( isset( $tabs['additional_information'] ) ) {
        $tabs['additional_information']['title'] = 'توضیحات تکمیلی';
        $tabs['additional_information']['callback'] = 'razgem_additional_info_content';
    }
    return $tabs;
}

function razgem_additional_info_content() {
    global $product;
    wc_display_product_attributes( $product );
}

add_action( 'woocommerce_after_single_product_summary', 'comments_template', 30 );

/* =========================================================================
   4. IRANIAN TOMAN CURRENCY & LOCALIZED PRICING (FR-003)
   ========================================================================= */
add_filter( 'woocommerce_currencies', 'razgem_add_toman_currency' );
function razgem_add_toman_currency( $currencies ) {
    $currencies['IRT'] = __( 'تومان ایران', 'razgem' );
    $currencies['TOMAN'] = __( 'تومان', 'razgem' );
    $currencies['IRR'] = __( 'ریال ایران', 'razgem' );
    return $currencies;
}

add_filter( 'woocommerce_currency_symbol', 'razgem_toman_currency_symbol', 10, 2 );
function razgem_toman_currency_symbol( $currency_symbol, $currency ) {
    switch( $currency ) {
        case 'IRT':
        case 'TOMAN':
            $currency_symbol = 'تومان';
            break;
        case 'IRR':
            $currency_symbol = 'ریال';
            break;
    }
    return $currency_symbol;
}

/* =========================================================================
   4.1. PERSIAN NUMBERS CONVERTER (Static PHP)
   ========================================================================= */
function razgem_persian_numbers( $price ) {
    $parts = preg_split('/(<[^>]*>|&#?[a-zA-Z0-9]+;)/', $price, -1, PREG_SPLIT_DELIM_CAPTURE);
    $english = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

    foreach ($parts as &$part) {
        if (strpos($part, '<') !== 0 && strpos($part, '&') !== 0) {
            $part = str_replace($english, $persian, $part);
        }
    }
    return implode('', $parts);
}
add_filter('wc_price', 'razgem_persian_numbers', 100);
add_filter('woocommerce_get_price_html', 'razgem_persian_numbers', 100);
add_filter('woocommerce_cart_item_price', 'razgem_persian_numbers', 100);
add_filter('woocommerce_cart_item_subtotal', 'razgem_persian_numbers', 100);
add_filter('woocommerce_cart_subtotal', 'razgem_persian_numbers', 100);
add_filter('woocommerce_cart_total', 'razgem_persian_numbers', 100);

// Remove screen-reader labels from sale price formatting so only strikethrough del and ins are shown
add_filter( 'woocommerce_format_sale_price', 'razgem_clean_sale_price_format', 99, 3 );
function razgem_clean_sale_price_format( $price, $regular_price, $sale_price ) {
    return '<del aria-hidden="true">' . ( is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price ) . '</del> <ins>' . ( is_numeric( $sale_price ) ? wc_price( $sale_price ) : $sale_price ) . '</ins>';
}

/* =========================================================================
   5. SHOP SIDEBAR & PRODUCT DISPLAY HOOKS
   ========================================================================= */
function razgem_register_sidebars() {
    register_sidebar(array(
        'name'          => 'سایدبار فروشگاه (Shop Sidebar)',
        'id'            => 'shop-sidebar',
        'description'   => 'ابزارک‌های فیلتر محصولات (قیمت، دسته‌بندی و...) را اینجا قرار دهید.',
        'before_widget' => '<div class="shop-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'razgem_register_sidebars');

add_filter( 'woocommerce_get_price_html', 'razgem_out_of_stock_price_html', 95, 2 );
function razgem_out_of_stock_price_html( $price, $product ) {
    if ( is_admin() && ! wp_doing_ajax() ) {
        return $price;
    }
    if ( is_a( $product, 'WC_Product' ) && ! $product->is_in_stock() ) {
        return '<span class="price-outofstock">ناموجود</span>';
    }
    return $price;
}

add_action( 'woocommerce_before_shop_loop_item_title', 'razgem_out_of_stock_loop_badge', 9 );
function razgem_out_of_stock_loop_badge() {
    global $product;
    if ( is_a( $product, 'WC_Product' ) && ! $product->is_in_stock() ) {
        echo '<span class="product-badge product-badge--outofstock">ناموجود</span>';
    }
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'razgem_custom_cart_button_text', 20, 2 );
add_filter( 'woocommerce_product_add_to_cart_text', 'razgem_custom_cart_button_text', 20, 2 );
function razgem_custom_cart_button_text( $text, $product = null ) {
    if ( ! $product ) {
        global $product;
    }
    if ( is_a( $product, 'WC_Product' ) && ! $product->is_in_stock() ) {
        return 'ناموجود';
    }
    return 'افزودن به سبد خرید';
}

add_filter( 'woocommerce_breadcrumb_defaults', 'razgem_breadcrumb_defaults' );
function razgem_breadcrumb_defaults( $defaults ) {
    $defaults['home'] = 'خانه';
    $defaults['delimiter'] = ' <span class="divider">/</span> ';
    return $defaults;
}

add_filter( 'woocommerce_get_terms_and_conditions_checkbox_text', 'razgem_custom_terms_text', 999 );
function razgem_custom_terms_text() {
    return 'من <a href="/terms" target="_blank" style="color:var(--color-dark); border-bottom:1px dashed var(--color-gold); font-weight:bold;">قوانین و مقررات</a> سایت را مطالعه کرده و می‌پذیرم.';
}

/* =========================================================================
   6. WOOCOMMERCE AJAX FRAGMENTS & MINI CART
   ========================================================================= */
add_filter( 'woocommerce_add_to_cart_fragments', 'razgem_cart_count_fragment' );
function razgem_cart_count_fragment( $fragments ) {
    ob_start();
    ?>
    <span class="cart-count">
        <?php echo esc_html( razgem_cart_count() ); ?>
    </span>
    <?php
    $fragments['span.cart-count'] = ob_get_clean();
    return $fragments;
}

add_filter( 'woocommerce_cart_item_name', 'razgem_mini_cart_item_name', 10, 3 );
function razgem_mini_cart_item_name( $product_name, $cart_item, $cart_item_key ) {
    if ( ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_checkout' ) && is_checkout() ) ) return $product_name; 
    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    return '<div class="mini-cart-item-info"><span class="mini-cart-item-title">' . ( is_object($_product) && method_exists($_product, 'get_name') ? $_product->get_name() : '' ) . '</span></div>';
}

/* =========================================================================
   7. CHECKOUT & ADDRESS OPTIMIZATIONS
   ========================================================================= */
add_filter( 'default_checkout_billing_country', 'razgem_default_checkout_country' );
add_filter( 'default_checkout_shipping_country', 'razgem_default_checkout_country' );
function razgem_default_checkout_country() {
  return 'IR';
}

add_filter( 'woocommerce_default_address_fields' , 'razgem_custom_default_address_fields' );
function razgem_custom_default_address_fields( $fields ) {
    $fields['first_name']['label'] = 'نام';
    $fields['last_name']['label'] = 'نام خانوادگی';
    $fields['company']['label'] = 'نام شرکت';
    $fields['country']['label'] = 'کشور';
    $fields['address_1']['label'] = 'آدرس کامل پستی';
    $fields['address_1']['placeholder'] = 'نام خیابان، کوچه، پلاک...';
    $fields['address_2']['label'] = 'واحد / طبقه';
    $fields['address_2']['placeholder'] = 'شماره واحد، طبقه...';
    $fields['address_2']['label_class'] = array();
    $fields['city']['label'] = 'شهر';
    $fields['state']['label'] = 'استان';
    $fields['postcode']['label'] = 'کد پستی ۱۰ رقمی';
    return $fields;
}

add_filter('woocommerce_checkout_fields', 'razgem_optimize_checkout_fields', 999);
function razgem_optimize_checkout_fields($fields) {
    unset($fields['billing']['billing_company']);

    $fields['billing']['billing_first_name']['priority'] = 10;
    $fields['billing']['billing_first_name']['class'] = array('form-row-first');
    $fields['billing']['billing_last_name']['priority'] = 20;
    $fields['billing']['billing_last_name']['class'] = array('form-row-last');
    $fields['billing']['billing_phone']['label'] = 'شماره موبایل';
    $fields['billing']['billing_phone']['required'] = true; 
    $fields['billing']['billing_phone']['priority'] = 30;
    $fields['billing']['billing_phone']['class'] = array('form-row-first');
    $fields['billing']['billing_email']['label'] = 'آدرس ایمیل';
    $fields['billing']['billing_email']['required'] = false; 
    $fields['billing']['billing_email']['priority'] = 40;
    $fields['billing']['billing_email']['class'] = array('form-row-last');
    $fields['billing']['billing_state']['priority'] = 50;
    $fields['billing']['billing_state']['class'] = array('form-row-first');
    $fields['billing']['billing_city']['priority'] = 60;
    $fields['billing']['billing_city']['class'] = array('form-row-last');
    $fields['billing']['billing_address_1']['priority'] = 70;
    $fields['billing']['billing_address_1']['class'] = array('form-row-wide');
    $fields['billing']['billing_address_2']['priority'] = 80;
    $fields['billing']['billing_address_2']['class'] = array('form-row-first');
    $fields['billing']['billing_postcode']['priority'] = 90;
    $fields['billing']['billing_postcode']['class'] = array('form-row-last');

    $fields['order']['order_comments']['label'] = 'یادداشت سفارش';
    $fields['order']['order_comments']['placeholder'] = 'اگر نکته خاصی برای زمان تحویل یا بسته‌بندی دارید اینجا بنویسید...';
    
    return $fields;
}

add_filter( 'woocommerce_billing_fields', 'razgem_force_billing_phone', 999, 1 );
function razgem_force_billing_phone( $fields ) {
    $fields['billing_phone']['label'] = 'شماره موبایل';
    $fields['billing_phone']['required'] = true; 
    return $fields;
}

/* =========================================================================
   8. COMMENTS & LIVE SEARCH
   ========================================================================= */
function razgem_custom_comment_format($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment-meta-header">
                <div class="comment-author-group">
                    <div class="comment-author-avatar">
                        <?php echo get_avatar($comment, 45); ?>
                    </div>
                    <div class="comment-author-info">
                        <b class="fn"><?php comment_author_link(); ?></b>
                        <span class="comment-date">
                            <?php echo get_comment_date(); ?>
                        </span>
                    </div>
                </div>
                <div class="comment-actions">
                    <?php 
                    edit_comment_link('ویرایش', '<span class="edit-link">', '</span>'); 
                    comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'پاسخ دادن'))); 

                    if ( current_user_can( 'moderate_comments' ) ) {
                        $delete_nonce = wp_create_nonce( 'trash-comment_' . $comment->comment_ID );
                        $delete_url = admin_url( 'comment.php?action=trash&c=' . $comment->comment_ID . '&_wpnonce=' . $delete_nonce );
                        echo '<a href="' . esc_url( $delete_url ) . '" class="delete-link" onclick="return confirm(\'آیا از حذف این دیدگاه مطمئن هستید؟\');">حذف دیدگاه</a>';
                    }
                    ?>
                </div>
            </div>
            
            <?php 
            if ( 'product' === get_post_type( $comment->comment_post_ID ) ) {
                $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
                if ( $rating && function_exists('wc_get_rating_html') ) {
                    echo '<div class="custom-woo-stars" style="margin-bottom: 0.8rem;">' . wc_get_rating_html( $rating ) . '</div>';
                }
            }
            ?>

            <?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-moderation">دیدگاه شما ثبت شد و در انتظار تایید مدیریت است.</em>
            <?php endif; ?>
            
            <div class="comment-content-text">
                <?php comment_text(); ?>
            </div>
        </div>
<?php
}

add_filter( 'woocommerce_product_review_list_args', 'razgem_override_woo_reviews' );
function razgem_override_woo_reviews( $args ) {
    $args['callback'] = 'razgem_custom_comment_format';
    return $args;
}

add_action('wp_ajax_razgem_live_search', 'razgem_live_search_ajax');
add_action('wp_ajax_nopriv_razgem_live_search', 'razgem_live_search_ajax');
function razgem_live_search_ajax() {
    $keyword = isset($_POST['keyword']) ? sanitize_text_field($_POST['keyword']) : '';
    if (strlen($keyword) < 2) wp_send_json_error();

    $args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        's'              => $keyword,
        'posts_per_page' => 5, 
    );
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            global $product;
            ?>
            <a href="<?php the_permalink(); ?>" class="live-search-item">
                <div class="ls-img">
                    <?php echo woocommerce_get_product_thumbnail('thumbnail'); ?>
                </div>
                <div class="ls-info">
                    <h4><?php the_title(); ?></h4>
                    <span class="ls-price"><?php echo $product->get_price_html(); ?></span>
                </div>
            </a>
            <?php
        }
        ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>?s=<?php echo urlencode($keyword); ?>&post_type=product" class="ls-view-all">مشاهده همه نتایج جستجو</a>
        <?php
        wp_reset_postdata();
        $html = ob_get_clean();
        wp_send_json_success($html);
    } else {
        wp_send_json_error();
    }
}

/* =========================================================================
   9. CUSTOMIZER SETTINGS
   ========================================================================= */
function razgem_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'razgem_hero_section', array( 'title' => 'تنظیمات هدر اصلی (Hero Section)', 'priority' => 30 ) );
    $wp_customize->add_setting( 'hero_badge', array( 'default' => 'PREMIUM INTERIOR COLLECTION', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'hero_badge', array( 'label' => 'متن نشان (Badge)', 'section' => 'razgem_hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'hero_title_main', array( 'default' => 'تلفیق مدرنیته و اصالت <br>در چیدمان', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'hero_title_main', array( 'label' => 'متن اصلی عنوان', 'section' => 'razgem_hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'hero_title_highlight', array( 'default' => 'لوکس خانه شما', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'hero_title_highlight', array( 'label' => 'بخش طلایی عنوان', 'section' => 'razgem_hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'hero_desc', array( 'default' => 'جزئیات ظریف دکوراسیون داخلی برند رازگِم، روح هنری عمیق و فضایی آرام و مینیمال را به خانه‌تان هدیه می‌دهد.', 'sanitize_callback' => 'sanitize_textarea_field' ) );
    $wp_customize->add_control( 'hero_desc', array( 'label' => 'توضیحات زیر عنوان', 'section' => 'razgem_hero_section', 'type' => 'textarea' ) );
    $wp_customize->add_setting( 'hero_btn1_text', array( 'default' => 'ورود به فروشگاه رازگِم', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'hero_btn1_text', array( 'label' => 'متن دکمه اول', 'section' => 'razgem_hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'hero_btn1_url', array( 'default' => '/shop', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'hero_btn1_url', array( 'label' => 'لینک دکمه اول', 'section' => 'razgem_hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'hero_btn2_text', array( 'default' => 'مشاهده کالکشن جدید', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'hero_btn2_text', array( 'label' => 'متن دکمه دوم', 'section' => 'razgem_hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'hero_btn2_url', array( 'default' => '#new-arrivals', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'hero_btn2_url', array( 'label' => 'لینک دکمه دوم', 'section' => 'razgem_hero_section', 'type' => 'text' ) );

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting( 'hero_image_' . $i, array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_image_' . $i, array( 'label' => 'تصویر اسلایدر ' . $i, 'section' => 'razgem_hero_section', 'settings' => 'hero_image_' . $i ) ) );
    }

    $wp_customize->add_section( 'razgem_contact_section', array( 'title' => 'اطلاعات تماس (تماس با ما)', 'priority' => 31 ) );
    $wp_customize->add_setting( 'contact_phone', array( 'default' => '۰۲۱ - ۹۱۰۰XXXX', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'contact_phone', array( 'label' => 'شماره تماس اول (اصلی)', 'section' => 'razgem_contact_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'contact_phone_2', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'contact_phone_2', array( 'label' => 'شماره تماس دوم (اختیاری)', 'section' => 'razgem_contact_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'contact_phone_3', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'contact_phone_3', array( 'label' => 'شماره تماس سوم (اختیاری)', 'section' => 'razgem_contact_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'contact_email', array( 'default' => 'info@razgem.ir', 'sanitize_callback' => 'sanitize_email' ) );
    $wp_customize->add_control( 'contact_email', array( 'label' => 'آدرس ایمیل', 'section' => 'razgem_contact_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'contact_address', array( 'default' => 'تهران، نیاوران، خیابان عمار، پلاک ۱۲، واحد ۳', 'sanitize_callback' => 'sanitize_textarea_field' ) );
    $wp_customize->add_control( 'contact_address', array( 'label' => 'آدرس فیزیکی', 'section' => 'razgem_contact_section', 'type' => 'textarea' ) );

    $wp_customize->add_section( 'razgem_about_section', array( 'title' => 'ارزش‌های برند (درباره ما)', 'priority' => 32 ) );
    $wp_customize->add_setting( 'about_v1_title', array( 'default' => 'طراحی مینیمال', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'about_v1_title', array( 'label' => 'عنوان ارزش اول', 'section' => 'razgem_about_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'about_v1_desc', array( 'default' => 'حذف زواید و تمرکز بر فرم خالص', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'about_v1_desc', array( 'label' => 'توضیح ارزش اول', 'section' => 'razgem_about_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'about_v2_title', array( 'default' => 'متریال ارگانیک', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'about_v2_title', array( 'label' => 'عنوان ارزش دوم', 'section' => 'razgem_about_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'about_v2_desc', array( 'default' => 'احترام به طبیعت و استفاده از مواد پایدار', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'about_v2_desc', array( 'label' => 'توضیح ارزش دوم', 'section' => 'razgem_about_section', 'type' => 'text' ) );

    $wp_customize->add_section( 'razgem_enamad_section', array( 'title' => 'نماد اعتماد (e-Namad)', 'priority' => 35 ) );
    $wp_customize->add_setting( 'enamad_code', array( 'default' => '', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'enamad_code', array( 'label' => 'کد اختصاصی اینماد (HTML)', 'section' => 'razgem_enamad_section', 'type' => 'textarea', 'description' => 'کد دریافتی از اینماد را اینجا قرار دهید تا در فوتر سایت نمایش داده شود.' ) );

    $wp_customize->add_setting( 'top_bar_announcement', array(
    'default'           => 'ارسال رایگان برای خرید‌های بالای ۳ میلیون تومان',
    'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( 'top_bar_announcement', array(
    'label'    => 'متن اطلاعیه بالای سایت (Top Bar)',
    'section'  => 'razgem_contact_section', 
    'type'     => 'text'
    ) );
    $wp_customize->add_section( 'razgem_shop_section', array( 'title' => 'تنظیمات ارسال و فروشگاه (Shop Settings)', 'priority' => 34 ) );
    $wp_customize->add_setting( 'free_shipping_min_amount', array( 'default' => 3000000, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'free_shipping_min_amount', array(
        'label'       => 'حداقل مبلغ جهت ارسال رایگان (تومان)',
        'section'     => 'razgem_shop_section',
        'type'        => 'number',
        'description' => 'مبلغ فاکتور خرید (به تومان) جهت محاسبه نوار پیشرفت ارسال رایگان در سبد خرید'
    ) );

    $wp_customize->add_section( 'razgem_social_section', array( 'title' => 'شبکه‌های اجتماعی (Social Media)', 'priority' => 33 ) );
    $wp_customize->add_setting( 'social_instagram', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'social_instagram', array( 'label' => 'لینک اینستاگرام', 'section' => 'razgem_social_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'social_telegram', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'social_telegram', array( 'label' => 'لینک تلگرام', 'section' => 'razgem_social_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'social_whatsapp', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'social_whatsapp', array( 'label' => 'لینک واتس‌اپ', 'section' => 'razgem_social_section', 'type' => 'url' ) );

    $wp_customize->add_section( 'razgem_bale_section', array( 'title' => 'اطلاع‌رسانی بله (Bale Bot)', 'priority' => 36 ) );
    $wp_customize->add_setting( 'bale_bot_token', array( 'default' => '93568967:H8HZAqpo4QqddujZFHUm-W02PuJpqL9sojg', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bale_bot_token', array( 'label' => 'توکن ربات بله (Bot Token)', 'section' => 'razgem_bale_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'bale_chat_id', array( 'default' => '5595461321', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bale_chat_id', array( 'label' => 'شناسه چت یا گروه بله (Chat ID)', 'section' => 'razgem_bale_section', 'type' => 'text', 'description' => 'شناسه کاربری یا گروه بله جهت دریافت نوتیفیکیشن سفارشات' ) );

    // SPOTLIGHT PRODUCT SECTION (بخش محصول پیشنهادی صفحه اصلی)
    $wp_customize->add_section( 'razgem_spotlight_section', array( 'title' => 'محصول پیشنهادی صفحه اصلی (Spotlight)', 'priority' => 30 ) );
    
    $wp_customize->add_setting( 'spotlight_enabled', array( 'default' => 'yes', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'spotlight_enabled', array( 'label' => 'نمایش بخش محصول پیشنهادی', 'section' => 'razgem_spotlight_section', 'type' => 'checkbox' ) );

    $wp_customize->add_setting( 'spotlight_badge', array( 'default' => 'پیشنهاد رازگِم', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'spotlight_badge', array( 'label' => 'متن برچسب (Badge)', 'section' => 'razgem_spotlight_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'spotlight_title', array( 'default' => 'محصول منتخب رازگِم', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'spotlight_title', array( 'label' => 'عنوان فرعی / معرفی', 'section' => 'razgem_spotlight_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'spotlight_desc', array( 'default' => 'انتخاب شده با تمرکز بر فرم خالص، کیفیت ساخت و اصالت متریال', 'sanitize_callback' => 'sanitize_textarea_field' ) );
    $wp_customize->add_control( 'spotlight_desc', array( 'label' => 'توضیحات کوتاه زیر عنوان', 'section' => 'razgem_spotlight_section', 'type' => 'textarea' ) );

    // Build Product Choices for Dropdown
    $product_choices = array( '' => '— انتخاب خودکار (اولین محصول ویژه/جدید) —' );
    if ( function_exists( 'wc_get_products' ) ) {
        $recent_products = wc_get_products( array( 'status' => 'publish', 'limit' => 100, 'orderby' => 'date', 'order' => 'DESC' ) );
        foreach ( $recent_products as $p ) {
            $product_choices[ strval( $p->get_id() ) ] = $p->get_name() . ' (' . number_format((float)$p->get_price()) . ' تومان)';
        }
    }
    $wp_customize->add_setting( 'spotlight_product_id', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'spotlight_product_id', array(
        'label'       => 'انتخاب محصول برای نمایش',
        'section'     => 'razgem_spotlight_section',
        'type'        => 'select',
        'choices'     => $product_choices,
        'description' => 'محصولی که می‌خواهید در این بخش ویژه نمایش داده شود را انتخاب کنید.'
    ) );
}
add_action( 'customize_register', 'razgem_customize_register' );


add_filter( 'woocommerce_reset_variations_link', '__return_empty_string' );
add_filter( 'woocommerce_show_variation_price', '__return_true' );

function razgem_clean_phone( $phone ) {
    $persian = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
    $english = array('0','1','2','3','4','5','6','7','8','9');
    $cleaned = str_replace( $persian, $english, $phone );
    return preg_replace( '/[^0-9+]/', '', $cleaned );
}

/* =========================================================================
   10. CONTACT MESSAGES INBOX
   ========================================================================= */
add_action( 'init', 'razgem_register_message_inbox' );
function razgem_register_message_inbox() {
    $labels = array(
        'name'                  => 'صندوق پیام‌ها',
        'singular_name'         => 'پیام',
        'menu_name'             => 'صندوق پیام‌ها',
        'all_items'             => 'همه پیام‌ها',
        'add_new_item'          => 'افزودن پیام (تستی)',
        'edit_item'             => 'مشاهد پیام',
        'view_item'             => 'نمایش پیام',
        'search_items'          => 'جستجوی پیام',
        'not_found'             => 'هیچ پیامی دریافت نشده است.',
    );
    $args = array(
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor' ),
        'public'                => false, 
        'show_ui'               => true,  
        'show_in_menu'          => true,
        'menu_position'         => 25,    
        'menu_icon'             => 'dashicons-email-alt', 
        'exclude_from_search'   => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'razgem_message', $args );
}

add_filter( 'manage_razgem_message_posts_columns', 'razgem_set_message_columns' );
function razgem_set_message_columns($columns) {
    return array(
        'cb'           => $columns['cb'],
        'title'        => 'عنوان پیام',
        'sender_name'  => 'فرستنده',
        'sender_phone' => 'شماره تماس',
        'msg_subject'  => 'موضوع اختصاصی',
        'date'         => 'تاریخ ثبت'
    );
}

add_action( 'manage_razgem_message_posts_custom_column', 'razgem_message_custom_column', 10, 2 );
function razgem_message_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'sender_name' :
            echo '<b>' . esc_html( get_post_meta( $post_id, 'sender_name', true ) ) . '</b>';
            break;
        case 'sender_phone' :
            echo esc_html( get_post_meta( $post_id, 'sender_phone', true ) );
            break;
        case 'msg_subject' :
            $sub = get_post_meta( $post_id, 'msg_subject', true );
            echo $sub ? esc_html($sub) : '<i>بدون موضوع</i>';
            break;
    }
}

add_action('wp_ajax_submit_razgem_contact', 'razgem_handle_contact_form');
add_action('wp_ajax_nopriv_submit_razgem_contact', 'razgem_handle_contact_form');
function razgem_handle_contact_form() {
    $name    = isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '';
    $phone   = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $subject = isset($_POST['subject']) ? sanitize_text_field($_POST['subject']) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

    if (empty($name) || empty($phone) || empty($message)) {
        wp_send_json_error('لطفاً فیلدهای ضروری (ستاره‌دار) را پر کنید.');
    }

    $post_title = 'پیام از طرف: ' . $name . ' (' . wp_date('Y/m/d H:i') . ')';
    
    $post_data = array(
        'post_title'   => $post_title,
        'post_content' => $message,
        'post_status'  => 'publish',
        'post_type'    => 'razgem_message',
    );

    $post_id = wp_insert_post($post_data);

    if (!is_wp_error($post_id)) {
        update_post_meta($post_id, 'sender_name', $name);
        update_post_meta($post_id, 'sender_phone', $phone);
        update_post_meta($post_id, 'msg_subject', $subject);
        wp_send_json_success('پیام شما با موفقیت در سیستم ثبت شد. همکاران ما به زودی با شما تماس خواهند گرفت.');
    } else {
        wp_send_json_error('خطا در برقراری ارتباط با دیتابیس. لطفاً مجدداً تلاش کنید.');
    }
}

/* =========================================================================
   11. PERFORMANCE FIXES & HPOS
   ========================================================================= */
add_filter( 'heartbeat_settings', 'razgem_tame_heartbeat' );
function razgem_tame_heartbeat( $settings ) {
    $settings['interval'] = 60; 
    return $settings;
}



add_action( 'before_woocommerce_init', function() {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 
            'custom_order_tables', 
            'wp-parsidate/wp-parsidate.php', 
            true 
        );
    }
} );

/* =========================================================================
   12. THE EXPANDED MEGA TRANSLATOR 
   ========================================================================= */
add_filter( 'gettext', 'razgem_mega_translate_woo_strings', 99, 3 );
function razgem_mega_translate_woo_strings( $translated_text, $text, $domain ) {
    if ( 'woocommerce' === $domain || 'default' === $domain ) {
        
        if ( strpos(strtolower($text), 'subtotal') !== false ) {
            return str_replace(['Cart subtotal', 'Subtotal:', 'Subtotal'], ['جمع سبد خرید', 'جمع جزء:', 'جمع جزء'], $text);
        }

        if ( $text === 'Shop' ) return 'فروشگاه';
        if ( strpos(strtolower($text), 'search result') !== false ) return 'نتایج جستجو';
        
        if ( $text === 'Get Shortlink' || $text === 'Get shortlink' || strpos($translated_text, 'دریافت پیوندک') !== false ) return 'لینک کوتاه';
        if ( $text === 'Shortlink' || $text === 'Short Link' || $text === 'پیوندک' ) return 'لینک کوتاه';

        if ( $text === 'Showing the single result' ) return 'نمایش تنها نتیجه';
        if ( $text === 'Showing all %d results' ) return 'نمایش تمامی %d محصول';
        if ( strpos($text, 'Showing %1$d&ndash;%2$d of %3$d results') !== false ) return 'نمایش %1$d تا %2$d از %3$d محصول';
        if ( strpos(strtolower($text), 'showing') !== false && strpos(strtolower($text), 'results') !== false ) return 'نمایش نتایج';

        if ( strpos($text, 'Related products') !== false ) return 'محصولات مرتبط';
        if ( strpos($text, 'Price:') !== false ) return str_replace('Price:', 'قیمت:', $text);
        if ( $text === 'Relevance' || $text === 'Sort by relevance' ) return 'مرتبط‌ترین';
        if ( $text === 'Default sorting' ) return 'مرتب‌سازی پیش‌فرض';
        if ( $text === 'Sort by popularity' ) return 'محبوب‌ترین‌ها';
        if ( $text === 'Sort by average rating' ) return 'بالاترین امتیاز';
        if ( $text === 'Sort by latest' ) return 'جدیدترین‌ها';
        if ( $text === 'Sort by price: low to high' ) return 'ارزان‌ترین';
        if ( $text === 'Sort by price: high to low' ) return 'گران‌ترین';
        if ( $text === 'Filter' ) return 'اعمال فیلتر';
        
        if ( $text === 'Product' ) return 'محصول';
        if ( $text === 'Price' ) return 'قیمت';
        if ( $text === 'Quantity' ) return 'تعداد';
        if ( strpos($text, 'View cart') !== false ) return 'مشاهده سبد خرید';
        if ( strpos($text, 'Checkout') !== false ) return 'تسویه حساب';
        if ( $text === 'Have a coupon?' ) return 'کد تخفیف دارید؟';
        if ( $text === 'Click here to enter your code' ) return 'برای وارد کردن کد اینجا کلیک کنید';
        if ( $text === 'optional' || $text === '(optional)' ) return 'اختیاری';
        if ( $text === 'Total' ) return 'مبلغ کل فاکتور';
        if ( $text === 'Cart totals' ) return 'خلاصه فاکتور';
        if ( $text === 'Proceed to checkout' ) return 'ادامه جهت تسویه حساب';
        if ( $text === 'Apply coupon' ) return 'اعمال تخفیف';
        if ( $text === 'Update cart' ) return 'بروزرسانی سبد خرید';
        if ( $text === 'Coupon code' ) return 'کد تخفیف';
        if ( $text === 'Your cart is currently empty.' ) return 'سبد خرید شما در حال حاضر خالی است.';
        if ( $text === 'Return to shop' ) return 'بازگشت به فروشگاه';

        if ( $text === 'Billing details' ) return 'جزئیات صورت‌حساب';
        if ( $text === 'Your order' ) return 'خلاصه سفارش شما';
        if ( $text === 'Place order' ) return 'ثبت و پرداخت نهایی';
        if ( $text === 'Province' || $text === 'State / County' || $text === 'State' ) return 'استان';
        if ( $text === 'Postal code' || $text === 'Postcode / ZIP' || $text === 'Postcode' ) return 'کد پستی';
        if ( $text === 'Additional information' || strtolower($text) === 'additional information' ) return 'توضیحات تکمیلی';
        if ( $text === 'Phone' || strtolower($text) === 'phone' ) return 'شماره موبایل';
        if ( strpos($text, 'I have read and agree to the website') !== false ) return 'من قوانین و مقررات را می‌پذیرم.';
        if ( strpos($text, 'no available payment methods') !== false ) return 'در حال حاضر درگاه پرداختی متصل نیست. جهت هماهنگی با پشتیبانی تماس بگیرید.';
        if ( strpos($text, 'Your personal data will be used') !== false ) return 'اطلاعات شما نزد ما محفوظ است و تنها برای پردازش سفارش استفاده می‌شود.';
        if ( $text === '<strong>%s</strong> is a required field.' ) return 'وارد کردن <strong>%s</strong> الزامی است.';
        if ( $text === 'Billing %s' ) return '%s';
        if ( $text === 'Shipping %s' ) return '%s';
        if ( $text === 'Pay for order' || strtolower($text) === 'pay for order' ) return 'پرداخت سفارش';
        if ( $text === 'Order number:' ) return 'شماره سفارش:';
        if ( $text === 'Date:' ) return 'تاریخ:';
        if ( $text === 'Total:' ) return 'مبلغ کل:';
        if ( $text === 'Payment method:' ) return 'روش پرداخت:';
        if ( $text === 'Cancel order &amp; restore cart' ) return 'بازگشت به سبد خرید';
        if ( strpos($text, '%1$s review for %2$s') !== false ) return '';
        if ( strpos($text, '%1$s reviews for %2$s') !== false ) return '';
        if ( strpos($text, 'Leave a Reply to %s') !== false ) return 'پاسخ به %s';
        if ( strpos($text, 'Cancel reply') !== false ) return 'لغو پاسخ';
        if ( $text === 'Reviews' ) return 'دیدگاه‌ها';
        if ( strpos($text, 'Rated %s out of 5') !== false ) return 'امتیاز %s از ۵';
        if ( strpos($text, 'Add a review') !== false ) return 'ثبت دیدگاه';
        if ( strpos($text, 'Your review') !== false ) return 'متن دیدگاه شما';
        if ( $text === 'There are no reviews yet.' ) return 'هنوز دیدگاهی برای این محصول ثبت نشده است.';
        if ( strpos($text, 'Be the first to review') !== false ) return 'اولین نفری باشید که نظر می‌دهید';
        if ( $text === 'Your rating' ) return 'امتیاز شما';
        if ( $text === 'Submit' ) return 'ثبت دیدگاه';

        if ( strpos($text, 'To track your order please enter your Order ID') !== false ) return 'برای پیگیری وضعیت سفارش خود، لطفاً شناسه سفارش را در کادر زیر وارد کرده و روی دکمه پیگیری کلیک کنید.';
        if ( $text === 'Order ID' ) return 'شناسه سفارش';
        if ( $text === 'Billing email' ) return 'ایمیل صورت‌حساب (هنگام خرید)';
        if ( $text === 'Found in your order confirmation email.' ) return 'در ایمیل تایید سفارش شما ارسال شده است.';
        if ( $text === 'Email you used during checkout.' ) return 'آدرس ایمیلی که هنگام ثبت سفارش وارد کرده‌اید.';
        if ( $text === 'Track' ) return 'پیگیری سفارش';

        if ( $text === 'Login' || $text === 'Log in' ) return 'ورود به حساب';
        if ( $text === 'Register' ) return 'ثبت‌نام';
        if ( $text === 'Username or email address' ) return 'شماره موبایل یا ایمیل';
        if ( $text === 'Password' ) return 'رمز عبور';
        if ( $text === 'Remember me' ) return 'مرا به خاطر بسپار';
        if ( $text === 'Lost your password?' ) return 'رمز عبور خود را فراموش کرده‌اید؟';
        if ( strpos($text, 'A link to set a new password') !== false ) return 'لینک تنظیم رمز عبور جدید ایمیل خواهد شد.';
        if ( $text === 'Dashboard' ) return 'پیشخوان';
        if ( $text === 'Orders' ) return 'سفارش‌ها';
        if ( $text === 'Downloads' ) return 'دانلودها';
        if ( $text === 'Addresses' ) return 'آدرس‌ها';
        if ( $text === 'Account details' ) return 'جزئیات حساب';
        if ( $text === 'Logout' || $text === 'Log out' ) return 'خروج از سیستم';
        if ( strpos($text, 'From your account dashboard') !== false ) return 'از طریق این پیشخوان می‌توانید سفارش‌ها را مشاهده و مشخصات خود را ویرایش کنید.';
        if ( $text === 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)' ) return 'سلام %1$s (شما نیستید؟ <a href="%2$s">خارج شوید</a>)';

        if ( $text === 'First name' ) return 'نام';
        if ( $text === 'Last name' ) return 'نام خانوادگی';
        if ( $text === 'Display name' ) return 'نام نمایشی';
        if ( strpos($text, 'This will be how your name will be displayed') !== false ) return 'این نام در حساب کاربری و دیدگاه‌های شما در سایت نمایش داده می‌شود.';
        if ( $text === 'Email address' ) return 'آدرس ایمیل';
        if ( $text === 'Password change' ) return 'تغییر رمز عبور';
        if ( strpos($text, 'Current password') !== false ) return 'رمز عبور فعلی (برای عدم تغییر خالی بگذارید)';
        if ( strpos($text, 'New password (leave') !== false ) return 'رمز عبور جدید (برای عدم تغییر خالی بگذارید)';
        if ( $text === 'Confirm new password' ) return 'تایید رمز عبور جدید';
        if ( $text === 'Save changes' ) return 'ذخیره تغییرات';

        if ( strpos($text, 'The following addresses will be used') !== false ) return 'آدرس‌های زیر به صورت پیش‌فرض در صفحه تسویه حساب استفاده خواهند شد.';
        if ( $text === 'Billing address' ) return 'آدرس صورت‌حساب';
        if ( $text === 'Shipping address' ) return 'آدرس حمل و نقل';
        if ( $text === 'Add' ) return 'افزودن';
        if ( $text === 'Edit' ) return 'ویرایش';
        if ( strpos($text, 'You have not set up this type of address yet') !== false ) return 'شما هنوز این نوع آدرس را ثبت نکرده‌اید.';
        if ( $text === 'No downloads available yet.' ) return 'هیچ فایلی برای دانلود وجود ندارد.';
        if ( $text === 'No order has been made yet.' ) return 'هنوز هیچ سفارشی ثبت نشده است.';
        if ( $text === 'Browse products' ) return 'مشاهده محصولات';
        if ( $text === 'Go to shop' ) return 'رفتن به فروشگاه';
        
        if ( $text === 'Order received' || $text === 'Order received:' ) return 'سفارش شما دریافت شد';
        if ( $text === 'Thank you. Your order has been received.' ) return 'با تشکر، سفارش شما با موفقیت ثبت گردید.';
        if ( $text === 'Order details' ) return 'جزئیات سفارش شما';
        if ( $text === 'Customer details' ) return 'مشخصات خریدار';
        if ( $text === 'Order updates' ) return 'بروزرسانی‌های وضعیت سفارش';
        if ( strpos(strtolower($text), 'was placed on') !== false ) {
            return 'سفارش شماره %1$s در تاریخ %2$s ثبت شده است و در حال حاضر در وضعیت «%3$s» قرار دارد.';
        }
    }
    return $translated_text;
}

/* =========================================================================
   13. DYNAMIC DOM PERSIAN NUMBERS
   ========================================================================= */
add_action('wp_footer', 'razgem_persian_dom_numbers', 99);
function razgem_persian_dom_numbers() {
    ?>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        function convertToPersian(node) {
            if (node.nodeType === 3) { 
                var text = node.nodeValue;
                var persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                var converted = text.replace(/[0-9]/g, function(w) { return persian[w]; });
                if (converted !== text) node.nodeValue = converted;
            } else if (node.nodeType === 1 && node.nodeName !== "SCRIPT" && node.nodeName !== "STYLE" && node.nodeName !== "INPUT") {
                for (var i = 0; i < node.childNodes.length; i++) {
                    convertToPersian(node.childNodes[i]);
                }
            }
        }
        
        const priceSlider = document.querySelector('.price_slider_amount');
        if (priceSlider) convertToPersian(priceSlider);

        if (typeof jQuery !== 'undefined') {
            jQuery(document.body).on('price_slider_updated updated_checkout updated_cart_totals', function() {
                setTimeout(function() {
                    const slider = document.querySelector('.price_slider_amount');
                    if (slider) convertToPersian(slider);
                    const totals = document.querySelector('.cart_totals');
                    if (totals) convertToPersian(totals);
                }, 100);
            });
        }
    });
    </script>
    <?php
}

/* =========================================================================
   14. SHAMSI DATE BRIDGE
   ========================================================================= */
if ( ! function_exists( 'razgem_get_shamsi_date' ) ) {
    function razgem_get_shamsi_date() {
        return get_the_date('j F Y'); 
    }
}

/* =========================================================================
   15. CUSTOM SHOP FILTERS
   ========================================================================= */
add_action( 'woocommerce_product_query', 'razgem_enforce_on_sale_filter' );
function razgem_enforce_on_sale_filter( $q ) {
    if ( ! is_admin() && $q->is_main_query() && isset( $_GET['on_sale'] ) && '1' === $_GET['on_sale'] ) {
        $on_sale_ids = function_exists('wc_get_product_ids_on_sale') ? wc_get_product_ids_on_sale() : array();
        if ( empty( $on_sale_ids ) ) {
            $on_sale_ids = array( 0 );
        }
        $q->set( 'post__in', $on_sale_ids );
    }
}

/* =========================================================================
   16. MOBILE MAGIC BOTTOM APP NAVIGATION
   ========================================================================= */
add_action('wp_footer', 'razgem_magic_bottom_nav');
function razgem_magic_bottom_nav() {
    if ( is_admin() ) return;
    $cart_count = ( function_exists('WC') && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
    
    $active_index = 0; 
    if ( function_exists('is_shop') && (is_shop() || is_product_category()) && !isset($_GET['on_sale']) ) {
        $active_index = 1;
    } elseif ( function_exists('is_cart') && (is_cart() || is_checkout()) ) {
        $active_index = 2;
    } elseif ( isset($_GET['on_sale']) ) {
        $active_index = 3;
    } elseif ( function_exists('is_account_page') && is_account_page() ) {
        $active_index = 4;
    }

    $home_url    = home_url('/');
    $shop_url    = razgem_shop_url();
    $cart_url    = razgem_cart_url();
    $sale_url    = add_query_arg('on_sale', '1', $shop_url);
    $account_url = razgem_account_url();
    $count_display = function_exists('razgem_persian_numbers') ? razgem_persian_numbers((string)$cart_count) : $cart_count;
    ?>
    <nav class="magic-bottom-nav" aria-label="ناوبری سریع موبایل">
        <ul>
            <div class="magic-indicator" style="right: calc(<?php echo ($active_index * 20 + 10); ?>% - 28px);"></div>
            
            <li class="<?php echo $active_index === 0 ? 'active' : ''; ?>">
                <a href="<?php echo esc_url($home_url); ?>" aria-label="صفحه اصلی">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    </span>
                    <span class="text">خانه</span>
                </a>
            </li>
            <li class="<?php echo $active_index === 1 ? 'active' : ''; ?>">
                <a href="<?php echo esc_url($shop_url); ?>" aria-label="فروشگاه و دسته‌بندی زیورآلات">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    </span>
                    <span class="text">دسته‌بندی</span>
                </a>
            </li>
            <li class="magic-nav-cart <?php echo $active_index === 2 ? 'active' : ''; ?>">
                <a href="<?php echo esc_url($cart_url); ?>" id="magicBottomCartTrigger" aria-label="سبد خرید زیورآلات">
                    <span class="icon nav-cart-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <span class="nav-cart-count"><?php echo esc_html($count_display); ?></span>
                    </span>
                    <span class="text">سبد خرید</span>
                </a>
            </li>
            <li class="<?php echo $active_index === 3 ? 'active' : ''; ?>">
                <a href="<?php echo esc_url($sale_url); ?>" aria-label="کالکشن‌های تخفیف‌دار و برگزیده">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    </span>
                    <span class="text">برگزیده‌ها</span>
                </a>
            </li>
            <li class="<?php echo $active_index === 4 ? 'active' : ''; ?>">
                <a href="<?php echo esc_url($account_url); ?>" aria-label="حساب کاربری و پیگیری سفارشات">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </span>
                    <span class="text">پروفایل</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const listItems = document.querySelectorAll('.magic-bottom-nav li');
            const indicator = document.querySelector('.magic-indicator');
            
            listItems.forEach((item, index) => {
                item.addEventListener('click', function(e) {
                    if (item.classList.contains('magic-nav-cart')) {
                        const miniCart = document.getElementById('miniCartDrawer');
                        const overlay = document.getElementById('miniCartOverlay');
                        if (miniCart && overlay) {
                            e.preventDefault();
                            miniCart.classList.add('active');
                            overlay.classList.add('active');
                            document.body.style.overflow = 'hidden';
                            return;
                        }
                    }
                    listItems.forEach(li => li.classList.remove('active'));
                    this.classList.add('active');
                    if (indicator) {
                        indicator.style.right = `calc(${index * 20 + 10}% - 28px)`;
                    }
                });
            });
        });
    </script>
    <?php
}

add_filter( 'woocommerce_add_to_cart_fragments', 'razgem_magic_nav_cart_fragment' );
function razgem_magic_nav_cart_fragment( $fragments ) {
    if ( function_exists('WC') ) {
        $fragments['.nav-cart-count'] = '<span class="nav-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
    }
    return $fragments;
}

/* =========================================================================
   17. NATIVE APP PAGE TRANSITIONS SCRIPT (Disabled to prevent stuck white overlay)
   ========================================================================= */
// Page transition script disabled to fix navigation freeze bug.


/* =========================================================================
   18. AUTO-REDIRECT ORDER PAY PAGE
   ========================================================================= */
add_action( 'wp_footer', 'razgem_auto_redirect_bank_gateway', 999 );
function razgem_auto_redirect_bank_gateway() {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.href.indexOf('order-pay') > -1) {
                const zibalButton = document.querySelector('#place_order, button[name="woocommerce_pay"], input[name="woocommerce_pay"], button[value="پرداخت"], input[value="پرداخت"]');
                if (zibalButton) {
                    const form = zibalButton.closest('form');
                    if (form) {
                        form.style.display = 'none';
                    }
                    document.body.style.overflow = 'hidden';
                    
                    const loader = document.createElement('div');
                    loader.innerHTML = `
                        <div style="position:fixed; top:0; left:0; width:100vw; height:100vh; background:var(--color-bg); z-index:999999; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="var(--color-accent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="animation: spin 1s linear infinite; margin-bottom: 2rem;"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
                            <h2 style="font-family: var(--font-heading); font-size: 1.6rem; color: var(--color-dark); margin-bottom: 0.5rem;">در حال انتقال به درگاه بانکی...</h2>
                            <p style="color: var(--color-muted); font-size: 0.95rem;">لطفاً منتظر بمانید</p>
                        </div>
                        <style>@keyframes spin { 100% { transform: rotate(360deg); } }</style>
                    `;
                    document.body.appendChild(loader);

                    setTimeout(() => {
                        zibalButton.click();
                    }, 500);
                }
            }
        });
    </script>
    <?php
}

/* =========================================================================
   19. CLEAN WOOCOMMERCE CHECKOUT ERRORS
   ========================================================================= */
add_filter( 'woocommerce_checkout_required_field_notice', 'razgem_clean_required_field_error', 10, 2 );
function razgem_clean_required_field_error( $error_message, $field_label ) {
    $clean_label = str_replace( array( 'Billing ', 'Shipping ' ), '', $field_label );
    return sprintf( 'وارد کردن <strong>%s</strong> الزامی است.', $clean_label );
}

/* =========================================================================
   20. MELLIPAYAMAK OTP LOGIN SYSTEM
   ========================================================================= */
add_action('wp_ajax_nopriv_razgem_send_otp', 'razgem_send_otp_handler');
function razgem_send_otp_handler() {
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    if (!preg_match('/^09[0-9]{9}$/', $phone)) {
        wp_send_json_error('شماره موبایل نامعتبر است.');
    }

    $otp_code = wp_rand(10000, 99999);
    set_transient('otp_' . $phone, $otp_code, 120);

    try {
        if (!class_exists('SoapClient')) {
            wp_send_json_error('اکستنشن SOAP روی سرور فعال نیست.');
        }

        ini_set("soap.wsdl_cache_enabled", "0");
        $sms = new SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl", array("encoding" => "UTF-8"));
        
        $data = array(
            "username" => "9192306288",
            "password" => "7f18bfcd-5e3d-4435-8357-4b51eb62c0fa", 
            "text"     => array(strval($otp_code)),
            "to"       => $phone,
            "bodyId"   => 482609
        );
        
        $result = $sms->SendByBaseNumber($data)->SendByBaseNumberResult;

        if (is_numeric($result) && strlen(strval($result)) < 10) {
            wp_send_json_error('خطا از سمت درگاه پیامک. کد خطا: ' . $result);
        }

    } catch (Exception $e) {
        wp_send_json_error('خطای سرور: ' . $e->getMessage());
    }

    wp_send_json_success('کد تایید با موفقیت ارسال شد.');
}

add_action('wp_ajax_login_by_otp', 'razgem_verify_otp_handler');
add_action('wp_ajax_nopriv_razgem_verify_otp', 'razgem_verify_otp_handler');
function razgem_verify_otp_handler() {
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $code  = isset($_POST['code']) ? sanitize_text_field($_POST['code']) : '';

    $saved_code = get_transient('otp_' . $phone);

    if (!$saved_code || $saved_code !== $code) {
        wp_send_json_error('کد وارد شده نامعتبر یا منقضی شده است.');
    }

    delete_transient('otp_' . $phone);

    $user = get_user_by('login', $phone);
    if (!$user) {
        $user_id = wp_create_user($phone, wp_generate_password(16, false));
        $user = get_user_by('id', $user_id);
        update_user_meta($user_id, 'billing_phone', $phone);
    }

    wp_set_current_user($user->ID);
    wp_set_auth_cookie($user->ID, true);

    wp_send_json_success('ورود موفقیت‌آمیز بود.');
}

/* =========================================================================
   21. FRONTEND OTP MODAL & JS LOGIC
   ========================================================================= */
add_action('wp_footer', 'razgem_frontend_otp_modal', 999);
function razgem_frontend_otp_modal() {
    if (is_user_logged_in()) return; 
    ?>
    <div class="otp-overlay" id="otpOverlay"></div>
    <div class="otp-modal" id="otpModal">
        <button class="otp-close" id="otpClose" aria-label="بستن">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        
        <div class="otp-header">
            <h3 class="otp-title">ورود / ثبت‌نام</h3>
            <p class="otp-subtitle" id="otpSubtitle">لطفاً شماره موبایل خود را وارد کنید.</p>
        </div>

        <div class="otp-step active" id="otpStepPhone">
            <input type="tel" id="otpPhoneInput" class="otp-input-main" placeholder="۰۹۱۲۳۴۵۶۷۸۹" dir="ltr" maxlength="11" autocomplete="off">
            <button class="button otp-btn-main" id="btnSendOtp" type="button">دریافت کد تایید</button>
            <p class="otp-msg" id="otpMsgPhone"></p>
        </div>

        <div class="otp-step" id="otpStepCode">
            <div class="otp-digit-group" dir="ltr">
                <input type="tel" class="otp-digit" maxlength="1" autocomplete="off">
                <input type="tel" class="otp-digit" maxlength="1" autocomplete="off">
                <input type="tel" class="otp-digit" maxlength="1" autocomplete="off">
                <input type="tel" class="otp-digit" maxlength="1" autocomplete="off">
                <input type="tel" class="otp-digit" maxlength="1" autocomplete="off">
            </div>
            <button class="button otp-btn-main" id="btnVerifyOtp" type="button">تایید و ورود</button>
            
            <div class="otp-timer-wrap">
                <span id="otpTimerText">ارسال مجدد کد تا <span id="otpCountdown">02:00</span></span>
                <button class="otp-resend-btn" id="btnResendOtp" type="button" style="display:none;">ارسال مجدد کد</button>
            </div>
            <p class="otp-msg" id="otpMsgCode"></p>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const oldForms = document.querySelectorAll('.u-columns.col2-set, form.login, form.register, #customer_login');
        oldForms.forEach(form => {
            form.style.display = 'none'; 
        });

        const myAccountContainer = document.querySelector('.woocommerce-account .woocommerce');
        if (myAccountContainer && !document.querySelector('.woocommerce-MyAccount-navigation')) {
            const loginCard = document.createElement('div');
            loginCard.className = 'app-login-card';
            loginCard.innerHTML = `
                <h2>ورود به گالری رازگِم</h2>
                <p>جهت پیگیری سفارشات و مدیریت حساب، وارد شوید.</p>
                <button class="button open-otp-modal-btn" type="button" style="width:100%; height:52px; font-size:1.05rem;">ورود با شماره موبایل</button>
            `;
            myAccountContainer.prepend(loginCard);
        }

        const overlay = document.getElementById('otpOverlay');
        const modal = document.getElementById('otpModal');
        const closeBtn = document.getElementById('otpClose');

        document.addEventListener('click', (e) => {
            if (e.target.closest('.open-otp-modal-btn') || e.target.closest('.showlogin')) {
                e.preventDefault();
                overlay.classList.add('active');
                modal.classList.add('active');
                setTimeout(() => document.getElementById('otpPhoneInput').focus(), 100);
            }
        });

        closeBtn.addEventListener('click', () => {
            overlay.classList.remove('active');
            modal.classList.remove('active');
        });
        overlay.addEventListener('click', () => closeBtn.click());

        let countdownInterval;
        const ajaxUrl = '<?php echo admin_url("admin-ajax.php"); ?>';
        
        document.getElementById('btnSendOtp').addEventListener('click', function() {
            const phone = document.getElementById('otpPhoneInput').value.trim();
            const msgBox = document.getElementById('otpMsgPhone');
            
            if(!/^09[0-9]{9}$/.test(phone)) {
                msgBox.innerText = 'شماره موبایل وارد شده صحیح نیست.';
                msgBox.classList.add('error');
                return;
            }
            
            this.innerText = 'در حال ارسال...';
            this.style.opacity = '0.7';
            msgBox.innerText = '';

            const formData = new URLSearchParams();
            formData.append('action', 'razgem_send_otp');
            formData.append('phone', phone);

            fetch(ajaxUrl, { method: 'POST', body: formData })
            .then(res => res.json())
            .then(res => {
                if(res.success) {
                    document.getElementById('otpStepPhone').classList.remove('active');
                    document.getElementById('otpStepCode').classList.add('active');
                    document.getElementById('otpSubtitle').innerText = `کد ۵ رقمی به ${phone} پیامک شد.`;
                    startTimer(120);
                    document.querySelector('.otp-digit').focus();
                } else {
                    msgBox.innerText = res.data;
                    msgBox.classList.add('error');
                }
            }).finally(() => {
                this.innerText = 'دریافت کد تایید';
                this.style.opacity = '1';
            });
        });

        const digits = document.querySelectorAll('.otp-digit');
        digits.forEach((digit, index) => {
            digit.addEventListener('input', (e) => {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
                if(e.target.value && index < digits.length - 1) {
                    digits[index + 1].focus();
                }
            });
            digit.addEventListener('keydown', (e) => {
                if(e.key === 'Backspace' && !e.target.value && index > 0) {
                    digits[index - 1].focus();
                } else if(e.key === 'Enter') {
                    document.getElementById('btnVerifyOtp').click();
                }
            });
        });

        document.getElementById('btnVerifyOtp').addEventListener('click', function() {
            const phone = document.getElementById('otpPhoneInput').value.trim();
            let code = '';
            digits.forEach(d => code += d.value);
            const msgBox = document.getElementById('otpMsgCode');

            if(code.length !== 5) {
                msgBox.innerText = 'لطفاً کد ۵ رقمی را کامل وارد کنید.';
                msgBox.classList.add('error');
                return;
            }

            this.innerText = 'در حال بررسی...';
            this.style.opacity = '0.7';
            msgBox.innerText = '';

            const formData = new URLSearchParams();
            formData.append('action', 'razgem_verify_otp');
            formData.append('phone', phone);
            formData.append('code', code);

            fetch(ajaxUrl, { method: 'POST', body: formData })
            .then(res => res.json())
            .then(res => {
                if(res.success) {
                    msgBox.innerText = 'تایید شد! در حال انتقال...';
                    msgBox.classList.remove('error');
                    msgBox.style.color = '#27ae60';
                    setTimeout(() => window.location.reload(), 800);
                } else {
                    msgBox.innerText = res.data;
                    msgBox.classList.add('error');
                    digits.forEach(d => d.value = '');
                    digits[0].focus();
                }
            }).finally(() => {
                this.innerText = 'تایید و ورود';
                this.style.opacity = '1';
            });
        });

        function startTimer(duration) {
            let timer = duration;
            const display = document.getElementById('otpCountdown');
            const textWrap = document.getElementById('otpTimerText');
            const resendBtn = document.getElementById('btnResendOtp');
            
            resendBtn.style.display = 'none';
            textWrap.style.display = 'inline';
            
            clearInterval(countdownInterval);
            countdownInterval = setInterval(() => {
                let minutes = parseInt(timer / 60, 10);
                let seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(countdownInterval);
                    textWrap.style.display = 'none';
                    resendBtn.style.display = 'inline-block';
                }
            }, 1000);
        }

        document.getElementById('btnResendOtp').addEventListener('click', () => {
            document.getElementById('btnSendOtp').click();
        });
    });
    </script>
    <?php
}

/* =========================================================================
   22. CUSTOM ORDER STATUSES (Registered -> Preparing -> Posted -> Completed)
   ========================================================================= */
add_action( 'init', 'razgem_register_custom_order_statuses' );
function razgem_register_custom_order_statuses() {
    register_post_status( 'wc-preparing', array(
        'label'                     => 'در حال آماده سازی',
        'public'                    => true,
        'show_in_admin_status_list' => true,
        'show_in_admin_all_list'    => true,
        'exclude_from_search'       => false,
        'label_count'               => _n_noop( 'در حال آماده سازی <span class="count">(%s)</span>', 'در حال آماده سازی <span class="count">(%s)</span>' )
    ) );

    register_post_status( 'wc-posted', array(
        'label'                     => 'تحویل به پست',
        'public'                    => true,
        'show_in_admin_status_list' => true,
        'show_in_admin_all_list'    => true,
        'exclude_from_search'       => false,
        'label_count'               => _n_noop( 'تحویل به پست <span class="count">(%s)</span>', 'تحویل به پست <span class="count">(%s)</span>' )
    ) );
}

add_filter( 'wc_order_statuses', 'razgem_custom_order_statuses', 9999 );
function razgem_custom_order_statuses( $order_statuses ) {
    $order_statuses['wc-processing'] = 'ثبت شده';
    $order_statuses['wc-preparing']  = 'در حال آماده سازی';
    $order_statuses['wc-posted']     = 'تحویل به پست';
    $order_statuses['wc-completed']  = 'تکمیل شده'; 
    return $order_statuses;
}

/* =========================================================================
   23. POST TRACKING CODE INJECTION (Admin & Frontend)
   ========================================================================= */
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'razgem_add_tracking_code_admin', 10, 1 );
function razgem_add_tracking_code_admin( $order ) {
    $tracking_code = $order->get_meta('_post_tracking_code');
    echo '<div class="edit_address" style="margin-top:20px; border-top:1px solid #eee; padding-top:10px;">';
    woocommerce_wp_text_input( array(
        'id'            => '_post_tracking_code',
        'label'         => 'کد رهگیری پستی (جهت نمایش به مشتری):',
        'wrapper_class' => 'form-field-wide',
        'value'         => $tracking_code
    ) );
    echo '</div>';
}

add_action( 'woocommerce_process_shop_order_meta', 'razgem_save_tracking_code_admin', 10, 2 );
function razgem_save_tracking_code_admin( $order_id, $post ) {
    $order = wc_get_order( $order_id );
    if ( isset( $_POST['_post_tracking_code'] ) ) {
        $order->update_meta_data( '_post_tracking_code', sanitize_text_field( $_POST['_post_tracking_code'] ) );
        $order->save();
    }
}

add_action( 'woocommerce_order_details_after_order_table', 'razgem_display_tracking_code_frontend', 10, 1 );
function razgem_display_tracking_code_frontend( $order ) {
    $tracking_code = $order->get_meta('_post_tracking_code');
    if ( !empty($tracking_code) ) {
        echo '<div class="razgem-tracking-box" style="background:var(--color-panel); border:1px solid var(--color-gold); padding:2rem; border-radius:var(--radius-md); text-align:center; margin-bottom:2.5rem; box-shadow:0 5px 15px rgba(200,167,107,0.1);">';
        echo '<h3 style="font-family:var(--font-heading); color:var(--color-dark); margin-bottom:0.8rem; font-size:1.4rem;">کد رهگیری مرسوله پستی شما</h3>';
        echo '<p style="font-size:1.3rem; font-weight:800; color:var(--color-accent); letter-spacing:3px; margin:0 0 1rem 0;">' . esc_html($tracking_code) . '</p>';
        echo '<a href="https://tracking.post.ir/?id=' . esc_attr($tracking_code) . '" target="_blank" style="display:inline-flex; align-items:center; justify-content:center; padding:0.8rem 2rem; background:var(--color-dark); color:#fff; border-radius:var(--radius-sm); font-size:0.95rem; font-weight:700; text-decoration:none;">پیگیری در سامانه ملی پست</a>';
        echo '</div>';
    }
}

/* =========================================================================
   24. AGGRESSIVE CLEANUP OF CORRUPTED DATES & NOTES
   ========================================================================= */
add_filter('woocommerce_order_note_text', 'razgem_nuke_corrupted_dates', 999, 1);
function razgem_nuke_corrupted_dates($note) {
    $note = preg_replace('/[fF]\\\\?\d+\s*/u', '', $note);
    $note = preg_replace('/(۱۴۰[۰-۹])(\s*،\s*|\s*\|\s*|\s*,\s*)\1/u', '$1', $note);
    $note = str_replace('، ۱۴۰۵', '', $note);
    
    $note = str_replace('کد رهگیری :', 'رسید تراکنش بانکی:', $note);
    $note = str_replace('کد رهگیری', 'شماره ارجاع بانک', $note);
    return $note;
}

/* =========================================================================
   25. FIX WOOCOMMERCE ADMIN DATEPICKER & HOUR/MINUTE TRANSLATION BUG
   ========================================================================= */
add_filter('gettext', 'razgem_fix_admin_time_placeholders', 9999, 3);
function razgem_fix_admin_time_placeholders($translated, $text, $domain) {
    if (is_admin()) {
        if ($text === 'h' || $text === 'H') {
            return 'ساعت';
        }
        if ($text === 'm' || $text === 'M') {
            return 'دقیقه';
        }
    }
    return $translated;
}

add_action('admin_enqueue_scripts', 'razgem_disable_parsidate_on_wc_orders', 9999);
function razgem_disable_parsidate_on_wc_orders() {
    if (isset($_GET['page']) && $_GET['page'] === 'wc-orders') {
        wp_dequeue_script('wpp-datepicker');
        wp_dequeue_script('persian-datepicker');
        wp_deregister_script('persian-datepicker');
    }
}

add_action('admin_init', 'razgem_bypass_parsidate_order_dates', 1);
function razgem_bypass_parsidate_order_dates() {
    if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'wc-orders') {
        remove_filter('get_post_time', 'wpp_get_post_time', 10);
        remove_filter('get_the_date', 'wpp_get_the_date', 10);
        remove_filter('get_post_modified_time', 'wpp_get_post_modified_time', 10);
    }
}

/* =========================================================================
   27. VARIATION SWATCHES BRIDGE
   ========================================================================= */
add_action( 'wp_footer', 'razgem_swatches_script', 999 );
function razgem_swatches_script() {
    if ( ! is_product() ) return;
    ?>
    <script>
    jQuery(document).ready(function($) {
        function renderSwatches() {
            const $form = $('form.variations_form');
            if (!$form.length) return;

            const normalizeStr = function(str) {
                if (!str) return '';
                return String(str).toLowerCase().replace(/[\u200c\s\-_]+/g, '');
            };

            const colorMap = {
                // Grays & Blacks & Whites
                'مشکی': '#111111', 'سیاه': '#111111', 'زغالی': '#2b2b2b', 'black': '#111111', 'charcoal': '#2b2b2b',
                'سفید': '#ffffff', 'white': '#ffffff',
                'استخوانی': '#f9f6ee', 'شیری': '#f5f2eb', 'صدفی': '#f7f5f0', 'ivory': '#f9f6ee',
                'طوسی روشن': '#d3d5d9', 'خاکستری روشن': '#d3d5d9', 'light grey': '#d3d5d9', 'light gray': '#d3d5d9',
                'طوسی تیره': '#4a4e54', 'خاکستری تیره': '#4a4e54', 'dark grey': '#4a4e54', 'dark gray': '#4a4e54',
                'دودی': '#3a3d40', 'نوک مدادی': '#383b3e',
                'طوسی': '#8e9297', 'خاکستری': '#8e9297', 'grey': '#8e9297', 'gray': '#8e9297',
                
                // Metallics & Lux
                'رزگلد': '#b76e79', 'رز گلد': '#b76e79', 'rosegold': '#b76e79',
                'طلایی روشن': '#f3e5ab', 'طلایی مات': '#c5a059',
                'طلایی': '#d4af37', 'طلا': '#d4af37', 'gold': '#d4af37',
                'نقره‌ای': '#c0c0c0', 'نقره ای': '#c0c0c0', 'نقرهای': '#c0c0c0', 'نقره': '#c0c0c0', 'silver': '#c0c0c0',
                'برنز': '#cd7f32', 'bronze': '#cd7f32',
                'برنجی': '#c5a059', 'brass': '#c5a059',
                'مسی': '#b87333', 'copper': '#b87333',

                // Creams & Woods
                'کرم روشن': '#fdf8ec', 'کرم': '#e8dcc4', 'بژ': '#f5f5dc', 'cream': '#e8dcc4', 'beige': '#f5f5dc',
                'نسکافه‌ای': '#9e7b66', 'نسکافه ای': '#9e7b66', 'نسکافه': '#9e7b66', 'nescafe': '#9e7b66',
                'چوبی روشن': '#d2b48c', 'چوبی تیره': '#4a2e16', 'چوبی': '#8b5a2b', 'wood': '#8b5a2b',
                'گردویی': '#5c4033', 'بلوطی': '#804000', 'شکلاتی': '#4a2c11', 'chocolate': '#4a2c11',
                'قهوه‌ای روشن': '#966f33', 'قهوه‌ای تیره': '#3b240e',
                'قهوه‌ای': '#6f4e37', 'قهوهای': '#6f4e37', 'brown': '#6f4e37',
                'کاهی': '#e6d690', 'کتانی': '#d9d0c1',

                // Yellows, Oranges & Corals
                'خردلی': '#e1ad01', 'mustard': '#e1ad01',
                'لیمویی': '#fff44f', 'lemon': '#fff44f',
                'زرد': '#ffd700', 'yellow': '#ffd700',
                'نارنجی': '#e67e22', 'orange': '#e67e22',
                'آجری': '#d35400', 'مرجانی': '#ff7f50', 'coral': '#ff7f50',

                // Reds & Pinks
                'قرمز': '#e74c3c', 'سرخ': '#e74c3c', 'red': '#e74c3c',
                'زرشکی': '#6b1d2f', 'عنابی': '#722f37', 'burgundy': '#6b1d2f', 'maroon': '#800000',
                'صورتی روشن': '#ffc0cb', 'صورتی': '#ffb6c1', 'pink': '#ffb6c1',
                'کالباسی': '#e0a0a0', 'ارغوانی': '#800080',

                // Blues & Turquoises
                'آبی آسمانی': '#87ceeb', 'آبی روشن': '#87ceeb', 'light blue': '#87ceeb',
                'آبی کاربنی': '#4169e1', 'آبی تیره': '#000080', 'royal blue': '#4169e1',
                'سرمه‌ای': '#1b2a4a', 'سرمهای': '#1b2a4a', 'navy': '#1b2a4a',
                'فیروزه‌ای': '#40e0d0', 'فیروزه ای': '#40e0d0', 'turquoise': '#40e0d0',
                'آبی': '#3498db', 'blue': '#3498db',

                // Greens & Olives
                'سبز روشن': '#90ee90', 'پسته‌ای': '#93c572', 'پسته ای': '#93c572', 'نعنایی': '#98ff98', 'mint': '#98ff98',
                'زیتونی': '#556b2f', 'olive': '#556b2f',
                'سبز تیره': '#004b23', 'یشمی': '#004b23', 'jade': '#004b23',
                'سبز': '#2ecc71', 'green': '#2ecc71',

                // Purples
                'یاسی': '#c8a2c8', 'lilac': '#c8a2c8',
                'بادمجانی': '#4a0e4e', 'eggplant': '#4a0e4e',
                'بنفش': '#8e44ad', 'purple': '#8e44ad',

                // Translucent
                'شیشه‌ای': 'linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(220,240,255,0.7) 100%)',
                'شیشهای': 'linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(220,240,255,0.7) 100%)',
                'بی‌رنگ': 'linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(220,240,255,0.7) 100%)',
                'شفاف': 'linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(220,240,255,0.7) 100%)'
            };

            const sortedKeys = Object.keys(colorMap).sort((a, b) => b.length - a.length);

            const findSingleColor = function(str) {
                if (!str) return null;
                const norm = normalizeStr(str);
                for (let i = 0; i < sortedKeys.length; i++) {
                    const k = sortedKeys[i];
                    if (norm.includes(normalizeStr(k))) {
                        return colorMap[k];
                    }
                }
                return null;
            };

            const getSwatchBgStyle = function(text, val) {
                const parts = text.split(/[\/و\-\+]/).map(p => p.trim()).filter(Boolean);
                if (parts.length >= 2) {
                    const c1 = findSingleColor(parts[0]);
                    const c2 = findSingleColor(parts[1]);
                    if (c1 && c2) {
                        const bg1 = c1.startsWith('linear') ? '#ffffff' : c1;
                        const bg2 = c2.startsWith('linear') ? '#ffffff' : c2;
                        return { isGradient: true, bg: `linear-gradient(135deg, ${bg1} 50%, ${bg2} 50%)` };
                    }
                }
                const single = findSingleColor(text) || findSingleColor(val);
                if (single) {
                    if (single.startsWith('linear')) {
                        return { isGradient: true, bg: single };
                    }
                    return { isGradient: false, bg: single };
                }
                return null;
            };

            $form.find('.variations select').each(function() {
                const $select = $(this);
                $select.hide().css({'display': 'none', 'opacity': '0', 'position': 'absolute', 'pointer-events': 'none', 'visibility': 'hidden'}).attr('aria-hidden', 'true');

                let $wrapper = $select.next('.razgem-swatch-wrapper');
                if (!$wrapper.length) {
                    $wrapper = $('<div class="razgem-swatch-wrapper"></div>');
                    $select.after($wrapper);
                }

                const name = ($select.attr('name') || '').toLowerCase();
                const labelText = ($select.closest('tr').find('label').text() || '').toLowerCase();
                const isColorAttr = name.includes('color') || name.includes('رنگ') || labelText.includes('رنگ') || labelText.includes('color');
                const currentVal = $select.val();

                const validOpts = $select.find('option').filter(function() { return $(this).val(); });
                if (validOpts.length > 3) {
                    $wrapper.addClass('swatch-compact-many');
                } else {
                    $wrapper.removeClass('swatch-compact-many');
                }

                validOpts.each(function() {
                    const val = $(this).val();
                    if (!val) return;

                    const text = $(this).text().trim();
                    let $swatch = $wrapper.find(`[data-value="${val}"]`);

                    if (!$swatch.length) {
                        const colorStyle = getSwatchBgStyle(text, val);

                        $swatch = $('<div></div>').attr('data-value', val);
                        if (isColorAttr || colorStyle) {
                            $swatch.addClass('swatch-color-circle').attr('title', text);
                            if (colorStyle) {
                                if (colorStyle.isGradient) {
                                    $swatch.css('background', colorStyle.bg);
                                } else {
                                    $swatch.css('background-color', colorStyle.bg);
                                    if (colorStyle.bg.toLowerCase() === '#ffffff' || colorStyle.bg.toLowerCase() === '#f9f6ee' || colorStyle.bg.toLowerCase() === '#fdf8ec') {
                                        $swatch.addClass('swatch-white-circle').css('border', '2px solid #ccc');
                                    }
                                }
                            } else {
                                $swatch.css('background-color', '#888888');
                            }
                        } else {
                            $swatch.addClass('swatch-text-pill').text(text);
                        }

                        $swatch.on('click', function(e) {
                            e.preventDefault();
                            $wrapper.removeClass('swatch-error-highlight');

                            if ($(this).hasClass('active')) {
                                $(this).removeClass('active');
                                $select.val('').trigger('change');
                            } else {
                                $wrapper.find('.swatch-color-circle, .swatch-text-pill').removeClass('active');
                                $(this).addClass('active');
                                $select.val(val).trigger('change');
                            }

                            $form.trigger('woocommerce_variation_has_changed');
                            $form.trigger('check_variations');
                        });

                        $wrapper.append($swatch);
                    }

                    if (currentVal === val) {
                        $swatch.addClass('active');
                    } else {
                        $swatch.removeClass('active');
                    }

                    // Check stock status for this specific option
                    const productVariations = $form.data('product_variations') || [];
                    let isOptionInStock = true;
                    if (Array.isArray(productVariations) && productVariations.length) {
                        const attrName = $select.attr('name');
                        const matchingVars = productVariations.filter(function(v) {
                            return v.attributes && (v.attributes[attrName] === val || v.attributes[attrName] === '');
                        });
                        if (matchingVars.length > 0) {
                            isOptionInStock = matchingVars.some(function(v) { return v.is_in_stock; });
                        }
                    }

                    if (!isOptionInStock) {
                        $swatch.addClass('swatch-outofstock').attr('title', text + ' (ناموجود)');
                    } else {
                        $swatch.removeClass('swatch-outofstock');
                    }
                });
            });

            // Store original main price HTML for reset
            const $mainPriceBox = $('.product-price-box');
            if ($mainPriceBox.length && !$mainPriceBox.data('original-price')) {
                $mainPriceBox.data('original-price', $mainPriceBox.html());
            }

            $form.off('found_variation.golkhane').on('found_variation.golkhane', function(e, variation) {
                const $stickyPrice = $('.sticky-price');
                const $mobileBuyBtn = $('#triggerMobileBuy');
                const $submitBtn = $form.find('.single_add_to_cart_button');

                if (variation) {
                    if (!variation.is_in_stock) {
                        if ($mainPriceBox.length) {
                            $mainPriceBox.html('<span class="price-outofstock">ناموجود</span>');
                        }
                        if ($stickyPrice.length) {
                            $stickyPrice.html('<span class="price-outofstock">ناموجود</span>');
                        }
                        if ($mobileBuyBtn.length) {
                            $mobileBuyBtn.text('ناموجود').addClass('disabled').prop('disabled', true);
                        }
                        if ($submitBtn.length) {
                            $submitBtn.text('ناموجود').addClass('disabled').prop('disabled', true);
                        }
                    } else {
                        if (variation.price_html && $mainPriceBox.length) {
                            $mainPriceBox.html(variation.price_html);
                        }
                        if (variation.price_html && $stickyPrice.length) {
                            $stickyPrice.html(variation.price_html);
                        }
                        if ($mobileBuyBtn.length) {
                            $mobileBuyBtn.text('افزودن به سبد خرید').removeClass('disabled').prop('disabled', false);
                        }
                        if ($submitBtn.length) {
                            $submitBtn.text('افزودن به سبد خرید').removeClass('disabled').prop('disabled', false);
                        }
                    }

                    // Update Variation Image on Single Product & Lightbox
                    if (variation.image && (variation.image.full_src || variation.image.src)) {
                        const newImgUrl = variation.image.full_src || variation.image.src;
                        const $mainImg = $('#mainProductImage');
                        if ($mainImg.length) {
                            $mainImg.css('opacity', '0.4');
                            $mainImg.attr('src', newImgUrl);
                            setTimeout(function() { $mainImg.css('opacity', '1'); }, 150);
                        }
                        $('.sticky-buy-info img').attr('src', newImgUrl);
                        if (window.updateLightboxVariationImage) {
                            window.updateLightboxVariationImage(newImgUrl);
                        }
                    }
                }
            });

            $form.off('reset_data.golkhane').on('reset_data.golkhane', function() {
                $('.swatch-color-circle, .swatch-text-pill').removeClass('active');
                $('.razgem-swatch-wrapper').removeClass('swatch-error-highlight');
                if ($mainPriceBox.length && $mainPriceBox.data('original-price')) {
                    $mainPriceBox.html($mainPriceBox.data('original-price'));
                }
                const $stickyPrice = $('.sticky-price');
                if ($stickyPrice.length && $mainPriceBox.data('original-price')) {
                    $stickyPrice.html($mainPriceBox.data('original-price'));
                }
                const $mobileBuyBtn = $('#triggerMobileBuy');
                if ($mobileBuyBtn.length) {
                    $mobileBuyBtn.text('افزودن به سبد خرید').removeClass('disabled').prop('disabled', false);
                }
                const $submitBtn = $form.find('.single_add_to_cart_button');
                if ($submitBtn.length) {
                    $submitBtn.text('افزودن به سبد خرید').removeClass('disabled').prop('disabled', false);
                }
                const $mainImg = $('#mainProductImage');
                if ($mainImg.length && $mainImg.data('original-src')) {
                    const origSrc = $mainImg.data('original-src');
                    $mainImg.attr('src', origSrc);
                    $('.sticky-buy-info img').attr('src', origSrc);
                    if (window.resetLightboxVariationImage) {
                        window.resetLightboxVariationImage();
                    }
                }
            });
        }

        renderSwatches();
        setTimeout(renderSwatches, 150);
        setTimeout(renderSwatches, 500);
        setTimeout(renderSwatches, 1000);
        $(window).on('load', renderSwatches);
        $(document).on('woocommerce_variation_has_changed check_variations wc_variation_form', renderSwatches);
    });
    </script>
    <?php
}

/* =========================================================================
   28. AJAX MORPH CART HANDLER FOR VARIABLE & SIMPLE PRODUCTS
   ========================================================================= */
add_action( 'wp_ajax_update_morph_cart', 'razgem_update_morph_cart_ajax' );
add_action( 'wp_ajax_nopriv_update_morph_cart', 'razgem_update_morph_cart_ajax' );
function razgem_update_morph_cart_ajax() {
    if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
        wp_send_json_error( array( 'message' => 'ووکامرس فعال نیست.' ) );
    }

    $product_id   = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
    $variation_id = isset( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : 0;
    $qty          = isset( $_POST['qty'] ) ? intval( $_POST['qty'] ) : 1;
    $is_check     = ! empty( $_POST['check_only'] );

    if ( ! $product_id && ! $variation_id ) {
        wp_send_json_error( array( 'message' => 'شناسه محصول معتبر نیست.' ) );
    }

    // Collect variations if any
    $variations = array();
    foreach ( $_POST as $key => $value ) {
        if ( strpos( $key, 'attribute_' ) === 0 ) {
            $variations[ sanitize_title( $key ) ] = sanitize_text_field( wp_unslash( $value ) );
        }
    }

    // Find existing item key in cart
    $cart_item_key = false;
    $existing_qty  = 0;
    foreach ( WC()->cart->get_cart() as $key => $item ) {
        if ( $variation_id > 0 ) {
            if ( isset( $item['variation_id'] ) && $item['variation_id'] == $variation_id ) {
                $cart_item_key = $key;
                $existing_qty  = $item['quantity'];
                break;
            }
        } else {
            if ( $item['product_id'] == $product_id && empty( $item['variation_id'] ) ) {
                $cart_item_key = $key;
                $existing_qty  = $item['quantity'];
                break;
            }
        }
    }

    if ( $is_check ) {
        wp_send_json_success( array(
            'in_cart_qty' => $existing_qty,
            'cart_count'  => WC()->cart->get_cart_contents_count()
        ) );
    }

    if ( $qty > 0 ) {
        if ( $cart_item_key ) {
            WC()->cart->set_quantity( $cart_item_key, $qty, true );
        } else {
            $cart_item_key = WC()->cart->add_to_cart( $product_id, $qty, $variation_id, $variations );
        }
    } else {
        if ( $cart_item_key ) {
            WC()->cart->remove_cart_item( $cart_item_key );
            $cart_item_key = false;
        }
    }

    WC()->cart->calculate_totals();

    ob_start();
    woocommerce_mini_cart();
    $mini_cart_html = ob_get_clean();

    $cart_count = WC()->cart->get_cart_contents_count();

    wp_send_json_success( array(
        'cart_count'    => $cart_count,
        'cart_item_key' => $cart_item_key,
        'qty'           => $qty,
        'fragments'     => array(
            'span.cart-count' => '<span class="cart-count">' . esc_html( $cart_count ) . '</span>',
            '.nav-cart-count' => '<span class="nav-cart-count">' . esc_html( $cart_count ) . '</span>',
            'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart_html . '</div>',
        )
    ) );
}

/* =========================================================================
   29. FREE SHIPPING PROGRESS BAR & MINI CART QTY CONTROLS
   ========================================================================= */
add_action( 'woocommerce_before_mini_cart', 'razgem_render_free_shipping_bar' );
function razgem_render_free_shipping_bar() {
    $threshold = (int) get_theme_mod('free_shipping_min_amount', 3000000);
    if ( $threshold <= 0 ) $threshold = 3000000;
    $cart_subtotal = WC()->cart->get_subtotal();

    $percent = min(100, round(($cart_subtotal / $threshold) * 100));
    $remaining = max(0, $threshold - $cart_subtotal);

    ?>
    <div class="free-shipping-bar-wrapper">
        <?php if ($remaining > 0) : ?>
            <p class="fs-text">فقط <strong><?php echo wc_price($remaining); ?></strong> دیگر تا <span class="fs-highlight">ارسال رایگان</span> سفارش!</p>
        <?php else : ?>
            <p class="fs-text fs-success">تبریک! سفارش شما شامل <strong>ارسال رایگان</strong> گردید 🎉</p>
        <?php endif; ?>
        <div class="fs-progress-bg">
            <div class="fs-progress-fill" style="width: <?php echo $percent; ?>%;"></div>
        </div>
    </div>
    <?php
}

add_filter( 'woocommerce_widget_cart_item_quantity', 'razgem_mini_cart_item_qty_controls', 10, 3 );
function razgem_mini_cart_item_qty_controls( $html, $cart_item, $cart_item_key ) {
    $p_id = $cart_item['product_id'];
    $v_id = isset($cart_item['variation_id']) ? $cart_item['variation_id'] : 0;
    $qty  = $cart_item['quantity'];

    $controls = '<div class="mini-cart-qty-controls">' .
        '<button type="button" class="mini-cart-qty-btn minus" data-product-id="' . esc_attr($p_id) . '" data-variation-id="' . esc_attr($v_id) . '" data-current-qty="' . esc_attr($qty) . '">-</button>' .
        '<span class="mini-cart-qty-val">' . esc_html($qty) . '</span>' .
        '<button type="button" class="mini-cart-qty-btn plus" data-product-id="' . esc_attr($p_id) . '" data-variation-id="' . esc_attr($v_id) . '" data-current-qty="' . esc_attr($qty) . '">+</button>' .
        '</div>';

    return '<span class="quantity">' . $cart_item['data']->get_price_html() . ' &times; ' . $controls . '</span>';
}

/* =========================================================================
   36. STRUCTURED DATA (JSON-LD SCHEMAS FOR SEO & GOOGLE RICH RESULTS)
   ========================================================================= */
function razgem_output_structured_data() {
    $site_url  = home_url('/');
    $site_name = 'گالری طلا و جواهرات رازگِم';
    $logo_url  = get_template_directory_uri() . '/assets/images/Razgem-Logo.png';
    $phone     = get_theme_mod('contact_phone', '۰۲۱-۹۱۰۰XXXX');
    $address   = get_theme_mod('contact_address', 'تهران، نیاوران، خیابان عمار، پلاک ۱۲');

    $social_links = array_filter(array(
        get_theme_mod('social_instagram', 'https://instagram.com/razgem.ir'),
        get_theme_mod('social_telegram', 'https://t.me/razgem'),
        get_theme_mod('social_whatsapp', 'https://wa.me/98912XXXXXXX'),
    ));

    // 1. JewelryStore & Organization Schema (T028 / FR-009)
    $store_schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'JewelryStore',
        '@id'             => $site_url . '#jewelrystore',
        'name'            => $site_name,
        'alternateName'   => 'RazGem Luxury Handcrafted Jewelry',
        'url'             => $site_url,
        'logo'            => $logo_url,
        'image'           => $logo_url,
        'description'     => 'گالری طلا و جواهرات دست‌ساز رازگِم؛ طراحی و ساخت زیورآلات فاخر طلا، مروارید باروک و سنگ‌های قیمتی اصیل.',
        'priceRange'      => '$$$',
        'currenciesAccepted' => 'IRT, IRR',
        'paymentAccepted' => 'شاپرک، کارت‌های عضو شبکه شتاب',
        'telephone'       => $phone,
        'email'           => get_theme_mod('contact_email', 'info@razgem.ir'),
        'address'         => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => $address,
            'addressLocality' => 'تهران',
            'addressRegion'   => 'تهران',
            'addressCountry'  => 'IR'
        ),
        'openingHoursSpecification' => array(
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => array('Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'),
            'opens'     => '10:00',
            'closes'    => '22:00'
        ),
        'sameAs'          => array_values($social_links)
    );

    // 2. WebSite Schema with SearchAction
    $website_schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'WebSite',
        '@id'             => $site_url . '#website',
        'name'            => $site_name,
        'url'             => $site_url,
        'potentialAction' => array(
            '@type'       => 'SearchAction',
            'target'      => $site_url . '?s={search_term_string}&post_type=product',
            'query-input' => 'required name=search_term_string'
        )
    );

    echo '<script type="application/ld+json">' . wp_json_encode($store_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
    echo '<script type="application/ld+json">' . wp_json_encode($website_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";

    // 3. BreadcrumbList Schema (T027 / FR-009)
    $breadcrumb_items = array();
    $breadcrumb_items[] = array(
        '@type'    => 'ListItem',
        'position' => 1,
        'name'     => 'خانه',
        'item'     => $site_url
    );

    $position = 2;
    if ( function_exists('is_shop') && is_shop() ) {
        $breadcrumb_items[] = array(
            '@type'    => 'ListItem',
            'position' => $position,
            'name'     => 'فروشگاه زیورآلات',
            'item'     => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : $site_url . 'shop'
        );
    } elseif ( is_singular('product') ) {
        global $product;
        $shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : $site_url . 'shop';
        $breadcrumb_items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => 'فروشگاه زیورآلات',
            'item'     => $shop_url
        );

        if ( is_a($product, 'WC_Product') ) {
            $terms = get_the_terms($product->get_id(), 'product_cat');
            if ( $terms && ! is_wp_error($terms) ) {
                $term = reset($terms);
                $breadcrumb_items[] = array(
                    '@type'    => 'ListItem',
                    'position' => $position++,
                    'name'     => $term->name,
                    'item'     => get_term_link($term)
                );
            }

            $breadcrumb_items[] = array(
                '@type'    => 'ListItem',
                'position' => $position,
                'name'     => $product->get_name(),
                'item'     => get_permalink($product->get_id())
            );
        }
    }

    if ( count($breadcrumb_items) > 1 ) {
        $breadcrumb_schema = array(
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $breadcrumb_items
        );
        echo '<script type="application/ld+json">' . wp_json_encode($breadcrumb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
    }

    // 4. Product Schema (Single Product Page) (T027 / FR-009)
    if ( is_singular('product') ) {
        global $product;
        if ( is_a($product, 'WC_Product') ) {
            $product_id   = $product->get_id();
            $thumb_id     = get_post_thumbnail_id($product_id);
            $image_url    = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : $logo_url;
            $description  = has_excerpt($product_id) ? wp_strip_all_tags(get_the_excerpt($product_id)) : wp_strip_all_tags(wp_trim_words(get_the_content(), 30));
            if ( empty($description) ) {
                $description = 'زیورآلات دست‌ساز فاخر طلا و مروارید طبیعی از گالری رازگِم با ضمانت اصالت و شناسنامه رسمی.';
            }

            $product_schema = array(
                '@context'    => 'https://schema.org',
                '@type'       => 'Product',
                'name'        => $product->get_name(),
                'image'       => $image_url,
                'description' => $description,
                'sku'         => $product->get_sku() ? $product->get_sku() : 'RAZGEM-' . $product_id,
                'category'    => 'زیورآلات دست‌ساز و طلا',
                'brand'       => array(
                    '@type' => 'Brand',
                    'name'  => 'گالری رازگِم (RazGem)'
                ),
                'offers'      => array(
                    '@type'         => 'Offer',
                    'url'           => get_permalink($product_id),
                    'priceCurrency' => 'IRT',
                    'price'         => $product->get_price(),
                    'itemCondition' => 'https://schema.org/NewCondition',
                    'availability'  => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                    'priceValidUntil' => date('Y-12-31', strtotime('+1 year')),
                    'seller'        => array(
                        '@type' => 'JewelryStore',
                        'name'  => 'گالری رازگِم'
                    )
                )
            );

            echo '<script type="application/ld+json">' . wp_json_encode($product_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
        }
    }
}
function razgem_json_ld_schema() {
    razgem_output_structured_data();
}
add_action('wp_head', 'razgem_output_structured_data', 5);

/* =========================================================================
   37. DYNAMIC ROBOTS.TXT & SITEMAP DECLARATION
   ========================================================================= */
add_filter( 'robots_txt', 'razgem_custom_robots_txt', 99, 2 );
function razgem_custom_robots_txt( $output, $public ) {
    $rules  = "User-agent: *\n";
    $rules .= "Disallow: /wp-admin/\n";
    $rules .= "Disallow: /cart/\n";
    $rules .= "Disallow: /checkout/\n";
    $rules .= "Disallow: /my-account/\n";
    $rules .= "Disallow: /*?add-to-cart=*\n";
    $rules .= "Allow: /wp-admin/admin-ajax.php\n\n";
    $rules .= "Sitemap: " . esc_url( home_url( '/wp-sitemap.xml' ) ) . "\n";
    $rules .= "Sitemap: " . esc_url( home_url( '/sitemap_index.xml' ) ) . "\n";

    return $rules;
}

/* =========================================================================
   38. PERFORMANCE & LIGHTHOUSE BOOST ENGINE
   ========================================================================= */

// A. Defer Non-Critical JavaScript to Eliminate Render-Blocking Penalty
add_filter( 'script_loader_tag', 'razgem_defer_scripts', 10, 3 );
function razgem_defer_scripts( $tag, $handle, $src ) {
    if ( is_admin() || empty($src) ) return $tag;

    $defer_handles = array(
        'gsap', 'gsap-scroll', 'razgem-main', 'woocommerce', 
        'wc-cart-fragments', 'wc-add-to-cart', 'wc-single-product'
    );

    if ( in_array($handle, $defer_handles) || strpos($handle, 'golkhane') !== false ) {
        return str_replace( ' src=', ' defer src=', $tag );
    }
    return $tag;
}

// B. Smart Image Lazy-Loading & Async Decoding
add_filter( 'wp_get_attachment_image_attributes', 'razgem_lazy_load_images', 10, 3 );
function razgem_lazy_load_images( $attr, $attachment, $size ) {
    if ( ! is_admin() ) {
        $attr['loading']  = 'lazy';
        $attr['decoding'] = 'async';
    }
    return $attr;
}

// C. LCP Image Priority (High Priority for Single Product & Hero Main Image)
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'razgem_lcp_image_priority', 10, 2 );
function razgem_lcp_image_priority( $html, $attachment_id ) {
    if ( ! is_admin() ) {
        $html = str_replace( 'loading="lazy"', 'loading="eager" fetchpriority="high"', $html );
    }
    return $html;
}

// D. Strip WP Emoji Bloat & Unused Embeds
add_action( 'init', 'razgem_disable_wp_bloat' );
function razgem_disable_wp_bloat() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}

add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' );
    wp_dequeue_style( 'global-styles' );
}, 100 );

/* =========================================================================
   39. SEO HOMEPAGE VS SHOP PAGE TITLE DISTINCTION
   ========================================================================= */
add_filter( 'document_title_parts', 'razgem_custom_seo_titles', 999 );
function razgem_custom_seo_titles( $title ) {
    if ( is_front_page() ) {
        $title['title']   = 'گالری طلا و جواهرات دست‌ساز رازگِم';
        $title['tagline'] = 'خرید آنلاین خاص‌ترین زیورآلات طلا، مروارید باروک و سنگ‌های قیمتی دست‌ساز';
    } elseif ( function_exists( 'is_shop' ) && is_shop() ) {
        $title['title']   = 'فروشگاه و کالکشن طلا و جواهرات رازگِم';
        $title['site']    = 'گالری رازگِم';
    }
    return $title;
}

/* =========================================================================
   40. AUTO-POPULATE WOOCOMMERCE COLOR ATTRIBUTE TERMS (PA_COLOR)
   ========================================================================= */
add_action( 'init', 'razgem_auto_populate_color_terms', 20 );
function razgem_auto_populate_color_terms() {
    if ( ! taxonomy_exists( 'pa_color' ) ) return;

    // Run check to populate taxonomy terms once
    if ( get_option( 'razgem_color_terms_populated_v1' ) ) return;

    $colors = array(
        'طلایی'        => 'gold',
        'نقره‌ای'      => 'silver',
        'رزگلد'        => 'rosegold',
        'مسی'          => 'copper',
        'برنجی'        => 'brass',
        'برنز'         => 'bronze',
        'کرم'          => 'cream',
        'بژ'           => 'beige',
        'استخوانی'     => 'ivory',
        'شیری'         => 'off-white',
        'طوسی'         => 'gray',
        'طوسی روشن'    => 'light-gray',
        'طوسی تیره'    => 'dark-gray',
        'دودی'         => 'smoky',
        'نوک مدادی'    => 'charcoal',
        'قهوه‌ای'      => 'brown',
        'قهوه‌ای روشن' => 'light-brown',
        'قهوه‌ای تیره' => 'dark-brown',
        'چوبی'         => 'wood',
        'گردویی'       => 'walnut',
        'نسکافه‌ای'    => 'nescafe',
        'شکلاتی'       => 'chocolate',
        'زرشکی'        => 'maroon',
        'عنابی'        => 'burgundy',
        'صورتی'        => 'pink',
        'صورتی روشن'   => 'light-pink',
        'کالباسی'      => 'nude-pink',
        'یاسی'         => 'lilac',
        'بنفش'         => 'purple',
        'بادمجانی'     => 'eggplant',
        'سرمه‌ای'      => 'navy',
        'آبی کاربنی'   => 'royal-blue',
        'آبی آسمانی'   => 'sky-blue',
        'فیروزه‌ای'     => 'turquoise',
        'سبز'          => 'green',
        'سبز روشن'     => 'light-green',
        'سبز تیره'     => 'dark-green',
        'زیتونی'       => 'olive',
        'یشمی'         => 'jade',
        'پسته‌ای'       => 'pistachio',
        'نعنایی'       => 'mint',
        'خردلی'        => 'mustard',
        'لیمویی'       => 'lemon',
        'نارنجی'       => 'orange',
        'آجری'         => 'terracotta',
        'مرجانی'       => 'coral',
        'زغالی'        => 'anthracite',
        'شیشه‌ای'       => 'glass'
    );

    foreach ( $colors as $name => $slug ) {
        if ( ! term_exists( $name, 'pa_color' ) && ! term_exists( $slug, 'pa_color' ) ) {
            wp_insert_term( $name, 'pa_color', array( 'slug' => $slug ) );
        }
    }

    update_option( 'razgem_color_terms_populated_v1', 1 );
}

/* =========================================================================
   41. BALE BOT NOTIFICATIONS FOR NEW ORDERS
   ========================================================================= */
add_action( 'woocommerce_order_status_processing', 'razgem_bale_order_notification', 20, 1 );
add_action( 'woocommerce_order_status_pending', 'razgem_bale_order_notification', 20, 1 );
add_action( 'woocommerce_order_status_on-hold', 'razgem_bale_order_notification', 20, 1 );
add_action( 'woocommerce_thankyou', 'razgem_bale_order_notification', 20, 1 );

function razgem_bale_order_notification( $order_id ) {
    if ( ! $order_id ) return;

    $order = wc_get_order( $order_id );
    if ( ! $order || ! is_a( $order, 'WC_Order' ) ) return;

    // Check if notification already sent for this order
    if ( $order->get_meta( '_bale_notified' ) ) {
        return;
    }

    $token   = get_theme_mod( 'bale_bot_token', '93568967:H8HZAqpo4QqddujZFHUm-W02PuJpqL9sojg' );
    $chat_id = get_theme_mod( 'bale_chat_id', '5595461321' );

    if ( empty( $token ) || empty( $chat_id ) ) {
        return;
    }

    // Mark as notified to prevent duplicate messages
    $order->update_meta_data( '_bale_notified', '1' );
    $order->save();

    // Order number & date
    $order_num  = $order->get_order_number();
    $date_obj   = $order->get_date_created();
    $order_date = $date_obj ? wp_date( 'Y/m/d H:i', $date_obj->getTimestamp() ) : wp_date( 'Y/m/d H:i' );

    // Customer info
    $full_name  = trim( $order->get_formatted_billing_full_name() );
    if ( empty( $full_name ) ) {
        $full_name = 'مشتری بدون نام';
    }
    $phone      = $order->get_billing_phone() ?: 'ثبت نشده';

    // Address
    $state      = $order->get_billing_state();
    $city       = $order->get_billing_city();
    $address_1  = $order->get_billing_address_1();
    $address    = trim( implode( '، ', array_filter( array( $state, $city, $address_1 ) ) ) );
    if ( empty( $address ) ) {
        $address = 'بدون آدرس فیزیکی';
    }

    // Items list
    $items_text = array();
    foreach ( $order->get_items() as $item ) {
        $name         = $item->get_name();
        $quantity     = $item->get_quantity();
        $total        = number_format( (float) $item->get_total() );
        $items_text[] = "▫️ {$name} × {$quantity} ({$total} تومان)";
    }
    $items_summary = ! empty( $items_text ) ? implode( "\n", $items_text ) : '▫️ ثبت نشده';

    $payment_method  = $order->get_payment_method_title() ?: 'نامشخص';
    $shipping_method = $order->get_shipping_method() ?: 'ارسال استاندارد';
    $total_amount    = number_format( (float) $order->get_total() );
    $customer_note   = $order->get_customer_note();

    // Admin URL
    $admin_url = admin_url( 'admin.php?page=wc-orders&action=edit&id=' . $order_id );

    $msg  = "🌿 *ثبت سفارش جدید در رازگِم!*\n";
    $msg .= "━━━━━━━━━━━━━━━━━━━\n";
    $msg .= "📦 *شماره سفارش:* #{$order_num}\n";
    $msg .= "📅 *تاریخ:* {$order_date}\n";
    $msg .= "👤 *نام خریدار:* {$full_name}\n";
    $msg .= "📞 *تلفن همراه:* {$phone}\n";
    $msg .= "📍 *آدرس:* {$address}\n\n";
    $msg .= "🛍️ *اقلام سفارش:*\n";
    $msg .= "{$items_summary}\n\n";
    $msg .= "🚚 *روش ارسال:* {$shipping_method}\n";
    $msg .= "💳 *نحوه پرداخت:* {$payment_method}\n";
    $msg .= "💰 *مبلغ کل:* {$total_amount} تومان\n";

    if ( ! empty( $customer_note ) ) {
        $msg .= "📝 *یادداشت مشتری:* {$customer_note}\n";
    }

    $msg .= "━━━━━━━━━━━━━━━━━━━\n";
    $msg .= "🔗 [مشاهده سفارش در پنل مدیریت]({$admin_url})";

    $payload = array(
        'chat_id'    => $chat_id,
        'text'       => $msg,
        'parse_mode' => 'Markdown',
    );

    wp_remote_post( 'https://tapi.bale.ai/bot' . $token . '/sendMessage', array(
        'headers'     => array( 'Content-Type' => 'application/json' ),
        'body'        => json_encode( $payload ),
        'timeout'     => 10,
        'blocking'    => false,
        'data_format' => 'body',
    ) );
}

/* =========================================================================
   42. PRODUCT SHORTLINK SYSTEM (golkhaneshop.ir/p/ID -> 301 Redirect)
   ========================================================================= */
// 1. Register rewrite rule for /p/123 -> product
add_action( 'init', 'razgem_register_shortlink_rewrites' );
function razgem_register_shortlink_rewrites() {
    add_rewrite_rule( '^p/([0-9]+)/?$', 'index.php?post_type=product&p=$matches[1]', 'top' );
}

// 2. High-performance direct 301 redirect on template_redirect & early request
add_action( 'template_redirect', 'razgem_handle_shortlink_redirect', 1 );
function razgem_handle_shortlink_redirect() {
    if ( isset( $_SERVER['REQUEST_URI'] ) ) {
        $path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
        if ( preg_match( '#^/p/([0-9]+)/?$#', $path, $matches ) ) {
            $product_id = intval( $matches[1] );
            if ( $product_id > 0 && 'product' === get_post_type( $product_id ) ) {
                $url = get_permalink( $product_id );
                if ( $url ) {
                    wp_redirect( $url, 301 );
                    exit;
                }
            }
        }
    }
}

// 3. Helper to get product shortlink
function razgem_get_product_shortlink( $product_id ) {
    return home_url( '/p/' . intval( $product_id ) );
}

// 4. Override WordPress core shortlink for products
add_filter( 'pre_get_shortlink', 'razgem_custom_product_shortlink', 10, 4 );
function razgem_custom_product_shortlink( $shortlink, $id, $context, $allow_slugs ) {
    $post_id = $id ? $id : get_the_ID();
    if ( $post_id && 'product' === get_post_type( $post_id ) ) {
        return home_url( '/p/' . $post_id );
    }
    return $shortlink;
}

// 5. Add 1-click Copy Shortlink Column to WP Admin Products Table
add_filter( 'manage_edit-product_columns', 'razgem_add_shortlink_admin_column', 20 );
function razgem_add_shortlink_admin_column( $columns ) {
    $new_columns = array();
    foreach ( $columns as $key => $title ) {
        $new_columns[ $key ] = $title;
        if ( 'name' === $key ) {
            $new_columns['product_shortlink'] = 'لینک کوتاه';
        }
    }
    return $new_columns;
}

add_action( 'manage_product_posts_custom_column', 'razgem_render_shortlink_admin_column', 10, 2 );
function razgem_render_shortlink_admin_column( $column, $post_id ) {
    if ( 'product_shortlink' === $column ) {
        $shortlink = razgem_get_product_shortlink( $post_id );
        echo '<div style="display:inline-flex; align-items:center; gap:6px; direction:ltr;">';
        echo '<input type="text" readonly value="' . esc_url( $shortlink ) . '" style="width:125px; font-size:11px; padding:3px 6px; height:26px; border:1px solid #ccd0d4; border-radius:4px; background:#f6f7f7; font-family:monospace;" onclick="this.select()">';
        echo '<button type="button" class="button button-small" style="font-size:11px; padding:0 8px; height:26px; line-height:24px; border-radius:4px;" onclick="navigator.clipboard.writeText(\'' . esc_url( $shortlink ) . '\'); this.innerText=\'✓ کپی شد\'; this.style.color=\'#27ae60\'; setTimeout(() => { this.innerText=\'کپی\'; this.style.color=\'\'; }, 1500);">کپی</button>';
        echo '</div>';
    }
}

/* =========================================================================
   43. HOMEPAGE SUGGESTED PRODUCT CHECKBOX (_razgem_is_suggested)
   ========================================================================= */
// 1. Add Checkbox to WooCommerce Product Data > General
add_action( 'woocommerce_product_options_general_product_data', 'razgem_add_suggested_checkbox' );
function razgem_add_suggested_checkbox() {
    echo '<div class="options_group show_if_simple show_if_variable show_if_external" style="background:#fcf9f6; border-top:1px solid #eee; padding:10px 12px; margin-top:10px;">';
    woocommerce_wp_checkbox( array(
        'id'            => '_razgem_is_suggested',
        'label'         => 'پیشنهاد رازگِم (صفحه اصلی)',
        'description'   => 'با فعال کردن این گزینه، این محصول در «پیشنهاد رازگِم» در بالای صفحه اصلی نمایش داده می‌شود.',
        'desc_tip'      => false,
    ) );
    echo '</div>';
}

// 2. Save Checkbox Value
add_action( 'woocommerce_process_product_meta', 'razgem_save_suggested_checkbox', 10, 1 );
add_action( 'save_post_product', 'razgem_save_suggested_checkbox', 10, 1 );
function razgem_save_suggested_checkbox( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    
    if ( isset( $_POST['_razgem_is_suggested'] ) ) {
        update_post_meta( $post_id, '_razgem_is_suggested', 'yes' );
        $product = wc_get_product( $post_id );
        if ( $product ) {
            $product->update_meta_data( '_razgem_is_suggested', 'yes' );
            $product->save_meta_data();
        }
    } else if ( isset( $_POST['action'] ) && 'editpost' === $_POST['action'] ) {
        update_post_meta( $post_id, '_razgem_is_suggested', 'no' );
        $product = wc_get_product( $post_id );
        if ( $product ) {
            $product->update_meta_data( '_razgem_is_suggested', 'no' );
            $product->save_meta_data();
        }
    }
}

// 3. Quick Edit Support for Suggested Product
add_action( 'woocommerce_product_quick_edit_end', 'razgem_quick_edit_suggested_checkbox' );
function razgem_quick_edit_suggested_checkbox() {
    ?>
    <br class="clear" />
    <div class="inline-edit-group">
        <label class="alignleft">
            <input type="checkbox" name="_razgem_is_suggested" value="yes">
            <span class="checkbox-title" style="font-weight:700; color:#a85018;">★ پیشنهاد رازگِم (صفحه اصلی)</span>
        </label>
    </div>
    <?php
}

add_action( 'woocommerce_product_quick_edit_save', 'razgem_quick_edit_save_suggested' );
function razgem_quick_edit_save_suggested( $product ) {
    if ( isset( $_REQUEST['_razgem_is_suggested'] ) ) {
        $product->update_meta_data( '_razgem_is_suggested', 'yes' );
    } else {
        $product->update_meta_data( '_razgem_is_suggested', 'no' );
    }
    $product->save_meta_data();
}

// 4. Admin Column in Products Table
add_filter( 'manage_edit-product_columns', 'razgem_add_suggested_admin_column', 21 );
function razgem_add_suggested_admin_column( $columns ) {
    $new_cols = array();
    foreach ( $columns as $k => $v ) {
        $new_cols[$k] = $v;
        if ( 'product_shortlink' === $k ) {
            $new_cols['razgem_suggested'] = 'پیشنهاد رازگِم';
        }
    }
    return $new_cols;
}

add_action( 'manage_product_posts_custom_column', 'razgem_render_suggested_admin_column', 10, 2 );
function razgem_render_suggested_admin_column( $col, $post_id ) {
    if ( 'razgem_suggested' === $col ) {
        $is_sugg = get_post_meta( $post_id, '_razgem_is_suggested', true );
        if ( 'yes' === $is_sugg ) {
            echo '<span style="color:#8e4212; font-weight:800; background:#f0dfd5; border:1px solid #dcc3b5; padding:3px 8px; border-radius:12px; font-size:11px; display:inline-block;">★ پیشنهاد</span>';
        } else {
            echo '<span style="color:#ccc; font-size:13px;">—</span>';
        }
    }
}






// Dual compatibility hooks for AJAX actions
add_action('wp_ajax_golkhane_live_search', 'razgem_live_search_ajax');
add_action('wp_ajax_nopriv_golkhane_live_search', 'razgem_live_search_ajax');
add_action('wp_ajax_razgem_live_search', 'razgem_live_search_ajax');
add_action('wp_ajax_nopriv_razgem_live_search', 'razgem_live_search_ajax');

add_action('wp_ajax_golkhane_send_otp', 'razgem_send_otp_handler');
add_action('wp_ajax_nopriv_golkhane_send_otp', 'razgem_send_otp_handler');
add_action('wp_ajax_razgem_send_otp', 'razgem_send_otp_handler');
add_action('wp_ajax_nopriv_razgem_send_otp', 'razgem_send_otp_handler');

add_action('wp_ajax_golkhane_verify_otp', 'razgem_verify_otp_handler');
add_action('wp_ajax_nopriv_golkhane_verify_otp', 'razgem_verify_otp_handler');
add_action('wp_ajax_razgem_verify_otp', 'razgem_verify_otp_handler');
add_action('wp_ajax_nopriv_razgem_verify_otp', 'razgem_verify_otp_handler');

add_action('wp_ajax_razgem_update_morph_cart', 'razgem_update_morph_cart_ajax');
add_action('wp_ajax_nopriv_razgem_update_morph_cart', 'razgem_update_morph_cart_ajax');

// Aliases for functions called in legacy templates
if (!function_exists('golkhane_clean_phone')) {
    function golkhane_clean_phone($phone) { return razgem_clean_phone($phone); }
}
if (!function_exists('golkhane_get_product_shortlink')) {
    function golkhane_get_product_shortlink($product_id) { return razgem_get_product_shortlink($product_id); }
}
if (!function_exists('golkhane_get_shamsi_date')) {
    function golkhane_get_shamsi_date($timestamp = null) { return razgem_get_shamsi_date($timestamp); }
}
if (!function_exists('golkhane_custom_comment_format')) {
    function golkhane_custom_comment_format($comment, $args, $depth) { return razgem_custom_comment_format($comment, $args, $depth); }
}

// Fallback alias for legacy contact submissions
add_action('wp_ajax_submit_golkhane_contact', 'razgem_handle_contact_form');
add_action('wp_ajax_nopriv_submit_golkhane_contact', 'razgem_handle_contact_form');


