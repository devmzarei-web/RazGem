<?php
/**
 * Template Name: About Us Layout (داستان و آتلیه رازجم)
 * Template Post Type: page
 *
 * @package RazGem
 * @version 2.5.0
 */
defined( 'ABSPATH' ) || exit;
get_header();

// Fetch dynamic theme mods from Customizer (Fully manageable via WP Admin -> Customize)
$atelier_badge    = get_theme_mod( 'atelier_badge', 'آتلیه زرگری و گوهرهای طبیعی رازجم' );
$atelier_title    = get_theme_mod( 'atelier_title', 'داستان رازجم؛ تلاقی اصالت دریا و شکوه هنر ایرانی' );
$atelier_desc     = get_theme_mod( 'atelier_desc', 'روایتی یگانه از پیوند صدف‌های طبیعی وارداتی اصل، مرواریدهای باروک دست‌چین و دستان هنرمند زرگران اصیل؛ جایی که هر گوهر، هویتی تکرارناپذیر و روحی جاودان دارد.' );

$station_1_img    = get_theme_mod( 'atelier_image_1', get_template_directory_uri() . '/assets/images/workstation-1.jpg' );
$station_1_title  = get_theme_mod( 'atelier_title_1', 'میز شماره ۱: پایش گوهرشناسی و گزینش صدف وحشی' );
$station_1_desc   = get_theme_mod( 'atelier_desc_1', 'بررسی املاح معدنی، ضخامت لایه‌های صدفی و غربالگری دقیق ارگانیک از آب‌های سواحل جنوبی ایران.' );

$station_2_img    = get_theme_mod( 'atelier_image_2', get_template_directory_uri() . '/assets/images/workstation-2.jpg' );
$station_2_title  = get_theme_mod( 'atelier_title_2', 'میز شماره ۲: تراش دست‌ساز و صیقل ارگانیک' );
$station_2_desc   = get_theme_mod( 'atelier_desc_2', 'تراش اختصاصی بدون استفاده از حرارت تخریب‌کننده و پرداخت میکروسکوپی با روغن‌های طبیعی جهت تجلی حداکثر تلألو.' );

$station_3_img    = get_theme_mod( 'atelier_image_3', get_template_directory_uri() . '/assets/images/workstation-3.jpg' );
$station_3_title  = get_theme_mod( 'atelier_title_3', 'میز شماره ۳: اتصال هنری و یراق‌آلات باکیفیت' );
$station_3_desc   = get_theme_mod( 'atelier_desc_3', 'مخراج‌کاری ظریف، تعبیه پایه‌های مقاوم ضدحساسیت و صدور شناسنامه فیزیکی ممهور برای هر اثر اختصاصی.' );
?>

<main class="site-container utility-page about-us-experience" dir="rtl" role="main">
    
    <!-- 1. HERO MAISON BANNER -->
    <header class="about-hero-section">
        <div class="about-hero-badge">
            <span class="badge-icon">🦪</span>
            <span><?php echo esc_html( $atelier_badge ); ?></span>
        </div>
        
        <h1 class="about-hero-title">
            <?php echo esc_html( $atelier_title ); ?>
        </h1>
        
        <p class="about-hero-lead">
            <?php echo esc_html( $atelier_desc ); ?>
        </p>

        <div class="about-hero-stats">
            <div class="stat-pill">
                <span class="stat-number">۱۰۰٪</span>
                <span class="stat-label">صدف‌های طبیعی وارداتی اصل</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-pill">
                <span class="stat-number">دست‌ساز</span>
                <span class="stat-label">مخراج‌کاری و هنر اصیل آتلیه</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-pill">
                <span class="stat-number">یگانه</span>
                <span class="stat-label">طراحی و نقوش تکرارناپذیر ارگانیک</span>
            </div>
        </div>
    </header>

    <!-- 2. EDITABLE WORDPRESS CONTENT (Manageable in WP Admin -> Pages -> Edit "About Us") -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php 
        $raw_content = get_the_content();
        if ( ! empty( trim( $raw_content ) ) ) : 
        ?>
            <section class="about-editorial-wrapper">
                <div class="editorial-card">
                    <div class="editorial-card-header">
                        <span class="editorial-eyebrow">روایت آتلیه (قابل ویرایش در پیشخوان وردپرس)</span>
                        <h2 class="editorial-heading"><?php the_title(); ?></h2>
                    </div>
                    <div class="editorial-body">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
        <?php else : ?>
            <!-- Fallback Narrative if Editor is empty -->
            <section class="about-editorial-wrapper">
                <div class="editorial-card">
                    <div class="editorial-card-header">
                        <span class="editorial-eyebrow">فلسفه وجودی</span>
                        <h2 class="editorial-heading">ریشه‌های یک ایده بکر از دل امواج جنوب</h2>
                    </div>
                    <div class="editorial-body">
                        <p>
                            گالری رازجم با الهام از زیبایی‌های بی‌نظیر و رازآلود سواحل جنوبی ایران و با رسالت خلق آثار هنری ماندگار از دل طبیعت متولد شد. هر قطعه در کارگاه ما، روایتگر داستانی اصیل از اعماق آب‌های دریا و اقیانوس است که با دستان هنرمند استادکاران زرگر و گوهرتراشان ایرانی، به جواهری فاخر و متمایز مبدل می‌گردد.
                        </p>
                        <p>
                            ما بر این باوریم که کمال واقعی در نقص‌های ارگانیک و بی‌بدیل طبیعت نهفته است. در آتلیه رازجم، هیچ‌گونه دستکاری شیمیایی یا رنگ‌آمیزی مصنوعی روی صدف‌ها انجام نمی‌شود؛ رنگ‌های صورتی، مرجانی، عاجی و رنگین‌کمانی همگی بازتاب خالص سال‌ها هم‌نشینی صدف با املاح دریا و انوار زرین آفتاب جنوب هستند.
                        </p>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; endif; ?>

    <!-- 3. THREE CORE PILLARS OF RAZGEM -->
    <section class="about-pillars-section">
        <div class="section-title-wrap">
            <h2 class="section-main-title">ارکان سه‌گانه اصالت و تعهد رازجم</h2>
            <p class="section-subtitle">اصولی که هنر دست ما را از هر زیور صنعتی دیگری متمایز می‌سازد</p>
        </div>

        <div class="pillars-grid">
            <div class="pillar-card">
                <div class="pillar-icon-box">
                    <span class="pillar-emoji">🌊</span>
                </div>
                <h3 class="pillar-title">صدف‌های ۱۰۰٪ طبیعی و حفاظت‌شده</h3>
                <p class="pillar-desc">
                    گزینش اختصاصی از گونه‌های صدف طبیعی وارداتی درجه یک، بدون کوچک‌ترین آسیب به ذخایر زنده مرجانی، با احترام عمیق به بوم‌سازگان دریا.
                </p>
                <div class="pillar-tag">اصالت صدف‌های طبیعی وارداتی</div>
            </div>

            <div class="pillar-card">
                <div class="pillar-icon-box">
                    <span class="pillar-emoji">✨</span>
                </div>
                <h3 class="pillar-title">مرواریدهای باروک با فرم ارگانیک</h3>
                <p class="pillar-desc">
                    مرواریدهای آب شیرین و باروک طبیعی با هندسه‌های مجسمه‌ای منحصربه‌فرد؛ هر قطعه قطره‌ای یگانه از اشک دریاست که هرگز لنگه‌ای نخواهد داشت.
                </p>
                <div class="pillar-tag">تکرارناپذیر و انحصاری</div>
            </div>

            <div class="pillar-card">
                <div class="pillar-icon-box">
                    <span class="pillar-emoji">🛡️</span>
                </div>
                <h3 class="pillar-title">شناسنامه فیزیکی و اصالت گوهرشناسی</h3>
                <p class="pillar-desc">
                    تمامی قطعات با صدف‌های طبیعی اصل و مرواریدهای باروک، همراه با شناسنامه هولوگرام‌دار ممهور و بسته‌بندی مخملی ویژه تقدیم می‌شوند.
                </p>
                <div class="pillar-tag">ضمانت مادام‌العمر اصالت</div>
            </div>
        </div>
    </section>

    <!-- 4. ATELIER WORKSTATIONS JOURNEY (Manageable in WP Customize -> Atelier) -->
    <section class="about-atelier-steps">
        <div class="section-title-wrap">
            <div class="badge-mini">پشت صحنه آتلیه</div>
            <h2 class="section-main-title">مسیر خلق؛ از بستر امواج تا درخشش بر تن شما</h2>
            <p class="section-subtitle">فرآیند دقیق و چندمرحله‌ای هنرمندان و گوهرتراشان در کارگاه تخصصی رازجم</p>
        </div>

        <div class="workstations-timeline">
            <!-- Step 1 -->
            <div class="workstation-row">
                <div class="workstation-media">
                    <img src="<?php echo esc_url( $station_1_img ); ?>" 
                         alt="<?php echo esc_attr( $station_1_title ); ?>" 
                         loading="lazy"
                         onerror="this.src='<?php echo esc_url( get_template_directory_uri() . '/assets/images/atelier-story.jpg' ); ?>'">
                    <span class="step-badge">مرحله اول</span>
                </div>
                <div class="workstation-content">
                    <span class="workstation-tag">پایش و گزینش گوهرشناسی</span>
                    <h3 class="workstation-title"><?php echo esc_html( $station_1_title ); ?></h3>
                    <p class="workstation-desc"><?php echo esc_html( $station_1_desc ); ?></p>
                    <ul class="workstation-features">
                        <li>تفکیک نقوش طبیعی و امواج رنگین‌کمانی</li>
                        <li>سنجش ساختار کلسیمی و سلامت فیزیکی صدف</li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="workstation-row workstation-row--reverse">
                <div class="workstation-media">
                    <img src="<?php echo esc_url( $station_2_img ); ?>" 
                         alt="<?php echo esc_attr( $station_2_title ); ?>" 
                         loading="lazy"
                         onerror="this.src='<?php echo esc_url( get_template_directory_uri() . '/assets/images/model-pendant-atelier.jpg' ); ?>'">
                    <span class="step-badge">مرحله دوم</span>
                </div>
                <div class="workstation-content">
                    <span class="workstation-tag">تراش و صیقل دست‌ساز</span>
                    <h3 class="workstation-title"><?php echo esc_html( $station_2_title ); ?></h3>
                    <p class="workstation-desc"><?php echo esc_html( $station_2_desc ); ?></p>
                    <ul class="workstation-features">
                        <li>حفظ خطوط رشد طبیعی و کانتورهای مینیاتوری</li>
                        <li>پرداخت دست‌ساز چندمرحله‌ای تا دستیابی به درخشش آینه‌ای</li>
                    </ul>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="workstation-row">
                <div class="workstation-media">
                    <img src="<?php echo esc_url( $station_3_img ); ?>" 
                         alt="<?php echo esc_attr( $station_3_title ); ?>" 
                         loading="lazy"
                         onerror="this.src='<?php echo esc_url( get_template_directory_uri() . '/assets/images/model-earrings-baroque.jpg' ); ?>'">
                    <span class="step-badge">مرحله سوم</span>
                </div>
                <div class="workstation-content">
                    <span class="workstation-tag">مونتاژ هنری و شناسنامه‌گذاری</span>
                    <h3 class="workstation-title"><?php echo esc_html( $station_3_title ); ?></h3>
                    <p class="workstation-desc"><?php echo esc_html( $station_3_desc ); ?></p>
                    <ul class="workstation-features">
                        <li>نشاندن صدف بر رکاب‌های دست‌ساز با ایمنی و استحکام ارگونومیک</li>
                        <li>ثبت کد انحصاری اثر و صدور سند گواهی گوهرشناسی</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. NATURAL AUTHENTICITY VS MASS-MARKET COMPARISON -->
    <section class="about-comparison-section">
        <div class="comparison-card">
            <div class="comparison-side comparison-side--authentic">
                <div class="comp-badge">اصالت رازجم</div>
                <h3 class="comp-title">گوهرهای دست‌ساز و صدف واقعی دریا</h3>
                <ul class="comp-list">
                    <li><span class="icon-check">✓</span> صدف‌های اصیل و طبیعی وارداتی بدون رزین و پلاستیک</li>
                    <li><span class="icon-check">✓</span> تلألو رنگین‌کمانی طبیعی که با گذشت زمان محو نمی‌شود</li>
                    <li><span class="icon-check">✓</span> مرواریدهای باروک با فرم‌های مجسمه‌ای اختصاصی</li>
                    <li><span class="icon-check">✓</span> یراق‌آلات و اتصالات ضدحساسیت رنگ‌ثابت با دوام و درخشش پایدار</li>
                    <li><span class="icon-check">✓</span> همراه با شناسنامه معتبر فیزیکی و کد ثبتی گالری</li>
                </ul>
            </div>
            
            <div class="comparison-side comparison-side--industrial">
                <div class="comp-badge comp-badge--gray">زیورآلات صنعتی و کپی</div>
                <h3 class="comp-title">تولید انبوه و مواد مصنوعی</h3>
                <ul class="comp-list comp-list--cross">
                    <li><span class="icon-cross">✕</span> صدف‌های مصنوعی فشرده‌شده از پودر رزین شیمیایی</li>
                    <li><span class="icon-cross">✕</span> پوشش‌های رنگی صنعتی که در تماس با عطر و آب کدر می‌شوند</li>
                    <li><span class="icon-cross">✕</span> مرواریدهای پلاستیکی شبیه‌سازی‌شده و یکدست ماشینی</li>
                    <li><span class="icon-cross">✕</span> یراق‌آلات آلیاژی ارزان‌قیمت با احتمال ایجاد آلرژی پوستی</li>
                    <li><span class="icon-cross">✕</span> فاقد هرگونه اصالت گوهرشناسی، سند یا ارزش مادی پایدار</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- 6. ATELIER CTA & CONSULTATION BANNER -->
    <section class="about-cta-banner">
        <div class="cta-banner-content">
            <span class="cta-eyebrow">سفارش ساخت اختصاصی</span>
            <h2 class="cta-title">ایده ذهنی خود را به شاهکاری از صدف و گوهر بدل کنید</h2>
            <p class="cta-desc">
                آیا مایلید قطعه‌ای سفارشی با صدف و مروارید دلخواه شما در آتلیه رازجم طراحی و ساخته شود؟ هنرمندان ما آماده ارائه مشاوره مستقیم به شما هستند.
            </p>
            <div class="cta-actions">
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-coastal-gold">
                    <span>درخواست مشاوره و سفارش اختصاصی</span>
                    <span class="btn-arrow">←</span>
                </a>
                <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="btn-coastal-outline">
                    <span>مشاهده کالکشن کامل زیورآلات</span>
                </a>
            </div>
        </div>
    </section>

</main>

<style>
/* =========================================================================
   ABOUT US EXPERIENCE - COASTAL LUXURY STYLING
   ========================================================================= */
.about-us-experience {
    padding-top: 3.5rem;
    padding-bottom: 6rem;
    color: var(--color-marine-deep, #1B3347);
}

/* 1. Hero Banner */
.about-hero-section {
    text-align: center;
    max-width: 880px;
    margin: 0 auto 4.5rem auto;
    position: relative;
}
.about-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(212, 175, 55, 0.12);
    color: #9E7D3B;
    border: 1px solid rgba(212, 175, 55, 0.28);
    padding: 0.45rem 1.4rem;
    border-radius: 999px;
    font-size: 0.88rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}
.about-hero-title {
    font-family: var(--font-heading);
    font-size: 2.7rem;
    font-weight: 800;
    line-height: 1.4;
    color: var(--color-marine-deep, #1B3347);
    margin: 0 0 1.5rem 0;
}
.about-hero-lead {
    font-size: 1.15rem;
    line-height: 2.1;
    color: var(--color-marine-muted, #566E80);
    margin: 0 auto 2.5rem auto;
    max-width: 720px;
}
.about-hero-stats {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 2rem;
    background: #FFFFFF;
    border: 1px solid var(--color-pebble-light, #EAE3DA);
    padding: 1.2rem 2.5rem;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(27, 51, 71, 0.04);
    max-width: 720px;
    margin: 0 auto;
}
.stat-pill {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.3rem;
}
.stat-number {
    font-family: var(--font-heading);
    font-size: 1.6rem;
    font-weight: 800;
    color: #D4AF37;
}
.stat-label {
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--color-marine-muted, #566E80);
}
.stat-divider {
    width: 1px;
    height: 36px;
    background: var(--color-pebble-light, #EAE3DA);
}

/* 2. Editorial Story */
.about-editorial-wrapper {
    margin-bottom: 5rem;
}
.editorial-card {
    background: #FFFFFF;
    border: 1px solid var(--color-pebble-light, #EAE3DA);
    border-radius: 24px;
    padding: 3rem 3.5rem;
    box-shadow: 0 15px 45px rgba(27, 51, 71, 0.04);
    position: relative;
    overflow: hidden;
}
.editorial-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 6px;
    height: 100%;
    background: linear-gradient(180deg, #D4AF37 0%, #1B3347 100%);
}
.editorial-eyebrow {
    display: inline-block;
    font-size: 0.8rem;
    font-weight: 700;
    color: #D4AF37;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
}
.editorial-heading {
    font-family: var(--font-heading);
    font-size: 1.85rem;
    font-weight: 800;
    color: var(--color-marine-deep, #1B3347);
    margin: 0 0 1.5rem 0;
}
.editorial-body {
    font-size: 1.05rem;
    line-height: 2.2;
    color: #3B5366;
}
.editorial-body p {
    margin-bottom: 1.2rem;
}
.editorial-body p:last-child {
    margin-bottom: 0;
}

/* 3. Pillars */
.about-pillars-section {
    margin-bottom: 5.5rem;
}
.section-title-wrap {
    text-align: center;
    max-width: 650px;
    margin: 0 auto 3rem auto;
}
.badge-mini {
    display: inline-block;
    font-size: 0.82rem;
    font-weight: 700;
    color: #D4AF37;
    background: rgba(212, 175, 55, 0.1);
    padding: 0.3rem 1rem;
    border-radius: 999px;
    margin-bottom: 0.8rem;
}
.section-main-title {
    font-family: var(--font-heading);
    font-size: 2.1rem;
    font-weight: 800;
    color: var(--color-marine-deep, #1B3347);
    margin: 0 0 0.8rem 0;
}
.section-subtitle {
    font-size: 1rem;
    color: var(--color-marine-muted, #566E80);
    margin: 0;
    line-height: 1.8;
}
.pillars-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
    gap: 1.8rem;
}
.pillar-card {
    background: #FFFFFF;
    border: 1px solid var(--color-pebble-light, #EAE3DA);
    border-radius: 22px;
    padding: 2.5rem 2rem;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    box-shadow: 0 8px 25px rgba(27, 51, 71, 0.03);
}
.pillar-card:hover {
    transform: translateY(-5px);
    border-color: #D4AF37;
    box-shadow: 0 16px 40px rgba(212, 175, 55, 0.1);
}
.pillar-icon-box {
    width: 60px;
    height: 60px;
    border-radius: 18px;
    background: #FAF6F0;
    border: 1px solid rgba(212, 175, 55, 0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin-bottom: 1.5rem;
}
.pillar-title {
    font-family: var(--font-heading);
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--color-marine-deep, #1B3347);
    margin: 0 0 0.8rem 0;
    line-height: 1.5;
}
.pillar-desc {
    font-size: 0.95rem;
    line-height: 1.9;
    color: var(--color-marine-muted, #566E80);
    margin: 0 0 1.5rem 0;
    flex-grow: 1;
}
.pillar-tag {
    font-size: 0.78rem;
    font-weight: 700;
    color: #9E7D3B;
    background: #FAF6F0;
    padding: 0.35rem 0.9rem;
    border-radius: 8px;
}

/* 4. Workstations Timeline */
.about-atelier-steps {
    margin-bottom: 5.5rem;
}
.workstations-timeline {
    display: flex;
    flex-direction: column;
    gap: 3.5rem;
}
.workstation-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3.5rem;
    align-items: center;
    background: #FFFFFF;
    border: 1px solid var(--color-pebble-light, #EAE3DA);
    border-radius: 28px;
    padding: 2.2rem;
    box-shadow: 0 12px 35px rgba(27, 51, 71, 0.04);
}
.workstation-row--reverse {
    direction: ltr;
}
.workstation-row--reverse .workstation-content,
.workstation-row--reverse .workstation-media {
    direction: rtl;
}
.workstation-media {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    height: 340px;
    background: #FAF6F0;
}
.workstation-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}
.workstation-row:hover .workstation-media img {
    transform: scale(1.04);
}
.step-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(27, 51, 71, 0.88);
    backdrop-filter: blur(8px);
    color: #FAF8F5;
    padding: 0.4rem 1rem;
    border-radius: 999px;
    font-size: 0.82rem;
    font-weight: 700;
    border: 1px solid rgba(212, 175, 55, 0.4);
}
.workstation-content {
    display: flex;
    flex-direction: column;
}
.workstation-tag {
    font-size: 0.85rem;
    font-weight: 700;
    color: #D4AF37;
    margin-bottom: 0.6rem;
}
.workstation-title {
    font-family: var(--font-heading);
    font-size: 1.65rem;
    font-weight: 800;
    color: var(--color-marine-deep, #1B3347);
    margin: 0 0 1rem 0;
    line-height: 1.4;
}
.workstation-desc {
    font-size: 1rem;
    line-height: 2;
    color: var(--color-marine-muted, #566E80);
    margin: 0 0 1.2rem 0;
}
.workstation-features {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
}
.workstation-features li {
    font-size: 0.92rem;
    color: var(--color-marine-deep, #1B3347);
    font-weight: 600;
    position: relative;
    padding-right: 1.5rem;
}
.workstation-features li::before {
    content: '◆';
    position: absolute;
    right: 0;
    color: #D4AF37;
    font-size: 0.75rem;
}

/* 5. Comparison Card */
.about-comparison-section {
    margin-bottom: 5.5rem;
}
.comparison-card {
    display: grid;
    grid-template-columns: 1fr 1fr;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 15px 45px rgba(27, 51, 71, 0.06);
    border: 1px solid var(--color-pebble-light, #EAE3DA);
}
.comparison-side {
    padding: 3.5rem 3rem;
}
.comparison-side--authentic {
    background: linear-gradient(135deg, #1B3347 0%, #24445E 100%);
    color: #FAF8F5;
}
.comparison-side--industrial {
    background: #FAF6F0;
    color: #4A6375;
    border-right: 1px solid var(--color-pebble-light, #EAE3DA);
}
.comp-badge {
    display: inline-block;
    font-size: 0.8rem;
    font-weight: 700;
    padding: 0.35rem 1rem;
    border-radius: 999px;
    margin-bottom: 1.2rem;
    background: rgba(212, 175, 55, 0.2);
    color: #F3E3D0;
    border: 1px solid rgba(212, 175, 55, 0.4);
}
.comp-badge--gray {
    background: rgba(27, 51, 71, 0.08);
    color: #566E80;
    border: 1px solid rgba(27, 51, 71, 0.15);
}
.comp-title {
    font-family: var(--font-heading);
    font-size: 1.6rem;
    font-weight: 800;
    margin: 0 0 1.8rem 0;
    line-height: 1.4;
}
.comparison-side--authentic .comp-title {
    color: #FAF8F5;
}
.comparison-side--industrial .comp-title {
    color: var(--color-marine-deep, #1B3347);
}
.comp-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.comp-list li {
    font-size: 0.95rem;
    line-height: 1.7;
    display: flex;
    align-items: flex-start;
    gap: 0.8rem;
}
.icon-check {
    color: #D4AF37;
    font-weight: 900;
    font-size: 1.1rem;
}
.icon-cross {
    color: #C0392B;
    font-weight: 900;
    font-size: 1.1rem;
}

/* 6. CTA Banner */
.about-cta-banner {
    background: linear-gradient(135deg, #FAF6F0 0%, #F3E3D0 100%);
    border: 1px solid #E5D5C2;
    border-radius: 28px;
    padding: 4rem 3rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(27, 51, 71, 0.04);
}
.cta-banner-content {
    max-width: 700px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}
.cta-eyebrow {
    font-size: 0.85rem;
    font-weight: 700;
    color: #9E7D3B;
    display: inline-block;
    margin-bottom: 0.8rem;
}
.cta-title {
    font-family: var(--font-heading);
    font-size: 2.2rem;
    font-weight: 800;
    color: var(--color-marine-deep, #1B3347);
    margin: 0 0 1rem 0;
    line-height: 1.4;
}
.cta-desc {
    font-size: 1.05rem;
    line-height: 2;
    color: #4A6375;
    margin: 0 auto 2.5rem auto;
}
.cta-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1.2rem;
    flex-wrap: wrap;
}
.btn-coastal-gold {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: #1B3347;
    color: #FAF8F5 !important;
    padding: 0.95rem 2.2rem;
    border-radius: 999px;
    font-weight: 700;
    font-size: 0.98rem;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 8px 20px rgba(27, 51, 71, 0.15);
}
.btn-coastal-gold:hover {
    background: #24445E;
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(27, 51, 71, 0.22);
}
.btn-coastal-outline {
    display: inline-flex;
    align-items: center;
    background: transparent;
    color: var(--color-marine-deep, #1B3347) !important;
    border: 1.5px solid var(--color-marine-deep, #1B3347);
    padding: 0.95rem 2rem;
    border-radius: 999px;
    font-weight: 700;
    font-size: 0.98rem;
    text-decoration: none;
    transition: all 0.25s ease;
}
.btn-coastal-outline:hover {
    background: rgba(27, 51, 71, 0.05);
    transform: translateY(-2px);
}

/* Responsive adjustments */
@media (max-width: 900px) {
    .about-hero-title {
        font-size: 2.1rem;
    }
    .about-hero-stats {
        flex-direction: column;
        gap: 1.2rem;
        padding: 1.5rem;
    }
    .stat-divider {
        width: 100%;
        height: 1px;
    }
    .editorial-card {
        padding: 2rem 1.8rem;
    }
    .workstation-row,
    .workstation-row--reverse {
        grid-template-columns: 1fr;
        gap: 2rem;
        direction: rtl;
    }
    .workstation-row--reverse .workstation-content,
    .workstation-row--reverse .workstation-media {
        direction: rtl;
    }
    .workstation-media {
        height: 260px;
    }
    .comparison-card {
        grid-template-columns: 1fr;
    }
    .comparison-side--industrial {
        border-right: none;
        border-top: 1px solid var(--color-pebble-light, #EAE3DA);
    }
    .comparison-side {
        padding: 2.5rem 1.8rem;
    }
    .about-cta-banner {
        padding: 3rem 1.5rem;
    }
    .cta-title {
        font-size: 1.7rem;
    }
}
</style>

<?php get_footer(); ?>