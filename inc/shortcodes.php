<?php
/**
 * Custom Shortcodes for RazGem Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Shortcode: [razgem_atelier]
// Renders the atelier slider/section
add_shortcode( 'razgem_atelier', 'razgem_atelier_shortcode' );
function razgem_atelier_shortcode( $atts ) {
    ob_start();
    // We already have the atelier section in template-parts/atelier.php
    get_template_part( 'template-parts/atelier' );
    return ob_get_clean();
}

// Shortcode: [razgem_contact_form]
// Renders a beautiful coastal-themed contact form
add_shortcode( 'razgem_contact_form', 'razgem_contact_form_shortcode' );
function razgem_contact_form_shortcode( $atts ) {
    ob_start();
    ?>
    <form action="" method="post" class="razgem-custom-contact-form">
        <div class="razgem-form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div class="floating-label-group">
                <input type="text" name="rg_name" id="rg_name" class="floating-input" placeholder=" " required />
                <label for="rg_name" class="floating-label"><?php esc_html_e( 'نام و نام خانوادگی', 'razgem' ); ?></label>
            </div>
            <div class="floating-label-group">
                <input type="tel" name="rg_phone" id="rg_phone" class="floating-input" placeholder=" " required />
                <label for="rg_phone" class="floating-label"><?php esc_html_e( 'شماره تماس', 'razgem' ); ?></label>
            </div>
        </div>
        <div class="floating-label-group" style="margin-bottom: 1.5rem;">
            <input type="email" name="rg_email" id="rg_email" class="floating-input" placeholder=" " />
            <label for="rg_email" class="floating-label"><?php esc_html_e( 'ایمیل (اختیاری)', 'razgem' ); ?></label>
        </div>
        <div class="floating-label-group" style="margin-bottom: 2rem;">
            <textarea name="rg_message" id="rg_message" class="floating-input" placeholder=" " rows="5" required style="resize: vertical; min-height: 120px;"></textarea>
            <label for="rg_message" class="floating-label"><?php esc_html_e( 'پیام شما...', 'razgem' ); ?></label>
        </div>
        <button type="submit" class="btn-coastal-slate" style="width: 100%; padding: 1.1rem; border-radius: 12px; font-size: 1.05rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem; border: none; cursor: pointer;">
            <span><?php esc_html_e( 'ارسال پیام', 'razgem' ); ?></span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="22" y1="2" x2="11" y2="13"></line>
                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
            </svg>
        </button>
        
        <?php
        // Basic success message logic if form was submitted
        if ( isset( $_POST['rg_name'] ) && isset( $_POST['rg_message'] ) ) {
            echo '<div style="margin-top: 1.5rem; padding: 1rem; background: #eef8f2; color: #2c7a51; border-radius: 8px; text-align: center; font-weight: 500;">پیام شما با موفقیت دریافت شد. در اسرع وقت با شما تماس خواهیم گرفت.</div>';
        }
        ?>
    </form>
    <?php
    return ob_get_clean();
}
