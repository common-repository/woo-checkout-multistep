<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Yeemail_Addons_Woocommerce_Processing {
    function __construct(){
        add_filter( 'wc_get_template', array( $this, 'replace_template_path' ), 999, 5 );
    }

	public function replace_template_path( $located, $template_name, $args, $template_path, $default_path) {
		if($template_name == "emails/subscription-info.php"){
			$located        = YEEMAIL_PLUGIN_PATH . 'templates/woocommerce/emails/woocommerce-subscriptions/subscription-info.php';
		}
		if ( isset( $args['email'] ) && ! empty( $args['email']->id ) ) {
			if ( $args['plain_text'] ) {
				return $located;
			}
			switch ($template_name){
				case "emails/admin-new-order.php":
					$template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type("new_order");
					if( $template_id && $template_id > 0) {
						$located        = YEEMAIL_PLUGIN_PATH . 'templates/woocommerce/emails/admin-new-order-yeemail.php';
					}
					break;
				case "emails/customer-processing-order.php":
					$template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type("customer_processing_order");
					if( $template_id && $template_id > 0) {
						$located        = YEEMAIL_PLUGIN_PATH . 'templates/woocommerce/emails/customer-processing-order-yeemail.php';
					}
					break;
				case "emails/customer-on-hold-order.php":
					$template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type("customer_on_hold_order");
					if( $template_id && $template_id > 0) {
						$located        = YEEMAIL_PLUGIN_PATH . 'templates/woocommerce/emails/customer-on-hold-order-yeemail.php';
					}
					break;
				case "emails/customer-completed-order.php":
					$template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type("customer_completed_order");
					if( $template_id && $template_id > 0) {
						$located        = YEEMAIL_PLUGIN_PATH . 'templates/woocommerce/emails/customer-completed-order-yeemail.php';
					}
					break;
				case "emails/admin-failed-order.php":
					$template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type("failed_order");
					if( $template_id && $template_id > 0) {
						$located        = YEEMAIL_PLUGIN_PATH . 'templates/woocommerce/emails/admin-failed-order-yeemail.php';
					}
					break;
				case "emails/admin-cancelled-order.php":
					$template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type("cancelled_order");
					if( $template_id && $template_id > 0) {
						$located        = YEEMAIL_PLUGIN_PATH . 'templates/woocommerce/emails/admin-cancelled-order-yeemail.php';
					}
					break;
				case "emails/customer-invoice.php":
					$template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type("customer_invoice");
					if( $template_id && $template_id > 0) {
						$located        = YEEMAIL_PLUGIN_PATH . 'templates/woocommerce/emails/customer-invoice-yeemail.php';
					}
					break;
				case "emails/customer-note.php":
					$template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type("customer_note");
					if( $template_id && $template_id > 0) {
						$located        = YEEMAIL_PLUGIN_PATH . 'templates/woocommerce/emails/customer-note-yeemail.php';
					}
					break;
				case "emails/customer-new-account.php":
					$template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type("customer_new_account");
					if( $template_id && $template_id > 0) {
						$located        = YEEMAIL_PLUGIN_PATH . 'templates/woocommerce/emails/customer-new-account-yeemail.php';
					}
					break;
				case "emails/customer-reset-password.php":
					$template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type("customer_reset_password");
					if( $template_id && $template_id > 0) {
						$located        = YEEMAIL_PLUGIN_PATH . 'templates/woocommerce/emails/customer-reset-password-yeemail.php';
					}
					break;
				case "emails/customer-refunded-order.php":
					$template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type("customer_refunded_order");
					if( $template_id && $template_id > 0) {
						$located        = YEEMAIL_PLUGIN_PATH . 'templates/woocommerce/emails/customer-refunded-order-yeemail.php';
					}
					break;
			}
			
		}
		return $located;
	}
	function get_the_wc_email_id( $order, $sent_to_admin, $plain_text, $email ) {
		$this->order = $order;
		$this->sent_to_admin = $sent_to_admin;
		$this->plain_text = $plain_text;
		$this->email = $email;
		// Will output the email id for the current notification
		// new_order
		// customer_on_hold_order
		// customer_processing_order
		// customer_completed_order
		// customer_refunded_order
		// customer_partially_refunded_order
		// cancelled_order
		// failed_order
		// customer_reset_password
		// customer_invoice
		// customer_new_account
		// customer_note
		// low_stock
		// no_stock
		// ------------------For WooCommerce Subscriptions:
		// new_renewal_order
		// new_switch_order
		// customer_processing_renewal_order
		// customer_completed_renewal_order
		// customer_on_hold_renewal_order
		// customer_completed_switch_order
		// customer_renewal_invoice
		// cancelled_subscription
		// expired_subscription
		// suspended_subscription
		// ----------------For WooCommerce Bookings:
		// new_booking
		// booking_reminder
		// booking_confirmed
		// booking_pending_confirmation
		// booking_notification
		// booking_cancelled
		// admin_booking_cancelled
		// --------------For WooCommerce Memberships:
		// WC_Memberships_User_Membership_Note_Email
		// WC_Memberships_User_Membership_Ending_Soon_Email
		// WC_Memberships_User_Membership_Ended_Email
		// WC_Memberships_User_Membership_Renewal_Reminder_Email
		// WC_Memberships_User_Membership_Activated_Email
	}
}
new Yeemail_Addons_Woocommerce_Processing;