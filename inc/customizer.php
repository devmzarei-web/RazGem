<?php
/**
 * RazGem Theme Customizer
 * Native WordPress Customizer panels and controls for 100% dynamic storefront editing.
 *
 * @package RazGem
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Customizer settings, sections, and panels.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function razgem_customize_register( $wp_customize ) {

    // -------------------------------------------------------------------------
    // 1. TOP ANNOUNCEMENT BAR & QUICK CONTACTS
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'razgem_topbar_section', array(
        'title'       => 'نوار اعلان و تماس بالای سایت (Top Bar)',
        'priority'    => 25,
        'description' => 'مدیریت متن اعلان متحرک و شماره‌های تماس بالای سایت',
    ) );

    // Enable / Disable Top Bar
    $wp_customize->add_setting( 'top_bar_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'top_bar_enable', array(
        'label'    => 'نمایش نوار اعلان بالای سایت',
        'section'  => 'razgem_topbar_section',
        'type'     => 'checkbox',
    ) );

    // Announcement Text
    $wp_customize->add_setting( 'top_bar_announcement', array(
        'default'           => 'ارسال رایگان و بیمه‌شده سفارش‌ها به سراسر کشور',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'top_bar_announcement', array(
        'label'    => 'متن اطلاعیه نوار بالا',
        'section'  => 'razgem_topbar_section',
        'type'     => 'text',
    ) );

    // Contact Phone 1 (Primary)
    $wp_customize->add_setting( 'contact_phone', array(
        'default'           => '۰۲۱-۹۱۰۰XXXX',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'contact_phone', array(
        'label'    => 'شماره تماس اصلی (نمایش در هدر و فوتر)',
        'section'  => 'razgem_topbar_section',
        'type'     => 'text',
    ) );

    // Contact Phone 2 (Secondary / WhatsApp)
    $wp_customize->add_setting( 'contact_phone_2', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'contact_phone_2', array(
        'label'    => 'شماره تماس دوم / واتس‌اپ (اختیاری)',
        'section'  => 'razgem_topbar_section',
        'type'     => 'text',
    ) );

    // -------------------------------------------------------------------------
    // 2. HERO COMMERCIAL BANNERS & PROMO GRID (3-Part Layout)
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'razgem_hero_banners_section', array(
        'title'       => 'بنرها و هیرو تجاری صفحه نخست (Hero & Banners)',
        'priority'    => 26,
        'description' => 'مدیریت بنرهای ۳ بخشی هیرو. ابعاد استاندارد ۱۶:۹ برای اسلایدر اصلی: ۱۶۰۰ × ۹۰۰ پیکسل (حداقل ۱۲۸۰ × ۷۲۰ پیکسل). ابعاد استاندارد ۱۶:۹ برای بنرهای ثابت کناری: ۸۰۰ × ۴۵۰ پیکسل (حداقل ۶۰۰ × ۳۳۸ پیکسل). تصاویر به صورت خودکار و پوشش کامل (cover) بدون خط یا حاشیه مشکی در قاب قرار می‌گیرند.',
    ) );

    // --- Slide 1 (Featured Wide Carousel) ---
    $wp_customize->add_setting( 'hero_slide_1_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_slide_1_image', array(
        'label'       => 'تصویر اسلایدر اصلی ۱ (۱۶:۹ - استاندارد ۱۶۰۰ × ۹۰۰ px)',
        'section'     => 'razgem_hero_banners_section',
        'description' => 'تصویر اسلاید اول کروسل اصلی. کادر به صورت ۱۶:۹ با پوشش کامل نمایش داده می‌شود.',
    ) ) );

    $wp_customize->add_setting( 'hero_slide_1_url', array(
        'default'           => '/product/r-003/',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'hero_slide_1_url', array(
        'label'    => 'لینک مقصد اسلایدر ۱',
        'section'  => 'razgem_hero_banners_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'hero_slide_1_alt', array(
        'default'           => 'تابلو صدف دریایی طرح خورشید دست‌ساز کد R-003 - آتلیه رازجم',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_slide_1_alt', array(
        'label'       => 'متن جایگزین سئو (Alt) اسلایدر ۱',
        'section'     => 'razgem_hero_banners_section',
        'type'        => 'text',
        'description' => 'توصیف دقیق برای موتورهای جستجو و بهبود سئو رتبه سایت.',
    ) );

    // --- Slide 2 (Featured Wide Carousel) ---
    $wp_customize->add_setting( 'hero_slide_2_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_slide_2_image', array(
        'label'       => 'تصویر اسلایدر اصلی ۲ (۱۶:۹ - استاندارد ۱۶۰۰ × ۹۰۰ px)',
        'section'     => 'razgem_hero_banners_section',
    ) ) );

    $wp_customize->add_setting( 'hero_slide_2_url', array(
        'default'           => '/product/r-001/',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'hero_slide_2_url', array(
        'label'    => 'لینک مقصد اسلایدر ۲',
        'section'  => 'razgem_hero_banners_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'hero_slide_2_alt', array(
        'default'           => 'گوشواره هنری دست‌ساز با صدف طبیعی و مروارید باروک کد R-001',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_slide_2_alt', array(
        'label'    => 'متن جایگزین سئو (Alt) اسلایدر ۲',
        'section'  => 'razgem_hero_banners_section',
        'type'     => 'text',
    ) );

    // --- Slide 3 (Featured Wide Carousel) ---
    $wp_customize->add_setting( 'hero_slide_3_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_slide_3_image', array(
        'label'       => 'تصویر اسلایدر اصلی ۳ (۱۶:۹ - استاندارد ۱۶۰۰ × ۹۰۰ px)',
        'section'     => 'razgem_hero_banners_section',
    ) ) );

    $wp_customize->add_setting( 'hero_slide_3_url', array(
        'default'           => '/product/r-004/',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'hero_slide_3_url', array(
        'label'    => 'لینک مقصد اسلایدر ۳',
        'section'  => 'razgem_hero_banners_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'hero_slide_3_alt', array(
        'default'           => 'تابلو توتیای دریایی سه بعدی دست‌ساز کد R-004 - شاهکار طبیعی دریا',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_slide_3_alt', array(
        'label'    => 'متن جایگزین سئو (Alt) اسلایدر ۳',
        'section'  => 'razgem_hero_banners_section',
        'type'     => 'text',
    ) );

    // --- Top Static Promo Card (Left Side Desktop) ---
    $wp_customize->add_setting( 'hero_promo_top_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_promo_top_image', array(
        'label'       => 'تصویر بنر ثابت بالا (۱۶:۹ - استاندارد ۸۰۰ × ۴۵۰ px)',
        'section'     => 'razgem_hero_banners_section',
        'description' => 'بنر تبلیغاتی ثابت بالای ستون کناری. با نسبت ۱۶:۹ کاملاً در قاب قرار می‌گیرد.',
    ) ) );

    $wp_customize->add_setting( 'hero_promo_top_url', array(
        'default'           => '/product/r-002/',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'hero_promo_top_url', array(
        'label'    => 'لینک بنر ثابت بالا',
        'section'  => 'razgem_hero_banners_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'hero_promo_top_alt', array(
        'default'           => 'گوشواره صدف بادبزنی رگه‌دار طبیعی کد R-002',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_promo_top_alt', array(
        'label'    => 'متن جایگزین سئو (Alt) بنر بالا',
        'section'  => 'razgem_hero_banners_section',
        'type'     => 'text',
    ) );

    // --- Bottom Static Promo Card (Left Side Desktop) ---
    $wp_customize->add_setting( 'hero_promo_btm_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_promo_btm_image', array(
        'label'       => 'تصویر بنر ثابت پایین (۱۶:۹ - استاندارد ۸۰۰ × ۴۵۰ px)',
        'section'     => 'razgem_hero_banners_section',
        'description' => 'بنر تبلیغاتی ثابت پایین ستون کناری. با نسبت ۱۶:۹ کاملاً در قاب قرار می‌گیرد.',
    ) ) );

    $wp_customize->add_setting( 'hero_promo_btm_url', array(
        'default'           => '/product/r-007/',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'hero_promo_btm_url', array(
        'label'    => 'لینک بنر ثابت پایین',
        'section'  => 'razgem_hero_banners_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'hero_promo_btm_alt', array(
        'default'           => 'چوکر مروارید باروک و صدف مخملی دست‌ساز کد R-007',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_promo_btm_alt', array(
        'label'    => 'متن جایگزین سئو (Alt) بنر پایین',
        'section'  => 'razgem_hero_banners_section',
        'type'     => 'text',
    ) );

    // -------------------------------------------------------------------------
    // 2.1 WONDER DEALS & FLASH SALE (پیشنهاد شگفت‌انگیز)
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'razgem_flash_sale_section', array(
        'title'       => 'پیشنهاد شگفت‌انگیز و شمارشگر معکوس (Wonder Deals)',
        'priority'    => 26.5,
        'description' => 'تنظیمات بخش پیشنهاد شگفت‌انگیز و زمان‌بندی شمارشگر معکوس تخفیف.',
    ) );

    $wp_customize->add_setting( 'flash_sale_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'flash_sale_enable', array(
        'label'    => 'نمایش بخش پیشنهاد شگفت‌انگیز',
        'section'  => 'razgem_flash_sale_section',
        'type'     => 'checkbox',
    ) );

    $wp_customize->add_setting( 'flash_sale_title', array(
        'default'           => 'پیشنهاد شگفت‌انگیز صدف و مروارید',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'flash_sale_title', array(
        'label'    => 'عنوان پیشنهاد شگفت‌انگیز',
        'section'  => 'razgem_flash_sale_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'flash_sale_subtitle', array(
        'default'           => 'تخفیف‌های استثنایی و محدود شاهکارهای دست‌ساز رازجم',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'flash_sale_subtitle', array(
        'label'    => 'توضیحات زیر عنوان',
        'section'  => 'razgem_flash_sale_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'flash_sale_end', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'flash_sale_end', array(
        'label'       => 'زمان پایان فروش شگفت‌انگیز (ISO 8601)',
        'section'     => 'razgem_flash_sale_section',
        'type'        => 'text',
        'description' => 'مثال: 2026-10-15T23:59:59 (در صورت خالی بودن، شمارشگر به صورت ۲۴ ساعته هوشمند محاسبه خواهد شد).',
    ) );

    // -------------------------------------------------------------------------
    // 3. CONTACT CREDENTIALS, ADDRESS & OPERATING HOURS
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'razgem_contact_section', array(
        'title'       => 'اطلاعات تماس، آدرس و ساعات پاسخگویی',
        'priority'    => 27,
        'description' => 'مدیریت نشانی گالری، ایمیل رسمی، ساعات پاسخگویی و تلفن‌ها (نمایش در فوتر و صفحه تماس)',
    ) );

    // Address
    $wp_customize->add_setting( 'contact_address', array(
        'default'           => 'تهران، نیاوران، خیابان عمار، پلاک ۱۲، واحد ۳',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'contact_address', array(
        'label'       => 'نشانی فیزیکی گالری رازجم',
        'section'     => 'razgem_contact_section',
        'type'        => 'textarea',
        'description' => 'نشانی گالری جهت نمایش در فوتر و صفحه تماس با ما',
    ) );

    // Email
    $wp_customize->add_setting( 'contact_email', array(
        'default'           => 'info@razgem.ir',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'contact_email', array(
        'label'    => 'پست الکترونیک رسمی (Email)',
        'section'  => 'razgem_contact_section',
        'type'     => 'email',
    ) );

    // Operating / Support Hours
    $wp_customize->add_setting( 'contact_hours', array(
        'default'           => '۱۰ الی ۲۲',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'contact_hours', array(
        'label'       => 'ساعات کاری و پاسخگویی گالری',
        'section'     => 'razgem_contact_section',
        'type'        => 'text',
        'description' => 'به عنوان مثال: ۱۰ الی ۲۲ یا شنبه تا پنج‌شنبه: ۱۰ الی ۲۱',
    ) );

    // Additional Phone 3
    $wp_customize->add_setting( 'contact_phone_3', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'contact_phone_3', array(
        'label'    => 'شماره تلفن سوم / خط ثابت (اختیاری)',
        'section'  => 'razgem_contact_section',
        'type'     => 'text',
    ) );

    // -------------------------------------------------------------------------
    // 4. ARTISAN ATELIER STORY SECTION
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'razgem_atelier_section', array(
        'title'       => 'کارگاه زرگری و دست‌سازه‌ها (داستان رازجم)',
        'priority'    => 28,
        'description' => 'معرفی آتلیه زرگری، طراحی دست‌ساز و سفارشی‌سازی زیورآلات',
    ) );

    $wp_customize->add_setting( 'atelier_badge', array(
        'default'           => 'کارگاه زرگری و دست‌سازه‌ها',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'atelier_badge', array(
        'label'    => 'برچسب بخش کارگاه',
        'section'  => 'razgem_atelier_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'atelier_title', array(
        'default'           => 'داستان هنر و ظرافت در گالری طلا و مروارید رازجم',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'atelier_title', array(
        'label'    => 'تیتر بخش کارگاه',
        'section'  => 'razgem_atelier_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'atelier_desc', array(
        'default'           => 'هر اثر در گالری رازجم روایتی یگانه از تلاقی دستان هنرمند و طبیعت است. از گزینش اصیل‌ترین مرواریدهای باروک تا ریخته‌گری طلای ۱۸ عیار.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'atelier_desc', array(
        'label'    => 'متن معرفی کارگاه و اصالت هنر دست',
        'section'  => 'razgem_atelier_section',
        'type'     => 'textarea',
    ) );

    // --- Workstation 1 ---
    $wp_customize->add_setting( 'atelier_image_1', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'atelier_image_1', array(
        'label'       => 'تصویر میز کارگاه ۱ (پیش‌فرض: Workstations 1)',
        'section'     => 'razgem_atelier_section',
        'description' => 'تصویر میز انتخاب و تراش صدف طبیعی (ابعاد پیشنهادی: ۱۲۸۰ × ۷۲۰ پیکسل).',
    ) ) );

    $wp_customize->add_setting( 'atelier_title_1', array(
        'default'           => 'میز شماره ۱: انتخاب و تراش صدف طبیعی',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'atelier_title_1', array(
        'label'    => 'عنوان میز ۱',
        'section'  => 'razgem_atelier_section',
        'type'     => 'text',
    ) );

    // --- Workstation 2 ---
    $wp_customize->add_setting( 'atelier_image_2', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'atelier_image_2', array(
        'label'       => 'تصویر میز کارگاه ۲ (پیش‌فرض: Workstations 2)',
        'section'     => 'razgem_atelier_section',
        'description' => 'تصویر میز زرگری و گوهرنشانی مروارید باروک.',
    ) ) );

    $wp_customize->add_setting( 'atelier_title_2', array(
        'default'           => 'میز شماره ۲: گوهرنشانی و مروارید باروک',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'atelier_title_2', array(
        'label'    => 'عنوان میز ۲',
        'section'  => 'razgem_atelier_section',
        'type'     => 'text',
    ) );

    // --- Workstation 3 ---
    $wp_customize->add_setting( 'atelier_image_3', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'atelier_image_3', array(
        'label'       => 'تصویر میز کارگاه ۳ (پیش‌فرض: Workstations 3)',
        'section'     => 'razgem_atelier_section',
        'description' => 'تصویر میز طراحی سفارشی و کنترل نهایی اثر.',
    ) ) );

    $wp_customize->add_setting( 'atelier_title_3', array(
        'default'           => 'میز شماره ۳: طراحی سفارشی و کنترل نهایی',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'atelier_title_3', array(
        'label'    => 'عنوان میز ۳',
        'section'  => 'razgem_atelier_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'atelier_btn_text', array(
        'default'           => 'مشاوره و ساخت سفارش اختصاصی',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'atelier_btn_text', array(
        'label'    => 'متن دکمه بخش کارگاه',
        'section'  => 'razgem_atelier_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'atelier_btn_url', array(
        'default'           => '/contact',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'atelier_btn_url', array(
        'label'    => 'لینک دکمه بخش کارگاه',
        'section'  => 'razgem_atelier_section',
        'type'     => 'text',
    ) );

    // -------------------------------------------------------------------------
    // 4. FOOTER CREDENTIALS & BRAND IDENTITY
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'razgem_footer_section', array(
        'title'       => 'فوتر و کپی‌رایت گالری (Footer)',
        'priority'    => 29,
        'description' => 'مدیریت شعار فوتر، حق کپی‌رایت و کدهای ای‌نماد',
    ) );

    $wp_customize->add_setting( 'footer_tagline', array(
        'default'           => 'آفرینش زیورآلات ماندگار از طلای ۱۸ عیار و مروارید اصل',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_tagline', array(
        'label'    => 'شعار برند در فوتر',
        'section'  => 'razgem_footer_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'footer_copyright', array(
        'default'           => 'تمامی حقوق مادی و معنوی برای گالری طلا و مروارید رازجم محفوظ است.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_copyright', array(
        'label'    => 'متن کپی‌رایت پایین فوتر',
        'section'  => 'razgem_footer_section',
        'type'     => 'textarea',
    ) );

    // Creator / Developer Attribution
    $wp_customize->add_setting( 'footer_creator_prefix', array(
        'default'           => 'طراحی و توسعه:',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_creator_prefix', array(
        'label'    => 'پیشوند عنوان طراح سایت',
        'section'  => 'razgem_footer_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'footer_creator_name', array(
        'default'           => 'محمدعلی زارعی',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_creator_name', array(
        'label'    => 'نام طراح / توسعه‌دهنده',
        'section'  => 'razgem_footer_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'footer_creator_url', array(
        'default'           => 'https://devzarei.ir',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'footer_creator_url', array(
        'label'    => 'لینک وب‌سایت طراح (Creator URL)',
        'section'  => 'razgem_footer_section',
        'type'     => 'url',
    ) );

    $wp_customize->add_setting( 'enamad_code', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'enamad_code', array(
        'label'       => 'کد اختصاصی اینماد (HTML)',
        'section'     => 'razgem_footer_section',
        'type'        => 'textarea',
        'description' => 'کد دریافتی از اینماد را اینجا قرار دهید تا در فوتر نمایش داده شود.',
    ) );

    // -------------------------------------------------------------------------
    // 5. SOCIAL MEDIA & MESSAGING
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'razgem_social_section', array(
        'title'    => 'شبکه‌های اجتماعی (Social Media)',
        'priority' => 33,
    ) );

    $wp_customize->add_setting( 'social_instagram', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'social_instagram', array(
        'label'   => 'لینک اینستاگرام گالری رازجم',
        'section' => 'razgem_social_section',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting( 'social_telegram', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'social_telegram', array(
        'label'   => 'لینک تلگرام گالری رازجم',
        'section' => 'razgem_social_section',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting( 'social_whatsapp', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'social_whatsapp', array(
        'label'   => 'لینک واتس‌اپ گالری رازجم',
        'section' => 'razgem_social_section',
        'type'    => 'url',
    ) );

    // Bale Notification Bot
    $wp_customize->add_section( 'razgem_bale_section', array(
        'title'    => 'اطلاع‌رسانی بله (Bale Bot)',
        'priority' => 36,
    ) );

    $wp_customize->add_setting( 'bale_bot_token', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bale_bot_token', array(
        'label'   => 'توکن ربات بله (Bot Token)',
        'section' => 'razgem_bale_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'bale_chat_id', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bale_chat_id', array(
        'label'       => 'شناسه چت یا گروه بله (Chat ID)',
        'section'     => 'razgem_bale_section',
        'type'        => 'text',
        'description' => 'شناسه کاربری یا گروه بله جهت دریافت نوتیفیکیشن سفارشات جدید',
    ) );

    // -------------------------------------------------------------------------
    // 6. STORE & SHIPPING SETTINGS
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'razgem_shop_section', array(
        'title'    => 'تنظیمات ارسال و فروشگاه (Shop Settings)',
        'priority' => 34,
    ) );

    $wp_customize->add_setting( 'free_shipping_min_amount', array(
        'default'           => 3000000,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'free_shipping_min_amount', array(
        'label'       => 'حداقل مبلغ جهت ارسال رایگان (تومان)',
        'section'     => 'razgem_shop_section',
        'type'        => 'number',
        'description' => 'مبلغ فاکتور خرید (به تومان) جهت محاسبه نوار پیشرفت ارسال رایگان در سبد خرید',
    ) );

    // -------------------------------------------------------------------------
    // 7. SPOTLIGHT CURATED PRODUCT
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'razgem_spotlight_section', array(
        'title'    => 'محصول پیشنهادی صفحه اصلی (Featured Spotlight)',
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'spotlight_enabled', array(
        'default'           => 'yes',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'spotlight_enabled', array(
        'label'   => 'نمایش بخش محصول پیشنهادی',
        'section' => 'razgem_spotlight_section',
        'type'    => 'checkbox',
    ) );

    $wp_customize->add_setting( 'spotlight_badge', array(
        'default'           => 'پیشنهاد رازجم',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'spotlight_badge', array(
        'label'   => 'متن برچسب (Badge)',
        'section' => 'razgem_spotlight_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'spotlight_title', array(
        'default'           => 'محصول منتخب رازجم',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'spotlight_title', array(
        'label'   => 'عنوان فرعی / معرفی',
        'section' => 'razgem_spotlight_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'spotlight_desc', array(
        'default'           => 'انتخاب شده با تمرکز بر فرم خالص، هنر دست و اصالت مروارید طبیعی',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'spotlight_desc', array(
        'label'   => 'توضیحات کوتاه زیر عنوان',
        'section' => 'razgem_spotlight_section',
        'type'    => 'textarea',
    ) );

    $product_choices = array( '' => '— انتخاب خودکار (اولین محصول ویژه/جدید) —' );
    if ( function_exists( 'wc_get_products' ) ) {
        $recent_products = wc_get_products( array(
            'status'  => 'publish',
            'limit'   => 100,
            'orderby' => 'date',
            'order'   => 'DESC',
        ) );
        if ( ! empty( $recent_products ) ) {
            foreach ( $recent_products as $p ) {
                $product_choices[ strval( $p->get_id() ) ] = $p->get_name() . ' (' . number_format( (float) $p->get_price() ) . ' تومان)';
            }
        }
    }
    $wp_customize->add_setting( 'spotlight_product_id', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'spotlight_product_id', array(
        'label'       => 'انتخاب محصول برای نمایش',
        'section'     => 'razgem_spotlight_section',
        'type'        => 'select',
        'choices'     => $product_choices,
        'description' => 'محصولی که می‌خواهید در این بخش ویژه نمایش داده شود را انتخاب کنید.',
    ) );

    // =========================================================================
    // 10. INTERACTIVE 4-ITEM "WORN-ON-PERSON" STYLING SHOWCASE
    // =========================================================================
    $wp_customize->add_section( 'razgem_styling_showcase_section', array(
        'title'       => 'بخش تعاملی استایل زیورآلات بر تن',
        'priority'    => 55,
        'description' => 'تنظیمات ویترین تعاملی ۴ آیتم صدف و مروارید و نمایش بر تن مدل در صفحه اصلی.',
    ) );

    $wp_customize->add_setting( 'showcase_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'showcase_enable', array(
        'label'    => 'نمایش بخش استایل بر تن در صفحه اصلی',
        'section'  => 'razgem_styling_showcase_section',
        'type'     => 'checkbox',
    ) );

    $wp_customize->add_setting( 'showcase_heading', array(
        'default'           => 'استایل زیورآلات صدف و مروارید بر تن',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'showcase_heading', array(
        'label'    => 'عنوان اصلی بخش',
        'section'  => 'razgem_styling_showcase_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'showcase_subheading', array(
        'default'           => 'برای مشاهده جلوه، درخشش و مقیاس طبیعی هر قطعه بر تن، آیتم مورد نظر را انتخاب نمایید.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'showcase_subheading', array(
        'label'    => 'زیرعنوان و توضیحات',
        'section'  => 'razgem_styling_showcase_section',
        'type'     => 'textarea',
    ) );

    // Default item definitions
    $default_showcase_items = array(
        1 => array(
            'title' => 'گردنبند صدف تراش‌خورده و مروارید باروک',
            'tag'   => 'صدف طبیعی اصل خلیج فارس',
            'desc'  => 'تراش ارگانیک صدف طبیعی با آویز مروارید باروک اصل، بر بستر طلای ۱۸ عیار دست‌ساز و زنجیر ظریف.',
            'price' => '۴,۸۵۰,۰۰۰ تومان',
            'url'   => '/shop',
            'model' => 'model-necklace-seashell.jpg',
            'thumb' => 'spotlight-pendant.jpg',
        ),
        2 => array(
            'title' => 'گوشواره آویز صدف بادبزنی و مروارید قطره‌ای',
            'tag'   => 'مروارید باروک طبیعی',
            'desc'  => 'طراحی الهام‌گرفته از امواج ساحل با صدف بادبزنی سفید و مروارید باروک درخشان و سبک‌وزن.',
            'price' => '۳,۴۰۰,۰۰۰ تومان',
            'url'   => '/shop',
            'model' => 'model-earrings-baroque.jpg',
            'thumb' => 'earrings-collection.jpg',
        ),
        3 => array(
            'title' => 'دستبند زنجیری صدف و سنگ‌های ساحلی',
            'tag'   => 'دست‌ساز آتلیه رازجم',
            'desc'  => 'ترکیب هنرمندانه صدف‌های تراش‌خورده مینیاتوری با سنگ‌های طبیعی و قفل طلای دست‌ساز.',
            'price' => '۲,۷۵۰,۰۰۰ تومان',
            'url'   => '/shop',
            'model' => 'model-bracelet-pendant.jpg',
            'thumb' => 'coastal-wave-shoreline.jpg',
        ),
        4 => array(
            'title' => 'مدال اشکی مروارید باروک زراندود',
            'tag'   => 'تک‌نسخه در طبیعت',
            'desc'  => 'هر مروارید باروک فرم طبیعی منحصربه‌فرد خود را دارد و هیچ دو مدالی در جهان یکسان نیستند.',
            'price' => '۵,۲۰۰,۰۰۰ تومان',
            'url'   => '/shop',
            'model' => 'model-pendant-atelier.jpg',
            'thumb' => 'spotlight-pendant.jpg',
        ),
    );

    for ( $i = 1; $i <= 4; $i++ ) {
        $wp_customize->add_setting( "showcase_item_{$i}_title", array(
            'default'           => $default_showcase_items[$i]['title'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "showcase_item_{$i}_title", array(
            'label'   => "عنوان آیتم {$i}",
            'section' => 'razgem_styling_showcase_section',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "showcase_item_{$i}_tag", array(
            'default'           => $default_showcase_items[$i]['tag'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "showcase_item_{$i}_tag", array(
            'label'   => "برچسب اصالت آیتم {$i}",
            'section' => 'razgem_styling_showcase_section',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "showcase_item_{$i}_desc", array(
            'default'           => $default_showcase_items[$i]['desc'],
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( "showcase_item_{$i}_desc", array(
            'label'   => "توضیح کوتاه آیتم {$i}",
            'section' => 'razgem_styling_showcase_section',
            'type'    => 'textarea',
        ) );

        $wp_customize->add_setting( "showcase_item_{$i}_price", array(
            'default'           => $default_showcase_items[$i]['price'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "showcase_item_{$i}_price", array(
            'label'   => "قیمت آیتم {$i}",
            'section' => 'razgem_styling_showcase_section',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "showcase_item_{$i}_url", array(
            'default'           => $default_showcase_items[$i]['url'],
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "showcase_item_{$i}_url", array(
            'label'   => "لینک خرید آیتم {$i}",
            'section' => 'razgem_styling_showcase_section',
            'type'    => 'url',
        ) );

        $wp_customize->add_setting( "showcase_item_{$i}_thumb", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "showcase_item_{$i}_thumb", array(
            'label'       => "تصویر نمونه محصول {$i}",
            'section'     => 'razgem_styling_showcase_section',
        ) ) );

        $wp_customize->add_setting( "showcase_item_{$i}_model", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "showcase_item_{$i}_model", array(
            'label'       => "تصویر استایل بر تن مدل {$i}",
            'section'     => 'razgem_styling_showcase_section',
        ) ) );
    }
}
add_action( 'customize_register', 'razgem_customize_register' );

/**
 * Helper to retrieve hero 3-part grid banner data (3 slides + 2 static promo cards).
 * Uses Customizer settings with rich fallbacks to authentic product imagery.
 *
 * @return array
 */
function razgem_get_hero_banners() {
    $theme_uri = get_template_directory_uri();

    $slide1_img = get_theme_mod( 'hero_slide_1_image', '' );
    $slide2_img = get_theme_mod( 'hero_slide_2_image', '' );
    $slide3_img = get_theme_mod( 'hero_slide_3_image', '' );
    $promo_top_img = get_theme_mod( 'hero_promo_top_image', '' );
    $promo_btm_img = get_theme_mod( 'hero_promo_btm_image', '' );

    return array(
        'slides' => array(
            array(
                'image' => ! empty( $slide1_img ) ? esc_url( $slide1_img ) : $theme_uri . '/assets/images/products/r003-front.png',
                'url'   => esc_url( get_theme_mod( 'hero_slide_1_url', '/product/r-003/' ) ),
                'alt'   => sanitize_text_field( get_theme_mod( 'hero_slide_1_alt', 'تابلو صدف دریایی طرح خورشید دست‌ساز کد R-003 - آتلیه رازجم' ) ),
                'badge' => 'اثر شاخص گالری',
                'title' => 'تابلو صدف دریایی طرح خورشید',
            ),
            array(
                'image' => ! empty( $slide2_img ) ? esc_url( $slide2_img ) : $theme_uri . '/assets/images/products/r001-main.jpg',
                'url'   => esc_url( get_theme_mod( 'hero_slide_2_url', '/product/r-001/' ) ),
                'alt'   => sanitize_text_field( get_theme_mod( 'hero_slide_2_alt', 'گوشواره هنری دست‌ساز با صدف طبیعی و مروارید باروک کد R-001' ) ),
                'badge' => 'صدف طبیعی اصل',
                'title' => 'گوشواره دست‌ساز مرجانی',
            ),
            array(
                'image' => ! empty( $slide3_img ) ? esc_url( $slide3_img ) : $theme_uri . '/assets/images/products/r004-main.png',
                'url'   => esc_url( get_theme_mod( 'hero_slide_3_url', '/product/r-004/' ) ),
                'alt'   => sanitize_text_field( get_theme_mod( 'hero_slide_3_alt', 'تابلو توتیای دریایی سه بعدی دست‌ساز کد R-004 - شاهکار طبیعی دریا' ) ),
                'badge' => 'سه‌بعدی و طبیعی',
                'title' => 'تابلو توتیای دریایی خلیج فارس',
            ),
        ),
        'promo_top' => array(
            'image' => ! empty( $promo_top_img ) ? esc_url( $promo_top_img ) : $theme_uri . '/assets/images/products/r002-main.jpg',
            'url'   => esc_url( get_theme_mod( 'hero_promo_top_url', '/product/r-002/' ) ),
            'alt'   => sanitize_text_field( get_theme_mod( 'hero_promo_top_alt', 'گوشواره صدف بادبزنی رگه‌دار طبیعی کد R-002' ) ),
            'badge' => 'ویژه فصل',
            'title' => 'گوشواره صدف بادبزنی',
        ),
        'promo_btm' => array(
            'image' => ! empty( $promo_btm_img ) ? esc_url( $promo_btm_img ) : $theme_uri . '/assets/images/products/r007-main.jpg',
            'url'   => esc_url( get_theme_mod( 'hero_promo_btm_url', '/product/r-007/' ) ),
            'alt'   => sanitize_text_field( get_theme_mod( 'hero_promo_btm_alt', 'چوکر مروارید باروک و صدف مخملی دست‌ساز کد R-007' ) ),
            'badge' => 'کالکشن سلطنتی',
            'title' => 'چوکر مروارید باروک و صدف',
        ),
    );
}

/**
 * Helper to retrieve hero image URL with fallback to local bundled asset.
 *
 * @return string Image URL
 */
function razgem_get_hero_image_url() {
    return razgem_get_hero_slide_url( 1 );
}

/**
 * Helper to retrieve hero slide image URL with fallback to local bundled assets.
 *
 * @param int $index Slide index (1, 2, or 3).
 * @return string Image URL.
 */
function razgem_get_hero_slide_url( $index = 1 ) {
    $banners = razgem_get_hero_banners();
    $idx = max( 0, min( 2, (int) $index - 1 ) );
    return $banners['slides'][$idx]['image'];
}

/**
 * Helper to retrieve atelier image URL with fallback to local bundled asset.
 *
 * @return string Image URL
 */
function razgem_get_atelier_image_url() {
    $custom_img = get_theme_mod( 'atelier_image', '' );
    if ( ! empty( $custom_img ) ) {
        return esc_url( $custom_img );
    }
    return get_template_directory_uri() . '/assets/images/atelier-story.jpg';
}

/**
 * Helper to retrieve interactive styling showcase items with local fallbacks.
 *
 * @return array Array of 4 items.
 */
function razgem_get_showcase_items() {
    $theme_uri = get_template_directory_uri();
    $defaults = array(
        1 => array(
            'title' => 'گوشواره هنری دست‌ساز با صدف طبیعی کد R-001',
            'tag'   => 'صدف طبیعی دست‌تراش خلیج فارس',
            'desc'  => 'تراش و فرم‌دهی دستی صدف طبیعی بدون رنگ‌آمیزی با درخشش مرجانی اصیل و اتصالات برنجی طلایی (ابعاد 4.8 × 4.3 سانتی‌متر).',
            'price' => '۱,۸۵۰,۰۰۰ تومان',
            'url'   => function_exists( 'razgem_product_url' ) ? razgem_product_url( 'r-001' ) : home_url( '/?post_type=product&view_product=r-001' ),
            'model' => $theme_uri . '/assets/images/model-earrings-baroque.jpg',
            'thumb' => $theme_uri . '/assets/images/products/r001-main.jpg',
        ),
        2 => array(
            'title' => 'گوشواره هنری دست‌ساز با صدف طبیعی کد R-002',
            'tag'   => 'نقش‌های طبیعی سفید، صورتی و زرشکی',
            'desc'  => 'نقش‌های طبیعی دریا با طیف رنگی سفید، صورتی و زرشکی دست‌تراش با یراق طلایی گرم (ابعاد 5.0 × 4.5 سانتی‌متر).',
            'price' => '۱,۹۵۰,۰۰۰ تومان',
            'url'   => function_exists( 'razgem_product_url' ) ? razgem_product_url( 'r-002' ) : home_url( '/?post_type=product&view_product=r-002' ),
            'model' => $theme_uri . '/assets/images/products/r002-dimensions.jpg',
            'thumb' => $theme_uri . '/assets/images/products/r002-main.jpg',
        ),
        3 => array(
            'title' => 'گردنبند صدف تراش‌خورده و مروارید باروک',
            'tag'   => 'صدف طبیعی و مروارید باروک اصل',
            'desc'  => 'تراش ارگانیک صدف طبیعی با آویز مروارید باروک اصل، بر بستر طلای ۱۸ عیار دست‌ساز و زنجیر ظریف.',
            'price' => '۳,۶۵۰,۰۰۰ تومان',
            'url'   => function_exists( 'razgem_product_url' ) ? razgem_product_url( 'r-003' ) : home_url( '/?post_type=product&view_product=r-003' ),
            'model' => $theme_uri . '/assets/images/model-necklace-seashell.jpg',
            'thumb' => $theme_uri . '/assets/images/spotlight-pendant.jpg',
        ),
        4 => array(
            'title' => 'دستبند زنجیری صدف و سنگ‌های ساحلی',
            'tag'   => 'دست‌ساز آتلیه رازجم',
            'desc'  => 'ترکیب هنرمندانه صدف‌های تراش‌خورده مینیاتوری با سنگ‌های طبیعی و قفل طلای دست‌ساز.',
            'price' => '۲,۲۰۰,۰۰۰ تومان',
            'url'   => function_exists( 'razgem_product_url' ) ? razgem_product_url( 'r-005' ) : home_url( '/?post_type=product&view_product=r-005' ),
            'model' => $theme_uri . '/assets/images/model-bracelet-pendant.jpg',
            'thumb' => $theme_uri . '/assets/images/coastal-wave-shoreline.jpg',
        ),
    );

    $items = array();
    for ( $i = 1; $i <= 4; $i++ ) {
        $custom_thumb = get_theme_mod( "showcase_item_{$i}_thumb", '' );
        $custom_model = get_theme_mod( "showcase_item_{$i}_model", '' );

        $items[] = array(
            'index' => $i - 1,
            'title' => get_theme_mod( "showcase_item_{$i}_title", $defaults[$i]['title'] ),
            'tag'   => get_theme_mod( "showcase_item_{$i}_tag", $defaults[$i]['tag'] ),
            'desc'  => get_theme_mod( "showcase_item_{$i}_desc", $defaults[$i]['desc'] ),
            'price' => get_theme_mod( "showcase_item_{$i}_price", $defaults[$i]['price'] ),
            'url'   => get_theme_mod( "showcase_item_{$i}_url", $defaults[$i]['url'] ),
            'thumb' => ! empty( $custom_thumb ) ? esc_url( $custom_thumb ) : $defaults[$i]['thumb'],
            'model' => ! empty( $custom_model ) ? esc_url( $custom_model ) : $defaults[$i]['model'],
        );
    }
    return $items;
}
