<?php
/**
 * RazGem Artisan Atelier Story & 3-Workstation Showcase
 * کارگاه زرگری و دست‌سازه‌های اختصاصی طلا و مروارید رازجم
 *
 * @package RazGem
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$theme_uri        = get_template_directory_uri();
$atelier_badge    = get_theme_mod( 'atelier_badge', 'کارگاه زرگری و دست‌سازه‌ها' );
$atelier_title    = get_theme_mod( 'atelier_title', 'داستان هنر و ظرافت در گالری طلا و مروارید رازجم' );
$atelier_desc     = get_theme_mod( 'atelier_desc', 'هر اثر در گالری رازجم روایتی یگانه از تلاقی دستان هنرمند و طبیعت است. از گزینش اصیل‌ترین مرواریدهای باروک تا ریخته‌گری طلای ۱۸ عیار و تراش اختصاصی صدف‌های طبیعی در کارگاه اختصاصی رازجم.' );
$atelier_btn_text = get_theme_mod( 'atelier_btn_text', 'مشاوره و ساخت سفارش اختصاصی' );
$atelier_btn_url  = get_theme_mod( 'atelier_btn_url', '/contact' );

// 3 Curated Workstations (Configurable via Customizer)
$stations = array(
    array(
        'id'    => 1,
        'image' => get_theme_mod( 'atelier_image_1', '' ) ?: $theme_uri . '/assets/images/workstation-1.jpg',
        'title' => get_theme_mod( 'atelier_title_1', 'میز شماره ۱: انتخاب و تراش صدف طبیعی' ),
        'desc'  => get_theme_mod( 'atelier_desc_1', 'برش، صیقل و فرم‌دهی دستی صدف‌های طبیعی خلیج فارس بدون رنگ‌آمیزی شیمیایی' ),
    ),
    array(
        'id'    => 2,
        'image' => get_theme_mod( 'atelier_image_2', '' ) ?: $theme_uri . '/assets/images/workstation-2.jpg',
        'title' => get_theme_mod( 'atelier_title_2', 'میز شماره ۲: گوهرنشانی و مروارید باروک' ),
        'desc'  => get_theme_mod( 'atelier_desc_2', 'سوارکاری مرواریدهای باروک منفرد و ارگانیک بر پایه‌های طلایی و نقره استرلینگ' ),
    ),
    array(
        'id'    => 3,
        'image' => get_theme_mod( 'atelier_image_3', '' ) ?: $theme_uri . '/assets/images/workstation-3.jpg',
        'title' => get_theme_mod( 'atelier_title_3', 'میز شماره ۳: طراحی سفارشی و کنترل نهایی' ),
        'desc'  => get_theme_mod( 'atelier_desc_3', 'کنترل میکروسکوپی اتصالات، پولیش نهایی و صدور شناسنامه فیزیکی اصالت آتلیه' ),
    ),
);
?>

<section class="razgem-atelier-section" aria-label="<?php echo esc_attr( $atelier_title ); ?>">
    <div class="site-container razgem-atelier-grid">
        
        <!-- Atelier Visual Showcase: Interactive Workstation Gallery -->
        <div class="razgem-atelier-media-wrap">
            <div class="razgem-atelier-frame" id="razgemAtelierFrame">
                <img src="<?php echo esc_url( $stations[0]['image'] ); ?>" 
                     alt="<?php echo esc_attr( $stations[0]['title'] ); ?>" 
                     id="razgemAtelierMainImg"
                     class="razgem-atelier-img"
                     loading="lazy">
                
                <div class="razgem-atelier-badge-stamp">
                    <span class="stamp-year">EST. ۲۰۲۳</span>
                    <span class="stamp-text">کارگاه تخصصی زرگری و گوهرتراشی رازجم</span>
                </div>

                <div class="razgem-atelier-station-tag" id="razgemAtelierStationTag">
                    <?php echo esc_html( $stations[0]['title'] ); ?>
                </div>
            </div>

            <!-- 3 Workstations Interactive Switcher -->
            <div class="razgem-workstations-thumbs" role="tablist" aria-label="<?php esc_attr_e( 'میزهای کارگاه رازجم', 'razgem' ); ?>">
                <?php foreach ( $stations as $idx => $st ) : ?>
                    <button type="button" 
                            class="workstation-thumb-btn <?php echo 0 === $idx ? 'is-active' : ''; ?>"
                            data-img="<?php echo esc_url( $st['image'] ); ?>"
                            data-title="<?php echo esc_attr( $st['title'] ); ?>"
                            role="tab"
                            aria-selected="<?php echo 0 === $idx ? 'true' : 'false'; ?>"
                            aria-label="<?php echo esc_attr( $st['title'] ); ?>">
                        <div class="thumb-media">
                            <img src="<?php echo esc_url( $st['image'] ); ?>" alt="<?php echo esc_attr( $st['title'] ); ?>" loading="lazy">
                        </div>
                        <div class="thumb-info">
                            <span class="thumb-num"><?php echo esc_html( sprintf( 'میز کار %d', $idx + 1 ) ); ?></span>
                            <strong class="thumb-name"><?php echo esc_html( $st['title'] ); ?></strong>
                        </div>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Atelier Narrative & Craftsmanship Values -->
        <div class="razgem-atelier-content">
            <?php if ( ! empty( $atelier_badge ) ) : ?>
                <div class="razgem-atelier-badge-wrap">
                    <span class="razgem-atelier-badge"><?php echo esc_html( $atelier_badge ); ?></span>
                </div>
            <?php endif; ?>

            <h2 class="razgem-atelier-title">
                <?php echo esc_html( $atelier_title ); ?>
            </h2>

            <p class="razgem-atelier-desc">
                <?php echo nl2br( esc_html( $atelier_desc ) ); ?>
            </p>

            <div class="razgem-atelier-features">
                <div class="atelier-feature-pill">
                    <div class="pill-dot"></div>
                    <div class="pill-body">
                        <strong>ریخته‌گری دقیق طلای ۱۸ عیار</strong>
                        <p>تولید محدود با نظارت دقیق عیارسنجی اتحادیه طلا و جواهر</p>
                    </div>
                </div>

                <div class="atelier-feature-pill">
                    <div class="pill-dot"></div>
                    <div class="pill-body">
                        <strong>مرواریدهای باروک منفرد و طبیعی</strong>
                        <p>هیچ دو مرواریدی در جهان یکسان نیستند؛ اثری منحصربه‌فرد برای شما</p>
                    </div>
                </div>

                <div class="atelier-feature-pill">
                    <div class="pill-dot"></div>
                    <div class="pill-body">
                        <strong>سفارش‌سازی نام، تاریخ و نشان دلخواه</strong>
                        <p>تبدیل ایده و طرح ذهنی شما به یک شاهکار طلا با مدل‌سازی سه‌بعدی</p>
                    </div>
                </div>
            </div>

            <?php if ( ! empty( $atelier_btn_text ) && ! empty( $atelier_btn_url ) ) : ?>
                <div class="razgem-atelier-actions">
                    <a href="<?php echo esc_url( $atelier_btn_url ); ?>" class="btn-luxury-gold">
                        <span><?php echo esc_html( $atelier_btn_text ); ?></span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var thumbBtns = document.querySelectorAll('.workstation-thumb-btn');
    var mainImg = document.getElementById('razgemAtelierMainImg');
    var tagEl = document.getElementById('razgemAtelierStationTag');

    if (!thumbBtns.length || !mainImg) return;

    thumbBtns.forEach(function(btn) {
        function activateStation() {
            var newSrc = btn.getAttribute('data-img');
            var newTitle = btn.getAttribute('data-title');
            if (newSrc && mainImg.src !== newSrc) {
                mainImg.style.opacity = '0.4';
                setTimeout(function() {
                    mainImg.src = newSrc;
                    mainImg.style.opacity = '1';
                }, 150);
            }
            if (tagEl && newTitle) {
                tagEl.textContent = newTitle;
            }
            thumbBtns.forEach(function(b) {
                b.classList.remove('is-active');
                b.setAttribute('aria-selected', 'false');
            });
            btn.classList.add('is-active');
            btn.setAttribute('aria-selected', 'true');
        }

        btn.addEventListener('click', activateStation);
        btn.addEventListener('mouseenter', activateStation);
    });
});
</script>
