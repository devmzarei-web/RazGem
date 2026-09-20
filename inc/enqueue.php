<?php
/**
 * RazGem Enqueue Scripts and Styles
 * 100% Zero-CDN Local Asset Loading
 *
 * @package RazGem
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function razgem_scripts() {
    $theme_version  = wp_get_theme()->get( 'Version' ) ? wp_get_theme()->get( 'Version' ) : '1.0.0';
    $theme_dir_uri  = get_template_directory_uri();
    $theme_dir_path = get_template_directory();

    // Cache-busting timestamps using filemtime if available
    $font_css_path  = $theme_dir_path . '/assets/fonts/font.css';
    $font_version   = file_exists( $font_css_path ) ? filemtime( $font_css_path ) : $theme_version;
    $style_css_path = $theme_dir_path . '/style.css';
    $style_version  = file_exists( $style_css_path ) ? filemtime( $style_css_path ) : $theme_version;
    $main_js_path   = $theme_dir_path . '/assets/js/main.js';
    $js_version     = file_exists( $main_js_path ) ? filemtime( $main_js_path ) : $theme_version;

    // 1. Local Persian Typography (Morabba & IranYekanX)
    wp_enqueue_style( 'razgem-fonts', $theme_dir_uri . '/assets/fonts/font.css', array(), $font_version );

    // 2. Main Luxury Jewelry Stylesheet
    wp_enqueue_style( 'razgem-main-style', get_stylesheet_uri(), array( 'razgem-fonts' ), $style_version );

    // 3. Local GSAP Core & ScrollTrigger (Zero-CDN)
    wp_enqueue_script( 'gsap-core', $theme_dir_uri . '/assets/js/gsap.min.js', array(), '3.12.5', true );
    wp_enqueue_script( 'gsap-scroll', $theme_dir_uri . '/assets/js/ScrollTrigger.min.js', array( 'gsap-core' ), '3.12.5', true );

    // 4. Main Theme JavaScript
    wp_enqueue_script( 'razgem-main', $theme_dir_uri . '/assets/js/main.js', array( 'gsap-core', 'gsap-scroll' ), $js_version, true );

    // 5. Localized AJAX Data
    wp_localize_script( 'razgem-main', 'razgem_ajax', array(
        'ajax_url'     => admin_url( 'admin-ajax.php' ),
        'nonce'        => wp_create_nonce( 'razgem_nonce' ),
        'cart_url'     => function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : '',
        'checkout_url' => function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : '',
    ) );
}
add_action( 'wp_enqueue_scripts', 'razgem_scripts' );