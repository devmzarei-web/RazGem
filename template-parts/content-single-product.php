<?php
/**
 * RazGem Dedicated Single Product Vitrine
 * Handcrafted Seashell & Baroque Pearl Showcase
 *
 * @package RazGem
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. Resolve Product Data (Mock specimen or WooCommerce Product)
$p_data = null;
if ( ! empty( $args['mock_product'] ) ) {
    $p_data = $args['mock_product'];
} elseif ( isset( $_GET['view_product'] ) && function_exists( 'razgem_get_mock_product' ) ) {
    $p_data = razgem_get_mock_product( sanitize_text_field( wp_unslash( $_GET['view_product'] ) ) );
} elseif ( ! empty( $args['wc_product'] ) && is_a( $args['wc_product'], 'WC_Product' ) ) {
    $wc_p = $args['wc_product'];
    $main_img = wp_get_attachment_image_url( $wc_p->get_image_id(), 'full' );
    $gallery_ids = $wc_p->get_gallery_image_ids();
    $dim_img = ! empty( $gallery_ids ) ? wp_get_attachment_image_url( $gallery_ids[0], 'full' ) : $main_img;

    $p_data = array(
        'id'              => (string) $wc_p->get_id(),
        'code'            => $wc_p->get_sku() ? $wc_p->get_sku() : 'RG-' . $wc_p->get_id(),
        'title'           => $wc_p->get_name(),
        'category'        => function_exists( 'wc_get_product_category_list' ) ? wp_strip_all_tags( wc_get_product_category_list( $wc_p->get_id() ) ) : 'زیورآلات صدف طبیعی',
        'price_formatted' => $wc_p->get_price_html(),
        'old_price'       => '',
        'dimensions'      => $wc_p->get_attribute( 'pa_dimensions' ) ? $wc_p->get_attribute( 'pa_dimensions' ) : 'ابعاد اختصاصی در توضیحات',
        'material'        => $wc_p->get_attribute( 'pa_material' ) ? $wc_p->get_attribute( 'pa_material' ) : 'صدف طبیعی دست‌تراش، یراق طلایی',
        'color'           => $wc_p->get_attribute( 'pa_color' ) ? $wc_p->get_attribute( 'pa_color' ) : 'طبیعی بدون رنگ‌آمیزی شیمیایی',
        'desc'            => $wc_p->get_short_description() ? $wc_p->get_short_description() : $wc_p->get_description(),
        'img_primary'     => $main_img ? $main_img : get_template_directory_uri() . '/assets/images/products/r001-main.jpg',
        'img_hover'       => $dim_img ? $dim_img : $main_img,
        'tag'             => 'صدف طبیعی اصل',
        'badge'           => $wc_p->is_on_sale() ? 'حراج ویژه' : 'دست‌ساز',
        'in_stock'        => $wc_p->is_in_stock(),
        'wc_add_to_cart'  => $wc_p->add_to_cart_url(),
    );
}

// Fallback to R-001 if no product found
if ( ! $p_data && function_exists( 'razgem_get_mock_product' ) ) {
    $p_data = razgem_get_mock_product( 'r-001' );
}

if ( ! $p_data ) {
    echo '<div class="site-container" style="padding:4rem 1rem; text-align:center;"><p>محصول مورد نظر یافت نشد.</p></div>';
    return;
}

$wc_id = 0;
if ( ! empty( $args['wc_product'] ) && is_a( $args['wc_product'], 'WC_Product' ) ) {
    $wc_id = $args['wc_product']->get_id();
} elseif ( function_exists( 'razgem_get_wc_product_id' ) ) {
    $wc_id = razgem_get_wc_product_id( $p_data['id'] );
}

$id              = esc_attr( $p_data['id'] );
$code            = esc_html( $p_data['code'] );
$title           = esc_html( $p_data['title'] );
$category        = esc_html( $p_data['category'] );
$price_html      = ! empty( $p_data['price_formatted'] ) ? $p_data['price_formatted'] : '';
$old_price       = ! empty( $p_data['old_price'] ) ? esc_html( $p_data['old_price'] ) : '';
$dimensions      = ! empty( $p_data['dimensions'] ) ? esc_html( $p_data['dimensions'] ) : 'ابعاد در شناسنامه اثر';
$material        = ! empty( $p_data['material'] ) ? esc_html( $p_data['material'] ) : 'صدف طبیعی دست‌تراش، یراق برنجی با آبکاری طلایی';
$color           = ! empty( $p_data['color'] ) ? esc_html( $p_data['color'] ) : 'طبیعی بدون رنگ شیمیایی';
$desc            = ! empty( $p_data['desc'] ) ? esc_html( $p_data['desc'] ) : '';
$img_primary     = esc_url( $p_data['img_primary'] );
$img_dimensions  = ! empty( $p_data['img_hover'] ) ? esc_url( $p_data['img_hover'] ) : $img_primary;
$tag             = ! empty( $p_data['tag'] ) ? esc_html( $p_data['tag'] ) : 'صدف طبیعی اصل';
$badge           = ! empty( $p_data['badge'] ) ? esc_html( $p_data['badge'] ) : 'دست‌ساز';

// Prepare WhatsApp Link with Pre-filled Persian Message
$whatsapp_phone = get_theme_mod( 'contact_phone', '09120000000' );
$whatsapp_clean = preg_replace( '/[^0-9]/', '', $whatsapp_phone );
if ( strpos( $whatsapp_clean, '09' ) === 0 ) {
    $whatsapp_clean = '98' . substr( $whatsapp_clean, 1 );
}
$wa_text = "سلام، در رابطه با اثر دست‌ساز صدف کد {$code} ({$title}) سوال داشتم.";
$wa_url  = 'https://wa.me/' . $whatsapp_clean . '?text=' . rawurlencode( $wa_text );
?>

<main class="site-main single-product-vitrine site-container" role="main" dir="rtl">
    
    <!-- Coastal Breadcrumbs Navigation -->
    <nav class="coastal-breadcrumbs" aria-label="مسیر راهنما">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">خانه</a>
        <span class="sep">/</span>
        <a href="<?php echo esc_url( razgem_shop_url() ); ?>">فروشگاه زیورآلات</a>
        <span class="sep">/</span>
        <span class="current-cat"><?php echo $category; ?></span>
        <span class="sep">/</span>
        <span class="current-title"><?php echo $title; ?></span>
    </nav>

    <!-- Main Vitrine Grid (Gallery & Specimen Data) -->
    <div class="product-vitrine-grid">
        
        <!-- Gallery Column (RTL Right) -->
        <section class="product-gallery-section" aria-label="گالری تصاویر اثر دست‌ساز">
            <div class="product-main-stage pebble-surface">
                
                <!-- Main Showcase Photo -->
                <div class="stage-image-container">
                    <img id="mainProductDisplay" 
                         src="<?php echo $img_primary; ?>" 
                         data-main-src="<?php echo $img_primary; ?>"
                         data-dim-src="<?php echo $img_dimensions; ?>"
                         alt="<?php echo esc_attr( $title ); ?>" 
                         class="main-display-img">
                </div>

                <!-- Dimension / Studio Switcher Pill Button -->
                <button type="button" 
                        class="dimension-toggle-pill" 
                        id="dimensionToggleBtn" 
                        aria-pressed="false"
                        title="تغییر نما بین استودیویی و خط‌کش اندازه">
                    <svg class="pill-icon-ruler" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.3 8.7l-6-6a1 1 0 0 0-1.4 0l-11 11a1 1 0 0 0 0 1.4l6 6a1 1 0 0 0 1.4 0l11-11a1 1 0 0 0 0-1.4z"></path><path d="M14.5 4.5l2 2"></path><path d="M11.5 7.5l1 1"></path><path d="M8.5 10.5l2 2"></path><path d="M5.5 13.5l1 1"></path></svg>
                    <span id="togglePillText">مشاهده خط‌کش و ابعاد دقیق</span>
                </button>

                <!-- Authenticity Stamp Overlay -->
                <div class="coastal-auth-badge">
                    <span class="badge-dot"></span>
                    <span>تک‌نسخه ارگانیک</span>
                </div>
            </div>

            <!-- Thumbnail Selector Strip -->
            <div class="product-thumbs-strip" role="tablist" aria-label="انتخاب زاویه تصویر">
                <button type="button" 
                        class="thumb-btn is-active" 
                        data-target-src="<?php echo $img_primary; ?>"
                        data-mode="main"
                        aria-label="نمای استودیویی اصلی">
                    <img src="<?php echo $img_primary; ?>" alt="تصویر استودیویی">
                    <span class="thumb-label">نمای استودیو</span>
                </button>

                <?php if ( ! empty( $img_dimensions ) && $img_dimensions !== $img_primary ) : ?>
                    <button type="button" 
                            class="thumb-btn" 
                            data-target-src="<?php echo $img_dimensions; ?>"
                            data-mode="dimensions"
                            aria-label="نمای خط‌کش و ابعاد سانتیمتری">
                        <img src="<?php echo $img_dimensions; ?>" alt="خط‌کش ابعاد و مقیاس">
                        <span class="thumb-label">ابعاد و خط‌کش</span>
                    </button>
                <?php endif; ?>
            </div>
        </section>

        <!-- Product Summary & Action Column (RTL Left) -->
        <section class="product-summary-section" aria-label="مشخصات و سفارش اثر">
            
            <div class="product-badge-row">
                <span class="vitrine-badge vitrine-badge--nature"><?php echo $tag; ?></span>
                <span class="vitrine-badge vitrine-badge--code">کد اثر: <?php echo $code; ?></span>
                <span class="vitrine-badge vitrine-badge--artisan"><?php echo $badge; ?></span>
            </div>

            <h1 class="product-headline-title"><?php echo $title; ?></h1>

            <p class="product-lead-desc"><?php echo $desc; ?></p>

            <!-- Authentic Specification Matrix -->
            <div class="specs-matrix-card">
                <h3 class="specs-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    مشخصات فنی و گوهرشناسی اثر
                </h3>
                <table class="coastal-specs-matrix">
                    <tbody>
                        <tr>
                            <th scope="row">ابعاد سانتیمتری:</th>
                            <td><strong class="spec-highlight"><?php echo $dimensions; ?></strong></td>
                        </tr>
                        <tr>
                            <th scope="row">متریال و گوهر:</th>
                            <td><?php echo $material; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">رنگ‌آمیزی:</th>
                            <td><?php echo $color; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">سازنده و اصالت:</th>
                            <td>آتلیه دست‌ساز رازجم (تضمین صدف صد در صد طبیعی دریا)</td>
                        </tr>
                        <tr>
                            <th scope="row">بسته‌بندی:</th>
                            <td>جعبه کادویی نفیس به همراه شناسنامه اختصاصی اصالت</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Price & Availability Box -->
            <div class="product-pricing-box">
                <div class="price-wrapper">
                    <span class="price-caption">ارزش قطعه:</span>
                    <span class="price-amount"><?php echo $price_html; ?></span>
                    <?php if ( ! empty( $old_price ) ) : ?>
                        <span class="price-old"><?php echo $old_price; ?></span>
                    <?php endif; ?>
                </div>

                <div class="stock-status-pill in-stock">
                    <span class="stock-dot"></span>
                    <span>موجود در آتلیه (آماده ارسال فوری)</span>
                </div>
            </div>

            <!-- Dual Action Cluster: Add to Cart (Fly Parabolic) + WhatsApp Consultation -->
            <div class="product-action-cluster">
                <?php if ( $wc_id > 0 ) : ?>
                    <button type="button" 
                            class="btn-coastal-add-cart btn-fly-trigger razgem-ajax-add-to-cart ajax_add_to_cart" 
                            data-product_id="<?php echo esc_attr( $wc_id ); ?>"
                            data-product-id="<?php echo esc_attr( $wc_id ); ?>"
                            data-product_sku="<?php echo esc_attr( $code ); ?>"
                            data-quantity="1"
                            title="افزودن مستقیم به سبد خرید">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <span>افزودن به سبد خرید</span>
                    </button>
                <?php elseif ( ! empty( $p_data['wc_add_to_cart'] ) ) : ?>
                    <a href="<?php echo esc_url( $p_data['wc_add_to_cart'] ); ?>" 
                       class="btn-coastal-add-cart btn-fly-trigger razgem-ajax-add-to-cart ajax_add_to_cart" 
                       data-product-id="<?php echo $id; ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <span>افزودن به سبد خرید</span>
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url( function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart' ) ); ?>" 
                       class="btn-coastal-add-cart btn-fly-trigger" 
                       data-product-id="<?php echo $id; ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <span>افزودن به سبد خرید</span>
                    </a>
                <?php endif; ?>

                <a href="<?php echo esc_url( $wa_url ); ?>" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="btn-coastal-whatsapp">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    <span>مشاوره و خرید در واتس‌اپ</span>
                </a>
            </div>

            <!-- Trust Pillars Row -->
            <div class="product-trust-pillars">
                <div class="trust-pillar-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    <span>ضمانت اصالت صدف طبیعی</span>
                </div>
                <div class="trust-pillar-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    <span>ارسال رایگان و بیمه شده</span>
                </div>
                <div class="trust-pillar-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4"></path><path d="M4 6v12c0 1.1.9 2 2 2h14v-4"></path><path d="M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z"></path></svg>
                    <span>بسته‌بندی هدیه فاخر</span>
                </div>
            </div>

        </section>

    </div>

    <!-- Related Handcrafted Pieces Carousel -->
    <section class="related-seashell-section" aria-label="دست‌سازه‌های مرتبط">
        <div class="section-header section-header--flex">
            <div>
                <h2>دست‌سازه‌های دیگر گالری</h2>
                <p>تلفیق‌های دیگر صدف طبیعی، مروارید باروک و هنر دست در آتلیه رازجم</p>
            </div>
            <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="view-all-link">مشاهده همه <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg></a>
        </div>

        <div class="carousel-wrapper">
            <div class="carousel-track">
                <?php
                if ( function_exists( 'razgem_get_mock_products' ) ) {
                    $all_mocks = razgem_get_mock_products();
                    $counter = 0;
                    foreach ( $all_mocks as $mock_item ) {
                        if ( $mock_item['id'] === $p_data['id'] ) continue;
                        razgem_render_mock_product_card( $mock_item );
                        $counter++;
                        if ( $counter >= 4 ) break;
                    }
                }
                ?>
            </div>
        </div>
    </section>

</main>

<!-- Mobile Sticky Bottom Buy Bar -->
<div class="mobile-sticky-buy-bar" id="mobileStickyBuyBar" aria-label="نوار خرید سریع موبایل">
    <div class="sticky-buy-info">
        <img src="<?php echo $img_primary; ?>" alt="<?php echo esc_attr( $title ); ?>">
        <div class="sticky-buy-text">
            <h4 class="sticky-title"><?php echo $title; ?></h4>
            <div class="sticky-price"><?php echo $price_html; ?></div>
        </div>
    </div>
    <?php if ( $wc_id > 0 ) : ?>
        <button type="button" 
                class="sticky-buy-btn btn-fly-trigger razgem-ajax-add-to-cart ajax_add_to_cart" 
                data-product_id="<?php echo esc_attr( $wc_id ); ?>"
                data-product-id="<?php echo esc_attr( $wc_id ); ?>"
                data-product_sku="<?php echo esc_attr( $code ); ?>"
                data-quantity="1">
            افزودن به سبد خرید
        </button>
    <?php elseif ( ! empty( $p_data['wc_add_to_cart'] ) ) : ?>
        <a href="<?php echo esc_url( $p_data['wc_add_to_cart'] ); ?>" class="sticky-buy-btn btn-fly-trigger razgem-ajax-add-to-cart ajax_add_to_cart" data-product-id="<?php echo $id; ?>" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">
            افزودن به سبد خرید
        </a>
    <?php else : ?>
        <a href="<?php echo esc_url( function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart' ) ); ?>" class="sticky-buy-btn btn-fly-trigger" data-product-id="<?php echo $id; ?>" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">
            افزودن به سبد خرید
        </a>
    <?php endif; ?>
</div>

<!-- Interactive Switcher Script (Studio Photo vs Dimension Diagram) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const mainImg = document.getElementById('mainProductDisplay');
    const toggleBtn = document.getElementById('dimensionToggleBtn');
    const toggleText = document.getElementById('togglePillText');
    const thumbButtons = document.querySelectorAll('.product-thumbs-strip .thumb-btn');

    if (!mainImg || !toggleBtn) return;

    const mainSrc = mainImg.getAttribute('data-main-src');
    const dimSrc = mainImg.getAttribute('data-dim-src');
    let isShowingDimensions = false;

    function setDisplayImage(src, isDim) {
        mainImg.style.opacity = '0.4';
        setTimeout(() => {
            mainImg.src = src;
            mainImg.style.opacity = '1';
        }, 150);

        isShowingDimensions = isDim;
        toggleBtn.setAttribute('aria-pressed', isDim ? 'true' : 'false');
        
        if (toggleText) {
            toggleText.textContent = isDim ? 'مشاهده تصویر استودیویی' : 'مشاهده خط‌کش و ابعاد دقیق';
        }

        thumbButtons.forEach(btn => {
            const mode = btn.getAttribute('data-mode');
            if ((isDim && mode === 'dimensions') || (!isDim && mode === 'main')) {
                btn.classList.add('is-active');
            } else {
                btn.classList.remove('is-active');
            }
        });
    }

    toggleBtn.addEventListener('click', function () {
        if (!dimSrc || dimSrc === mainSrc) return;
        setDisplayImage(isShowingDimensions ? mainSrc : dimSrc, !isShowingDimensions);
    });

    thumbButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const targetSrc = this.getAttribute('data-target-src');
            const mode = this.getAttribute('data-mode');
            if (targetSrc) {
                setDisplayImage(targetSrc, mode === 'dimensions');
            }
        });
    });
});
</script>
