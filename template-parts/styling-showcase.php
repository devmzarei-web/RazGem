<?php
/**
 * RazGem Coastal Styling Showcase ("Worn-on-Person" Interactive Vitrine)
 * 4-Item Interactive Section with Organic Pebble Containers & Vanilla JS Crossfade
 *
 * @package RazGem
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$items = function_exists( 'razgem_get_showcase_items' ) ? razgem_get_showcase_items() : array();
if ( empty( $items ) ) {
    return;
}

$initial_item = $items[0];
?>

<section class="razgem-worn-showcase" id="wornShowcaseSection" aria-label="راهنمای استایل و تن‌خور زیورآلات صدف و مروارید رازجم">
    <!-- Top Undulating Wave Divider -->
    <div class="showcase-wave-top wave-divider" aria-hidden="true">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none">
            <path d="M0,40 C320,80 640,0 960,50 C1200,85 1360,20 1440,45 L1440,0 L0,0 Z" class="wave-fill--canvas"></path>
        </svg>
    </div>

    <div class="site-container">
        <!-- Section Header -->
        <header class="showcase-header">
            <span class="showcase-badge">
                <span class="badge-dot"></span>
                هنر دست در تلاقی نور و دریا
            </span>
            <h2 class="showcase-title">استایل زیورآلات صدف و مروارید بر تن</h2>
            <p class="showcase-sub">برای مشاهده جلوه، درخشش نسترن صدف و مقیاس طبیعی هر قطعه بر تن، آیتم مورد نظر را انتخاب نمایید</p>
        </header>

        <div class="worn-showcase-layout">
            
            <!-- Right Column (RTL): 4 Selectable Specimen Cards -->
            <div class="showcase-items-list" role="tablist" aria-label="انتخاب قطعه برای نمایش جلوه بر تن">
                <?php foreach ( $items as $idx => $item ) : 
                    $is_active = ( 0 === $idx );
                ?>
                    <button type="button"
                            class="showcase-specimen-btn <?php echo $is_active ? 'is-active' : ''; ?>"
                            role="tab"
                            id="showcaseTab-<?php echo esc_attr( $idx ); ?>"
                            aria-controls="showcasePreviewPanel"
                            aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
                            tabindex="0"
                            data-item-index="<?php echo esc_attr( $idx ); ?>"
                            data-model-img="<?php echo esc_url( $item['model'] ); ?>"
                            data-title="<?php echo esc_attr( $item['title'] ); ?>"
                            data-tag="<?php echo esc_attr( $item['tag'] ); ?>"
                            data-desc="<?php echo esc_attr( $item['desc'] ); ?>"
                            data-price="<?php echo esc_attr( $item['price'] ); ?>"
                            data-url="<?php echo esc_url( $item['url'] ); ?>">
                        
                        <div class="specimen-thumb-wrap">
                            <img src="<?php echo esc_url( $item['thumb'] ); ?>" 
                                 alt="<?php echo esc_attr( $item['title'] ); ?>" 
                                 class="specimen-thumb-img" 
                                 loading="lazy">
                        </div>

                        <div class="specimen-info">
                            <span class="specimen-tag"><?php echo esc_html( $item['tag'] ); ?></span>
                            <h3 class="specimen-title"><?php echo esc_html( $item['title'] ); ?></h3>
                            <div class="specimen-bottom-row">
                                <span class="specimen-price"><?php echo esc_html( $item['price'] ); ?></span>
                                <span class="specimen-select-pill">
                                    <span class="pill-text"><?php echo $is_active ? 'در حال نمایش' : 'انتخاب'; ?></span>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                                </span>
                            </div>
                        </div>

                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Left Column (RTL): Dominant Organic Model Preview Container -->
            <div class="showcase-preview-container" 
                 id="showcasePreviewPanel" 
                 role="tabpanel" 
                 aria-labelledby="showcaseTab-0">
                
                <div class="preview-organic-frame">
                    <!-- Model Image with Ambient Light Overlay -->
                    <div class="preview-img-wrapper">
                        <img src="<?php echo esc_url( $initial_item['model'] ); ?>" 
                             alt="<?php echo esc_attr( $initial_item['title'] ); ?> بر تن" 
                             class="preview-model-img" 
                             id="showcaseModelImg">
                        <div class="preview-light-vignette" aria-hidden="true"></div>
                    </div>

                    <!-- Floating Translucent Nature Card -->
                    <div class="preview-overlay-card">
                        <span class="preview-tag" id="showcasePreviewTag">
                            <?php echo esc_html( $initial_item['tag'] ); ?>
                        </span>
                        
                        <h3 class="preview-title" id="showcasePreviewTitle">
                            <?php echo esc_html( $initial_item['title'] ); ?>
                        </h3>
                        
                        <p class="preview-desc" id="showcasePreviewDesc">
                            <?php echo esc_html( $initial_item['desc'] ); ?>
                        </p>
                        
                        <div class="preview-bottom-row">
                            <div class="preview-price-box">
                                <span class="price-caption">ارزش قطعه:</span>
                                <span class="preview-price" id="showcasePreviewPrice">
                                    <?php echo esc_html( $initial_item['price'] ); ?>
                                </span>
                            </div>
                            
                            <a href="<?php echo esc_url( $initial_item['url'] ); ?>" 
                               class="btn-coastal-slate pearl-shimmer-hover" 
                               id="showcasePreviewBtn">
                                <span>مشاهده و سفارش قطعه</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Bottom Undulating Wave Divider -->
    <div class="showcase-wave-bottom wave-divider" aria-hidden="true">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none">
            <path d="M0,35 C360,75 720,10 1080,55 C1260,75 1380,25 1440,40 L1440,80 L0,80 Z" class="wave-fill--canvas"></path>
        </svg>
    </div>
</section>

<!-- Vanilla JS Crossfade Handler for Worn-on-Model Showcase -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const showcaseSection = document.getElementById('wornShowcaseSection');
    if (!showcaseSection) return;

    const specimenButtons = showcaseSection.querySelectorAll('.showcase-specimen-btn');
    const modelImg = document.getElementById('showcaseModelImg');
    const tagEl = document.getElementById('showcasePreviewTag');
    const titleEl = document.getElementById('showcasePreviewTitle');
    const descEl = document.getElementById('showcasePreviewDesc');
    const priceEl = document.getElementById('showcasePreviewPrice');
    const btnEl = document.getElementById('showcasePreviewBtn');
    const previewPanel = document.getElementById('showcasePreviewPanel');

    if (!specimenButtons.length || !modelImg) return;

    specimenButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            if (this.classList.contains('is-active')) return;

            // 1. Update Buttons Active & ARIA States
            specimenButtons.forEach(b => {
                b.classList.remove('is-active');
                b.setAttribute('aria-selected', 'false');
                const pillText = b.querySelector('.pill-text');
                if (pillText) pillText.textContent = 'انتخاب';
            });

            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');
            if (previewPanel) {
                previewPanel.setAttribute('aria-labelledby', this.id);
            }
            const activePill = this.querySelector('.pill-text');
            if (activePill) activePill.textContent = 'در حال نمایش';

            // 2. Perform Smooth Crossfade Transition
            const newModelSrc = this.dataset.modelImg;
            const newTag = this.dataset.tag;
            const newTitle = this.dataset.title;
            const newDesc = this.dataset.desc;
            const newPrice = this.dataset.price;
            const newUrl = this.dataset.url;

            // Fade out
            modelImg.style.opacity = '0.15';
            modelImg.style.transform = 'scale(0.98)';
            if (titleEl) titleEl.style.opacity = '0.5';

            // Preload image and swap
            const preloadImg = new Image();
            preloadImg.src = newModelSrc;
            preloadImg.onload = function () {
                modelImg.src = newModelSrc;
                if (tagEl) tagEl.textContent = newTag;
                if (titleEl) titleEl.textContent = newTitle;
                if (descEl) descEl.textContent = newDesc;
                if (priceEl) priceEl.textContent = newPrice;
                if (btnEl) btnEl.href = newUrl;

                // Fade back in
                modelImg.style.opacity = '1';
                modelImg.style.transform = 'scale(1)';
                if (titleEl) titleEl.style.opacity = '1';
            };
        });
    });
});
</script>
