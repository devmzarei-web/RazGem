<?php
/**
 * Template Name: Contact Us Layout
 */
defined( 'ABSPATH' ) || exit;
get_header(); 

// Fetch from Customizer
$contact_phone   = get_theme_mod('contact_phone', '۰۲۱ - ۹۱۰۰XXXX');
$contact_phone_2 = get_theme_mod('contact_phone_2', '');
$contact_phone_3 = get_theme_mod('contact_phone_3', '');
$contact_email   = get_theme_mod('contact_email', 'info@razgem.ir');
$contact_address = get_theme_mod('contact_address', 'تهران، نیاوران، خیابان عمار، پلاک ۱۲، واحد ۳');
$contact_hours   = get_theme_mod('contact_hours', '۱۰ الی ۲۲');
?>

<main class="site-container utility-page" dir="rtl" role="main">
    <div class="utility-page-wrapper">
        <header class="utility-header">
            <h1 class="utility-title"><?php the_title(); ?></h1>
        </header>

        <div class="contact-grid-layout">
            
            <div class="contact-info-panel">
                <h3>اطلاعات تماس گالری رازجم</h3>
                
                <div class="utility-content-text">
                    <?php the_content(); ?>
                </div>
                
                <ul class="contact-details-list">
                    <?php if ($contact_phone) : ?>
                        <li>
                            <div class="icon-box"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></div>
                            <div class="detail-text">
                                <strong>تلفن پشتیبانی و فروش (اصلی)</strong>
                                <span><a href="tel:<?php echo esc_attr(function_exists('razgem_clean_phone') ? razgem_clean_phone($contact_phone) : $contact_phone); ?>" style="color:inherit;text-decoration:none;"><?php echo esc_html($contact_phone); ?></a></span>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if ($contact_phone_2) : ?>
                        <li>
                            <div class="icon-box"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></div>
                            <div class="detail-text">
                                <strong>تلفن پشتیبانی دوم</strong>
                                <span><a href="tel:<?php echo esc_attr(function_exists('razgem_clean_phone') ? razgem_clean_phone($contact_phone_2) : $contact_phone_2); ?>" style="color:inherit;text-decoration:none;"><?php echo esc_html($contact_phone_2); ?></a></span>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if ($contact_phone_3) : ?>
                        <li>
                            <div class="icon-box"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></div>
                            <div class="detail-text">
                                <strong>تلفن پشتیبانی سوم</strong>
                                <span><a href="tel:<?php echo esc_attr(function_exists('razgem_clean_phone') ? razgem_clean_phone($contact_phone_3) : $contact_phone_3); ?>" style="color:inherit;text-decoration:none;"><?php echo esc_html($contact_phone_3); ?></a></span>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li>
                        <div class="icon-box"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></div>
                        <div class="detail-text">
                            <strong>پست الکترونیک</strong>
                            <span><?php echo esc_html($contact_email); ?></span>
                        </div>
                    </li>
                    <?php if ($contact_address) : ?>
                        <li>
                            <div class="icon-box"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></div>
                            <div class="detail-text">
                                <strong>آدرس گالری (با تعیین وقت قبلی)</strong>
                                <span><?php echo esc_html($contact_address); ?></span>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if ($contact_hours) : ?>
                        <li>
                            <div class="icon-box"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></div>
                            <div class="detail-text">
                                <strong>ساعات پاسخگویی و کاری</strong>
                                <span><?php echo esc_html($contact_hours); ?></span>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="contact-form-panel">
                <h3>ارسال پیام مستقیم به گالری</h3>
                <form id="razgemContactForm" class="custom-contact-form">
                    <div class="form-row">
                        <div class="form-col">
                            <label>نام و نام خانوادگی <span style="color:#d35400;">*</span></label>
                            <input type="text" name="full_name" placeholder="نام خود را وارد کنید..." required>
                        </div>
                        <div class="form-col">
                            <label>شماره تماس <span style="color:#d35400;">*</span></label>
                            <input type="tel" name="phone" placeholder="۰۹۱۲..." required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="width: 100%;">
                            <label>موضوع پیام</label>
                            <input type="text" name="subject" placeholder="مثال: مشاوره خرید یا ساخت سفارشی">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="width: 100%;">
                            <label>متن پیام <span style="color:#d35400;">*</span></label>
                            <textarea name="message" rows="5" placeholder="پیام خود را اینجا بنویسید..." required></textarea>
                        </div>
                    </div>
                    
                    <div id="contactFormResponse" style="margin-bottom: 1rem; font-weight: bold; font-size: 0.95rem; text-align: center; display: none;"></div>
                    
                    <button type="submit" id="contactSubmitBtn" class="btn-primary" style="width: 100%; border: none; cursor: pointer; padding: 1.2rem; font-family: var(--font-body); font-size: 1.1rem;">ارسال پیام به گالری رازجم</button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('razgemContactForm');
    const responseDiv = document.getElementById('contactFormResponse');
    const submitBtn = document.getElementById('contactSubmitBtn');

    if(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Visual Loading State
            submitBtn.textContent = 'در حال ارسال پیام...';
            submitBtn.style.opacity = '0.7';
            submitBtn.disabled = true;
            responseDiv.style.display = 'none';

            // Gather Data
            const formData = new FormData(form);
            formData.append('action', 'submit_razgem_contact');

            // Send via AJAX
            fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                responseDiv.style.display = 'block';
                if(res.success) {
                    responseDiv.style.color = '#2b4c3f'; // Success Green
                    responseDiv.textContent = res.data;
                    form.reset(); // Clear the form
                } else {
                    responseDiv.style.color = '#d35400'; // Error Orange
                    responseDiv.textContent = res.data;
                }
            })
            .catch(err => {
                responseDiv.style.display = 'block';
                responseDiv.style.color = '#d35400';
                responseDiv.textContent = 'ارتباط با سرور برقرار نشد. لطفاً اینترنت خود را بررسی کنید.';
            })
            .finally(() => {
                // Restore Button State
                submitBtn.textContent = 'ارسال پیام';
                submitBtn.style.opacity = '1';
                submitBtn.disabled = false;
            });
        });
    }
});
</script>

<?php get_footer(); ?>