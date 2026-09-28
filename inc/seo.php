<?php
/**
 * RazGem SEO & Schema.org JSON-LD Structured Data Engine
 *
 * Provides complete search engine optimization with:
 * - Schema.org WebSite with SearchAction
 * - Schema.org JewelryStore / OnlineStore organization data
 * - Schema.org Product structured data for handcrafted seashell & pearl pieces
 * - OpenGraph & Twitter Cards
 * - Persian meta descriptions and canonical links
 *
 * @package RazGem
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Output comprehensive Schema.org JSON-LD structured data in wp_head.
 */
function razgem_output_seo_structured_data() {
    $site_url  = home_url( '/' );
    $site_name = get_bloginfo( 'name' ) ?: 'گالری طلا و مروارید رازجم';
    $logo_url  = get_template_directory_uri() . '/assets/images/Razgem-Logo.png';
    $phone     = get_theme_mod( 'contact_phone', '۰۲۱-۹۱۰۰XXXX' );
    $address   = get_theme_mod( 'contact_address', 'تهران، نیاوران، خیابان عمار، پلاک ۱۲' );
    $email     = get_theme_mod( 'contact_email', 'info@razgem.ir' );

    $social_links = array_filter( array(
        get_theme_mod( 'social_instagram', 'https://instagram.com/razgem.ir' ),
        get_theme_mod( 'social_telegram', 'https://t.me/razgem' ),
        get_theme_mod( 'social_whatsapp', 'https://wa.me/98912XXXXXXX' ),
    ) );

    // 1. WebSite Schema
    $website_schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'WebSite',
        '@id'             => $site_url . '#website',
        'name'            => $site_name,
        'url'             => $site_url,
        'inLanguage'      => 'fa-IR',
        'description'     => 'فروشگاه تخصصی زیورآلات و تابلوهای دکوراتیو دست‌ساز با صدف‌های طبیعی اصل و مرواریدهای باروک خلیج فارس',
        'potentialAction' => array(
            '@type'       => 'SearchAction',
            'target'      => $site_url . '?s={search_term_string}&post_type=product',
            'query-input' => 'required name=search_term_string',
        ),
    );

    // 2. JewelryStore / OnlineStore Schema
    $store_schema = array(
        '@context'           => 'https://schema.org',
        '@type'              => 'JewelryStore',
        '@id'                => $site_url . '#jewelrystore',
        'name'               => $site_name,
        'alternateName'      => 'RazGem Luxury Handcrafted Seashell Jewelry',
        'url'                => $site_url,
        'logo'               => $logo_url,
        'image'              => $logo_url,
        'description'        => 'آتلیه و گالری تخصصی دست‌سازه‌های صدف طبیعی، مروارید باروک و طلای ۱۸ عیار رازجم با شناسنامه اصالت فیزیکی.',
        'priceRange'         => '$$$',
        'currenciesAccepted' => 'IRT, IRR',
        'paymentAccepted'    => 'شاپرک، کارت‌های عضو شبکه شتاب',
        'telephone'          => $phone,
        'email'              => $email,
        'address'            => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => $address,
            'addressLocality' => 'تهران',
            'addressRegion'   => 'تهران',
            'addressCountry'  => 'IR',
        ),
        'openingHoursSpecification' => array(
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => array( 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday' ),
            'opens'     => '10:00',
            'closes'    => '22:00',
        ),
        'sameAs'             => array_values( $social_links ),
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $website_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
    echo '<script type="application/ld+json">' . wp_json_encode( $store_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";

    // 3. Single Product Schema (if on product page)
    if ( is_singular( 'product' ) ) {
        global $product;
        if ( is_a( $product, 'WC_Product' ) ) {
            $p_id        = $product->get_id();
            $thumb_id    = get_post_thumbnail_id( $p_id );
            $img_url     = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'full' ) : $logo_url;
            $excerpt     = has_excerpt( $p_id ) ? wp_strip_all_tags( get_the_excerpt( $p_id ) ) : wp_strip_all_tags( wp_trim_words( get_the_content(), 30 ) );
            $price       = $product->get_price();
            $sku         = $product->get_sku() ?: 'RG-' . $p_id;

            $product_schema = array(
                '@context'    => 'https://schema.org',
                '@type'       => 'Product',
                '@id'         => get_permalink( $p_id ) . '#product',
                'name'        => $product->get_name(),
                'image'       => $img_url,
                'description' => ! empty( $excerpt ) ? $excerpt : 'دست‌سازه فاخر صدف طبیعی و مروارید باروک آتلیه رازجم به همراه شناسنامه فیزیکی اصالت.',
                'sku'         => $sku,
                'category'    => wp_strip_all_tags( wc_get_product_category_list( $p_id, '، ' ) ),
                'brand'       => array(
                    '@type' => 'Brand',
                    'name'  => 'گالری رازجم (RazGem)',
                ),
                'offers'      => array(
                    '@type'           => 'Offer',
                    'url'             => get_permalink( $p_id ),
                    'priceCurrency'   => 'IRT',
                    'price'           => $price,
                    'itemCondition'   => 'https://schema.org/NewCondition',
                    'availability'    => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                    'priceValidUntil' => date( 'Y-12-31', strtotime( '+1 year' ) ),
                    'seller'          => array(
                        '@type' => 'JewelryStore',
                        'name'  => 'گالری رازجم',
                    ),
                ),
            );

            echo '<script type="application/ld+json">' . wp_json_encode( $product_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
        }
    }
}
add_action( 'wp_head', 'razgem_output_seo_structured_data', 4 );

/**
 * Output OpenGraph and Twitter Meta Tags for Rich Social Previews.
 */
function razgem_output_seo_meta_tags() {
    $title       = wp_get_document_title();
    $desc        = 'گالری طلا و مروارید رازجم؛ مجموعه انحصاری زیورآلات و تابلوهای دکوراتیو دست‌ساز با صدف‌های طبیعی خلیج فارس، مروارید باروک و طلای ۱۸ عیار.';
    $current_url = home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );
    $logo_url    = get_template_directory_uri() . '/assets/images/Razgem-Logo.png';
    $img_url     = $logo_url;

    if ( is_singular( 'product' ) ) {
        global $post;
        if ( has_post_thumbnail( $post->ID ) ) {
            $img_url = wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'large' );
        }
        if ( has_excerpt( $post->ID ) ) {
            $desc = wp_strip_all_tags( get_the_excerpt( $post->ID ) );
        }
    }
    ?>
    <!-- Open Graph / Facebook / Telegram -->
    <meta property="og:type" content="<?php echo is_singular( 'product' ) ? 'product' : 'website'; ?>" />
    <meta property="og:title" content="<?php echo esc_attr( $title ); ?>" />
    <meta property="og:description" content="<?php echo esc_attr( $desc ); ?>" />
    <meta property="og:url" content="<?php echo esc_url( $current_url ); ?>" />
    <meta property="og:site_name" content="گالری طلا و مروارید رازجم" />
    <meta property="og:image" content="<?php echo esc_url( $img_url ); ?>" />
    <meta property="og:locale" content="fa_IR" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr( $desc ); ?>" />
    <meta name="twitter:image" content="<?php echo esc_url( $img_url ); ?>" />
    <?php
}
add_action( 'wp_head', 'razgem_output_seo_meta_tags', 3 );
