<?php
/**
 * Template Name: Contact Us Layout (تماس با آتلیه رازجم)
 * Template Post Type: page
 *
 * @package RazGem
 * @version 2.6.0
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

$contact_telegram  = get_theme_mod( 'social_telegram', 'https://t.me/+989007423055' );
$contact_instagram = get_theme_mod( 'social_instagram', 'https://instagram.com/razgem.ir' );
$contact_rubika    = get_theme_mod( 'social_rubika', 'https://rubika.ir/raz_gem' );
$icon_dir          = get_template_directory_uri() . '/assets/icons/';

// Calculate WhatsApp Link (Fallback)
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
            ما با کمال میل آماده پاسخگویی به پرسش‌های شما، ارائه مشاوره گوهرشناسی و ثبت سفارش‌های اختصاصی زیورآلات دست‌ساز صدف و مروارید هستیم.
        </p>
    </header>

    <!-- 2. MAIN DUAL-WING CONCIERGE GRID -->
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

                <!-- VIP Direct Messenger Concierge (Telegram, Instagram, Rubika) -->
                <div class="concierge-messenger-channels-box">
                    <span class="messenger-box-title">ارتباط مستقیم با مدیران در پیام‌رسان‌ها:</span>
                    <div class="messenger-buttons-grid">
                        <a href="<?php echo esc_url( $contact_telegram ); ?>" target="_blank" rel="noopener noreferrer" class="btn-concierge-channel btn-channel--telegram">
                            <img src="<?php echo esc_url( $icon_dir . 'telegram.png' ); ?>" alt="تلگرام">
                            <div class="channel-text">
                                <span class="channel-role">مدیر تلگرام</span>
                                <span class="channel-handle">ارتباط مستقیم ↶</span>
                            </div>
                        </a>
                        <a href="<?php echo esc_url( $contact_instagram ); ?>" target="_blank" rel="noopener noreferrer" class="btn-concierge-channel btn-channel--instagram">
                            <img src="<?php echo esc_url( $icon_dir . 'instagram.png' ); ?>" alt="اینستاگرام">
                            <div class="channel-text">
                                <span class="channel-role">مدیر اینستاگرام</span>
                                <span class="channel-handle">razgem.ir@ ↶</span>
                            </div>
                        </a>
                        <a href="<?php echo esc_url( $contact_rubika ); ?>" target="_blank" rel="noopener noreferrer" class="btn-concierge-channel btn-channel--rubika">
                            <img src="<?php echo esc_url( $icon_dir . 'Rubika.png' ); ?>" alt="روبیکا">
                            <div class="channel-text">
                                <span class="channel-role">مدیر روبیکا</span>
                                <span class="channel-handle">raz_gem@ ↶</span>
                            </div>
                        </a>
                    </div>
                    <span class="messenger-helper-text">مشاوره آنلاین تصاویر مدل‌ها، راهنمای سایز و موجودی کارگاه</span>
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
                        <!-- Full Name (No hardcoded real names) -->
                        <div class="luxury-form-group">
                            <label for="rg_full_name">نام و نام خانوادگی <span class="required-star">*</span></label>
                            <input type="text" id="rg_full_name" name="full_name" class="luxury-input" placeholder="نام و نام خانوادگی خود را بنویسید..." required>
                        </div>

                        <!-- Phone Number -->
                        <div class="luxury-form-group">
                            <label for="rg_phone">شماره تماس همراه <span class="required-star">*</span></label>
                            <input type="tel" id="rg_phone" name="phone" class="luxury-input" placeholder="شماره همراه (مانند ۰۹۱۲۳۴۵۶۷۸۹)" style="direction:ltr; text-align:right;" required>
                        </div>
                    </div>

                    <!-- Custom Dropdown Selectors Row -->
                    <div class="form-grid-2">
                        <!-- Selector 1: Subject / Inquiry Type -->
                        <div class="luxury-form-group">
                            <label for="rg_subject">موضوع گفت‌وگو <span class="required-star">*</span></label>
                            <div class="custom-select-wrapper">
                                <select id="rg_subject" name="subject" class="luxury-select" required>
                                    <option value="" disabled selected>انتخاب موضوع پیام...</option>
                                    <option value="مشاوره خرید اثر و اصالت گوهر">مشاوره خرید اثر و اصالت گوهر</option>
                                    <option value="سفارش ساخت طرح دلخواه">سفارش ساخت طرح دلخواه (دست‌ساز اختصاصی با صدف)</option>
                                    <option value="پیگیری سفارش و مرسوله">پیگیری وضعیت سفارش و مرسوله پستی</option>
                                    <option value="رزرو وقت بازدید حضوری">رزرو وقت بازدید حضوری از آتلیه</option>
                                    <option value="همکاری یا سایر موضوعات">همکاری تجاری یا سایر سوالات عمومی</option>
                                </select>
                                <span class="select-chevron-icon" aria-hidden="true">▾</span>
                            </div>
                        </div>

                        <!-- Selector 2: Preferred Response Channel -->
                        <div class="luxury-form-group">
                            <label for="rg_pref_channel">روش ترجیحی پاسخگویی</label>
                            <div class="custom-select-wrapper">
                                <select id="rg_pref_channel" name="preferred_channel" class="luxury-select">
                                    <option value="پیام و گفت‌وگو در واتس‌اپ" selected>پیام و گفت‌وگو در واتس‌اپ</option>
                                    <option value="تماس مستقیم تلفنی">تماس مستقیم تلفنی</option>
                                    <option value="ارسال پیامک (SMS)">ارسال پیامک (SMS)</option>
                                    <option value="پست الکترونیک (Email)">پست الکترونیک (Email)</option>
                                </select>
                                <span class="select-chevron-icon" aria-hidden="true">▾</span>
                            </div>
                        </div>
                    </div>

                    <!-- Message Body -->
                    <div class="luxury-form-group">
                        <label for="rg_message">شرح پیام یا مشخصات سفارش <span class="required-star">*</span></label>
                        <textarea id="rg_message" name="message" class="luxury-textarea" rows="5" placeholder="پیام یا طرح مد نظر خود را به صورت کامل بنویسید..." required></textarea>
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

    <!-- 3. REDESIGNED LUXURY FAQ ACCORDION SECTION (Pristine UI & Padding) -->
    <section class="contact-faq-section" aria-label="پرسش‌های متداول مشتریان">
        <div class="faq-header-wrap">
            <span class="faq-badge-mini">پاسخ سریع به سوالات خریداران</span>
            <h2 class="faq-main-title">آنچه ممکن است برایتان سوال باشد</h2>
            <p class="faq-subtitle">پاسخ‌های شفاف و رسمی درباره سفارش‌های اختصاصی، اصالت، ارسال و ابعاد آثار</p>
        </div>

        <div class="faq-accordion-stack">
            <!-- FAQ Item 1 -->
            <details class="luxury-faq-card">
                <summary class="luxury-faq-trigger">
                    <div class="faq-title-group">
                        <span class="faq-category-chip">💎 سفارش اختصاصی</span>
                        <span class="faq-question-text">مدت زمان ساخت زیورآلات سفارشی اختصاصی چقدر است؟</span>
                    </div>
                    <div class="faq-icon-bubble" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </summary>
                <div class="luxury-faq-drawer">
                    <p>فرآیند پایش و گزینش صدف‌های طبیعی، تراش دستی فرم ارگانیک، طراحی اختصاصی، سوارکاری هنری و پرداخت نهایی معمولاً بین <strong>۵ الی ۷ روز کاری</strong> زمان می‌برد. در صورت نیاز به تحویل فوری جهت مناسبت‌ها یا هدیه، می‌توانید در هنگام ثبت پیام هماهنگ فرمایید.</p>
                </div>
            </details>

            <!-- FAQ Item 2 -->
            <details class="luxury-faq-card">
                <summary class="luxury-faq-trigger">
                    <div class="faq-title-group">
                        <span class="faq-category-chip">🛡️ اصالت و شناسنامه</span>
                        <span class="faq-question-text">آیا صدف‌ها و مرواریدها دارای شناسنامه رسمی اصالت هستند؟</span>
                    </div>
                    <div class="faq-icon-bubble" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </summary>
                <div class="luxury-faq-drawer">
                    <p>بله، صددرصد آثار گالری رازجم با <strong>شناسنامه فیزیکی معتبر ممهور</strong>، هولوگرام رسمی ضدجعل و درج مشخصات کامل گونه صدف طبیعی، نوع مروارید باروک و جزئیات اثر در بسته‌بندی نفیس هدیه تقدیم می‌شوند. اصالت ارگانیک و طبیعی بودن صدف و مروارید باروک به صورت مادام‌العمر ضمانت می‌گردد.</p>
                </div>
            </details>

            <!-- FAQ Item 3 -->
            <details class="luxury-faq-card">
                <summary class="luxury-faq-trigger">
                    <div class="faq-title-group">
                        <span class="faq-category-chip">📏 سایز و ابعاد</span>
                        <span class="faq-question-text">آیا امکان سفارش دستبند یا گردنبند با اندازه و سایز اختصاصی وجود دارد؟</span>
                    </div>
                    <div class="faq-icon-bubble" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </summary>
                <div class="luxury-faq-drawer">
                    <p>کاملاً؛ شما می‌توانید اندازه دقیق دور مچ، قطر انگشت یا طول دلخواه زنجیر گردنبند را در فرم پیام یا از طریق واتس‌اپ اعلام فرمایید. استادکاران ما اثر را دقیقاً با ارگونومی و سایز سفارشی شما مهندسی و آماده خواهند کرد.</p>
                </div>
            </details>

            <!-- FAQ Item 4 -->
            <details class="luxury-faq-card">
                <summary class="luxury-faq-trigger">
                    <div class="faq-title-group">
                        <span class="faq-category-chip">🚚 ارسال و بیمه</span>
                        <span class="faq-question-text">نحوه و شرایط ارسال مرسولات به سراسر کشور چگونه است؟</span>
                    </div>
                    <div class="faq-icon-bubble" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </summary>
                <div class="luxury-faq-drawer">
                    <p>ارسال تمامی سفارش‌ها با <strong>پست پیشتاز ویژه همراه با بیمه کامل ارزش ریالی کالا</strong> انجام می‌شود. برای سفارش‌های بالای ۳ میلیون تومان، ارسال به سراسر کشور رایگان بوده و کد رهگیری پستی بلافاصله پس از تحویل به پست از طریق پیامک برای شما ارسال می‌گردد.</p>
                </div>
            </details>
        </div>
    </section>

</main>

<style>
/* =========================================================================
   CONTACT US EXPERIENCE - COASTAL CONCIERGE STYLING (V2.6)
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

/* 2. Main Concierge Grid */
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

/* Direct Messenger Channels Box (Telegram, Instagram, Rubika) */
.concierge-messenger-channels-box {
    background: #FAF6F0;
    border: 1px solid rgba(212, 175, 55, 0.28);
    border-radius: 18px;
    padding: 1.4rem;
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
    text-align: center;
}
.messenger-box-title {
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--color-marine-deep, #1B3347);
}
.messenger-buttons-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
}
.btn-concierge-channel {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.55rem;
    padding: 0.75rem 0.6rem;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.25s ease;
    border: 1px solid rgba(27, 51, 71, 0.08);
    box-shadow: 0 4px 12px rgba(27, 51, 71, 0.05);
}
.btn-concierge-channel img {
    width: 24px;
    height: 24px;
    object-fit: contain;
    flex-shrink: 0;
}
.btn-concierge-channel .channel-text {
    display: flex;
    flex-direction: column;
    text-align: right;
    line-height: 1.3;
}
.btn-concierge-channel .channel-role {
    font-size: 0.82rem;
    font-weight: 800;
    color: #FFFFFF;
}
.btn-concierge-channel .channel-handle {
    font-size: 0.72rem;
    opacity: 0.92;
    color: #FFFFFF;
}
.btn-channel--telegram {
    background: linear-gradient(135deg, #0088cc, #24A1DE);
}
.btn-channel--telegram:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(36, 161, 222, 0.35);
}
.btn-channel--instagram {
    background: linear-gradient(135deg, #833AB4, #FD1D1D, #FCB045);
}
.btn-channel--instagram:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(225, 48, 108, 0.35);
}
.btn-channel--rubika {
    background: linear-gradient(135deg, #4A148C, #7B1FA2);
}
.btn-channel--rubika:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(123, 31, 162, 0.35);
}
.messenger-helper-text {
    font-size: 0.8rem;
    color: var(--color-marine-muted, #566E80);
}

@media (max-width: 600px) {
    .messenger-buttons-grid {
        grid-template-columns: 1fr;
        gap: 0.6rem;
    }
    .btn-concierge-channel {
        padding: 0.75rem 1rem;
        justify-content: flex-start;
    }
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

/* Custom Dropdown Styling */
.custom-select-wrapper {
    position: relative;
    width: 100%;
}
.luxury-select {
    width: 100%;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    padding: 0.95rem 1.1rem 0.95rem 2.5rem;
    border: 1.5px solid var(--color-pebble-light, #EAE3DA);
    border-radius: 14px;
    font-family: inherit;
    font-size: 0.92rem;
    font-weight: 600;
    color: var(--color-marine-deep, #1B3347);
    background: #FAF8F5;
    cursor: pointer;
    box-sizing: border-box;
    transition: border-color 0.25s ease, box-shadow 0.25s ease, background-color 0.25s ease;
}
.select-chevron-icon {
    position: absolute;
    left: 1.1rem;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: #D4AF37;
    font-size: 1.1rem;
    font-weight: 800;
}
.luxury-input,
.luxury-textarea {
    width: 100%;
    padding: 0.95rem 1.1rem;
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
    padding: 1.15rem 2rem;
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

/* =========================================================================
   3. PRISTINE LUXURY FAQ ACCORDION (Fixed double plus, balanced padding)
   ========================================================================= */
.contact-faq-section {
    max-width: 920px;
    margin: 0 auto;
    padding-top: 2rem;
}
.faq-header-wrap {
    text-align: center;
    margin-bottom: 2.8rem;
}
.faq-badge-mini {
    display: inline-block;
    font-size: 0.82rem;
    font-weight: 700;
    color: #9E7D3B;
    background: rgba(212, 175, 55, 0.12);
    border: 1px solid rgba(212, 175, 55, 0.25);
    padding: 0.35rem 1.2rem;
    border-radius: 999px;
    margin-bottom: 0.8rem;
}
.faq-main-title {
    font-family: var(--font-heading);
    font-size: 2.2rem;
    font-weight: 800;
    color: var(--color-marine-deep, #1B3347);
    margin: 0 0 0.8rem 0;
    line-height: 1.4;
}
.faq-subtitle {
    font-size: 1rem;
    color: var(--color-marine-muted, #566E80);
    margin: 0;
    line-height: 1.8;
}

.faq-accordion-stack {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
}

/* The Card */
.luxury-faq-card {
    background: #FFFFFF;
    border: 1px solid var(--color-pebble-light, #EAE3DA);
    border-radius: 20px;
    box-shadow: 0 4px 18px rgba(27, 51, 71, 0.03);
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.luxury-faq-card:hover {
    border-color: #D4AF37;
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(212, 175, 55, 0.1);
}
.luxury-faq-card[open] {
    border-color: #D4AF37;
    background: #FAF8F5;
    box-shadow: 0 12px 35px rgba(27, 51, 71, 0.07);
}

/* The Trigger (Summary) */
.luxury-faq-trigger {
    list-style: none !important;
    list-style-type: none !important;
    cursor: pointer;
    padding: 1.4rem 1.8rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    user-select: none;
    outline: none;
}
/* Complete suppression of all native browser summary markers */
.luxury-faq-trigger::-webkit-details-marker,
.luxury-faq-trigger::marker {
    display: none !important;
    content: "" !important;
    font-size: 0 !important;
}

.faq-title-group {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}
.faq-category-chip {
    font-size: 0.78rem;
    font-weight: 700;
    color: #9E7D3B;
    background: #FAF6F0;
    border: 1px solid rgba(212, 175, 55, 0.25);
    padding: 0.3rem 0.85rem;
    border-radius: 8px;
    white-space: nowrap;
}
.luxury-faq-card[open] .faq-category-chip {
    background: #FFFFFF;
}
.faq-question-text {
    font-size: 1.08rem;
    font-weight: 800;
    color: var(--color-marine-deep, #1B3347);
    line-height: 1.5;
}

/* Elegant Rotating Chevron Bubble */
.faq-icon-bubble {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #FAF6F0;
    border: 1px solid var(--color-pebble-light, #EAE3DA);
    color: #1B3347;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: transform 0.35s ease, background-color 0.25s ease, color 0.25s ease;
}
.luxury-faq-card:hover .faq-icon-bubble {
    border-color: #D4AF37;
    color: #9E7D3B;
}
.luxury-faq-card[open] .faq-icon-bubble {
    transform: rotate(180deg);
    background: #1B3347;
    border-color: #1B3347;
    color: #FAF8F5;
}

/* The Answer Drawer */
.luxury-faq-drawer {
    padding: 0 1.8rem 1.6rem 1.8rem;
    font-size: 1rem;
    line-height: 2.1;
    color: #3B5366;
    border-top: 1px dashed rgba(212, 175, 55, 0.3);
    margin-top: 0.2rem;
    padding-top: 1.2rem;
    animation: faqFadeIn 0.3s ease;
}
.luxury-faq-drawer p {
    margin: 0;
}
@keyframes faqFadeIn {
    from { opacity: 0; transform: translateY(-6px); }
    to { opacity: 1; transform: translateY(0); }
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
    .faq-main-title {
        font-size: 1.7rem;
    }
    .luxury-faq-trigger {
        padding: 1.2rem 1.4rem;
        gap: 1rem;
    }
    .luxury-faq-drawer {
        padding: 0 1.4rem 1.4rem 1.4rem;
    }
    .faq-title-group {
        gap: 0.6rem;
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
            const subject = document.getElementById('rg_subject').value;

            if (!fullName || !phone || !message || !subject) {
                showResponse('لطفاً تمامی فیلدهای ستاره‌دار (نام، شماره، موضوع و متن پیام) را تکمیل فرمایید.', 'error');
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