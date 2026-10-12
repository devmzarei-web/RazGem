<?php
/**
 * Template Name: Contact Us Layout (تماس با آتلیه رازجم)
 * Template Post Type: page
 *
 * @package RazGem
 * @version 2.5.0
 */
defined( 'ABSPATH' ) || exit;
get_header();

// Fetch live settings from WordPress Customizer (Admin -> Customize -> Contact Credentials)
$contact_phone   = get_theme_mod( 'contact_phone', '۰۲۱ - ۹۱۰۰XXXX' );
$contact_phone_2 = get_theme_mod( 'contact_phone_2', '' );
$contact_phone_3 = get_theme_mod( 'contact_phone_3', '' );
$contact_email   = get_theme_mod( 'contact_email', 'info@razgem.ir' );
$contact_address = get_theme_mod( 'contact_address', 'تهران، نیاوران، خیابان عمار، پلاک ۱۲، واحد ۳' );
$contact_hours   = get_theme_mod( 'contact_hours', '۱۰ الی ۲۲ (شنبه تا پنج‌شنبه)' );

// Calculate WhatsApp Link
$wa_phone_raw = ! empty( $contact_phone_2 ) ? $contact_phone_2 : ( ! empty( $contact_phone ) ? $contact_phone : '09120000000' );
$wa_phone_clean = preg_replace( '/[^0-9]/', '', $wa_phone_raw );
if ( strpos( $wa_phone_clean, '09' ) === 0 ) {
    $wa_phone_clean = '98' . substr( $wa_phone_clean, 1 );
}
$wa_url = 'https://wa.me/' . $wa_phone_clean . '?text=' . rawurlencode( 'سلام و احترام، جهت مشاوره تخصصی در انتخاب آثار یا سفارش اختصاصی زیورآلات صدف طبیعی رازجم پیام می‌دهم.' );
?>

<main class="site-container utility-page contact-experience" dir="rtl" role="main">

    <!-- 1. HERO CONCIERGE HEADER -->
    <header class="contact-hero-header">
        <div class="contact-badge">
            <span class="badge-icon">✨</span>
            <span>میز گفت‌وگو و پشتیبانی آتلیه رازجم</span>
        </div>
        <h1 class="contact-hero-title">
            ارتباط با ما؛ از ایده تا خلق شاهکار شما
        </h1>
        <p class="contact-hero-lead">
            ما با کمال میل آماده پاسخگویی به پرسش‌های شما، ارائه مشاوره گوهرشناسی و ثبت سفارش‌های اختصاصی ساخت طلا و صدف هستیم.
        </p>
    </header>

    <!-- 2. OPTIONAL WP EDITOR CONTENT (Manageable in WP Admin -> Pages -> Edit "Contact Us") -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php 
        $raw_contact_content = get_the_content();
        if ( ! empty( trim( $raw_contact_content ) ) ) : 
        ?>
            <section class="contact-editorial-notice">
                <div class="contact-notice-inner">
                    <?php the_content(); ?>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; endif; ?>

    <!-- 3. MAIN DUAL-WING CONCIERGE GRID -->
    <div class="contact-concierge-grid">

        <!-- RIGHT WING: CONTACT TOUCHPOINTS & ATELIER INFO -->
        <div class="concierge-info-wing">
            <div class="concierge-card concierge-card--channels">
                <div class="card-top">
                    <span class="card-eyebrow">راه‌های دسترسی مستقیم</span>
                    <h2 class="card-title">اطلاعات تماس و نشانی گالری</h2>
                    <p class="card-desc">مشاوران گوهرشناسی رازجم در تمامی ساعات اداری همراه شما هستند.</p>
                </div>

                <ul class="touchpoints-list">
                    <!-- Primary Phone -->
                    <?php if ( $contact_phone ) : ?>
                    <li class="touchpoint-item">
                        <div class="tp-icon-box">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div class="tp-details">
                            <span class="tp-label">تلفن پشتیبانی و مشاوره فروش (اصلی)</span>
                            <a href="tel:<?php echo esc_attr( function_exists( 'razgem_clean_phone' ) ? razgem_clean_phone( $contact_phone ) : $contact_phone ); ?>" class="tp-value tp-value--phone">
                                <?php echo esc_html( $contact_phone ); ?>
                            </a>
                        </div>
                    </li>
                    <?php endif; ?>

                    <!-- Secondary Phone -->
                    <?php if ( $contact_phone_2 ) : ?>
                    <li class="touchpoint-item">
                        <div class="tp-icon-box">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div class="tp-details">
                            <span class="tp-label">تلفن همراه و پشتیبانی دوم</span>
                            <a href="tel:<?php echo esc_attr( function_exists( 'razgem_clean_phone' ) ? razgem_clean_phone( $contact_phone_2 ) : $contact_phone_2 ); ?>" class="tp-value tp-value--phone">
                                <?php echo esc_html( $contact_phone_2 ); ?>
                            </a>
                        </div>
                    </li>
                    <?php endif; ?>

                    <!-- Official Email -->
                    <?php if ( $contact_email ) : ?>
                    <li class="touchpoint-item">
                        <div class="tp-icon-box">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <div class="tp-details">
                            <span class="tp-label">پست الکترونیک رسمی آتلیه</span>
                            <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="tp-value">
                                <?php echo esc_html( $contact_email ); ?>
                            </a>
                        </div>
                    </li>
                    <?php endif; ?>

                    <!-- Physical Address -->
                    <?php if ( $contact_address ) : ?>
                    <li class="touchpoint-item">
                        <div class="tp-icon-box">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div class="tp-details">
                            <span class="tp-label">نشانی کارگاه و دفتر مرکزی</span>
                            <span class="tp-value tp-value--address">
                                <?php echo esc_html( $contact_address ); ?>
                            </span>
                            <span class="tp-subnote">بازدید حضوری از گالری صرفاً با هماهنگی و وقت قبلی امکان‌پذیر است.</span>
                        </div>
                    </li>
                    <?php endif; ?>

                    <!-- Operating Hours -->
                    <?php if ( $contact_hours ) : ?>
                    <li class="touchpoint-item">
                        <div class="tp-icon-box">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </div>
                        <div class="tp-details">
                            <span class="tp-label">ساعات کاری و پاسخگویی</span>
                            <span class="tp-value">
                                <?php echo esc_html( $contact_hours ); ?>
                            </span>
                        </div>
                    </li>
                    <?php endif; ?>
                </ul>

                <!-- VIP Direct WhatsApp Concierge Button -->
                <div class="whatsapp-concierge-box">
                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn-whatsapp-concierge">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.187-2.59-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.311.045-.698.059-1.146-.086-.285-.093-.655-.234-1.157-.456-2.152-.952-3.559-3.155-3.666-3.298-.107-.144-.873-1.16-.873-2.213 0-1.053.552-1.572.748-1.785.197-.214.43-.267.573-.267.144 0 .287.003.411.009.135.005.316-.051.493.376.183.441.624 1.52.678 1.631.054.111.09.241.018.385-.072.144-.108.234-.216.36-.107.126-.227.28-.324.376-.108.107-.221.224-.095.441.126.216.559.923 1.2 1.494.825.735 1.521.963 1.737 1.07.216.107.342.09.469-.054.126-.144.538-.628.682-.843.144-.216.288-.18.484-.108.198.072 1.254.592 1.469.7.216.108.36.162.414.252.054.09.054.522-.09.927z"></path></svg>
                        <span>ارتباط مستقیم و فوری در واتس‌اپ</span>
                    </a>
                    <span class="wa-helper-text">مشاوره آنلاین تصاویر مدل‌ها، راهنمای سایز و موجودی کارگاه</span>
                </div>
            </div>
        </div>

        <!-- LEFT WING: INTERACTIVE FORM (Saved to WP Admin -> Contact Messages) -->
        <div class="concierge-form-wing">
            <div class="concierge-card concierge-card--form">
                <div class="card-top">
                    <span class="card-eyebrow">فرم ارتباط مستقیم</span>
                    <h2 class="card-title">ارسال پیام یا سفارش دلخواه</h2>
                    <p class="card-desc">پیام شما مستقیماً در صندوق ورودی مدیریت گالری ثبت شده و سریعاً پاسخ داده می‌شود.</p>
                </div>

                <form id="razgemContactForm" class="luxury-contact-form" novalidate>
                    <div class="form-grid-2">
                        <!-- Full Name -->
                        <div class="luxury-form-group">
                            <label for="rg_full_name">نام و نام خانوادگی <span class="required-star">*</span></label>
                            <input type="text" id="rg_full_name" name="full_name" class="luxury-input" placeholder="مثال: سارا رادمنش" required>
                        </div>

                        <!-- Phone Number -->
                        <div class="luxury-form-group">
                            <label for="rg_phone">شماره تماس همراه <span class="required-star">*</span></label>
                            <input type="tel" id="rg_phone" name="phone" class="luxury-input" placeholder="۰۹۱۲XXXXXXX" style="direction:ltr; text-align:right;" required>
                        </div>
                    </div>

                    <!-- Subject / Inquire Type -->
                    <div class="luxury-form-group">
                        <label for="rg_subject">موضوع گفت‌وگو</label>
                        <select id="rg_subject" name="subject" class="luxury-select">
                            <option value="مشاوره خرید اثر">مشاوره خرید اثر و اصالت گوهر</option>
                            <option value="سفارش ساخت اختصاصی">سفارش ساخت اختصاصی طرح دلخواه</option>
                            <option value="پیگیری سفارش">پیگیری وضعیت سفارش ثبت‌شده</option>
                            <option value="رزرو وقت بازدید حضوری">رزرو وقت بازدید حضوری از کارگاه</option>
                            <option value="سایر موضوعات">سایر موارد و پیشنهادات</option>
                        </select>
                    </div>

                    <!-- Message Body -->
                    <div class="luxury-form-group">
                        <label for="rg_message">شرح پیام یا مشخصات سفارش <span class="required-star">*</span></label>
                        <textarea id="rg_message" name="message" class="luxury-textarea" rows="5" placeholder="پیام یا طرح مد نظر خود را بنویسید..." required></textarea>
                    </div>

                    <!-- Response Toast Div -->
                    <div id="contactFormResponse" class="form-response-alert" style="display:none;" role="alert"></div>

                    <!-- Submit Button -->
                    <button type="submit" id="contactSubmitBtn" class="btn-submit-luxury">
                        <span class="btn-text">ثبت و ارسال پیام به گالری رازجم</span>
                        <span class="btn-icon">↵</span>
                    </button>

                    <div class="form-privacy-pledge">
                        <span class="lock-icon">🔒</span>
                        <span>تمامی اطلاعات تماس شما نزد گالری رازجم محفوظ و محرمانه باقی می‌ماند.</span>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- 4. QUICK CONCIERGE FAQ SECTION -->
    <section class="contact-faq-section">
        <div class="section-title-wrap">
            <span class="badge-mini">پاسخ به سوالات پرتکرار</span>
            <h2 class="section-main-title">آنچه ممکن است برایتان سوال باشد</h2>
            <p class="section-subtitle">پاسخ سریع به متداول‌ترین پرسش‌های خریداران و علاقه‌مندان آثار رازجم</p>
        </div>

        <div class="faq-accordion-grid">
            <details class="faq-item">
                <summary class="faq-question">
                    <span>مدت زمان ساخت زیورآلات سفارشی اختصاصی چقدر است؟</span>
                    <span class="faq-toggle">+</span>
                </summary>
                <div class="faq-answer">
                    <p>فرآیند گزینش صدف، تراش دستی اختصاصی، ساخت رکاب طلای ۱۸ عیار و پرداخت نهایی معمولاً بین ۷ الی ۱۰ روز کاری زمان می‌برد. در صورت نیاز به تحویل فوری جهت هدیه، می‌توانید با پشتیبانی هماهنگ فرمایید.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary class="faq-question">
                    <span>آیا صدف‌ها و مرواریدها شناسنامه فیزیکی اصالت دارند؟</span>
                    <span class="faq-toggle">+</span>
                </summary>
                <div class="faq-answer">
                    <p>بله، تمامی آثار گالری رازجم همراه با شناسنامه رسمی گوهرشناسی ممهور، هولوگرام ضدجعل و ضمانت اصالت ۱۰۰٪ طبیعی بودن صدف و مروارید در بسته‌بندی نفیس هدیه تقدیم می‌شوند.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary class="faq-question">
                    <span>آیا امکان سفارش دستبند یا گردنبند با اندازه و سایز اختصاصی وجود دارد؟</span>
                    <span class="faq-toggle">+</span>
                </summary>
                <div class="faq-answer">
                    <p>کاملاً؛ در هنگام ثبت سفارش یا از طریق گفت‌وگو در واتس‌اپ، اندازه دور مچ یا طول زنجیر مد نظر خود را اعلام بفرمایید تا اثر دقیقاً متناسب با سایز اختصاصی شما ساخته شود.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary class="faq-question">
                    <span>نحوه و شرایط ارسال به شهرستان‌ها چگونه است؟</span>
                    <span class="faq-toggle">+</span>
                </summary>
                <div class="faq-answer">
                    <p>کلیه سفارش‌های ارسالی به سراسر کشور با پست پیشتاز ویژه، همراه با بیمه کامل ارزش ریالی کالا و بسته‌بندی امنیتی ارسال می‌شوند و کد رهگیری پستی بلافاصله پس از تحویل به پست پیامک می‌گردد.</p>
                </div>
            </details>
        </div>
    </section>

</main>

<style>
/* =========================================================================
   CONTACT US EXPERIENCE - COASTAL CONCIERGE STYLING
   ========================================================================= */
.contact-experience {
    padding-top: 3.5rem;
    padding-bottom: 6rem;
    color: var(--color-marine-deep, #1B3347);
}

/* 1. Hero Header */
.contact-hero-header {
    text-align: center;
    max-width: 820px;
    margin: 0 auto 3.5rem auto;
}
.contact-badge {
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
.contact-hero-title {
    font-family: var(--font-heading);
    font-size: 2.6rem;
    font-weight: 800;
    line-height: 1.4;
    color: var(--color-marine-deep, #1B3347);
    margin: 0 0 1.2rem 0;
}
.contact-hero-lead {
    font-size: 1.12rem;
    line-height: 2.1;
    color: var(--color-marine-muted, #566E80);
    margin: 0 auto;
    max-width: 680px;
}

/* 2. Notice Inner */
.contact-editorial-notice {
    max-width: 900px;
    margin: 0 auto 3rem auto;
}
.contact-notice-inner {
    background: #FFFFFF;
    border: 1px solid var(--color-pebble-light, #EAE3DA);
    padding: 2rem 2.5rem;
    border-radius: 20px;
    font-size: 1rem;
    line-height: 2;
    color: #3B5366;
    box-shadow: 0 10px 30px rgba(27, 51, 71, 0.03);
}

/* 3. Main Concierge Grid */
.contact-concierge-grid {
    display: grid;
    grid-template-columns: 1fr 1.15fr;
    gap: 2.5rem;
    margin-bottom: 5.5rem;
    align-items: start;
}
.concierge-card {
    background: #FFFFFF;
    border: 1px solid var(--color-pebble-light, #EAE3DA);
    border-radius: 26px;
    padding: 3rem 2.8rem;
    box-shadow: 0 15px 45px rgba(27, 51, 71, 0.05);
}
.card-eyebrow {
    display: inline-block;
    font-size: 0.82rem;
    font-weight: 700;
    color: #D4AF37;
    margin-bottom: 0.5rem;
}
.card-title {
    font-family: var(--font-heading);
    font-size: 1.7rem;
    font-weight: 800;
    color: var(--color-marine-deep, #1B3347);
    margin: 0 0 0.8rem 0;
    line-height: 1.4;
}
.card-desc {
    font-size: 0.95rem;
    line-height: 1.8;
    color: var(--color-marine-muted, #566E80);
    margin: 0 0 2rem 0;
}

/* Touchpoints List */
.touchpoints-list {
    list-style: none;
    padding: 0;
    margin: 0 0 2.5rem 0;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}
.touchpoint-item {
    display: flex;
    align-items: flex-start;
    gap: 1.2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(234, 227, 218, 0.7);
}
.touchpoint-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
.tp-icon-box {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: #FAF6F0;
    border: 1px solid rgba(212, 175, 55, 0.25);
    color: #1B3347;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.tp-details {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}
.tp-label {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--color-marine-muted, #566E80);
}
.tp-value {
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--color-marine-deep, #1B3347);
    text-decoration: none;
    transition: color 0.2s ease;
}
.tp-value:hover {
    color: #D4AF37;
}
.tp-value--phone {
    direction: ltr;
    text-align: right;
    font-family: inherit;
    font-size: 1.15rem;
}
.tp-value--address {
    line-height: 1.8;
    font-size: 0.98rem;
}
.tp-subnote {
    font-size: 0.78rem;
    color: #9E7D3B;
    margin-top: 0.2rem;
}

/* WhatsApp Concierge Box */
.whatsapp-concierge-box {
    background: #FAF6F0;
    border: 1px solid rgba(212, 175, 55, 0.25);
    border-radius: 18px;
    padding: 1.5rem;
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
}
.btn-whatsapp-concierge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.8rem;
    background: #25D366;
    color: #FFFFFF !important;
    padding: 0.9rem 1.5rem;
    border-radius: 14px;
    font-size: 1rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 8px 20px rgba(37, 211, 102, 0.25);
}
.btn-whatsapp-concierge:hover {
    background: #1EBE5D;
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(37, 211, 102, 0.35);
}
.wa-helper-text {
    font-size: 0.8rem;
    color: var(--color-marine-muted, #566E80);
}

/* Luxury Form */
.luxury-contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.4rem;
}
.form-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.2rem;
}
.luxury-form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}
.luxury-form-group label {
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--color-marine-deep, #1B3347);
}
.required-star {
    color: #C0392B;
}
.luxury-input,
.luxury-select,
.luxury-textarea {
    width: 100%;
    padding: 0.9rem 1.1rem;
    border: 1.5px solid var(--color-pebble-light, #EAE3DA);
    border-radius: 14px;
    font-family: inherit;
    font-size: 0.95rem;
    color: var(--color-marine-deep, #1B3347);
    background: #FAF8F5;
    transition: border-color 0.25s ease, box-shadow 0.25s ease, background-color 0.25s ease;
    box-sizing: border-box;
}
.luxury-input:focus,
.luxury-select:focus,
.luxury-textarea:focus {
    outline: none;
    border-color: #1B3347;
    background: #FFFFFF;
    box-shadow: 0 0 0 4px rgba(27, 51, 71, 0.08);
}
.luxury-textarea {
    resize: vertical;
    min-height: 120px;
    line-height: 1.8;
}

/* Submit Button */
.btn-submit-luxury {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.8rem;
    background: #1B3347;
    color: #FAF8F5;
    border: none;
    padding: 1.1rem 2rem;
    border-radius: 14px;
    font-family: inherit;
    font-size: 1.05rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
    box-shadow: 0 10px 25px rgba(27, 51, 71, 0.18);
    margin-top: 0.5rem;
}
.btn-submit-luxury:hover {
    background: #24445E;
    transform: translateY(-2px);
    box-shadow: 0 14px 32px rgba(27, 51, 71, 0.25);
}
.form-privacy-pledge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    font-size: 0.8rem;
    color: var(--color-marine-muted, #566E80);
    margin-top: 0.3rem;
}

/* Alert response toast */
.form-response-alert {
    padding: 1rem 1.4rem;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.95rem;
    line-height: 1.7;
    text-align: center;
}
.form-response-alert.success {
    background: #E8F8F0;
    border: 1px solid #A3E4D7;
    color: #117A65;
}
.form-response-alert.error {
    background: #FDEDEC;
    border: 1px solid #F5B7B1;
    color: #C0392B;
}

/* 4. FAQ Section */
.contact-faq-section {
    max-width: 860px;
    margin: 0 auto;
}
.faq-accordion-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.faq-item {
    background: #FFFFFF;
    border: 1px solid var(--color-pebble-light, #EAE3DA);
    border-radius: 16px;
    padding: 1.2rem 1.6rem;
    box-shadow: 0 4px 15px rgba(27, 51, 71, 0.02);
    transition: border-color 0.2s ease;
}
.faq-item[open] {
    border-color: #D4AF37;
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.08);
}
.faq-question {
    list-style: none;
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--color-marine-deep, #1B3347);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}
.faq-question::-webkit-details-marker {
    display: none;
}
.faq-toggle {
    font-size: 1.3rem;
    color: #D4AF37;
    font-weight: 800;
}
.faq-item[open] .faq-toggle {
    transform: rotate(45deg);
}
.faq-answer {
    padding-top: 1rem;
    font-size: 0.95rem;
    line-height: 2;
    color: var(--color-marine-muted, #566E80);
    border-top: 1px solid rgba(234, 227, 218, 0.6);
    margin-top: 0.8rem;
}
.faq-answer p {
    margin: 0;
}

/* Responsive */
@media (max-width: 900px) {
    .contact-concierge-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    .form-grid-2 {
        grid-template-columns: 1fr;
    }
    .concierge-card {
        padding: 2.2rem 1.8rem;
    }
    .contact-hero-title {
        font-size: 2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('razgemContactForm');
    const responseDiv = document.getElementById('contactFormResponse');
    const submitBtn = document.getElementById('contactSubmitBtn');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const fullName = document.getElementById('rg_full_name').value.trim();
            const phone = document.getElementById('rg_phone').value.trim();
            const message = document.getElementById('rg_message').value.trim();

            if (!fullName || !phone || !message) {
                showResponse('لطفاً تمامی فیلدهای ستاره‌دار را تکمیل فرمایید.', 'error');
                return;
            }

            // Visual Loading
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span>در حال ارسال پیام به آتلیه...</span>';
            submitBtn.style.opacity = '0.75';
            submitBtn.disabled = true;
            responseDiv.style.display = 'none';

            const formData = new FormData(form);
            formData.append('action', 'submit_razgem_contact');

            fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    showResponse(res.data, 'success');
                    form.reset();
                } else {
                    showResponse(res.data || 'خطایی رخ داده است. لطفاً مجدداً بررسی فرمایید.', 'error');
                }
            })
            .catch(() => {
                showResponse('ارتباط با سرور برقرار نشد. لطفاً اتصال اینترنت خود را بررسی نمایید.', 'error');
            })
            .finally(() => {
                submitBtn.innerHTML = originalBtnText;
                submitBtn.style.opacity = '1';
                submitBtn.disabled = false;
            });
        });
    }

    function showResponse(text, type) {
        if (!responseDiv) return;
        responseDiv.className = 'form-response-alert ' + type;
        responseDiv.textContent = text;
        responseDiv.style.display = 'block';
        responseDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
});
</script>

<?php get_footer(); ?>