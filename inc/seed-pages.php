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


add_action( 'init', 'razgem_seed_essential_pages_v2' );
function razgem_seed_essential_pages_v2() {
    if ( get_option( 'razgem_pages_seeded_v2' ) ) {
        return;
    }

    // Track Order Page
    $track_page = get_page_by_path( 'track-order' );
    if ( ! $track_page ) {
        $track_content = '
<!-- wp:group {"align":"full","className":"razgem-tracking-wrapper"} -->
<div class="wp-block-group alignfull razgem-tracking-wrapper" style="padding-top: 4rem; padding-bottom: 4rem;">
<!-- wp:shortcode -->
[woocommerce_order_tracking]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->';

        wp_insert_post( array(
            'post_title'   => 'پیگیری سفارش',
            'post_name'    => 'track-order',
            'post_content' => $track_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
    }

    update_option( 'razgem_pages_seeded_v2', true );
}

add_action( 'init', 'razgem_seed_enamad_policy_pages' );
function razgem_seed_enamad_policy_pages() {
    if ( get_option( 'razgem_enamad_pages_seeded_v1' ) ) {
        return;
    }

    // 1. Terms & Conditions
    $terms_page = get_page_by_path( 'terms' );
    if ( ! $terms_page ) {
        $terms_content = '
<h2>۱. تعاریف و مقررات عمومی</h2>
<p>ورود کاربران به وب‌سایت گالری رازجم و ثبت سفارش به معنای آگاهی کامل و پذیرش کلیه شرایط و قوانین مندرج در این صفحه است. کلیه اصول و رویه‌های گالری رازجم منطبق با قانون تجارت الکترونیک، قانون حمایت از حقوق مصرف‌کننده و ضوابط مرکز توسعه تجارت الکترونیکی (اینماد) جمهوری اسلامی ایران می‌باشد.</p>

<h2>۲. ویژگی و اصالت آثار دست‌ساز</h2>
<p>کلیه زیورآلات و قطعات ارائه‌شده در گالری رازجم با استفاده از صدف‌های ۱۰۰٪ طبیعی خلیج فارس، مرواریدهای باروک اصل و اتصالات طلای ۱۸ عیار و نقره استرلینگ ۹۲۵ به صورت دست‌ساز در آتلیه طراحی و ساخته می‌شوند. به دلیل ماهیت ارگانیک صدف و مروارید، تفاوت‌های میکروسکوپی و طبیعی در بافت و فرم هر اثر نشانه اصالت آن بوده و عیب محصول محسوب نمی‌گردد.</p>

<div class="policy-callout policy-callout--law">
    <strong>تعهد شفافیت و قیمت‌گذاری:</strong> کلیه قیمت‌های درج‌شده در سایت به‌روز و بر مبنای عیار استاندارد و کارمزد ساخت هنری محاسبه گردیده و همراه با فاکتور رسمی معتبر گالری تقدیم می‌گردد.
</div>

<h2>۳. ثبت سفارش، پرداخت و تحویل</h2>
<p>کاربران گرامی موظفند در هنگام ثبت سفارش، اطلاعات پستی و شماره تماس خود را با دقت و صحت کامل وارد نمایند. ارسال سفارش‌ها با پست پیشتاز و بیمه کامل مرسوله به نشانی خریدار انجام می‌پذیرد. در صورت عدم حضور خریدار در محل یا نقص نشانی، هماهنگی‌های بعدی از طریق پیامک یا تماس با خریدار صورت خواهد گرفت.</p>

<h2>۴. حقوق مالکیت فکری و معنوی</h2>
<p>کلیه محتوا، تصاویر آثار، طراحی‌های صنعتی و نشان تجاری رازجم (RazGem) مشمول حمایت‌های قانون حمایت از حقوق مؤلفان و مصنفان بوده و هرگونه کپی‌برداری یا بازتولید تجاری بدون اجازه کتبی پیگرد قانونی خواهد داشت.</p>';

        wp_insert_post( array(
            'post_title'   => 'شرایط و قوانین خرید',
            'post_name'    => 'terms',
            'post_content' => $terms_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
    }

    // 2. Return & Refund Policy (Enamad Article 37 & 38)
    $return_page = get_page_by_path( 'return-policy' );
    if ( ! $return_page ) {
        $return_content = '
<h2>ضمانت ۷ روزه بازگشت کالا و اصالت گوهرشناسی</h2>
<p>رضایت خاطر و آسودگی خیال شما اولویت نخست آتلیه رازجم است. در راستای احترام به حقوق مشتریان و ماده ۳۷ قانون تجارت الکترونیک، خریداران محترم تا <strong>۷ روز کاری</strong> پس از تحویل کالا حق انصراف و بازگرداندن اثر را دارا می‌باشند.</p>

<div class="policy-callout">
    <strong>شرایط پذیرش مرجوعی کالا:</strong>
    <ul>
        <li>اثر باید در حالت اولیه، بدون هرگونه آسیب فیزیکی، خط و خش یا تغییر حالت نگهداری شده باشد.</li>
        <li>پلمپ و لیبل امنیتی الصاق‌شده به زیورآلات نباید باز یا مخدوش شده باشد.</li>
        <li>جعبه چوبی/مخملی نفیس هدیه و شناسنامه فیزیکی ممهور گالری همراه با مرسوله عودت داده شود.</li>
    </ul>
</div>

<h2>استثنائات قانونی حق انصراف</h2>
<p>مطابق با بند (د) ماده ۳۸ آیین‌نامه اجرایی قانون تجارت الکترونیک، سفارش‌هایی که به صورت اختصاصی با حکاکی اسم، تغییر سایز خاص یا بر مبنای ابعاد و سفارش ویژه مشتری طراحی و تولید شده‌اند، به دلیل ماهیت شخصی‌سازی‌شده و عدم امکان ارائه به شخص ثالث، مشمول حق انصراف سلیقه‌ای نمی‌باشند؛ اما در صورت هرگونه نقص فنی در ساخت، مشمول ضمانت تعمیر یا تعویض رایگان آتلیه خواهند بود.</p>

<h2>مراحل عودت و واریز وجه</h2>
<p>پس از دریافت مرسوله توسط واحد کنترل کیفیت آتلیه رازجم و تایید سلامت اثر، وجه سفارش ظرف مدت <strong>۲۴ الی ۴۸ ساعت کاری</strong> به همان شماره شبای بانکی که پرداخت با آن انجام شده است واریز خواهد شد.</p>';

        wp_insert_post( array(
            'post_title'   => 'ضمانت اصالت و رویه بازگشت کالا',
            'post_name'    => 'return-policy',
            'post_content' => $return_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
    }

    // 3. Privacy Policy
    $privacy_page = get_page_by_path( 'privacy' );
    if ( ! $privacy_page ) {
        $privacy_content = '
<h2>سیاست حفظ حریم خصوصی کاربران</h2>
<p>گالری رازجم متعهد به احترام و صیانت از حریم خصوصی کلیه مشتریان و بازدیدکنندگان وب‌سایت است. اطلاعات گردآوری‌شده از شما صرفاً جهت پردازش سفارش، صدور شناسنامه اثر، هماهنگی بارنامه پستی و اطلاع‌رسانی پیامکی وضعیت سفارش استفاده خواهد شد.</p>

<h2>اطلاعاتی که جمع‌آوری می‌شود</h2>
<ul>
    <li>نام و نام خانوادگی، شماره تماس همراه جهت تایید پیامکی و پیگیری مرسوله پستی.</li>
    <li>آدرس پستی دقیق و کد پستی ۱۰ رقمی به منظور صدور بارنامه شرکت ملی پست جمهوری اسلامی ایران.</li>
    <li>سوابق سفارش‌ها و پیام‌های پشتیبانی ثبت‌شده در حساب کاربری شما.</li>
</ul>

<div class="policy-callout policy-callout--law">
    <strong>عدم افشای اطلاعات:</strong> گالری رازجم تحت هیچ شرایطی اطلاعات فردی یا شماره تماس مشتریان را در اختیار اشخاص، شرکت‌ها یا نهادهای تبلیغاتی ثالث قرار نخواهد داد.
</div>

<h2>امنیت پرداخت و ارتباطات</h2>
<p>تمامی تراکنش‌های مالی به صورت مستقیم در درگاه‌های شاپرکی امن شبکه بانکی کشور با پروتکل رمزنگاری SSL ۲۵۶ بیتی انجام می‌شود و هیچ‌گونه اطلاعات مربوط به شماره کارت، رمز پویا یا CVV2 در سرورهای رازجم ذخیره نمی‌گردد.</p>';

        wp_insert_post( array(
            'post_title'   => 'سیاست حفظ حریم خصوصی',
            'post_name'    => 'privacy',
            'post_content' => $privacy_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
    }

    // 4. Shipping & Payment Policy
    $shipping_page = get_page_by_path( 'shipping-payment' );
    if ( ! $shipping_page ) {
        $shipping_content = '
<h2>شیوه‌های ارسال مرسولات</h2>
<p>کلیه سفارش‌های گالری رازجم با حساسیت و ظرافت ویژه در بسته‌بندی‌های ضدضربه و جعبه‌های نفیس قرار گرفته و با روش‌های زیر ارسال می‌گردند:</p>

<ul>
    <li><strong>پست پیشتاز ویژه سراسری:</strong> ارسال به تمامی شهرها و روستاهای کشور با پوشش کامل بیمه ارزش ریالی کالا. زمان تحویل بین ۲ الی ۴ روز کاری پس از تحویل به پست.</li>
    <li><strong>پیک امن اختصاصی (ویژه شهر تهران):</strong> هماهنگی مستقیم جهت تحویل در ساعت درخواستی مشتری.</li>
    <li><strong>ارسال رایگان:</strong> کلیه سفارش‌های بالای ۳ میلیون تومان به صورت رایگان و بیمه‌شده ارسال می‌شوند.</li>
</ul>

<h2>روش‌های پرداخت وجه</h2>
<p>پرداخت آنلاین از طریق کلیه کارت‌های عضو شبکه شتاب با درگاه‌های معتبر و مورد تایید بانک مرکزی جمهوری اسلامی ایران (شاپرک) امکان‌پذیر است. پس از تکمیل فرآیند پرداخت، فاکتور دیجیتال همراه با کد پیگیری یکتا بلافاصله پیامک خواهد شد.</p>';

        wp_insert_post( array(
            'post_title'   => 'شیوه‌های پرداخت و ارسال کالا',
            'post_name'    => 'shipping-payment',
            'post_content' => $shipping_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
    }

    // 5. FAQ Page
    $faq_page = get_page_by_path( 'faq' );
    if ( ! $faq_page ) {
        $faq_content = '
<h2>راهنمای سایز و سوالات متداول</h2>
<p>پاسخ به رایج‌ترین پرسش‌های خریداران گرامی درباره ابعاد، نگهداری و سفارش آثار صدف طبیعی و مروارید رازجم:</p>

<h3>۱. چگونه سایز مناسب دستبند و انگشتر را انتخاب کنم؟</h3>
<p>در صفحه هر محصول، ابعاد دقیق صدف و طول استاندارد زنجیر درج شده است. بیشتر انگشترهای آتلیه دارای رکاب چکش‌خورده با قابلیت تنظیم سایز (Free Size) هستند. برای سفارش سایز خاص، کافیست اندازه دور مچ یا قطر انگشت را در توضیحات سفارش اعلام فرمایید.</p>

<h3>۲. نحوه نگهداری از زیورآلات صدف طبیعی و مروارید باروک چگونه است؟</h3>
<p>صدف و مروارید گوهرهای زنده و ارگانیک دریا هستند. جهت حفظ درخشش، توصیه می‌شود از تماس مستقیم عطر، اسپری مو، الکل و مواد سفیدکننده با اثر خودداری نموده و پس از استفاده با دستمال مایکروفایبر نرم پاکسازی فرمایید.</p>

<h3>۳. آیا سفارش‌های هدیه قابلیت بسته‌بندی ویژه دارند؟</h3>
<p>تمامی آثار گالری رازجم به صورت پیش‌فرض در بسته‌بندی نفیس هدیه همراه با شناسنامه اصالت و ساک دستی شکیل تقدیم می‌شوند. همچنین امکان درج یادداشت دست‌نویس تبریک شما در بسته‌بندی وجود دارد.</p>';

        wp_insert_post( array(
            'post_title'   => 'راهنمای سایز و پرسش‌های متداول',
            'post_name'    => 'faq',
            'post_content' => $faq_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
    }

    update_option( 'razgem_enamad_pages_seeded_v1', true );
}
