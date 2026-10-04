<?php
/**
 * Automatically seeds the About Us and Contact Us pages if they don't exist.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', 'razgem_seed_essential_pages' );

function razgem_seed_essential_pages() {
    // Only run this once. We use an option to flag if it's done.
    if ( get_option( 'razgem_pages_seeded_v1' ) ) {
        return;
    }

    // 1. About Us Page
    $about_page = get_page_by_path( 'about-us' );
    if ( ! $about_page ) {
        $about_content = '
<!-- wp:group {"align":"full","className":"razgem-about-wrapper"} -->
<div class="wp-block-group alignfull razgem-about-wrapper" style="padding-top: 4rem; padding-bottom: 4rem;">

<!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="has-text-align-center" style="color: #1B3347; font-weight: 800; font-size: 2.5rem; margin-bottom: 1rem;">داستان رازجم</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center" style="color: #5A7B92; font-size: 1.1rem; max-width: 600px; margin: 0 auto 3rem auto;">تلفیقی از اصالت صدف‌های طبیعی خلیج فارس و هنر دست استادکاران ایرانی</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide" style="gap: 4rem; margin-bottom: 4rem; align-items: center;">
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":2} -->
        <h2 style="color: #1B3347; font-weight: 700; margin-bottom: 1.5rem;">ریشه‌های یک ایده بکر</h2>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p style="line-height: 1.8; color: #4A6375;">گالری رازجم با الهام از زیبایی‌های بی‌نظیر سواحل جنوبی ایران و با هدف خلق آثار هنری ماندگار از دل طبیعت متولد شد. هر قطعه در کارگاه ما، روایتگر داستانی از اعماق دریاست که با دستان هنرمند تراشکاران و طراحان ما، به یک جواهر لوکس و منحصربه‌فرد تبدیل می‌شود.</p>
        <!-- /wp:paragraph -->
        <!-- wp:paragraph -->
        <p style="line-height: 1.8; color: #4A6375;">ما بر این باوریم که زیبایی واقعی در نقص‌های طبیعی و فرم‌های ارگانیک (مانند مرواریدهای باروک) نهفته است. به همین دلیل، هیچ‌گونه دستکاری شیمیایی روی صدف‌ها انجام نمی‌دهیم و اصالت آن‌ها را با تمام وجود حفظ می‌کنیم.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:image {"sizeSlug":"large","className":"is-style-rounded"} -->
        <figure class="wp-block-image size-large is-style-rounded" style="box-shadow: 0 12px 40px rgba(27, 51, 71, 0.1); border-radius: 24px; overflow: hidden;"><img src="' . get_template_directory_uri() . '/assets/images/about-image.jpg" alt="کارگاه رازجم"/></figure>
        <!-- /wp:image -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:shortcode -->
[razgem_atelier]
<!-- /wp:shortcode -->

</div>
<!-- /wp:group -->';

        $about_page_id = wp_insert_post( array(
            'post_title'   => 'درباره ما',
            'post_name'    => 'about-us',
            'post_content' => $about_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
    }

    // 2. Contact Us Page
    $contact_page = get_page_by_path( 'contact-us' );
    if ( ! $contact_page ) {
        $contact_content = '
<!-- wp:group {"align":"full","className":"razgem-contact-wrapper"} -->
<div class="wp-block-group alignfull razgem-contact-wrapper" style="padding-top: 4rem; padding-bottom: 4rem;">

<!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="has-text-align-center" style="color: #1B3347; font-weight: 800; font-size: 2.5rem; margin-bottom: 1rem;">ارتباط با ما</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center" style="color: #5A7B92; font-size: 1.1rem; max-width: 600px; margin: 0 auto 4rem auto;">برای ثبت سفارش اختصاصی، مشاوره گوهرشناسی و یا هرگونه سوال، با کمال میل پاسخگوی شما هستیم.</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide" style="gap: 3rem;">
    <!-- wp:column {"width":"40%"} -->
    <div class="wp-block-column" style="flex-basis: 40%; background: #FBF8F2; padding: 2.5rem; border-radius: 24px; border: 1px solid rgba(229, 213, 194, 0.4);">
        <!-- wp:heading {"level":3} -->
        <h3 style="color: #1B3347; margin-bottom: 1.5rem;">اطلاعات تماس</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p style="margin-bottom: 1rem;"><strong>📍 آدرس گالری:</strong><br>تهران، [آدرس دقیق درج شود]</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p style="margin-bottom: 1rem;"><strong>📞 تلفن تماس:</strong><br><a href="tel:02100000000" style="color: #1B3347; text-decoration: none; direction: ltr; display: inline-block;">021 - 000 000 00</a></p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p style="margin-bottom: 1rem;"><strong>✉️ ایمیل:</strong><br><a href="mailto:info@razgem.ir" style="color: #1B3347; text-decoration: none;">info@razgem.ir</a></p>
        <!-- /wp:paragraph -->

        <!-- wp:paragraph -->
        <p style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(27, 51, 71, 0.1);"><strong>ساعات کاری:</strong><br>شنبه تا چهارشنبه: ۱۰ صبح تا ۶ عصر</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column {"width":"60%"} -->
    <div class="wp-block-column" style="flex-basis: 60%; padding: 2.5rem; background: #fff; border-radius: 24px; box-shadow: 0 12px 40px rgba(27, 51, 71, 0.05); border: 1px solid rgba(27, 51, 71, 0.05);">
        <!-- wp:heading {"level":3} -->
        <h3 style="color: #1B3347; margin-bottom: 1.5rem;">ارسال پیام</h3>
        <!-- /wp:heading -->
        <!-- wp:shortcode -->
        [razgem_contact_form]
        <!-- /wp:shortcode -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->

</div>
<!-- /wp:group -->';

        $contact_page_id = wp_insert_post( array(
            'post_title'   => 'تماس با ما',
            'post_name'    => 'contact-us',
            'post_content' => $contact_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
    }

    // Flag as seeded
    update_option( 'razgem_pages_seeded_v1', true );
}

