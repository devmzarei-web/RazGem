<?php
/**
 * RazGem Luxury OTP Login Template
 *
 * Dedicated 100% OTP login & registration for WooCommerce customer accounts.
 * Connects directly to Melipayamak pattern service (BodyID: 574203).
 *
 * @package RazGem
 * @version 10.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_customer_login_form' );
?>

<div class="razgem-otp-page-wrapper" dir="rtl">
    <div class="razgem-otp-card">
        
        <!-- Atelier Brand Header -->
        <div class="otp-card-header">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="otp-brand-logo" aria-label="صفحه اصلی گالری رازجم">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Razgem-Logo-NoBg.png' ); ?>" alt="گالری صدف و مروارید رازجم" class="otp-logo-img">
            </a>
            <h1 class="otp-card-title"><?php esc_html_e( 'ورود یا عضویت با شماره همراه', 'razgem' ); ?></h1>
            <p class="otp-card-subtitle" id="razgemPageOtpSubtitle">
                <?php esc_html_e( 'جهت مشاهده فاکتورها، رهگیری مرسولات پستی و ثبت سفارش، شماره موبایل خود را وارد نمایید.', 'razgem' ); ?>
            </p>
        </div>

        <!-- Step 1: Phone Number Input -->
        <div class="razgem-otp-step active" id="razgemPageStepPhone">
            <div class="otp-field-group">
                <label for="razgemPagePhoneInput" class="otp-field-label">
                    <span><?php esc_html_e( 'شماره موبایل', 'razgem' ); ?></span>
                    <span class="required-star">*</span>
                </label>
                <div class="otp-phone-input-wrap">
                    <input type="tel" id="razgemPagePhoneInput" class="otp-phone-input" placeholder="۰۹۱۲۳۴۵۶۷۸۹" dir="ltr" maxlength="14" autocomplete="tel" autofocus>
                    <span class="otp-phone-prefix" dir="ltr">+۹۸</span>
                </div>
            </div>

            <button type="button" class="button razgem-otp-submit-btn" id="btnPageSendOtp">
                <span><?php esc_html_e( 'دریافت کد تایید پیامکی', 'razgem' ); ?></span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
            <div class="otp-notice-box" id="msgPagePhone"></div>
        </div>

        <!-- Step 2: 5-Digit Verification Code -->
        <div class="razgem-otp-step" id="razgemPageStepCode">
            <div class="otp-field-group">
                <div class="otp-step2-meta">
                    <label class="otp-field-label"><?php esc_html_e( 'کد ۵ رقمی تایید', 'razgem' ); ?></label>
                    <button type="button" class="btn-change-phone" id="btnPageChangePhone">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        <span><?php esc_html_e( 'ویرایش شماره', 'razgem' ); ?></span>
                    </button>
                </div>
                
                <div class="otp-digit-group" dir="ltr" id="pageDigitGroup">
                    <input type="tel" class="otp-page-digit" maxlength="1" autocomplete="one-time-code" inputmode="numeric">
                    <input type="tel" class="otp-page-digit" maxlength="1" autocomplete="off" inputmode="numeric">
                    <input type="tel" class="otp-page-digit" maxlength="1" autocomplete="off" inputmode="numeric">
                    <input type="tel" class="otp-page-digit" maxlength="1" autocomplete="off" inputmode="numeric">
                    <input type="tel" class="otp-page-digit" maxlength="1" autocomplete="off" inputmode="numeric">
                </div>
            </div>

            <button type="button" class="button razgem-otp-submit-btn" id="btnPageVerifyOtp">
                <span><?php esc_html_e( 'تایید و ورود به حساب', 'razgem' ); ?></span>
            </button>

            <div class="otp-timer-container">
                <span id="pageOtpTimerText">ارسال مجدد کد پس از <span id="pageOtpCountdown">02:00</span></span>
                <button type="button" class="otp-resend-link" id="btnPageResendOtp" style="display:none;">
                    <?php esc_html_e( 'ارسال مجدد کد تایید پیامکی', 'razgem' ); ?>
                </button>
            </div>
            <div class="otp-notice-box" id="msgPageCode"></div>
        </div>

        <!-- Trust Badges Footer -->
        <div class="otp-trust-footer">
            <div class="trust-pill">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                <span>ورود امن بدون کلمه عبور</span>
            </div>
            <div class="trust-pill">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#27ae60" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                <span>الگوی رسمی خدماتی ۵۷۴۲۰۳</span>
            </div>
        </div>

    </div>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
