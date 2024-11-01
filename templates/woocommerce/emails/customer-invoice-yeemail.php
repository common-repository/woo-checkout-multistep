<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type("customer_invoice");
if( $template_id && $template_id > 0) {
	Yeemail_Addons_Woocommerce_Shortcodes::set_shortcodes($args);
	$new_content_email = Yeemail_Builder_Frontend_Functions::creator_template(array("id_template"=>$template_id,"type"=>"content_no_shortcode"));
	$notification_email = Yeemail_Builder_Frontend_Functions::creator_template(array("id_template"=>$template_id,"type"=>"full","html"=>$new_content_email));
	echo $notification_email; // phpcs:ignore WordPress.Security.EscapeOutput
}