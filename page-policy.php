<?php
/**
 * Template Name: Legal Policy Layout (قوانین، حریم خصوصی و رویه‌ها)
 * Template Post Type: page
 *
 * @package RazGem
 * @version 2.5.0
 */
defined( 'ABSPATH' ) || exit;
get_header();

$current_slug = get_post_field( 'post_name', get_post() );
?>

<main class="site-container utility-page policy-experience" dir="rtl" role="main">

    <!-- 1. HERO POLICY HEADER -->
    <header class="policy-hero-header">
        <div class="policy-badge">
            <span class="badge-icon">⚖️</span>
            <span>شفافیت، حقوق مصرف‌کننده و ضوابط رسمی اینماد</span>
        </div>
        <h1 class="policy-hero-title">
            <?php the_title(); ?>
        </h1>
        <p class="policy-hero-subtitle">
            کلیه فرآیندهای خرید، ثبت سفارش، بسته‌بندی، ارسال و خدمات پس از فروش در گالری رازجم تحت نظارت قوانین تجارت الکترونیک جمهوری اسلامی ایران انجام می‌پذیرد.
        </p>
        <div class="policy-update-pill">
            <span>📅 آخرین بازنگری و به‌روزرسانی: پاییز ۱۴۰۵ | نسخه رسمی منطبق با ضوابط اینماد</span>
        </div>
    </header>

    <!-- 2. POLICY NAVIGATION TABS -->
    <nav class="policy-nav-tabs" aria-label="فهرست اسناد قانونی و مقررات">
        <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>" class="policy-tab <?php echo ( $current_slug === 'terms' ) ? 'active' : ''; ?>">
            <span class="tab-icon">📜</span>
            <span>شرایط و قوانین خرید</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/return-policy' ) ); ?>" class="policy-tab <?php echo ( in_array( $current_slug, array( 'return-policy', 'returns' ) ) ) ? 'active' : ''; ?>">
            <span class="tab-icon">🛡️</span>
            <span>ضمانت اصالت و بازگشت (۷ روز)</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>" class="policy-tab <?php echo ( $current_slug === 'privacy' ) ? 'active' : ''; ?>">
            <span class="tab-icon">🔒</span>
            <span>سیاست حفظ حریم خصوصی</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/shipping-payment' ) ); ?>" class="policy-tab <?php echo ( in_array( $current_slug, array( 'shipping-payment', 'shipping' ) ) ) ? 'active' : ''; ?>">
            <span class="tab-icon">🚚</span>
            <span>شیوه‌های پرداخت و ارسال</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/faq' ) ); ?>" class="policy-tab <?php echo ( $current_slug === 'faq' ) ? 'active' : ''; ?>">
            <span class="tab-icon">❓</span>
            <span>پرسش‌های متداول و سایز</span>
        </a>
    </nav>

    <!-- 3. MAIN EDITORIAL POLICY BODY -->
    <div class="policy-content-wrapper">
        <article class="policy-card">
            <?php if ( $current_slug === 'terms' && function_exists('razgem_render_natural_disclaimer') ) : ?>
                <?php razgem_render_natural_disclaimer('terms'); ?>
            <?php endif; ?>

            <?php while ( have_posts() ) : the_post(); ?>
                <div class="policy-editorial-body">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>

            <!-- Assistance Footer inside policy card -->
            <div class="policy-assistance-footer">
                <div class="assist-text">
                    <strong>آیا در خصوص این مفاد پرسشی دارید؟</strong>
                    <span>واحد امور مشتریان و حقوقی گالری رازجم آماده پاسخگویی و رفع ابهام شماست.</span>
                </div>
                <div class="assist-actions">
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-assist-contact">
                        <span>ارتباط با واحد پشتیبانی</span>
                    </a>
                </div>
            </div>
        </article>
    </div>

</main>

<style>
/* =========================================================================
   LEGAL POLICY EXPERIENCE - LUXURY EDITORIAL STYLING
   ========================================================================= */
.policy-experience {
    padding-top: 3.5rem;
    padding-bottom: 6rem;
    color: var(--color-marine-deep, #1B3347);
}

/* 1. Hero Header */
.policy-hero-header {
    text-align: center;
    max-width: 820px;
    margin: 0 auto 3rem auto;
}
.policy-badge {
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
    margin-bottom: 1.2rem;
}
.policy-hero-title {
    font-family: var(--font-heading);
    font-size: 2.6rem;
    font-weight: 800;
    line-height: 1.4;
    color: var(--color-marine-deep, #1B3347);
    margin: 0 0 1rem 0;
}
.policy-hero-subtitle {
    font-size: 1.08rem;
    line-height: 2;
    color: var(--color-marine-muted, #566E80);
    margin: 0 auto 1.5rem auto;
    max-width: 700px;
}
.policy-update-pill {
    display: inline-block;
    font-size: 0.8rem;
    font-weight: 600;
    color: #566E80;
    background: #FAF8F5;
    border: 1px solid var(--color-pebble-light, #EAE3DA);
    padding: 0.35rem 1rem;
    border-radius: 8px;
}

/* 2. Policy Nav Tabs */
.policy-nav-tabs {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.8rem;
    margin-bottom: 3.5rem;
    flex-wrap: wrap;
}
.policy-tab {
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    background: #FFFFFF;
    border: 1px solid var(--color-pebble-light, #EAE3DA);
    padding: 0.8rem 1.4rem;
    border-radius: 14px;
    color: var(--color-marine-deep, #1B3347);
    text-decoration: none;
    font-size: 0.92rem;
    font-weight: 700;
    transition: all 0.25s ease;
    box-shadow: 0 4px 15px rgba(27, 51, 71, 0.02);
}
.policy-tab:hover {
    border-color: #D4AF37;
    color: #9E7D3B;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(212, 175, 55, 0.1);
}
.policy-tab.active {
    background: #1B3347;
    color: #FAF8F5 !important;
    border-color: #1B3347;
    box-shadow: 0 8px 25px rgba(27, 51, 71, 0.18);
}
.policy-tab.active .tab-icon {
    filter: brightness(1.2);
}

/* 3. Main Policy Card & Typography */
.policy-content-wrapper {
    max-width: 960px;
    margin: 0 auto;
}
.policy-card {
    background: #FFFFFF;
    border: 1px solid var(--color-pebble-light, #EAE3DA);
    border-radius: 26px;
    padding: 3.5rem 3.8rem;
    box-shadow: 0 15px 45px rgba(27, 51, 71, 0.04);
    position: relative;
    overflow: hidden;
}
.policy-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    height: 5px;
    background: linear-gradient(90deg, #1B3347 0%, #D4AF37 50%, #1B3347 100%);
}
.policy-editorial-body {
    font-size: 1.06rem;
    line-height: 2.2;
    color: #2F4554;
}
.policy-editorial-body h2 {
    font-family: var(--font-heading);
    font-size: 1.65rem;
    font-weight: 800;
    color: var(--color-marine-deep, #1B3347);
    margin: 2.5rem 0 1rem 0;
    padding-bottom: 0.6rem;
    border-bottom: 1px solid rgba(234, 227, 218, 0.8);
    position: relative;
}
.policy-editorial-body h2:first-child {
    margin-top: 0;
}
.policy-editorial-body h3 {
    font-family: var(--font-heading);
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--color-marine-deep, #1B3347);
    margin: 1.8rem 0 0.8rem 0;
}
.policy-editorial-body p {
    margin-bottom: 1.2rem;
}
.policy-editorial-body ul,
.policy-editorial-body ol {
    margin: 0 0 1.5rem 0;
    padding-right: 1.5rem;
}
.policy-editorial-body li {
    margin-bottom: 0.6rem;
    line-height: 2;
}
.policy-editorial-body strong {
    color: var(--color-marine-deep, #1B3347);
    font-weight: 700;
}

/* Callout Alert Boxes inside policy content */
.policy-callout {
    background: #FAF8F5;
    border-right: 4px solid #D4AF37;
    border-radius: 12px;
    padding: 1.4rem 1.8rem;
    margin: 2rem 0;
    font-size: 0.98rem;
    line-height: 2;
    color: #1B3347;
}
.policy-callout--law {
    background: #F4F8FA;
    border-right-color: #1B3347;
}

/* Assistance Footer inside Policy Card */
.policy-assistance-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    margin-top: 3.5rem;
    padding-top: 2rem;
    border-top: 1px solid var(--color-pebble-light, #EAE3DA);
    flex-wrap: wrap;
}
.assist-text {
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
}
.assist-text strong {
    font-size: 1.05rem;
    color: var(--color-marine-deep, #1B3347);
}
.assist-text span {
    font-size: 0.9rem;
    color: var(--color-marine-muted, #566E80);
}
.btn-assist-contact {
    display: inline-flex;
    align-items: center;
    background: #1B3347;
    color: #FAF8F5 !important;
    padding: 0.85rem 1.8rem;
    border-radius: 999px;
    font-size: 0.92rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.25s ease;
}
.btn-assist-contact:hover {
    background: #24445E;
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 900px) {
    .policy-hero-title {
        font-size: 2rem;
    }
    .policy-card {
        padding: 2.2rem 1.8rem;
    }
    .policy-nav-tabs {
        flex-direction: column;
        align-items: stretch;
    }
    .policy-tab {
        justify-content: center;
    }
    .policy-assistance-footer {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

<?php get_footer(); ?>
