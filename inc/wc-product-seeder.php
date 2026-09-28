<?php
/**
 * RazGem WooCommerce Product Seeder & Auto-Sync Engine
 *
 * Programmatically registers authentic handcrafted seashell jewelry products
 * (R-001 through R-006+) into the WordPress database as genuine WooCommerce products,
 * imports studio imagery into the WordPress Media Library, and configures attributes.
 *
 * @package RazGem
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class RazGem_WC_Product_Seeder {

    /**
     * Singleton instance.
     */
    private static $instance = null;

    /**
     * Product definitions catalog.
     */
    private $products_catalog = [];

    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->init_catalog();

        // Register admin hooks
        add_action( 'admin_init', [ $this, 'handle_manual_sync_request' ] );
        add_action( 'admin_notices', [ $this, 'render_admin_notices' ] );
        add_action( 'admin_bar_menu', [ $this, 'register_admin_bar_node' ], 99 );
        add_action( 'wp_ajax_razgem_sync_products', [ $this, 'ajax_sync_products' ] );
        
        // Auto-seed on theme activation / first load if no products exist
        add_action( 'after_switch_theme', [ $this, 'auto_seed_on_activation' ] );
        add_action( 'init', [ $this, 'maybe_auto_seed' ], 20 );
    }

    /**
     * Define the complete catalog of authentic handcrafted pieces.
     */
    private function init_catalog() {
        $this->products_catalog = [
            'r-001' => [
                'sku'         => 'RG-R001',
                'title'       => 'گوشواره صدف طبیعی با مروارید باروک',
                'slug'        => 'r-001',
                'price'       => 1850000,
                'category'    => 'گوشواره صدف',
                'cat_slug'    => 'shell-earrings',
                'tags'        => [ 'دست‌ساز', 'صدف طبیعی', 'مروارید باروک', 'کالکشن اقیانوس' ],
                'dimensions'  => '۴.۸ × ۴.۳ سانتی‌متر',
                'weight'      => '۸.۵ گرم',
                'materials'   => 'صدف طبیعی تراش‌خورده مرجانی، مروارید باروک خلیج فارس، پایه نقره ۹۲۵ با روکش طلای ۱۸ عیار',
                'origin'      => 'خلیج فارس، تراش اختصاصی آتلیه رازجم',
                'short_desc'  => 'گوشواره دست‌ساز از صدف طبیعی خلیج فارس مزین به مروارید باروک با تلألو رنگین‌کمانی و یراق زرین ضدحساسیت.',
                'content'     => 'این گوشواره نفیس حاصل ساعت‌ها کار دست هنرمندان آتلیه رازجم است. بستر صدف کاملاً طبیعی بوده و با دقت تراش خورده تا فرم ارگانیک دریا حفظ شود. در مرکز این اثر، یک قطعه مروارید باروک طبیعی درخشان قرار گرفته است. کلیه یراق‌آلات از جنس نقره استرلینگ ۹۲۵ با آبکاری طلای ۱۸ عیار و کاملاً ضدحساسیت می‌باشند. به همراه شناسنامه اصالت فیزیکی و جعبه لوکس کادویی رازجم تقدیم می‌گردد.',
                'image_file'  => 'r001-main.jpg',
                'dim_file'    => 'r001-dimensions.jpg',
            ],
            'r-002' => [
                'sku'         => 'RG-R002',
                'title'       => 'گوشواره آویز صدف زرین با قطره مروارید',
                'slug'        => 'r-002',
                'price'       => 2200000,
                'category'    => 'گوشواره صدف',
                'cat_slug'    => 'shell-earrings',
                'tags'        => [ 'دست‌ساز', 'صدف زرین', 'قطره مروارید', 'کالکشن اقیانوس' ],
                'dimensions'  => '۵.۰ × ۴.۵ سانتی‌متر',
                'weight'      => '۹.۲ گرم',
                'materials'   => 'صدف شیاردار طبیعی بادبزنی، مروارید اشکی پرورشی درجه یک، اتصالات برنجی با آبکاری طلای ۲۴ عیار',
                'origin'      => 'سواحل نیلگون جنوب، کارگاه طلاسازی رازجم',
                'short_desc'  => 'گوشواره آویز شاهکار با صدف طبیعی شیاردار بادبزنی و قطره مروارید باروک درخشان با روکش طلای ۲۴ عیار.',
                'content'     => 'طراحی الهام‌گرفته از امواج خروشان و بادبزن‌های دریایی. خطوط طبیعی و ارگانیک صدف با لایه‌ای از طلای براق محافظت شده تا درخشندگی ابدی داشته باشد. آویز مروارید اشکی در انتهای اثر حرکتی موزون و چشم‌نواز خلق می‌کند. این شاهکار نماد شکوه و اصالت زنانه است.',
                'image_file'  => 'r002-main.jpg',
                'dim_file'    => 'r002-dimensions.jpg',
            ],
            'r-003' => [
                'sku'         => 'RG-R003',
                'title'       => 'گردنبند پلاک صدف و مروارید باروک',
                'slug'        => 'r-003',
                'price'       => 2650000,
                'category'    => 'گردنبند و چوکر',
                'cat_slug'    => 'necklaces-chokers',
                'tags'        => [ 'دست‌ساز', 'گردنبند صدف', 'مروارید باروک', 'شاهکار' ],
                'dimensions'  => '۴.۲ × ۳.۸ سانتی‌متر (زنجیر ۴۵ سانتی‌متر)',
                'weight'      => '۱۱.۵ گرم',
                'materials'   => 'صدف طبیعی شیاردار، مروارید اشکی باروک، زنجیر و قاب نقره استرلینگ زرین با روکش طلای ۱۸ عیار',
                'origin'      => 'آتلیه جواهرسازی رازجم',
                'short_desc'  => 'گردنبند پلاک مجلل دست‌ساز با قاب اسکلت زرین صدف و مروارید باروک اشکی ارگانیک با زنجیر بافت ظریف.',
                'content'     => 'گردنبند پلاک صدف و مروارید باروک کد R-003 تجلی روح زنده اقیانوس بر گردن شماست. قاب برنجی و نقره با بافت طلای چکش‌خورده، صدفی درخشان و یک مروارید ارگانیک درشت را در آغوش کشیده است. زنجیر ضدحساسیت با قفل ایمن و طول استاندارد ۴۵ سانتی‌متر امکان استفاده روزمره و مجلسی را فراهم می‌کند.',
                'image_file'  => 'r003-main.jpg',
                'dim_file'    => 'r003-dimensions.jpg',
            ],
            'r-004' => [
                'sku'         => 'RG-R004',
                'title'       => 'گوشواره آویز صدف حلزونی زرین',
                'slug'        => 'r-004',
                'price'       => 1980000,
                'category'    => 'گوشواره صدف',
                'cat_slug'    => 'shell-earrings',
                'tags'        => [ 'دست‌ساز', 'صدف حلزونی', 'مروارید طبیعی', 'کالکشن اقیانوس' ],
                'dimensions'  => '۵.۲ × ۳.۵ سانتی‌متر',
                'weight'      => '۷.۸ گرم',
                'materials'   => 'صدف حلزونی ارگانیک مینیاتوری، مروارید گرد پرورشی، مفتول‌پیچی دستی با طلای ۱۸ عیار',
                'origin'      => 'سواحل هرمزگان، دست‌ساز رازجم',
                'short_desc'  => 'گوشواره آویز دو تکه با پیچ و تاب هنرمندانه صدف حلزونی و مروارید درخشان احاطه‌شده در مفتول طلایی.',
                'content'     => 'فرم حلزونی صدف نماد رشد، تکامل و آرامش بیکران دریاست. در این مدل، یک مروارید کروی در بخش بالایی با سیم‌پیچی طلایی مهار شده و صدف حلزونی نقوش‌دار در پایین به زیبایی به حرکت درمی‌آید. وزنی فوق‌العاده سبک برای استفاده در تمام طول روز بدون احساس خستگی گوش.',
                'image_file'  => 'r004-main.jpg',
                'dim_file'    => 'r004-dimensions.jpg',
            ],
            'r-005' => [
                'sku'         => 'RG-R005',
                'title'       => 'دستبند صدف کائوری و مروارید طبیعی',
                'slug'        => 'r-005',
                'price'       => 1450000,
                'category'    => 'دستبند و انگشتر',
                'cat_slug'    => 'bracelets-rings',
                'tags'        => [ 'دست‌ساز', 'صدف کائوری', 'دستبند مروارید', 'کالکشن ساحل' ],
                'dimensions'  => 'طول: ۱۸ سانتی‌متر (دارای زنجیر رگلاژ ۳ سانتی‌متری)',
                'weight'      => '۶.۴ گرم',
                'materials'   => 'صدف کائوری پولیش خورده، مرواریدهای آب شیرین نامنظم، مهره‌های طلایی برنجی مات',
                'origin'      => 'آتلیه ساحلی رازجم',
                'short_desc'  => 'دستبند ظریف بوهو-لوکس ترکیب صدف‌های مینیاتوری کائوری و مرواریدهای طبیعی نامنظم با اتصالات زرین.',
                'content'     => 'صدف‌های کائوری در تاریخ باستان به عنوان نماد برکت، ثروت و محافظت شناخته می‌شدند. در این دستبند دست‌ساز، صدف‌های منتخب با مرواریدهای طبیعی کشی و مهره‌های تراش‌خورده مات تلفیق شده‌اند تا استایلی تابستانی، شیک و سرشار از طراوت را خلق نمایند.',
                'image_file'  => 'r005-main.jpg',
                'dim_file'    => 'r005-dimensions.jpg',
            ],
            'r-006' => [
                'sku'         => 'RG-R006',
                'title'       => 'انگشتر صدف ناتیلوس و مروارید کشی',
                'slug'        => 'r-006',
                'price'       => 1680000,
                'category'    => 'دستبند و انگشتر',
                'cat_slug'    => 'bracelets-rings',
                'tags'        => [ 'دست‌ساز', 'انگشتر صدف', 'ناتیلوس', 'مروارید کشی' ],
                'dimensions'  => 'سایز قابل تنظیم (فری‌سایز)',
                'weight'      => '۷.۱ گرم',
                'materials'   => 'مقطع مینیاتوری صدف ناتیلوس با جلای هفت‌رنگ، مروارید کشی درشت، رکاب ارگانیک برنجی با آبکاری طلای ۲۴ عیار',
                'origin'      => 'آتلیه تخصصی رازجم',
                'short_desc'  => 'انگشتر بیاتومیک خیره‌کننده با مقطع صدف ناتیلوس هفت‌رنگ و مروارید پهن کشی روی رکاب چکش‌خورده باز.',
                'content'     => 'هندسه مقدس مارپیچ فیبوناچی در مقطع صدف طبیعی ناتیلوس با بازی رنگ‌های صدفی فیروزه‌ای و بنفش، در کنار یک مروارید طبیعی کشی قرار گرفته است. رکاب انگشتر به صورت دو شاخه ارگانیک و باز طراحی شده که به راحتی برای هر اندازه انگشتی قابل تنظیم است.',
                'image_file'  => 'r006-main.jpg',
                'dim_file'    => 'r006-dimensions.jpg',
            ],
            'r-007' => [
                'sku'         => 'RG-R007',
                'title'       => 'چوکر مروارید باروک و صدف مخملی دست‌ساز',
                'slug'        => 'r-007',
                'price'       => 2890000,
                'category'    => 'گردنبند و چوکر',
                'cat_slug'    => 'necklaces-chokers',
                'tags'        => [ 'دست‌ساز', 'چوکر صدف', 'مروارید باروک', 'مخمل عاجی' ],
                'dimensions'  => 'طول ۳۶ تا ۴۰ سانتی‌متر (پلاک: ۴.۰ × ۳.۵ سانتی‌متر)',
                'weight'      => '۱۴.۲ گرم',
                'materials'   => 'صدف طبیعی بادبزنی، مروارید باروک درخشان، روبان مخمل کتان عاجی، اتصالات نقره ۹۲۵ با روکش طلای ۱۸ عیار',
                'origin'      => 'آتلیه جواهرسازی رازجم',
                'short_desc'  => 'چوکر درباری نفیس با صدف بادبزنی تراش‌خورده و قطره مروارید باروک اصل روی نوار مخمل لطیف عاجی.',
                'content'     => 'شاهکار اصیل از تلفیق صدف بادبزنی طبیعی و مروارید باروک بر بستر مخمل کتان عاجی. این اثر فاخر با الهام از گردنبندهای ملوکانه قاجار و سواحل نیلگون جنوب بازآفرینی شده است. کلیه یراق‌آلات از نقره استرلینگ ۹۲۵ با آبکاری ضخیم طلای ۱۸ عیار و کاملاً ضدحساسیت می‌باشند. به همراه جعبه لوکس چوبی و شناسنامه فیزیکی ارائه می‌گردد.',
                'image_file'  => 'r007-main.jpg',
                'dim_file'    => 'r007-dimensions.jpg',
            ],
            'r-008' => [
                'sku'         => 'RG-R008',
                'title'       => 'انگشتر صدف حلزونی هفت‌رنگ مرجانی دست‌ساز',
                'slug'        => 'r-008',
                'price'       => 2150000,
                'category'    => 'دستبند و انگشتر',
                'cat_slug'    => 'bracelets-rings',
                'tags'        => [ 'دست‌ساز', 'انگشتر صدف', 'حلزونی هفت‌رنگ', 'مروارید باروک' ],
                'dimensions'  => 'ابعاد صدف: ۲.۸ × ۲.۲ سانتی‌متر (سایز قابل تنظیم)',
                'weight'      => '۷.۸ گرم',
                'materials'   => 'صدف حلزونی مینیاتوری هفت‌رنگ طبیعی، مرواریدهای باروک ریز، رکاب چکش‌خورده با روکش طلای ۱۸ عیار',
                'origin'      => 'کارگاه زرگری رازجم',
                'short_desc'  => 'انگشتر استیتمنت با صدف حلزونی مینیاتوری طبیعی و مرواریدهای باروک ریز بر رکابی ارگانیک با روکش طلای ۱۸ عیار.',
                'content'     => 'انگشتر استیتمنت مجلل که یک قطعه صدف حلزونی مینیاتوری طبیعی هفت‌رنگ را در میان حلقه‌ای از مرواریدهای باروک ریز جای داده است. تلألو رنگین‌کمانی صدف در نور خورشید تغییر رنگ می‌دهد. رکاب چکش‌خورده طلایی به صورت فری‌سایز و ارگانیک قابلیت تنظیم دقیق با سایز انگشت را داراست.',
                'image_file'  => 'r008-main.jpg',
                'dim_file'    => 'r008-dimensions.jpg',
            ],
        ];
    }

    /**
     * Check if WooCommerce is installed and active.
     */
    public function is_woocommerce_active() {
        return class_exists( 'WooCommerce' );
    }

    /**
     * Automatic seeder on theme activation.
     */
    public function auto_seed_on_activation() {
        $this->seed_all_products( false );
    }

    /**
     * Maybe auto-seed if WooCommerce is active but 0 products exist.
     */
    public function maybe_auto_seed() {
        if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
            return;
        }

        if ( ! $this->is_woocommerce_active() ) {
            return;
        }

        $seeded_flag = get_option( 'razgem_products_auto_seeded', false );
        if ( ! $seeded_flag ) {
            $product_count = wp_count_posts( 'product' );
            if ( empty( $product_count->publish ) || 0 === (int) $product_count->publish ) {
                $this->seed_all_products( false );
                update_option( 'razgem_products_auto_seeded', 1 );
            }
        }
    }

    /**
     * Handle manual sync via GET parameter.
     */
    public function handle_manual_sync_request() {
        if ( ! isset( $_GET['razgem_action'] ) || 'sync_products' !== $_GET['razgem_action'] ) {
            return;
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'دسترسی غیرمجاز.' );
        }

        check_admin_referer( 'razgem_sync_products_nonce' );

        $results = $this->seed_all_products( true );

        $redirect_url = add_query_arg(
            [
                'razgem_sync_result' => 'success',
                'synced_count'       => count( $results['created'] ) + count( $results['updated'] ),
            ],
            admin_url( 'edit.php?post_type=product' )
        );

        wp_safe_redirect( $redirect_url );
        exit;
    }

    /**
     * AJAX handler for seamless one-click sync.
     */
    public function ajax_sync_products() {
        check_ajax_referer( 'razgem_admin_nonce', 'nonce' );

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( [ 'message' => 'دسترسی غیرمجاز.' ] );
        }

        $results = $this->seed_all_products( true );
        wp_send_json_success( [
            'message' => sprintf(
                'همگام‌سازی با موفقیت انجام شد: %d محصول ایجاد و %d محصول بروزرسانی شد.',
                count( $results['created'] ),
                count( $results['updated'] )
            ),
            'results' => $results,
        ] );
    }

    /**
     * Primary Seeder Method: Seeds all catalog products into WooCommerce DB.
     *
     * @param bool $force_update If true, updates existing products.
     * @return array Summary of created and updated products.
     */
    public function seed_all_products( $force_update = false ) {
        $results = [
            'created' => [],
            'updated' => [],
            'errors'  => [],
        ];

        foreach ( $this->products_catalog as $slug => $data ) {
            $existing_id = $this->get_product_id_by_sku( $data['sku'] );
            if ( ! $existing_id ) {
                $existing_id = $this->get_product_id_by_slug( $data['slug'] );
            }

            if ( $existing_id && ! $force_update ) {
                continue;
            }

            $product_post = [
                'post_title'   => $data['title'],
                'post_name'    => $data['slug'],
                'post_content' => $data['content'],
                'post_excerpt' => $data['short_desc'],
                'post_status'  => 'publish',
                'post_type'    => 'product',
                'ping_status'  => 'closed',
            ];

            if ( $existing_id ) {
                $product_post['ID'] = $existing_id;
                $post_id = wp_update_post( $product_post );
                $is_new  = false;
            } else {
                $post_id = wp_insert_post( $product_post );
                $is_new  = true;
            }

            if ( is_wp_error( $post_id ) ) {
                $results['errors'][] = $data['title'] . ': ' . $post_id->get_error_message();
                continue;
            }

            // Set WooCommerce metadata
            update_post_meta( $post_id, '_sku', $data['sku'] );
            update_post_meta( $post_id, '_regular_price', $data['price'] );
            update_post_meta( $post_id, '_price', $data['price'] );
            update_post_meta( $post_id, '_stock_status', 'instock' );
            update_post_meta( $post_id, '_manage_stock', 'no' );
            update_post_meta( $post_id, '_visibility', 'visible' );
            update_post_meta( $post_id, '_virtual', 'no' );
            update_post_meta( $post_id, '_downloadable', 'no' );
            update_post_meta( $post_id, '_razgem_dimensions', $data['dimensions'] );
            update_post_meta( $post_id, '_razgem_materials', $data['materials'] );
            update_post_meta( $post_id, '_razgem_origin', $data['origin'] );
            update_post_meta( $post_id, '_razgem_weight', $data['weight'] );

            // Assign Category
            $this->assign_category( $post_id, $data['category'], $data['cat_slug'] );

            // Assign Tags
            if ( ! empty( $data['tags'] ) ) {
                wp_set_object_terms( $post_id, $data['tags'], 'product_tag', false );
            }

            // Attach Studio Featured Image
            $attachment_id = $this->import_product_image( $data['image_file'], $data['title'], $post_id );
            if ( $attachment_id ) {
                set_post_thumbnail( $post_id, $attachment_id );
            }

            // Attach Dimension Diagram to Gallery if available
            if ( ! empty( $data['dim_file'] ) ) {
                $dim_attach_id = $this->import_product_image( $data['dim_file'], $data['title'] . ' - راهنمای ابعاد', $post_id );
                if ( $dim_attach_id ) {
                    update_post_meta( $post_id, '_product_image_gallery', (string) $dim_attach_id );
                }
            }

            if ( $is_new ) {
                $results['created'][] = $data['title'] . " (ID: {$post_id})";
            } else {
                $results['updated'][] = $data['title'] . " (ID: {$post_id})";
            }
        }

        return $results;
    }

    /**
     * Find product post ID by SKU.
     */
    private function get_product_id_by_sku( $sku ) {
        global $wpdb;
        $id = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_sku' AND meta_value = %s LIMIT 1",
                $sku
            )
        );
        return $id ? (int) $id : 0;
    }

    /**
     * Find product post ID by slug.
     */
    private function get_product_id_by_slug( $slug ) {
        $post = get_page_by_path( $slug, OBJECT, 'product' );
        return $post ? $post->ID : 0;
    }

    /**
     * Assign category safely creating term if needed.
     */
    private function assign_category( $post_id, $cat_name, $cat_slug ) {
        $term = term_exists( $cat_name, 'product_cat' );
        if ( ! $term ) {
            $term = wp_insert_term( $cat_name, 'product_cat', [ 'slug' => $cat_slug ] );
        }

        if ( ! is_wp_error( $term ) && isset( $term['term_id'] ) ) {
            wp_set_object_terms( $post_id, [ (int) $term['term_id'] ], 'product_cat', false );
        }
    }

    /**
     * Import a local theme image into WordPress Media Library.
     */
    private function import_product_image( $filename, $title, $parent_post_id = 0 ) {
        $local_path = get_template_directory() . '/assets/images/products/' . $filename;
        if ( ! file_exists( $local_path ) ) {
            return 0;
        }

        // Check if attachment already exists with this filename
        global $wpdb;
        $existing_attach_id = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND guid LIKE %s LIMIT 1",
                '%' . $filename
            )
        );

        if ( $existing_attach_id ) {
            return (int) $existing_attach_id;
        }

        // Copy file to WordPress uploads directory
        $upload_dir = wp_upload_dir();
        $dest_filename = wp_unique_filename( $upload_dir['path'], $filename );
        $dest_file = $upload_dir['path'] . '/' . $dest_filename;

        if ( ! @copy( $local_path, $dest_file ) ) {
            return 0;
        }

        $filetype = wp_check_filetype( $dest_filename, null );

        $attachment = [
            'post_mime_type' => $filetype['type'],
            'post_title'     => sanitize_text_field( $title ),
            'post_content'   => '',
            'post_status'    => 'inherit',
            'guid'           => $upload_dir['url'] . '/' . $dest_filename,
        ];

        $attach_id = wp_insert_attachment( $attachment, $dest_file, $parent_post_id );

        if ( ! is_wp_error( $attach_id ) && $attach_id > 0 ) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $attach_data = wp_generate_attachment_metadata( $attach_id, $dest_file );
            wp_update_attachment_metadata( $attach_id, $attach_data );
            update_post_meta( $attach_id, '_wp_attachment_image_alt', $title );
            return $attach_id;
        }

        return 0;
    }

    /**
     * Add sync button to WordPress admin bar.
     */
    public function register_admin_bar_node( $admin_bar ) {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $sync_url = wp_nonce_url(
            admin_url( 'edit.php?post_type=product&razgem_action=sync_products' ),
            'razgem_sync_products_nonce'
        );

        $admin_bar->add_node( [
            'id'    => 'razgem_sync_products',
            'title' => '🦪 همگام‌سازی محصولات رازجم',
            'href'  => $sync_url,
            'meta'  => [
                'title' => 'افزودن و بروزرسانی خودکار محصولات صدف و مروارید رازجم در ووکامرس',
            ],
        ] );
    }

    /**
     * Render admin notices after manual sync.
     */
    public function render_admin_notices() {
        if ( isset( $_GET['razgem_sync_result'] ) && 'success' === $_GET['razgem_sync_result'] ) {
            $count = isset( $_GET['synced_count'] ) ? absint( $_GET['synced_count'] ) : 0;
            echo '<div class="notice notice-success is-dismissible" style="border-right-color:#D4AF37;">';
            echo '<p><strong>رازجم:</strong> ' . sprintf( 'تعداد %d محصول دست‌ساز با موفقیت در پایگاه داده ووکامرس همگام‌سازی و تصاویر آنها در کتابخانه پرونده‌های چندرسانه‌ای ثبت شدند.', $count ) . '</p>';
            echo '</div>';
        }

        if ( ! $this->is_woocommerce_active() ) {
            echo '<div class="notice notice-warning is-dismissible">';
            echo '<p><strong>هشدار رازجم:</strong> افزونه ووکامرس فعال نیست. برای فعال‌سازی سبد خرید و ثبت واقعی محصولات، لطفاً افزونه WooCommerce را از بخش افزونه‌ها فعال کنید.</p>';
            echo '</div>';
        }
    }
}

// Initialize on load
RazGem_WC_Product_Seeder::get_instance();
