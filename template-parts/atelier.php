<?php
/**
 * Artisan Atelier Section Template
 *
 * @package RazGem
 */

// Customizer Options
$atelier_badge    = get_theme_mod( 'atelier_badge', 'کارگاه اختصاصی' );
$atelier_title    = get_theme_mod( 'atelier_title', 'داستان هنر و ظرافت در گالری رازجم' );
$atelier_desc     = get_theme_mod( 'atelier_desc', 'هر اثر در گالری رازجم روایتی یگانه از تلاقی دستان هنرمند و طبیعت است. گزینش اصیل‌ترین مرواریدها و تراش اختصاصی صدف‌های طبیعی خلیج فارس.' );
$atelier_btn_text = get_theme_mod( 'atelier_btn_text', 'مشاوره و ساخت سفارش اختصاصی' );
$atelier_btn_url  = get_theme_mod( 'atelier_btn_url', '/contact' );

$theme_uri = get_template_directory_uri();

// 3 Curated Workstations (Configurable via Customizer)
$stations = array(
    array(
        'id'    => 1,
        'image' => get_theme_mod( 'atelier_image_1', '' ) ?: $theme_uri . '/assets/images/workstation-1.jpg',
        'title' => 'انتخاب و تراش صدف طبیعی',
        'desc'  => 'برش، صیقل و فرم‌دهی دستی صدف‌های طبیعی خلیج فارس بدون رنگ‌آمیزی شیمیایی',
    ),
    array(
        'id'    => 2,
        'image' => get_theme_mod( 'atelier_image_2', '' ) ?: $theme_uri . '/assets/images/workstation-2.jpg',
        'title' => 'گوهرنشانی و مروارید باروک',
        'desc'  => 'سوارکاری مرواریدهای باروک منفرد و ارگانیک بر پایه‌های نقره استرلینگ و فلزات گرانبها',
    ),
    array(
        'id'    => 3,
        'image' => get_theme_mod( 'atelier_image_3', '' ) ?: $theme_uri . '/assets/images/workstation-3.jpg',
        'title' => 'طراحی سفارشی و کنترل نهایی',
        'desc'  => 'کنترل میکروسکوپی اتصالات، پولیش نهایی و صدور شناسنامه فیزیکی اصالت آتلیه',
    ),
);
?>

<section class="razgem-atelier-section" aria-label="<?php echo esc_attr( $atelier_title ); ?>">
    <div class="site-container">
        
        <!-- Atelier Narrative Header -->
        <div class="razgem-atelier-header" style="text-align: center; max-width: 800px; margin: 0 auto 3rem auto;">
            <?php if ( ! empty( $atelier_badge ) ) : ?>
                <div class="razgem-atelier-badge-wrap" style="justify-content: center; display: flex;">
                    <span class="razgem-atelier-badge" style="margin: 0 auto; background: var(--color-marine-deep, #1B3347); color: #fff; padding: 0.4rem 1rem; border-radius: 999px; font-size: 0.8rem;"><?php echo esc_html( $atelier_badge ); ?></span>
                </div>
            <?php endif; ?>

            <h2 class="razgem-atelier-title" style="margin-top: 1.5rem; font-size: 2rem; color: var(--color-marine-deep, #1B3347);">
                <?php echo esc_html( $atelier_title ); ?>
            </h2>

            <p class="razgem-atelier-desc" style="color: var(--color-marine-muted, #5A7B92); margin-top: 1rem; font-size: 1.1rem; line-height: 1.8;">
                <?php echo nl2br( esc_html( $atelier_desc ) ); ?>
            </p>
        </div>

        <!-- 3 Workstations Interactive Gallery (Slider) -->
        <div class="atelier-slider-container" style="display: flex; gap: 3rem; align-items: stretch; margin-top: 4rem; margin-left: auto; margin-right: auto; max-width: 1100px; background: #fff; padding: 2rem; border-radius: 24px; box-shadow: 0 10px 40px rgba(27,51,71,0.06); border: 1px solid rgba(27,51,71,0.04);">
            
            <!-- Left: Tabs (Text) -->
            <div class="atelier-tabs" style="flex: 0 0 45%; display: flex; flex-direction: column; gap: 0.5rem; justify-content: center;">
                <?php foreach ( $stations as $idx => $st ) : ?>
                    <div class="atelier-tab-btn <?php echo $idx === 0 ? 'active' : ''; ?>" data-slide="<?php echo $idx; ?>" style="padding: 1.5rem 1.5rem 1.5rem 2rem; border-radius: 16px; cursor: pointer; transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1); background: <?php echo $idx === 0 ? 'var(--color-bg-base, #FBF8F2)' : 'transparent'; ?>; position: relative; overflow: hidden;">
                        <?php if ( $idx === 0 ) : ?>
                            <div class="active-indicator" style="position: absolute; right: 0; top: 1.5rem; bottom: 1.5rem; width: 4px; background: var(--color-marine-deep, #1B3347); border-radius: 4px 0 0 4px;"></div>
                        <?php else : ?>
                            <div class="active-indicator" style="position: absolute; right: 0; top: 1.5rem; bottom: 1.5rem; width: 4px; background: transparent; border-radius: 4px 0 0 4px; transition: background 0.3s;"></div>
                        <?php endif; ?>
                        
                        <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--color-marine-deep, #1B3347); margin: 0 0 0.5rem 0;"><?php echo esc_html( $st['title'] ); ?></h3>
                        <p style="font-size: 0.95rem; color: var(--color-marine-muted, #5A7B92); margin: 0; line-height: 1.6; opacity: <?php echo $idx === 0 ? '1' : '0.6'; ?>; transition: opacity 0.3s;"><?php echo esc_html( $st['desc'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Right: Slider (Images) -->
            <div class="atelier-slider-images" style="flex: 1; position: relative; border-radius: 16px; overflow: hidden; min-height: 400px; box-shadow: inset 0 0 0 1px rgba(0,0,0,0.05);">
                <?php foreach ( $stations as $idx => $st ) : ?>
                    <div class="atelier-slide <?php echo $idx === 0 ? 'active' : ''; ?>" id="atelier-slide-<?php echo $idx; ?>" style="position: absolute; inset: 0; opacity: <?php echo $idx === 0 ? '1' : '0'; ?>; visibility: <?php echo $idx === 0 ? 'visible' : 'hidden'; ?>; transition: opacity 0.6s cubic-bezier(0.2, 0.8, 0.2, 1), visibility 0.6s, transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1); transform: <?php echo $idx === 0 ? 'scale(1)' : 'scale(1.05)'; ?>;">
                        <img src="<?php echo esc_url( $st['image'] ); ?>" alt="<?php echo esc_attr( $st['title'] ); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- Atelier Features (Bottom Row) -->
        <div class="razgem-atelier-features" style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: center; align-items: stretch; gap: 2.5rem; margin-top: 4rem;">
            <div class="atelier-feature-pill" style="display: flex; align-items: flex-start; gap: 1rem; max-width: 320px;">
                <div class="pill-dot" style="width: 40px; height: 40px; border-radius: 50%; background: var(--color-bg-base, #FBF8F2); color: var(--color-marine-deep, #1B3347); display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid rgba(27,51,71,0.1);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <div class="pill-body">
                    <strong style="font-size: 0.95rem; color: var(--color-marine-deep, #1B3347); display: block; margin-bottom: 0.3rem;">تضمین اصالت متریال</strong>
                    <p style="font-size: 0.8rem; color: var(--color-marine-muted, #5A7B92); margin: 0; line-height: 1.5;">استفاده از متریال ۱۰۰٪ طبیعی با بالاترین درجه کیفی در کارگاه اختصاصی</p>
                </div>
            </div>

            <div class="atelier-feature-pill" style="display: flex; align-items: flex-start; gap: 1rem; max-width: 320px;">
                <div class="pill-dot" style="width: 40px; height: 40px; border-radius: 50%; background: var(--color-bg-base, #FBF8F2); color: var(--color-marine-deep, #1B3347); display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid rgba(27,51,71,0.1);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
                </div>
                <div class="pill-body">
                    <strong style="font-size: 0.95rem; color: var(--color-marine-deep, #1B3347); display: block; margin-bottom: 0.3rem;">مرواریدهای باروک منحصربه‌فرد</strong>
                    <p style="font-size: 0.8rem; color: var(--color-marine-muted, #5A7B92); margin: 0; line-height: 1.5;">هیچ دو مرواریدی در جهان یکسان نیستند؛ هر قطعه منحصربه‌فرد است</p>
                </div>
            </div>

            <div class="atelier-feature-pill" style="display: flex; align-items: flex-start; gap: 1rem; max-width: 320px;">
                <div class="pill-dot" style="width: 40px; height: 40px; border-radius: 50%; background: var(--color-bg-base, #FBF8F2); color: var(--color-marine-deep, #1B3347); display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid rgba(27,51,71,0.1);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </div>
                <div class="pill-body">
                    <strong style="font-size: 0.95rem; color: var(--color-marine-deep, #1B3347); display: block; margin-bottom: 0.3rem;">سفارش‌سازی طرح دلخواه</strong>
                    <p style="font-size: 0.8rem; color: var(--color-marine-muted, #5A7B92); margin: 0; line-height: 1.5;">تبدیل ایده و طرح ذهنی شما به یک قطعه جواهر دست‌ساز و یگانه</p>
                </div>
            </div>
        </div>

        <?php if ( ! empty( $atelier_btn_text ) && ! empty( $atelier_btn_url ) ) : ?>
            <div class="razgem-atelier-actions" style="display: flex; justify-content: center; margin-top: 3.5rem;">
                <a href="<?php echo esc_url( $atelier_btn_url ); ?>" class="btn-coastal-slate" style="padding: 0.8rem 2.5rem; border-radius: 999px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.8rem;">
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
.atelier-tab-btn:hover { background: var(--color-bg-base, #FBF8F2) !important; }
.atelier-tab-btn.active p { opacity: 1 !important; }
@media (max-width: 991px) {
    .atelier-slider-container { flex-direction: column-reverse; padding: 1.5rem !important; }
    .atelier-slider-images { width: 100%; aspect-ratio: 4/3; min-height: 250px !important; }
    .atelier-tab-btn { padding: 1.2rem !important; }
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
                t.querySelector('p').style.opacity = '0.6';
                const ind = t.querySelector('.active-indicator');
                if (ind) ind.style.background = 'transparent';
            });
            slides.forEach(s => {
                s.classList.remove('active');
                s.style.opacity = '0';
                s.style.visibility = 'hidden';
                s.style.transform = 'scale(1.05)';
            });
            
            // Add active to clicked
            this.classList.add('active');
            this.style.background = 'var(--color-bg-base, #FBF8F2)';
            this.querySelector('p').style.opacity = '1';
            const thisInd = this.querySelector('.active-indicator');
            if (thisInd) thisInd.style.background = 'var(--color-marine-deep, #1B3347)';
            
            const slideId = this.getAttribute('data-slide');
            const targetSlide = document.getElementById('atelier-slide-' + slideId);
            if(targetSlide) {
                targetSlide.classList.add('active');
                targetSlide.style.opacity = '1';
                targetSlide.style.visibility = 'visible';
                targetSlide.style.transform = 'scale(1)';
            }
        });
    });
});
</script>

