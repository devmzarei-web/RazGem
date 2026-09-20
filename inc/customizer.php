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
    // 2. HERO SECTION & JEWELRY SPOTLIGHT
    // -------------------------------------------------------------------------
    $wp_customize->add_section( 'razgem_hero_section', array(
        'title'       => 'بخش هیرو و ویترین اصلی (Spotlight Hero)',
        'priority'    => 26,
        'description' => 'تنظیمات ویترین اصلی، تیترها، دکمه‌ها و نشانگرهای هوشمند روی تصویر',
    ) );

    // Hero Badge
    $wp_customize->add_setting( 'hero_badge', array(
        'default'           => 'کالکشن فاخر زیورآلات دست‌ساز',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_badge', array(
        'label'    => 'برچسب بالای تیتر (Badge)',
        'section'  => 'razgem_hero_section',
        'type'     => 'text',
    ) );

    // Hero Title
    $wp_customize->add_setting( 'hero_title', array(
        'default'           => 'درخشش اصالت و هنر دست در تلفیق طلا و مروارید رازجم',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_title', array(
        'label'    => 'تیتر اصلی هیرو (Peyda)',
        'section'  => 'razgem_hero_section',
        'type'     => 'text',
    ) );

    // Hero Subtitle / Description
    $wp_customize->add_setting( 'hero_subtitle', array(
        'default'           => 'طراحی و ساخت دست‌سازه‌های اختصاصی طلای ۱۸ عیار، مرواریدهای باروک طبیعی و سنگ‌های قیمتی',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'hero_subtitle', array(
        'label'    => 'متن توضیحات زیر تیتر',
        'section'  => 'razgem_hero_section',
        'type'     => 'textarea',
    ) );

    // Primary CTA Button
    $wp_customize->add_setting( 'hero_btn1_text', array(
        'default'           => 'مشاهده کالکشن زیورآلات',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_btn1_text', array(
        'label'    => 'متن دکمه اصلی (CTA 1)',
        'section'  => 'razgem_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'hero_btn1_url', array(
        'default'           => '/shop',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'hero_btn1_url', array(
        'label'    => 'لینک دکمه اصلی',
        'section'  => 'razgem_hero_section',
        'type'     => 'text',
    ) );

    // Secondary CTA Button
    $wp_customize->add_setting( 'hero_btn2_text', array(
        'default'           => 'سفارش ساخت اختصاصی',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_btn2_text', array(
        'label'    => 'متن دکمه دوم (CTA 2)',
        'section'  => 'razgem_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'hero_btn2_url', array(
        'default'           => '/contact',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'hero_btn2_url', array(
        'label'    => 'لینک دکمه دوم',
        'section'  => 'razgem_hero_section',
        'type'     => 'text',
    ) );

    // Hero Spotlight Slide 1 Image
    $wp_customize->add_setting( 'hero_slide_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_slide_image', array(
        'label'       => 'تصویر اسلاید اول هیرو (پیشنهادی: ۱۲۰۰x۱۲۰۰ پیکسل)',
        'section'     => 'razgem_hero_section',
        'description' => 'در صورت خالی بودن، تصویر مدال مروارید باروک و طلا لود می‌شود.',
    ) ) );

    $wp_customize->add_setting( 'hero_slide_1_tag', array(
        'default'           => 'مدال و آویز طلای ۱۸ عیار و مروارید باروک',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_slide_1_tag', array(
        'label'    => 'برچسب معرف اسلاید اول',
        'section'  => 'razgem_hero_section',
        'type'     => 'text',
    ) );

    // Hero Spotlight Slide 2 Image
    $wp_customize->add_setting( 'hero_slide_2_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_slide_2_image', array(
        'label'       => 'تصویر اسلاید دوم هیرو',
        'section'     => 'razgem_hero_section',
        'description' => 'در صورت خالی بودن، تصویر کالکشن گوشواره‌های دست‌ساز لود می‌شود.',
    ) ) );

    $wp_customize->add_setting( 'hero_slide_2_tag', array(
        'default'           => 'گوشواره‌های دست‌ساز مروارید و طلا',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_slide_2_tag', array(
        'label'    => 'برچسب معرف اسلاید دوم',
        'section'  => 'razgem_hero_section',
        'type'     => 'text',
    ) );

    // Hero Spotlight Slide 3 Image
    $wp_customize->add_setting( 'hero_slide_3_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_slide_3_image', array(
        'label'       => 'تصویر اسلاید سوم هیرو',
        'section'     => 'razgem_hero_section',
        'description' => 'در صورت خالی بودن، تصویر آتلیه زرگری و ساخت اختصاصی لود می‌شود.',
    ) ) );

    $wp_customize->add_setting( 'hero_slide_3_tag', array(
        'default'           => 'آتلیه و ساخت اختصاصی زیورآلات',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_slide_3_tag', array(
        'label'    => 'برچسب معرف اسلاید سوم',
        'section'  => 'razgem_hero_section',
        'type'     => 'text',
    ) );

    // Hotspot Pin 1
    $wp_customize->add_setting( 'hero_pin1_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'hero_pin1_enable', array(
        'label'    => 'فعال‌سازی نشانگر اول (Pin 1)',
        'section'  => 'razgem_hero_section',
        'type'     => 'checkbox',
    ) );

    $wp_customize->add_setting( 'hero_pin1_text', array(
        'default'           => 'طلای ۱۸ عیار دست‌ساز',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_pin1_text', array(
        'label'    => 'متن نشانگر اول',
        'section'  => 'razgem_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'hero_pin1_x', array(
        'default'           => 38,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'hero_pin1_x', array(
        'label'       => 'موقعیت افقی نشانگر ۱ (درصد: 0-100)',
        'section'     => 'razgem_hero_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 100, 'step' => 1 ),
    ) );

    $wp_customize->add_setting( 'hero_pin1_y', array(
        'default'           => 42,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'hero_pin1_y', array(
        'label'       => 'موقعیت عمودی نشانگر ۱ (درصد: 0-100)',
        'section'     => 'razgem_hero_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 100, 'step' => 1 ),
    ) );

    // Hotspot Pin 2
    $wp_customize->add_setting( 'hero_pin2_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'hero_pin2_enable', array(
        'label'    => 'فعال‌سازی نشانگر دوم (Pin 2)',
        'section'  => 'razgem_hero_section',
        'type'     => 'checkbox',
    ) );

    $wp_customize->add_setting( 'hero_pin2_text', array(
        'default'           => 'مروارید اصل باروک خلیج فارس',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_pin2_text', array(
        'label'    => 'متن نشانگر دوم',
        'section'  => 'razgem_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'hero_pin2_x', array(
        'default'           => 56,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'hero_pin2_x', array(
        'label'       => 'موقعیت افقی نشانگر ۲ (درصد: 0-100)',
        'section'     => 'razgem_hero_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 100, 'step' => 1 ),
    ) );

    $wp_customize->add_setting( 'hero_pin2_y', array(
        'default'           => 64,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'hero_pin2_y', array(
        'label'       => 'موقعیت عمودی نشانگر ۲ (درصد: 0-100)',
        'section'     => 'razgem_hero_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 100, 'step' => 1 ),
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

    $wp_customize->add_setting( 'atelier_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'atelier_image', array(
        'label'       => 'تصویر استودیو و کارگاه زرگری',
        'section'     => 'razgem_atelier_section',
        'description' => 'در صورت خالی بودن، تصویر طراحی آتلیه و میز کارشناس باروک لود خواهد شد.',
    ) ) );

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
}
add_action( 'customize_register', 'razgem_customize_register' );

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
    if ( 1 === (int) $index ) {
        $custom_img = get_theme_mod( 'hero_slide_image', '' );
        if ( ! empty( $custom_img ) ) {
            return esc_url( $custom_img );
        }
        return get_template_directory_uri() . '/assets/images/spotlight-pendant.jpg';
    } elseif ( 2 === (int) $index ) {
        $custom_img = get_theme_mod( 'hero_slide_2_image', '' );
        if ( ! empty( $custom_img ) ) {
            return esc_url( $custom_img );
        }
        return get_template_directory_uri() . '/assets/images/earrings-collection.jpg';
    } elseif ( 3 === (int) $index ) {
        $custom_img = get_theme_mod( 'hero_slide_3_image', '' );
        if ( ! empty( $custom_img ) ) {
            return esc_url( $custom_img );
        }
        return get_template_directory_uri() . '/assets/images/atelier-story.jpg';
    }
    return get_template_directory_uri() . '/assets/images/spotlight-pendant.jpg';
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
