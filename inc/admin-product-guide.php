<?php
/**
 * RazGem Admin Product Creation & Management Documentation Guide
 *
 * Provides a beautifully formatted in-dashboard Persian guide for adding,
 * editing, and organizing handcrafted jewelry products in WooCommerce.
 *
 * @package RazGem
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class RazGem_Admin_Product_Guide {

    public static function init() {
        add_action( 'admin_menu', [ __CLASS__, 'register_admin_subpage' ] );
    }

    public static function register_admin_subpage() {
        add_submenu_page(
            'edit.php?post_type=product',
            'راهنمای درج محصولات رازجم',
            '📖 راهنمای محصولات رازجم',
            'manage_options',
            'razgem-product-guide',
            [ __CLASS__, 'render_guide_page' ]
        );
    }

    public static function render_guide_page() {
        $sync_nonce_url = wp_nonce_url(
            admin_url( 'admin.php?razgem_action=sync_products' ),
            'razgem_sync_products_nonce'
        );
        ?>
        <div class="wrap razgem-guide-wrap" style="max-width: 1080px; font-family: Tahoma, 'IranYekanX', sans-serif; direction: rtl; margin-top: 20px;">
            <div style="background: linear-gradient(135deg, #1B3347 0%, #2F597A 100%); color: #FAF8F5; padding: 2.2rem; border-radius: 16px; box-shadow: 0 10px 30px rgba(27,51,71,0.15); margin-bottom: 2rem;">
                <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1.5rem;">
                    <div>
                        <h1 style="color: #FAF8F5; font-size: 1.8rem; margin: 0 0 0.5rem 0; font-weight: 800;">
                            ✨ راهنمای جامع درج و مدیریت محصولات دست‌ساز رازجم
                        </h1>
                        <p style="color: #F3E3D0; font-size: 1rem; margin: 0; line-height: 1.7;">
                            استانداردهای ثبت محصولات صدف طبیعی، مرواریدهای باروک و جواهرات ارگانیک در ووکامرس
                        </p>
                    </div>
                    <div>
                        <a href="<?php echo esc_url( $sync_nonce_url ); ?>" class="button button-primary button-hero" style="background: #D4AF37; border-color: #B5952F; color: #1B3347; font-weight: bold; border-radius: 8px; box-shadow: 0 4px 15px rgba(212,175,55,0.4);">
                            🦪 همگام‌سازی خودکار و ساخت محصولات آماده (R-001 تا R-006)
                        </a>
                    </div>
                </div>
            </div>

            <!-- Steps Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                
                <!-- Card 1: Title & Category -->
                <div style="background: #FFFFFF; border: 1px solid #E5E7EB; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div style="display:flex; align-items:center; gap:0.6rem; margin-bottom:1rem;">
                        <span style="background:#EAF3F7; color:#2F597A; width:34px; height:34px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-weight:bold;">۱</span>
                        <h2 style="font-size: 1.15rem; margin: 0; color: #1B3347;">عنوان و دسته‌بندی اثر</h2>
                    </div>
                    <ul style="line-height: 1.8; color: #4B5563; font-size: 0.92rem; padding-right: 1.2rem;">
                        <li><strong>عنوان محصول:</strong> از نام‌های شاعرانه و اصیل به همراه کد استفاده کنید؛ مثال: <code>گوشواره صدف طبیعی با مروارید باروک کد R-001</code></li>
                        <li><strong>نامک (Slug):</strong> حتماً انگلیسی و کوتاه با کد اثر باشد؛ مثال: <code>r-001</code> یا <code>baroque-seashell-earrings</code></li>
                        <li><strong>دسته‌بندی‌های رسمی:</strong>
                            <br>• گوشواره صدف (<code>shell-earrings</code>)
                            <br>• گردنبند و چوکر (<code>necklaces-chokers</code>)
                            <br>• دستبند و انگشتر (<code>bracelets-rings</code>)
                        </li>
                    </ul>
                </div>

                <!-- Card 2: Pricing & SKU -->
                <div style="background: #FFFFFF; border: 1px solid #E5E7EB; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div style="display:flex; align-items:center; gap:0.6rem; margin-bottom:1rem;">
                        <span style="background:#FBF8F2; color:#B5952F; width:34px; height:34px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-weight:bold;">۲</span>
                        <h2 style="font-size: 1.15rem; margin: 0; color: #1B3347;">قیمت، شناسه (SKU) و موجودی</h2>
                    </div>
                    <ul style="line-height: 1.8; color: #4B5563; font-size: 0.92rem; padding-right: 1.2rem;">
                        <li><strong>شناسه محصول (SKU):</strong> با پیشوند <code>RG-</code> و شماره اثر درج شود؛ مثال: <code>RG-R001</code></li>
                        <li><strong>قیمت عادی:</strong> عدد به تومان وارد شود؛ مثال: برای ۱ میلیون و ۸۵۰ هزار تومان عدد <code>1850000</code> را وارد کنید.</li>
                        <li><strong>وضعیت انبار:</strong> بر روی <code>موجود در انبار</code> (In Stock) تنظیم باشد.</li>
                    </ul>
                </div>

                <!-- Card 3: Dimensions & Custom Fields -->
                <div style="background: #FFFFFF; border: 1px solid #E5E7EB; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div style="display:flex; align-items:center; gap:0.6rem; margin-bottom:1rem;">
                        <span style="background:#EAF3F7; color:#2F597A; width:34px; height:34px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-weight:bold;">۳</span>
                        <h2 style="font-size: 1.15rem; margin: 0; color: #1B3347;">ابعاد و فیلدهای اختصاصی رازجم</h2>
                    </div>
                    <ul style="line-height: 1.8; color: #4B5563; font-size: 0.92rem; padding-right: 1.2rem;">
                        <li>قالب رازجم فیلدهای اختصاصی زیر را در صفحه تک‌محصول به صورت ویترین لوکس نمایش می‌دهد:
                            <br>• <strong>ابعاد (Dimensions):</strong> به سانتی‌متر؛ مثال: <code>۴.۸ × ۴.۳ سانتی‌متر</code> (ذخیره در زمینه دلخواه <code>_razgem_dimensions</code>)
                            <br>• <strong>متریال:</strong> <code>صدف طبیعی، مروارید باروک، نقره ۹۲۵ با روکش طلای ۱۸ عیار</code> (در <code>_razgem_materials</code>)
                            <br>• <strong>وزن تقریبی:</strong> مثال: <code>۸.۵ گرم</code> (در <code>_razgem_weight</code>)
                        </li>
                    </ul>
                </div>

                <!-- Card 4: Photography Guidelines -->
                <div style="background: #FFFFFF; border: 1px solid #E5E7EB; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div style="display:flex; align-items:center; gap:0.6rem; margin-bottom:1rem;">
                        <span style="background:#FBF8F2; color:#B5952F; width:34px; height:34px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-weight:bold;">۴</span>
                        <h2 style="font-size: 1.15rem; margin: 0; color: #1B3347;">استاندارد عکاسی و تصویر شاخص</h2>
                    </div>
                    <ul style="line-height: 1.8; color: #4B5563; font-size: 0.92rem; padding-right: 1.2rem;">
                        <li><strong>تصویر شاخص (Featured Image):</strong> عکس استودیویی شفاف روی پس‌زمینه کتان عاجی یا ماسه‌ای با نور طبیعی ملایم (ابعاد ۱:۱ مربعی ترجیحاً ۱۰۰۰×۱۰۰۰ پیکسل).</li>
                        <li><strong>گالری محصول (Product Gallery):</strong> تصویر دوم شامل دیاگرام اندازه‌گیری با خط‌کش یا ابعاد سانتی‌متری باشد. این تصویر در دکمه سوئیچ ابعاد ویترین ظاهر می‌شود.</li>
                        <li><strong>متن جایگزین (Alt):</strong> حتماً حاوی نام کامل اثر و اصالت صدف و مروارید برای سئو گوگل باشد.</li>
                    </ul>
                </div>

            </div>

            <!-- Ready-to-use Table Reference -->
            <div style="background:#FFFFFF; border:1px solid #E5E7EB; border-radius:12px; padding:1.8rem; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                <h3 style="margin-top:0; color:#1B3347; font-size:1.2rem; border-bottom:2px solid #FAF6F0; padding-bottom:0.7rem;">
                    💎 مشخصات آثار رسمی آتلیه رازجم (جهت ثبت سریع یا بررسی)
                </h3>
                <table class="widefat striped" style="margin-top:1rem; border-radius:8px; overflow:hidden;">
                    <thead>
                        <tr style="background:#FAF8F5;">
                            <th style="padding:10px;">کد (SKU)</th>
                            <th style="padding:10px;">عنوان فارسی</th>
                            <th style="padding:10px;">دسته‌بندی</th>
                            <th style="padding:10px;">ابعاد</th>
                            <th style="padding:10px;">قیمت (تومان)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>RG-R001</code></td>
                            <td><strong>گوشواره صدف طبیعی با مروارید باروک</strong></td>
                            <td>گوشواره صدف</td>
                            <td>۴.۸ × ۴.۳ سانتی‌متر</td>
                            <td>۱,۸۵۰,۰۰۰</td>
                        </tr>
                        <tr>
                            <td><code>RG-R002</code></td>
                            <td><strong>گوشواره آویز صدف زرین با قطره مروارید</strong></td>
                            <td>گوشواره صدف</td>
                            <td>۵.۰ × ۴.۵ سانتی‌متر</td>
                            <td>۲,۲۰۰,۰۰۰</td>
                        </tr>
                        <tr>
                            <td><code>RG-R003</code></td>
                            <td><strong>گردنبند پلاک صدف و مروارید باروک</strong></td>
                            <td>گردنبند و چوکر</td>
                            <td>۴.۲ × ۳.۸ سانتی‌متر</td>
                            <td>۲,۶۵۰,۰۰۰</td>
                        </tr>
                        <tr>
                            <td><code>RG-R004</code></td>
                            <td><strong>گوشواره آویز صدف حلزونی زرین</strong></td>
                            <td>گوشواره صدف</td>
                            <td>۵.۲ × ۳.۵ سانتی‌متر</td>
                            <td>۱,۹۸۰,۰۰۰</td>
                        </tr>
                        <tr>
                            <td><code>RG-R005</code></td>
                            <td><strong>دستبند صدف کائوری و مروارید طبیعی</strong></td>
                            <td>دستبند و انگشتر</td>
                            <td>طول: ۱۸ سانتی‌متر</td>
                            <td>۱,۴۵۰,۰۰۰</td>
                        </tr>
                        <tr>
                            <td><code>RG-R006</code></td>
                            <td><strong>انگشتر صدف ناتیلوس و مروارید کشی</strong></td>
                            <td>دستبند و انگشتر</td>
                            <td>فری‌سایز قابل تنظیم</td>
                            <td>۱,۶۸۰,۰۰۰</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
}

RazGem_Admin_Product_Guide::init();
