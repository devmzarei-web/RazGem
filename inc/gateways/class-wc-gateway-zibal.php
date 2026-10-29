<?php
/**
 * RazGem - Zibal Payment Gateway Integration for WooCommerce
 *
 * Fully integrated Zibal gateway class supporting automated merchant code injection,
 * dual-endpoint fallback (zibal.ir / zibal.io), IPv4 resolution, and Toman/Rial conversions.
 *
 * @package RazGem
 */

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'WC_Payment_Gateway' ) && ! class_exists( 'WC_Gateway_Zibal' ) ) {

    class WC_Gateway_Zibal extends WC_Payment_Gateway {

        private $pin;
        private $sandbox;
        private $success_massage;
        private $failed_massage;
        private $author;

        public function __construct() {
            $this->author             = 'zibal.ir';
            $this->id                 = 'WC_Gateway_Zibal';
            $this->method_title       = __( 'درگاه پرداخت زیبال', 'razgem' );
            $this->method_description = __( 'تنظیمات درگاه پرداخت زیبال برای پرداخت امن سفارش‌ها از طریق کلیه کارت‌های عضو شتاب', 'razgem' );

            $logo_url = get_template_directory_uri() . '/assets/images/zibal-logo.png';
            $this->icon = apply_filters( 'woo_zibal_logo', $logo_url );
            $this->has_fields = false;

            $this->init_form_fields();
            $this->init_settings();

            $this->title       = ! empty( $this->settings['title'] ) ? $this->settings['title'] : __( 'پرداخت امن اینترنتی زیبال (کارت‌های شتاب)', 'razgem' );
            $this->description = ! empty( $this->settings['description'] ) ? $this->settings['description'] : __( 'پرداخت امن و سریع با کلیه کارت‌های عضو شبکه شتاب از طریق درگاه رسمی زیبال', 'razgem' );

            // Default merchant code provided for RazGem
            $default_merchant = '6adb6b3f4caaab4eb0a91751';
            $this->pin        = ! empty( $this->settings['pin'] ) ? trim( $this->settings['pin'] ) : $default_merchant;
            $this->sandbox    = ! empty( $this->settings['sandbox'] ) ? $this->settings['sandbox'] : 'no';

            $this->success_massage = ! empty( $this->settings['success_massage'] ) ? $this->settings['success_massage'] : __( 'با تشکر از سفارش شما. پرداخت شما با موفقیت انجام شد. کد پیگیری: {transaction_id}', 'razgem' );
            $this->failed_massage  = ! empty( $this->settings['failed_massage'] ) ? $this->settings['failed_massage'] : __( 'پرداخت شما ناموفق بوده است یا لغو شد. در صورت کسر وجه، حداکثر ظرف ۷۲ ساعت توسط بانک بازگردانده می‌شود. کد خطا: {fault}', 'razgem' );

            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
            add_action( 'woocommerce_receipt_' . $this->id, array( $this, 'Send_to_zibal_Gateway' ) );
            add_action( 'woocommerce_api_' . strtolower( get_class( $this ) ), array( $this, 'Return_from_zibal_Gateway' ) );
            add_action( 'woocommerce_api_wc_gateway_zibal', array( $this, 'Return_from_zibal_Gateway' ) );

            if ( is_admin() && 'yes' === $this->sandbox ) {
                add_action( 'admin_bar_menu', array( $this, 'add_sandbox_notice_to_admin_bar' ), 100 );
            }
        }

        public function admin_options() {
            parent::admin_options();
        }

        public function init_form_fields() {
            $this->form_fields = apply_filters(
                'WC_Gateway_Zibal_Config',
                array(
                    'base_config'     => array(
                        'title'       => __( 'تنظیمات پایه‌ای درگاه', 'razgem' ),
                        'type'        => 'title',
                        'description' => '',
                    ),
                    'enabled'         => array(
                        'title'       => __( 'فعالسازی / غیرفعالسازی', 'razgem' ),
                        'type'        => 'checkbox',
                        'label'       => __( 'فعالسازی درگاه پرداخت زیبال', 'razgem' ),
                        'description' => __( 'برای نمایش درگاه زیبال در صفحه تسویه حساب این گزینه را فعال کنید.', 'razgem' ),
                        'default'     => 'yes',
                        'desc_tip'    => true,
                    ),
                    'title'           => array(
                        'title'       => __( 'عنوان درگاه', 'razgem' ),
                        'type'        => 'text',
                        'description' => __( 'عنوانی که خریدار در صفحه تسویه حساب مشاهده می‌کند.', 'razgem' ),
                        'default'     => __( 'پرداخت امن اینترنتی زیبال (کارت‌های شتاب)', 'razgem' ),
                        'desc_tip'    => true,
                    ),
                    'description'     => array(
                        'title'       => __( 'توضیحات درگاه', 'razgem' ),
                        'type'        => 'text',
                        'description' => __( 'توضیحاتی که زیر عنوان درگاه به خریدار نمایش داده می‌شود.', 'razgem' ),
                        'default'     => __( 'پرداخت امن و سریع با کلیه کارت‌های عضو شبکه شتاب از طریق درگاه رسمی زیبال', 'razgem' ),
                        'desc_tip'    => true,
                    ),
                    'account_config'  => array(
                        'title'       => __( 'تنظیمات حساب کاربری زیبال', 'razgem' ),
                        'type'        => 'title',
                        'description' => '',
                    ),
                    'pin'             => array(
                        'title'       => __( 'کد درگاه (Merchant Code)', 'razgem' ),
                        'type'        => 'text',
                        'description' => __( 'مرچنت کد دریافتی از پنل پذیرندگان زیبال (Zibal Merchant ID).', 'razgem' ),
                        'default'     => '6adb6b3f4caaab4eb0a91751',
                        'desc_tip'    => true,
                    ),
                    'sandbox'         => array(
                        'title'       => __( 'حالت آزمایشی (سندباکس)', 'razgem' ),
                        'type'        => 'checkbox',
                        'label'       => __( 'فعالسازی محیط تست زیبال', 'razgem' ),
                        'description' => __( 'تنها برای بررسی‌های برنامه‌نویسی فعال شود. در حالت عادی غیرفعال باشد.', 'razgem' ),
                        'default'     => 'no',
                        'desc_tip'    => true,
                    ),
                    'payment_config'  => array(
                        'title'       => __( 'پیام‌های پرداخت', 'razgem' ),
                        'type'        => 'title',
                        'description' => '',
                    ),
                    'success_massage' => array(
                        'title'       => __( 'پیام پرداخت موفق', 'razgem' ),
                        'type'        => 'textarea',
                        'description' => __( 'پیام نمایش داده شده پس از بازگشت موفق از بانک. شورت‌کد: {transaction_id}', 'razgem' ),
                        'default'     => __( 'با تشکر از شما. سفارش شما با موفقیت پرداخت شد. کد پیگیری: {transaction_id}', 'razgem' ),
                    ),
                    'failed_massage'  => array(
                        'title'       => __( 'پیام پرداخت ناموفق', 'razgem' ),
                        'type'        => 'textarea',
                        'description' => __( 'پیام نمایش داده شده پس از تراکنش ناموفق یا انصراف کاربر. شورت‌کد: {fault}', 'razgem' ),
                        'default'     => __( 'پرداخت شما ناموفق بوده است یا لغو شد. در صورت کسر وجه از حساب، ظرف ۷۲ ساعت توسط بانک بازگردانده می‌شود. کد خطا: {fault}', 'razgem' ),
                    ),
                )
            );
        }

        public function process_payment( $order_id ) {
            $order = wc_get_order( $order_id );
            return array(
                'result'   => 'success',
                'redirect' => $order->get_checkout_payment_url( true ),
            );
        }

        private function silent_curl_with_fallback( $primary_url, $secondary_url, $data ) {
            $payload = wp_json_encode( $data );

            $exec = function( $url ) use ( $payload ) {
                if ( ! extension_loaded( 'curl' ) ) {
                    return false;
                }
                $ch = curl_init( $url );
                curl_setopt_array(
                    $ch,
                    array(
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST           => true,
                        CURLOPT_POSTFIELDS     => $payload,
                        CURLOPT_HTTPHEADER     => array(
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen( $payload ),
                        ),
                        CURLOPT_IPRESOLVE      => defined( 'CURL_IPRESOLVE_V4' ) ? CURL_IPRESOLVE_V4 : 1,
                        CURLOPT_CONNECTTIMEOUT => 7,
                        CURLOPT_TIMEOUT        => 15,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => false,
                    )
                );

                $response  = curl_exec( $ch );
                $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
                $error     = curl_errno( $ch );
                curl_close( $ch );

                if ( $error || ! $response || 200 !== $http_code ) {
                    return false;
                }

                $json_check = json_decode( $response );
                if ( null === $json_check && JSON_ERROR_NONE !== json_last_error() ) {
                    return false;
                }

                return $response;
            };

            $result = $exec( $primary_url );
            if ( false === $result && ! empty( $secondary_url ) ) {
                $result = $exec( $secondary_url );
            }

            return $result;
        }

        private function redirect_to_gateway_with_fallback( $trackId ) {
            $payment_urls = array(
                sprintf( 'https://gateway.zibal.ir/start/%s', rawurlencode( $trackId ) ),
                sprintf( 'https://gateway.zibal.io/start/%s', rawurlencode( $trackId ) ),
            );

            // Directly redirect to primary portal
            wp_redirect( $payment_urls[0] );
            exit;
        }

        public function Send_to_zibal_Gateway( $order_id ) {
            global $woocommerce;
            $order = wc_get_order( $order_id );
            if ( ! $order ) {
                return;
            }

            if ( ! extension_loaded( 'curl' ) ) {
                $order->add_order_note( __( 'خطا: ماژول cURL بر روی وب‌سرور هاست فعال نیست.', 'razgem' ) );
                wc_add_notice( __( 'خطا در برقراری ارتباط با بانک: ماژول cURL فعال نیست.', 'razgem' ), 'error' );
                return;
            }

            $currency = $order->get_currency();
            $currency = apply_filters( 'WC_Gateway_Zibal_Currency', $currency, $order_id );

            $amount = intval( $order->get_total() );
            $amount = apply_filters( 'woocommerce_order_amount_total_IRANIAN_gateways_before_check_currency', $amount, $currency );

            $lower_currency = strtolower( (string) $currency );
            $toman_currencies = array( 'irt', 'toman', 'iran toman', 'iranian toman', 'iran-toman', 'iranian-toman', 'iran_toman', 'iranian_toman', 'تومان', 'تومان ایران' );

            if ( in_array( $lower_currency, $toman_currencies, true ) ) {
                $amount = $amount * 10;
            } elseif ( 'irht' === $lower_currency ) {
                $amount = $amount * 10000;
            } elseif ( 'irhr' === $lower_currency ) {
                $amount = $amount * 1000;
            }

            $amount = apply_filters( 'woocommerce_order_amount_total_IRANIAN_gateways_after_check_currency', $amount, $currency );
            $amount = apply_filters( 'woocommerce_order_amount_total_Zibal_gateway', $amount, $currency );

            $products_list = array();
            foreach ( $order->get_items() as $item ) {
                $products_list[] = $item->get_name() . ' (' . $item->get_quantity() . ')';
            }
            $products_summary = ! empty( $products_list ) ? implode( ' - ', $products_list ) : 'سفارش آنلاین گالری رازجم';

            $customer_name = trim( $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() );
            $description   = sprintf( 'سفارش #%s | مشتری: %s | اقلام: %s', $order_id, $customer_name, $products_summary );
            $phone         = preg_replace( '/[^0-9]/', '', (string) $order->get_billing_phone() );
            $email         = sanitize_email( $order->get_billing_email() );

            $callback_url = add_query_arg(
                array(
                    'wc_order' => $order_id,
                ),
                WC()->api_request_url( 'WC_Gateway_Zibal' )
            );

            $merchant_id = ( 'yes' === $this->sandbox ) ? 'zibal' : ( ! empty( $this->pin ) ? $this->pin : '6adb6b3f4caaab4eb0a91751' );

            $primary_url   = 'https://gateway.zibal.ir/v1/request';
            $secondary_url = 'https://gateway.zibal.io/v1/request';

            $payload = array(
                'merchant'    => $merchant_id,
                'amount'      => (int) $amount,
                'callbackUrl' => $callback_url,
                'orderId'     => (string) $order_id,
                'mobile'      => $phone,
                'email'       => $email,
                'description' => mb_substr( $description, 0, 250, 'UTF-8' ),
            );

            $response = $this->silent_curl_with_fallback( $primary_url, $secondary_url, $payload );
            $result   = $response ? json_decode( $response ) : false;

            if ( ! $result ) {
                $error_msg = __( 'خطا در ارتباط امن با درگاه شاپرک/زیبال.', 'razgem' );
                $fault     = 'cURL Error';
            } elseif ( isset( $result->result ) && 100 === (int) $result->result && ! empty( $result->trackId ) ) {
                // Save Track ID before redirect
                update_post_meta( $order_id, '_zibal_track_id', sanitize_text_field( $result->trackId ) );
                $this->redirect_to_gateway_with_fallback( $result->trackId );
                return;
            } else {
                $result_code = isset( $result->result ) ? $result->result : 'نامشخص';
                $error_msg   = sprintf( __( 'تراکنش ناموفق بود - کد خطا درگاه زیبال: %s', 'razgem' ), $result_code );
                $fault       = $result_code;
            }

            if ( ! empty( $error_msg ) ) {
                $order->add_order_note( sprintf( __( 'خطا در ارسال سفارش به بانک: %s', 'razgem' ), $error_msg ) );
                wc_add_notice( $error_msg, 'error' );
            }
        }

        public function Return_from_zibal_Gateway() {
            global $woocommerce;

            $success         = isset( $_GET['success'] ) ? sanitize_text_field( wp_unslash( $_GET['success'] ) ) : '';
            $trackId         = isset( $_GET['trackId'] ) ? sanitize_text_field( wp_unslash( $_GET['trackId'] ) ) : '';
            $tracking_number = isset( $_POST['tracking_number'] ) ? sanitize_text_field( wp_unslash( $_POST['tracking_number'] ) ) : '';
            $card_number     = isset( $_POST['cardnumber'] ) ? sanitize_text_field( wp_unslash( $_POST['cardnumber'] ) ) : '';

            $order_id = isset( $_GET['wc_order'] ) ? absint( $_GET['wc_order'] ) : 0;
            if ( ! $order_id && ! empty( $trackId ) ) {
                // Failsafe lookup by meta
                $found_orders = wc_get_orders( array(
                    'meta_key'   => '_zibal_track_id',
                    'meta_value' => $trackId,
                    'limit'      => 1,
                ) );
                if ( ! empty( $found_orders ) ) {
                    $order_id = $found_orders[0]->get_id();
                }
            }

            if ( ! $order_id ) {
                wc_add_notice( __( 'سفارش مورد نظر جهت بازگشت از بانک یافت نشد.', 'razgem' ), 'error' );
                wp_safe_redirect( wc_get_checkout_url() );
                exit;
            }

            $order = wc_get_order( $order_id );
            if ( ! $order ) {
                wc_add_notice( __( 'خطا در بازیابی اطلاعات سفارش.', 'razgem' ), 'error' );
                wp_safe_redirect( wc_get_checkout_url() );
                exit;
            }

            $currency = $order->get_currency();
            $currency = apply_filters( 'WC_Gateway_Zibal_Currency', $currency, $order_id );

            $amount = intval( $order->get_total() );
            $amount = apply_filters( 'woocommerce_order_amount_total_IRANIAN_gateways_before_check_currency', $amount, $currency );

            $lower_currency   = strtolower( (string) $currency );
            $toman_currencies = array( 'irt', 'toman', 'iran toman', 'iranian toman', 'iran-toman', 'iranian-toman', 'iran_toman', 'iranian_toman', 'تومان', 'تومان ایران' );

            if ( in_array( $lower_currency, $toman_currencies, true ) ) {
                $amount = $amount * 10;
            } elseif ( 'irht' === $lower_currency ) {
                $amount = $amount * 10000;
            } elseif ( 'irhr' === $lower_currency ) {
                $amount = $amount * 1000;
            }

            $amount      = apply_filters( 'woocommerce_order_amount_total_IRANIAN_gateways_after_check_currency', $amount, $currency );
            $merchant_id = ( 'yes' === $this->sandbox ) ? 'zibal' : ( ! empty( $this->pin ) ? $this->pin : '6adb6b3f4caaab4eb0a91751' );

            if ( ! $order->is_paid() ) {
                if ( '1' === $success && ! empty( $trackId ) ) {
                    $primary_url   = 'https://gateway.zibal.ir/v1/verify';
                    $secondary_url = 'https://gateway.zibal.io/v1/verify';

                    $verify_payload = array(
                        'merchant' => $merchant_id,
                        'trackId'  => (string) $trackId,
                    );

                    $response = $this->silent_curl_with_fallback( $primary_url, $secondary_url, $verify_payload );
                    $result   = $response ? json_decode( $response ) : false;

                    if ( ! $result ) {
                        $status  = 'failed';
                        $message = __( 'خطا در تأییدیه تراکنش از سرور بانک زیبال.', 'razgem' );
                    } elseif ( isset( $result->result ) && 100 === (int) $result->result && (int) $result->amount === (int) $amount ) {
                        $status         = 'completed';
                        $transaction_id = $trackId;
                        $verify_cardnum = ! empty( $result->cardNumber ) ? sanitize_text_field( $result->cardNumber ) : $card_number;
                        $verify_track   = ! empty( $result->refNumber ) ? sanitize_text_field( $result->refNumber ) : $tracking_number;
                    } elseif ( isset( $result->result ) && 201 === (int) $result->result ) {
                        // Already verified
                        wp_safe_redirect( add_query_arg( 'wc_status', 'success', $this->get_return_url( $order ) ) );
                        exit;
                    } else {
                        $status  = 'failed';
                        $fault   = isset( $result->result ) ? $result->result : 'نامشخص';
                        $message = sprintf( __( 'تراکنش ناموفق بود - کد خطا: %s', 'razgem' ), $fault );
                    }
                } else {
                    $status  = 'failed';
                    $message = __( 'پرداخت توسط کاربر لغو شد یا انجام نپذیرفت.', 'razgem' );
                }

                if ( 'completed' === $status && ! empty( $transaction_id ) ) {
                    update_post_meta( $order_id, '_transaction_id', $transaction_id );
                    update_post_meta( $order_id, '_card_number', $verify_cardnum );
                    update_post_meta( $order_id, '_tracking_number', $verify_track );

                    $order->payment_complete( $transaction_id );
                    if ( isset( WC()->cart ) ) {
                        WC()->cart->empty_cart();
                    }

                    $note  = sprintf( __( 'پرداخت سفارش از طریق درگاه زیبال با موفقیت انجام شد.<br/>کد پیگیری زیبال: %s', 'razgem' ), $transaction_id );
                    if ( ! empty( $verify_cardnum ) ) {
                        $note .= sprintf( __( '<br/>شماره کارت: %s', 'razgem' ), $verify_cardnum );
                    }
                    if ( ! empty( $verify_track ) ) {
                        $note .= sprintf( __( '<br/>شماره مرجع شاپرک: %s', 'razgem' ), $verify_track );
                    }
                    $order->add_order_note( $note, 1 );

                    $notice = str_replace( '{transaction_id}', $transaction_id, $this->success_massage );
                    wc_add_notice( wp_strip_all_tags( $notice ), 'success' );

                    wp_safe_redirect( add_query_arg( 'wc_status', 'success', $this->get_return_url( $order ) ) );
                    exit;
                } else {
                    $note = sprintf( __( 'خطا در بازگشت از بانک زیبال: %s', 'razgem' ), $message );
                    $order->add_order_note( $note, 1 );

                    $notice = str_replace( array( '{transaction_id}', '{fault}' ), array( $trackId, $message ), $this->failed_massage );
                    wc_add_notice( wp_strip_all_tags( $notice ), 'error' );

                    wp_safe_redirect( wc_get_checkout_url() );
                    exit;
                }
            } else {
                // Order is already paid
                $transaction_id = get_post_meta( $order_id, '_transaction_id', true );
                $notice         = str_replace( '{transaction_id}', $transaction_id, $this->success_massage );
                wc_add_notice( wp_strip_all_tags( $notice ), 'success' );

                wp_safe_redirect( add_query_arg( 'wc_status', 'success', $this->get_return_url( $order ) ) );
                exit;
            }
        }

        public function add_sandbox_notice_to_admin_bar( $wp_admin_bar ) {
            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }
            echo '<div class="notice notice-warning is-dismissible" style="direction:rtl;">';
            echo '<p><strong>رازجم:</strong> درگاه پرداخت زیبال در حالت تست (سندباکس) قرار دارد. برای فعالسازی پرداخت واقعی، به بخش ووکامرس > پیکربندی > تسویه حساب > زیبال مراجعه نمایید.</p>';
            echo '</div>';
        }
    }
}
