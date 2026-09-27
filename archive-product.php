<?php
/**
 * The Template for displaying product archives, including the main shop page.
 * RazGem Coastal Haute-Joaillerie Edition
 *
 * @package RazGem
 */
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

// Determine current category or filter state
$current_cat_param = isset( $_GET['category'] ) ? sanitize_text_field( wp_unslash( $_GET['category'] ) ) : 'all';
$is_on_sale_param  = ! empty( $_GET['on_sale'] );
?>

<div class="shop-coastal-hero" role="region" aria-label="سربرگ فروشگاه زیورآلات رازجم">
    <div class="site-container">
        <div class="shop-coastal-hero__content">
            <span class="shop-coastal-hero__badge">
                <span class="badge-dot"></span>
                گالری دست‌سازه‌های صدف طبیعی و مروارید باروک رازجم
            </span>
            <h1 class="shop-coastal-hero__title">
                <?php 
                if ( function_exists( 'is_product_category' ) && is_product_category() ) {
                    woocommerce_page_title();
                } else {
                    echo 'زیورآلات دست‌ساز صدف و گوهر اقیانوس';
                }
                ?>
            </h1>
            <p class="shop-coastal-hero__desc">
                هر قطعه از دل صدف‌های بکر دریا، بدون رنگ‌آمیزی شیمیایی و با هنر دست شکل گرفته است. تلاقی درخشش ارگانیک صدف، مرواریدهای باروک و اتصالات ظریف طلایی.
            </p>
        </div>
    </div>

    <!-- Continuous Living Ocean Wave Baseline Transition -->
    <div class="shop-coastal-hero__wave ocean-wave-animator ocean-wave--to-canvas" aria-hidden="true">
        <svg class="ocean-waves-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="shop-hero-gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="ocean-parallax-waves">
                <use xlink:href="#shop-hero-gentle-wave" x="48" y="0" class="wave-layer-deep" />
                <use xlink:href="#shop-hero-gentle-wave" x="48" y="3" class="wave-layer-seafoam" />
                <use xlink:href="#shop-hero-gentle-wave" x="48" y="5" class="wave-layer-sand" />
                <use xlink:href="#shop-hero-gentle-wave" x="48" y="7" class="wave-layer-canvas" />
            </g>
        </svg>
    </div>
</div>

<main class="site-container shop-archive-page" dir="rtl" role="main">
    
    <header class="shop-custom-header">
        <nav class="shop-breadcrumbs" aria-label="مسیر راهنما">
            <?php 
            if ( function_exists( 'woocommerce_breadcrumb' ) ) {
                woocommerce_breadcrumb();
            }
            ?>
        </nav>

        <!-- Category & Specimen Quick Filter Ribbon -->
        <nav class="jewelry-filter-pills" aria-label="فیلتر دسته‌بندی زیورآلات">
            <a href="<?php echo esc_url( razgem_shop_url() ); ?>" 
               class="filter-pill <?php echo ( 'all' === $current_cat_param && ! $is_on_sale_param ) ? 'active' : ''; ?>">
                همه آثار
            </a>
            
            <a href="<?php echo esc_url( add_query_arg( 'category', 'earrings', razgem_shop_url() ) ); ?>" 
               class="filter-pill <?php echo ( 'earrings' === $current_cat_param ) ? 'active' : ''; ?>">
                گوشواره صدف طبیعی (R-001 & R-002)
            </a>
            
            <a href="<?php echo esc_url( add_query_arg( 'category', 'necklaces', razgem_shop_url() ) ); ?>" 
               class="filter-pill <?php echo ( 'necklaces' === $current_cat_param ) ? 'active' : ''; ?>">
                گردنبند و چوکر صدف و مروارید
            </a>

            <a href="<?php echo esc_url( add_query_arg( 'category', 'bracelets', razgem_shop_url() ) ); ?>" 
               class="filter-pill <?php echo ( 'bracelets' === $current_cat_param ) ? 'active' : ''; ?>">
                دستبند و انگشتر صدف
            </a>

            <a href="<?php echo esc_url( add_query_arg( 'on_sale', '1', razgem_shop_url() ) ); ?>" 
               class="filter-pill filter-pill--sale <?php echo $is_on_sale_param ? 'active' : ''; ?>">
                مجموعه برگزیده و حراج
            </a>
        </nav>
        
        <?php do_action( 'woocommerce_archive_description' ); ?>
    </header>

    <div class="shop-layout-grid">
        
        <!-- Sticky Coastal Sidebar -->
        <aside class="shop-sidebar" role="complementary" aria-label="فیلترها و مشخصات گالری رازجم">
            <div class="shop-sidebar-sticky">
                
                <?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'shop-sidebar' ); ?>
                <?php else : ?>
                    
                    <!-- Coastal Categories Widget -->
                    <div class="coastal-sidebar-widget">
                        <h3 class="coastal-widget-title">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                            دسته‌بندی آثار
                        </h3>
                        <ul class="coastal-widget-list">
                            <li>
                                <a href="<?php echo esc_url( razgem_shop_url() ); ?>" class="coastal-widget-link <?php echo ( 'all' === $current_cat_param && ! $is_on_sale_param ) ? 'is-active' : ''; ?>">
                                    <span>همه زیورآلات</span>
                                    <span class="coastal-widget-count">۸ اثر</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url( add_query_arg( 'category', 'earrings', razgem_shop_url() ) ); ?>" class="coastal-widget-link <?php echo ( 'earrings' === $current_cat_param ) ? 'is-active' : ''; ?>">
                                    <span>گوشواره صدف طبیعی</span>
                                    <span class="coastal-widget-count">۴ اثر</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url( add_query_arg( 'category', 'necklaces', razgem_shop_url() ) ); ?>" class="coastal-widget-link <?php echo ( 'necklaces' === $current_cat_param ) ? 'is-active' : ''; ?>">
                                    <span>گردنبند و چوکر صدف</span>
                                    <span class="coastal-widget-count">۲ اثر</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url( add_query_arg( 'category', 'bracelets', razgem_shop_url() ) ); ?>" class="coastal-widget-link <?php echo ( 'bracelets' === $current_cat_param ) ? 'is-active' : ''; ?>">
                                    <span>دستبند و انگشتر</span>
                                    <span class="coastal-widget-count">۲ اثر</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Authenticity & Handcraft Spec Checklist -->
                    <div class="coastal-sidebar-widget">
                        <h3 class="coastal-widget-title">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            اصالت و مشخصات کارگاه
                        </h3>
                        <ul class="coastal-spec-checklist">
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>صدف طبیعی دست‌تراش بدون رنگ شیمیایی</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>اتصالات برنجی با آبکاری طلایی مقاوم</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>تک‌نسخه و تکرارناپذیر در نقوش طبیعی</span>
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>جدول ابعاد دقیق سانتیمتری هر اثر</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Trust Seal Card -->
                    <div class="coastal-trust-card">
                        <div class="coastal-trust-card__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        </div>
                        <h4>شناسنامه و بسته‌بندی هدیه</h4>
                        <p>تمامی آثار همراه با کارت اصالت صدف طبیعی و بسته‌بندی نفیس هدیه کارگاه رازجم ارسال می‌گردند.</p>
                    </div>

                <?php endif; ?>

            </div>
        </aside>

        <!-- Shop Main Product Grid -->
        <section class="shop-main-content">
            <?php
            $has_wc_products = false;

            if ( function_exists( 'woocommerce_product_loop' ) && woocommerce_product_loop() && function_exists( 'wc_get_loop_prop' ) && wc_get_loop_prop( 'total' ) ) {
                $has_wc_products = true;
            }

            if ( $has_wc_products ) :
                woocommerce_product_loop_start();

                while ( have_posts() ) {
                    the_post();
                    do_action( 'woocommerce_shop_loop' );
                    wc_get_template_part( 'content', 'product' );
                }

                woocommerce_product_loop_end();
                woocommerce_pagination();
            else :
                // Render Handcrafted Mock Catalog (R-001, R-002, etc.)
                $filter_args = array();
                if ( 'all' !== $current_cat_param ) {
                    $filter_args['category'] = $current_cat_param;
                }
                if ( $is_on_sale_param ) {
                    $filter_args['on_sale'] = true;
                }

                $catalog_items = function_exists( 'razgem_get_filtered_mock_products' ) ? razgem_get_filtered_mock_products( $filter_args ) : array();

                if ( ! empty( $catalog_items ) ) :
                    ?>
                    <div class="shop-catalog-grid" id="shopCatalogGrid">
                        <?php foreach ( $catalog_items as $item ) : ?>
                            <div class="shop-item-wrapper" 
                                 data-product-id="<?php echo esc_attr( $item['id'] ); ?>"
                                 data-product-code="<?php echo esc_attr( $item['code'] ); ?>"
                                 data-product-title="<?php echo esc_attr( $item['title'] ); ?>"
                                 data-product-dimensions="<?php echo esc_attr( $item['dimensions'] ); ?>"
                                 data-product-material="<?php echo esc_attr( $item['material'] ); ?>"
                                 data-product-color="<?php echo esc_attr( $item['color'] ); ?>"
                                 data-product-desc="<?php echo esc_attr( $item['desc'] ); ?>"
                                 data-product-price="<?php echo esc_attr( $item['price_formatted'] ); ?>"
                                 data-product-primary="<?php echo esc_url( $item['img_primary'] ); ?>"
                                 data-product-hover="<?php echo esc_url( ! empty( $item['img_hover'] ) ? $item['img_hover'] : $item['img_primary'] ); ?>">
                                <?php razgem_render_mock_product_card( $item ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p class="woocommerce-info">اثری با مشخصات انتخابی یافت نشد. لطفاً فیلترهای دیگر را انتخاب نمایید.</p>
                <?php endif; ?>

            <?php endif; ?>
        </section>

    </div>
</main>

<!-- Handcrafted Specimen Quick-View Modal -->
<div class="coastal-specimen-modal" id="specimenModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="coastal-modal-box">
        <button type="button" class="coastal-modal-close" id="modalCloseBtn" aria-label="بستن پنجره جزئیات">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        
        <div class="coastal-modal-grid">
            <div class="coastal-modal-gallery">
                <img src="" alt="" id="modalMainImg">
                <div class="coastal-modal-gallery-nav" id="modalGalleryNav">
                    <img src="" alt="نمای استودیو" class="coastal-modal-thumb is-active" id="modalThumbPrimary">
                    <img src="" alt="نمای ابعاد و مقیاس" class="coastal-modal-thumb" id="modalThumbHover">
                </div>
            </div>

            <div class="coastal-modal-details">
                <span class="coastal-modal-code" id="modalCode">کد اثر: </span>
                <h2 class="coastal-modal-title" id="modalTitle"></h2>
                <p class="coastal-modal-desc" id="modalDesc"></p>

                <table class="coastal-modal-specs-table">
                    <tbody>
                        <tr>
                            <th>ابعاد دقیق قطعه</th>
                            <td id="modalDimensions">-</td>
                        </tr>
                        <tr>
                            <th>جنس و تراش</th>
                            <td id="modalMaterial">-</td>
                        </tr>
                        <tr>
                            <th>طیف رنگی صدف</th>
                            <td id="modalColor">-</td>
                        </tr>
                        <tr>
                            <th>اصالت و ساخت</th>
                            <td>صدف طبیعی دست‌تراش، تک‌نسخه بدون تکرار</td>
                        </tr>
                    </tbody>
                </table>

                <div class="coastal-modal-price" id="modalPrice"></div>

                <div class="coastal-modal-actions">
                    <a href="#" id="modalConsultBtn" target="_blank" rel="noopener noreferrer" class="btn-coastal-slate" style="width: 100%;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        مشاوره و خرید اثر در واتس‌اپ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('specimenModal');
    const closeBtn = document.getElementById('modalCloseBtn');
    const mainImg = document.getElementById('modalMainImg');
    const thumbPrimary = document.getElementById('modalThumbPrimary');
    const thumbHover = document.getElementById('modalThumbHover');
    const codeEl = document.getElementById('modalCode');
    const titleEl = document.getElementById('modalTitle');
    const descEl = document.getElementById('modalDesc');
    const dimensionsEl = document.getElementById('modalDimensions');
    const materialEl = document.getElementById('modalMaterial');
    const colorEl = document.getElementById('modalColor');
    const priceEl = document.getElementById('modalPrice');
    const consultBtn = document.getElementById('modalConsultBtn');

    if (!modal) return;

    // Attach click triggers to product cards in shop catalog grid
    const itemWrappers = document.querySelectorAll('.shop-item-wrapper');
    itemWrappers.forEach(wrapper => {
        const link = wrapper.querySelector('.product-title a');
        const imgLink = wrapper.querySelector('.product-card__gallery a');
        const cartBtn = wrapper.querySelector('.product-card-cart-btn');

        const openHandler = function (e) {
            e.preventDefault();
            const d = wrapper.dataset;
            
            mainImg.src = d.productPrimary;
            mainImg.alt = d.productTitle;
            thumbPrimary.src = d.productPrimary;
            thumbHover.src = d.productHover;
            
            thumbPrimary.classList.add('is-active');
            thumbHover.classList.remove('is-active');

            codeEl.textContent = 'کد اثر: ' + d.productCode;
            titleEl.textContent = d.productTitle;
            descEl.textContent = d.productDesc;
            dimensionsEl.textContent = d.productDimensions;
            materialEl.textContent = d.productMaterial;
            colorEl.textContent = d.productColor;
            priceEl.textContent = d.productPrice;

            const msg = encodeURIComponent('درود، تمایل به ثبت سفارش یا استعلام موجودی اثر صدف طبیعی کد ' + d.productCode + ' (' + d.productTitle + ') دارم.');
            consultBtn.href = 'https://wa.me/989120000000?text=' + msg;

            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        };

        if (link) link.addEventListener('click', openHandler);
        if (imgLink) imgLink.addEventListener('click', openHandler);
        if (cartBtn) cartBtn.addEventListener('click', openHandler);
    });

    // Thumb Switcher
    if (thumbPrimary && thumbHover) {
        thumbPrimary.addEventListener('click', function () {
            mainImg.src = this.src;
            thumbPrimary.classList.add('is-active');
            thumbHover.classList.remove('is-active');
        });
        thumbHover.addEventListener('click', function () {
            mainImg.src = this.src;
            thumbHover.classList.add('is-active');
            thumbPrimary.classList.remove('is-active');
        });
    }

    // Close Modal
    function closeModal() {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('is-open')) {
            closeModal();
        }
    });
});
</script>

<?php get_footer( 'shop' ); ?>