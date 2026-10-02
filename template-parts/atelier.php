<?php
/**
 * Artisan Atelier Section Template
 *
 * @package RazGem
 */

// Customizer Options
    = get_theme_mod( 'atelier_badge', 'کارگاه زرگری و دست‌سازه‌ها' );
    = get_theme_mod( 'atelier_title', 'داستان هنر و ظرافت در گالری رازجم' );
     = get_theme_mod( 'atelier_desc', 'هر اثر در گالری رازجم روایتی یگانه از تلاقی دستان هنرمند و طبیعت است. از گزینش اصیل‌ترین مرواریدهای باروک تا ریخته‌گری طلای ۱۸ عیار و تراش اختصاصی صدف‌های طبیعی در کارگاه اختصاصی رازجم.' );
 = get_theme_mod( 'atelier_btn_text', 'مشاوره و ساخت سفارش اختصاصی' );
  = get_theme_mod( 'atelier_btn_url', '/contact' );

 = get_template_directory_uri();

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
    <div class="site-container">
        
        <!-- Atelier Narrative Header -->
        <div class="razgem-atelier-header" style="text-align: center; max-width: 800px; margin: 0 auto 3rem auto;">
            <?php if ( ! empty( $atelier_badge ) ) : ?>
                <div class="razgem-atelier-badge-wrap" style="justify-content: center;">
                    <span class="razgem-atelier-badge" style="margin: 0 auto;"><?php echo esc_html( $atelier_badge ); ?></span>
                </div>
            <?php endif; ?>

            <h2 class="razgem-atelier-title" style="margin-top: 1rem;">
                <?php echo esc_html( $atelier_title ); ?>
            </h2>

            <p class="razgem-atelier-desc" style="color: var(--color-marine-muted); margin-bottom: 2rem;">
                <?php echo nl2br( esc_html( $atelier_desc ) ); ?>
            </p>
        </div>

        <!-- 3 Workstations Interactive Gallery (Slider) -->
        <div class="atelier-slider-container" style="display: flex; gap: 2rem; align-items: stretch; margin-top: 3rem;">
            
            <!-- Left: Tabs (Text) -->
            <div class="atelier-tabs" style="flex: 0 0 40%; display: flex; flex-direction: column; gap: 1rem; justify-content: center;">
                <?php foreach ( $stations as $idx => $st ) : ?>
                    <div class="atelier-tab-btn <?php echo $idx === 0 ? 'active' : ''; ?>" data-slide="<?php echo $idx; ?>" style="padding: 1.5rem; border-radius: 12px; cursor: pointer; transition: all 0.3s ease; background: <?php echo $idx === 0 ? '#fff' : 'transparent'; ?>; box-shadow: <?php echo $idx === 0 ? '0 4px 15px rgba(27,51,71,0.05)' : 'none'; ?>; border: 1px solid <?php echo $idx === 0 ? 'rgba(0,0,0,0.04)' : 'transparent'; ?>;">
                        <h3 style="font-size: 1.1rem; font-weight: 800; color: #1B3347; margin: 0 0 0.5rem 0;"><?php echo esc_html( $st['title'] ); ?></h3>
                        <p style="font-size: 0.9rem; color: #5A7B92; margin: 0; line-height: 1.6; opacity: <?php echo $idx === 0 ? '1' : '0.6'; ?>;"><?php echo esc_html( $st['desc'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Right: Slider (Images) -->
            <div class="atelier-slider-images" style="flex: 0 0 calc(60% - 2rem); position: relative; border-radius: 16px; overflow: hidden; aspect-ratio: 16/9; box-shadow: 0 10px 30px rgba(27,51,71,0.1);">
                <?php foreach ( $stations as $idx => $st ) : ?>
                    <div class="atelier-slide <?php echo $idx === 0 ? 'active' : ''; ?>" id="atelier-slide-<?php echo $idx; ?>" style="position: absolute; inset: 0; opacity: <?php echo $idx === 0 ? '1' : '0'; ?>; visibility: <?php echo $idx === 0 ? 'visible' : 'hidden'; ?>; transition: opacity 0.5s ease, visibility 0.5s ease;">
                        <img src="<?php echo esc_url( $st['image'] ); ?>" alt="<?php echo esc_attr( $st['title'] ); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <div style="position: absolute; top: 1.5rem; right: 1.5rem; background: rgba(255,255,255,0.9); backdrop-filter: blur(4px); padding: 0.4rem 1rem; border-radius: 999px; font-weight: 700; font-size: 0.85rem; color: #1B3347;">
                            <?php echo esc_html( sprintf( 'میز کار %d', $idx + 1 ) ); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- Atelier Features (Bottom Row) -->
        <div class="razgem-atelier-features" style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: center; align-items: stretch; gap: 2rem; margin-top: 4rem; padding-top: 2rem; border-top: 1px solid rgba(27,51,71,0.05);">
            <div class="atelier-feature-pill" style="display: flex; align-items: center; gap: 0.8rem; max-width: 300px;">
                <div class="pill-dot" style="width: 8px; height: 8px; border-radius: 50%; background: #D4AF37; flex-shrink: 0;"></div>
                <div class="pill-body">
                    <strong style="font-size: 0.85rem; color: #1B3347; display: block;">ریخته‌گری دقیق طلای ۱۸ عیار</strong>
                    <p style="font-size: 0.75rem; color: #5A7B92; margin: 0;">تولید محدود با نظارت دقیق عیارسنجی اتحادیه طلا و جواهر</p>
                </div>
            </div>

            <div class="atelier-feature-pill" style="display: flex; align-items: center; gap: 0.8rem; max-width: 300px;">
                <div class="pill-dot" style="width: 8px; height: 8px; border-radius: 50%; background: #D4AF37; flex-shrink: 0;"></div>
                <div class="pill-body">
                    <strong style="font-size: 0.85rem; color: #1B3347; display: block;">مرواریدهای باروک منفرد و طبیعی</strong>
                    <p style="font-size: 0.75rem; color: #5A7B92; margin: 0;">هیچ دو مرواریدی در جهان یکسان نیستند؛ اثری منحصربه‌فرد</p>
                </div>
            </div>

            <div class="atelier-feature-pill" style="display: flex; align-items: center; gap: 0.8rem; max-width: 300px;">
                <div class="pill-dot" style="width: 8px; height: 8px; border-radius: 50%; background: #D4AF37; flex-shrink: 0;"></div>
                <div class="pill-body">
                    <strong style="font-size: 0.85rem; color: #1B3347; display: block;">سفارش‌سازی نام، تاریخ و نشان دلخواه</strong>
                    <p style="font-size: 0.75rem; color: #5A7B92; margin: 0;">تبدیل ایده و طرح ذهنی شما به یک شاهکار طلا با مدل‌سازی</p>
                </div>
            </div>
        </div>

        <?php if ( ! empty( $atelier_btn_text ) && ! empty( $atelier_btn_url ) ) : ?>
            <div class="razgem-atelier-actions" style="display: flex; justify-content: center; margin-top: 2.5rem;">
                <a href="<?php echo esc_url( $atelier_btn_url ); ?>" class="btn-luxury-gold" style="padding: 0.8rem 2rem; border-radius: 999px; background: #D4AF37; color: #fff; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: background 0.2s;">
                    <span><?php echo esc_html( $atelier_btn_text ); ?></span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>

<style>
.atelier-tab-btn:hover { background: rgba(255,255,255,0.5) !important; }
.atelier-tab-btn.active { background: #fff !important; box-shadow: 0 4px 15px rgba(27,51,71,0.05) !important; border-color: rgba(0,0,0,0.04) !important; }
.atelier-tab-btn.active p { opacity: 1 !important; }
.btn-luxury-gold:hover {
    background: #c59b27 !important;
}
@media (max-width: 991px) {
    .atelier-slider-container { flex-direction: column-reverse; }
    .atelier-slider-images { width: 100%; aspect-ratio: 4/3; }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.atelier-tab-btn');
    const slides = document.querySelectorAll('.atelier-slide');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active from all
            tabs.forEach(t => {
                t.classList.remove('active');
                t.style.background = 'transparent';
                t.style.boxShadow = 'none';
                t.style.borderColor = 'transparent';
                t.querySelector('p').style.opacity = '0.6';
            });
            slides.forEach(s => {
                s.classList.remove('active');
                s.style.opacity = '0';
                s.style.visibility = 'hidden';
            });
            
            // Add active to clicked
            this.classList.add('active');
            this.style.background = '#fff';
            this.style.boxShadow = '0 4px 15px rgba(27,51,71,0.05)';
            this.style.borderColor = 'rgba(0,0,0,0.04)';
            this.querySelector('p').style.opacity = '1';
            
            const slideId = this.getAttribute('data-slide');
            const targetSlide = document.getElementById('atelier-slide-' + slideId);
            if(targetSlide) {
                targetSlide.classList.add('active');
                targetSlide.style.opacity = '1';
                targetSlide.style.visibility = 'visible';
            }
        });
    });
});
</script>
