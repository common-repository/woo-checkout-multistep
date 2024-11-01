<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Yeemail_Addons_Woocommerce_Shortcodes {
	protected static $args = array();
    function __construct(){
        if(Yeemail_Settings_Builder_Backend::is_plugin_active("woocommerce")){
            add_filter('yeemail_shortcodes', array("Yeemail_Addons_Woocommerce_Shortcodes","yeemail_shortcodes"),50);
            self::set_shortcodes();
        }
    }
    public static function yeemail_shortcodes($shortcodes){
        $shortcode_woo = array();
        $shortcode_woo["Order Details"] = array(
            "yeemail_woo_order_id"=>"Order ID",
            "yeemail_woo_order_number"=>"Order Number",
            "yeemail_woo_order_link"=>"Order URL",
            "yeemail_woo_order_date"=>"Order Date",
            "yeemail_woo_order_subtotal"=>"Order Sub-Total",
            "yeemail_woo_order_total"=>"Order Total",
            "yeemail_woo_order_total_number"=>"Order Total Number",
            "yeemail_woo_order_fee"=>"Order Fee",
            "yeemail_woo_order_refunds"=>"Order Refunds",
            "yeemail_woo_order_count"=>"Order Count",
            "yeemail_woo_order_quantity_count"=>"Order Quantity Total",
            "yeemail_woo_order_total_tax"=>"Order Tax",
            "yeemail_woo_order_discount_total"=>"Order Discount Total",
            "yeemail_woo_order_status"=>"Order Status",
            "yeemail_woo_order_currency"=>"Order Currency",
            "yeemail_woo_order_detail"=>"Order Detail",
            "yeemail_woo_order_addresses"=>"Order Addesses",
            "yeemail_woo_item_download"=>"Order Item Download",
        );
        $shortcode_woo["Billing"] = array(
            //Billing
            "yeemail_woo_order_billing"=>"Billing Addeess",
            "yeemail_woo_billing_firstname"=>"Billing First Name",
            "yeemail_woo_billing_lastname"=>"Billing Last Name",
            "yeemail_woo_billing_fullname"=>"Billing Full Name",
            "yeemail_woo_billing_address"=>"Billing Address",
            "yeemail_woo_billing_city"=>"Billing City",
            "yeemail_woo_billing_company"=>"Billing Company",
            "yeemail_woo_billing_address_1"=>"Billing Address 1",
            "yeemail_woo_billing_address_2"=>"Billing Address 2",
            "yeemail_woo_billing_state"=>"Billing State",
            "yeemail_woo_billing_postcode"=>"Billing Postcode",
            "yeemail_woo_billing_country"=>"Billing Country",
            "yeemail_woo_billing_phone"=>"Billing Phone",
            "yeemail_woo_billing_email"=>"Billing Email",
        );
            $shortcode_woo["Shipping"] = array(
            //Shipping
            "yeemail_woo_order_shipping"=>"Shipping Address",
            "yeemail_woo_shipping_firstname"=>"Shipping First Name",
            "yeemail_woo_shipping_lastname"=>"Shipping Last Name",
            "yeemail_woo_shipping_fullname"=>"Shipping Full Name",
            "yeemail_woo_shipping_address"=>"Shipping Address",
            "yeemail_woo_shipping_city"=>"Shipping City",
            "yeemail_woo_shipping_company"=>"Shipping Company",
            "yeemail_woo_shipping_address_1"=>"Shipping Address 1",
            "yeemail_woo_shipping_address_2"=>"Shipping Address 2",
            "yeemail_woo_shipping_state"=>"Shipping State",
            "yeemail_woo_shipping_postcode"=>"Shipping Postcode",
            "yeemail_woo_shipping_country"=>"Shipping Country",
            "yeemail_woo_shipping_phone"=>"Shipping Phone",
            "yeemail_woo_shipping_map_url"=>"Shipping Map URL",
            );
            $shortcode_woo["Customer"] = array(
            //customer
            "yeemail_woo_customer_id"=>"Customer ID",
            "yeemail_woo_customer_note"=>"Customer Note",
            "yeemail_woo_customer_notes"=>"Customer Notes",
            "yeemail_woo_customer_ip_address"=>"Customer IP",
            "yeemail_woo_customer_user_agent"=>"Customer Agent",
            );
            $shortcode_woo["User"] = array(
            ///user
            "yeemail_woo_user_my_account_url"=>"My Account URL",
            "yeemail_woo_user_login"=>"User Login",
            "yeemail_woo_user_set_password"=>"User Set Password",
            "yeemail_woo_user_set_password_url"=>"User Set Password Link",
            );
            $shortcode_woo["Hook"] = array(
            //hook
            'yeemail_woo_hook_woocommerce_email_before_order_table' => 'Hook woocommerce_email_before_order_table',
            'yeemail_woo_hook_woocommerce_email_after_order_table' => 'Hook woocommerce_email_after_order_table',
            );
        $shortcodes["WooCommerce"] = apply_filters("yeemail_shortcodes_woocommerce",$shortcode_woo);
        return $shortcodes;
    }
    public static function set_shortcodes($args= array()){
        self::$args = $args;
        $shortcodes = self::yeemail_shortcodes(array());
        foreach($shortcodes["WooCommerce"] as $group){
            foreach($group as $shortcode_k => $shortcode_v){
                add_shortcode($shortcode_k,array("Yeemail_Addons_Woocommerce_Shortcodes","shortcodes"),10,3); 
            }
        }
    }
    public static function shortcodes($data_atts, $content="", $shortcode ="" ){
        $args = self::$args;
        foreach( $args as $key => $woo_datas ){
            $$key = $woo_datas;
        }
        switch ($shortcode) {
            case 'yeemail_woo_user_my_account_url':
                return make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) );
                break;
            case 'yeemail_woo_order_id':
                if(isset($order)){
                    return $order->get_id();
                }else{
                    return 1;
                }
                break;
            case 'yeemail_woo_order_number':
                if(isset($order)){
                    return $order->get_order_number();
                }else{
                    return 1;
                }
                break;
            case 'yeemail_woo_order_link':
                if(isset($order)){
                    return $order->get_view_order_url();
                }else{
                    return get_home_url().'/my-account/view-order/1';
                }
                break;
            case 'yeemail_woo_order_date':
                if(isset($order)){
                    return wc_format_datetime( $order->get_date_created() );
                }else{
                    return date(get_option('date_format'));
                }
                break;
            case 'yeemail_woo_order_status':
                if(isset($order)){
                    return $order->get_status();
                }else{
                    return 'Completed';
                }
                break;
            case 'yeemail_woo_order_currency':
                if(isset($order)){
                    return $order->get_currency();
                }else{
                    return "USD";
                }
                break;
            case 'yeemail_woo_order_subtotal':
                if(isset($order)){
                    return $order->get_subtotal(); 
                }else{
                    return "48.00";
                }
                break;
            case 'yeemail_woo_order_total':
                if(isset($order)){
                    return  $order->get_total(); 
                }else{
                    return  "48.00";
                }
                break;
            case 'yeemail_woo_order_total_number':
                if(isset($order)){
                    return  $order->get_total(); 
                }else{
                    return  "48.00";
                }
                break;
            case 'yeemail_woo_order_fee':
                $order_fee_total = 0;
                if(isset($order)){
                    foreach ( $order->get_fees() as $fee_id => $fee ) {
                        $order_fee_total += $fee->get_total();
                    }  
                }
                return $order_fee_total;
                break;
            case 'yeemail_woo_order_total_tax':
                if(isset($order)){
                    return $order->get_total_tax(); 
                }else{
                    return 0;
                }
                break;
            case 'yeemail_woo_order_discount_total':
                if(isset($order)){
                    return $order->get_total_discount(); 
                }else{
                    return 0;
                }
                break;
            case 'yeemail_woo_order_count':
                if(isset($order)){
                    return wc_orders_count("completed");  
                }else{
                    return "999";
                }
                break;
            case 'yeemail_woo_order_quantity_count':
                $total_quantity = 0;
                if(isset($order)){
                    foreach ( $order->get_items() as $item_id => $item ) {
                        $quantity = $item->get_quantity();
                        $total_quantity += $quantity;
                    }   
                }
                return $total_quantity;
                break;
            case 'yeemail_woo_order_refunds':
                $refund = 0;
                if(isset($order)){
                    $totals = $order->get_order_item_totals();
                        foreach ( $totals as $index => $value ) {
                            if ( strpos( $index, 'refund' ) !== false ) {
                            $refund= $order->get_total_refunded();
                            break;
                        }
                    }
                }
                return $refund;
                break;
            case 'yeemail_woo_order_detail':
                return self::product_details($data_atts);
                break;
            case 'woo_builder_order_total':
                return self::order_total($data_atts);
                break;
            case 'woo_builder_order_shiping':
                return self::order_shipping();
                break;
            case 'yeemail_woo_item_download':
                ob_start();
                if(isset($order)){
                    $downloads = $order->get_downloadable_items();
                    if(count($downloads) > 0 ){
                        include YEEMAIL_PLUGIN_PATH."templates/woocommerce/emails/email-downloads.php";
                    }
                }else{
                    include YEEMAIL_PLUGIN_PATH."templates/woocommerce/emails/email-downloads-default.php";
                }
                $html = ob_get_contents();
                ob_end_clean();
                return $html;
                break;
            //Addresses
            case 'yeemail_woo_order_addresses':
                return self::order_addresses();
                break;
            //Billing
            case 'yeemail_woo_order_billing':
                return self::order_billing();
                break;
            case 'yeemail_woo_billing_firstname':
                if(isset($order)){
                   return $order->get_billing_first_name(); 
                }else{
                    return "Tayler";
                }
                break;
            case 'yeemail_woo_billing_lastname':
                if(isset($order)){
                    return $order->get_billing_last_name(); 
                 }else{
                     return "Holder";
                 }
                break;
            case 'yeemail_woo_billing_fullname':
                if(isset($order)){
                    return $order->get_formatted_billing_full_name(); 
                 }else{
                     return "Tayler Holder";
                 }
                break;
            case 'yeemail_woo_billing_address':
                if(isset($order)){
                    return $order->get_formatted_billing_address();
                 }else{
                     return self::order_billing();
                 }
                break;
            case 'yeemail_woo_billing_city':
                if(isset($order)){
                    return $order->get_billing_city(); 
                 }else{
                     return "City Name";
                 }
                break;
            case 'yeemail_woo_billing_company':
                if(isset($order)){
                    return $order->get_billing_company(); 
                 }else{
                     return "YeeAdd-ons";
                 }
                break;
            case 'yeemail_woo_billing_address_1':
                if(isset($order)){
                    return $order->get_billing_address_1(); 
                 }else{
                     return "7400 Edwards Rd";
                 }
                break;
            case 'yeemail_woo_billing_address_2':
                if(isset($order)){
                    return $order->get_billing_address_2(); 
                 }else{
                     return "7422 Edwards Rd";
                 }
                break;
            case 'yeemail_woo_billing_state':
                if(isset($order)){
                    return $order->get_billing_state(); 
                 }else{
                     return "Mayville";
                 }
                break;
            case 'yeemail_woo_billing_postcode':
                if(isset($order)){
                    return $order->get_billing_postcode(); 
                 }else{
                     return "511000";
                 }
                break;
            case 'yeemail_woo_billing_phone':
                if(isset($order)){
                    return $order->get_billing_phone(); 
                 }else{
                     return "(820) 555-999";
                 }
                break;
            case 'yeemail_woo_billing_email':
                if(isset($order)){
                    return $order->get_billing_email(); 
                 }else{
                     return get_option( 'admin_email' );
                 }
                break;
            case 'yeemail_woo_billing_country':
                if(isset($order)){
                    return $order->get_billing_country(); 
                 }else{
                     return "US";
                 }
                break;
            //Shipping
            case 'yeemail_woo_order_shipping':
                return self::order_shipping();
                break;
            case 'yeemail_woo_shipping_firstname':
                if(isset($order)){
                    return $order->get_shipping_first_name(); 
                 }else{
                     return "Tayler";
                 }
                break;
            case 'yeemail_woo_shipping_lastname':
                if(isset($order)){
                    return $order->get_shipping_last_name(); 
                 }else{
                     return "Holder";
                 }
                break;
            case 'yeemail_woo_shipping_fullname':
                if(isset($order)){
                    return $order->get_formatted_shipping_full_name(); 
                 }else{
                     return "Tayler Holder";
                 }
                break;
            case 'yeemail_woo_shipping_address':
                if(isset($order)){
                    return $order->get_billing_country(); 
                 }else{
                     return self::order_shipping();
                 }
                //return $order->get_formatted_shipping_address();
                break;
            case 'yeemail_woo_shipping_company':
                if(isset($order)){
                    return $order->get_shipping_company(); 
                 }else{
                     return "YeeAdd-ons";
                 }
                break;
            case 'yeemail_woo_shipping_address_1':
                if(isset($order)){
                    return $order->get_shipping_address_1(); 
                 }else{
                     return "7400 Edwards Rd";
                 }
                break;
            case 'yeemail_woo_shipping_address_2':
                if(isset($order)){
                    return $order->get_shipping_address_2(); 
                 }else{
                     return "7422 Edwards Rd";
                 }
                break;
            case 'yeemail_woo_shipping_city':
                if(isset($order)){
                    return $order->get_shipping_city(); 
                 }else{
                     return "Mayville";
                 }
                break;
            case 'yeemail_woo_shipping_state':
                if(isset($order)){
                    return $order->get_shipping_state(); 
                 }else{
                     return "Mayville";
                 }
                break;
            case 'yeemail_woo_shipping_postcode':
                if(isset($order)){
                    return $order->get_shipping_postcode(); 
                 }else{
                     return "511000";
                 }
                break;
            case 'yeemail_woo_shipping_country':
                if(isset($order)){
                    return $order->get_shipping_country(); 
                 }else{
                     return "US";
                 }
                break;
            case 'yeemail_woo_shipping_phone':
                if(isset($order)){
                    return $order->get_shipping_phone(); 
                 }else{
                     return "(820) 555-999";
                 }
                break;
            case 'yeemail_woo_shipping_map_url':
                if(isset($order)){
                    return $order->get_shipping_address_map_url(); 
                 }else{
                     return "https://www.google.com/maps/";
                 }
                break;
            //customer
            case 'yeemail_woo_customer_id':
                if(isset($order)){
                    return $order->get_customer_id(); 
                 }else{
                     return "1";
                 }
                break;    
            case 'yeemail_woo_customer_note':
                if(isset($order)){
                    return $order->get_customer_note(); 
                 }else{
                     return "Note message";
                 }
                break;
            case 'yeemail_woo_customer_notes':
                if(isset($order)){
                    $notes = $order->get_customer_order_notes();
                    return self::customer_notes($notes);
                 }else{
                     return '<p>This is some customer note , just some dummy text nothing to see here</p>';
                 }
                break;
            case 'yeemail_woo_customer_ip_address':
                if(isset($order)){
                    return $order->get_customer_ip_address(); 
                 }else{
                     return "192.168.1.1";
                 }
                break;
            case 'yeemail_woo_customer_user_agent':
                if(isset($order)){
                    return $order->get_customer_user_agent(); 
                 }else{
                     return "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36";
                 }
                break;
            //Customer User
            case 'yeemail_woo_user_id':
                if(isset($args["user_id"])){
                    return $args["user_id"];
                }else{
                    $current_user = wp_get_current_user();
				    return $current_user->user_login;
                }
                break;
            case "yeemail_woo_user_login":
                if(isset($args["user_login"])){
                    return $args["user_login"];
                }else{
                    $current_user = wp_get_current_user();
				    return $current_user->user_login;
                }
                break;
            case 'yeemail_woo_user_set_password_url':
                if(isset($args["reset_key"])){
                    return esc_url( add_query_arg( array( 'key' => $args["reset_key"], 'id' => $args["user_id"] ), wc_get_endpoint_url( 'lost-password', '', wc_get_page_permalink( 'myaccount' ) ) ) );
                }else{
                    return esc_url( wc_get_endpoint_url( 'lost-password', '', wc_get_page_permalink( 'myaccount' ) ) ) ;
                }
                break;
            case 'yeemail_woo_user_set_password':
                if(isset($args["reset_key"])){
                    return '<a class="link" href="'. esc_url( add_query_arg( array( 'key' => $args["reset_key"], 'id' => $args["user_id"] ), wc_get_endpoint_url( 'lost-password', '', wc_get_page_permalink( 'myaccount' ) ) ) ).'">'.esc_html__( 'Click here to reset your password', 'woocommerce' ).'</a>';
                }else{
                    return '<a class="link" href="#">'.esc_html__( 'Click here to reset your password', 'woocommerce' ).'</a>';
                }
                break;
            case 'yeemail_woo_hook_woocommerce_email_before_order_table':
                if(isset($order)){
                    $sent_to_admin = false;
                    $plain_text = false;
                    $email = "";
                    if(isset($args["sent_to_admin"])){
                        $sent_to_admin = $args["sent_to_admin"];
                    }
                    if(isset($args["plain_text"])){
                        $plain_text = $args["plain_text"];
                    }
                    if(isset($args["email"])){
                        $email = $args["email"];
                    }
                    ob_start();
                    do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email ); 
                    $html = ob_get_contents();
                    ob_end_clean();
                    return $html;
                }else{
                    return '<div class="yeemail_hook">woocommerce_email_before_order_table</div>';
                } 
                break;
            case 'yeemail_woo_hook_woocommerce_email_after_order_table':
                if(isset($order)){
                    $sent_to_admin = false;
                    $plain_text = false;
                    $email = "";
                    if(isset($args["sent_to_admin"])){
                        $sent_to_admin = $args["sent_to_admin"];
                    }
                    if(isset($args["plain_text"])){
                        $plain_text = $args["plain_text"];
                    }
                    if(isset($args["email"])){
                        $email = $args["email"];
                    }
                    ob_start();
                    do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); 
                    $html = ob_get_contents();
                    ob_end_clean();
                    return $html;
                }else{
                    return '<div class="yeemail_hook">woocommerce_email_after_order_table</div>';
                } 
                break;
            default:
                return apply_filters( "yeemail_shortcodes_woocommerce_action", $shortcode,$order, $sent_to_admin, $plain_text, $email );
                break;
        }
    }
    public static function product_details( $atts = null ){
        $args = self::$args;
        $sent_to_admin = false;
        $plain_text = false;
        $email = "";
        foreach( $args as $key => $woo_datas ){
            $$key = $woo_datas;
        }
        ob_start();
        if(isset($order)){
            include YEEMAIL_PLUGIN_PATH."templates/woocommerce/emails/email-order-details.php";
        }else{
            include YEEMAIL_PLUGIN_PATH."templates/woocommerce/emails/email-order-details-default.php";
        }
		$html = ob_get_contents();
        ob_end_clean();
        return $html;
	}
	public static function order_total( $atts ){
		$args = self::$args;
        $sent_to_admin = false;
        $plain_text = false;
        $email = "";
        foreach( $args as $key => $woo_datas ){
            $$key = $woo_datas;
        }
        ob_start();
        if(isset($order)){
            include YEEMAIL_PLUGIN_PATH."templates/woocommerce/emails/order-total.php";
        }else{
            include YEEMAIL_PLUGIN_PATH."templates/woocommerce/emails/order-total.php";
        }
		$html = ob_get_contents();
        ob_end_clean();
        return $html;
	}
	public static function order_addresses(){
		$args = self::$args;
        $sent_to_admin = false;
        $plain_text = false;
        $email = "";
        foreach( $args as $key => $woo_datas ){
            $$key = $woo_datas;
        }
		ob_start();
        if(isset($order)){
		    include YEEMAIL_PLUGIN_PATH."templates/woocommerce/emails/email-addresses.php";
        }else{
            include YEEMAIL_PLUGIN_PATH."templates/woocommerce/emails/email-addresses-default.php";
        }
		$html = ob_get_contents();
        ob_end_clean();
        return $html;
	}
	public static function order_billing(){
		$args = self::$args;
        $sent_to_admin = false;
        $plain_text = false;
        $email = "";
        foreach( $args as $key => $woo_datas ){
            $$key = $woo_datas;
        }
		ob_start();
        if(isset($order)){
            $address    = $order->get_formatted_billing_address();
            ?>
            <address class="address">
				<?php echo wp_kses_post( $address ? $address : esc_html__( 'N/A', 'woocommerce' ) ); ?>
				<?php if ( $order->get_billing_phone() ) : ?>
					<br/><?php echo wc_make_phone_clickable( $order->get_billing_phone() ); ?>
				<?php endif; ?>
				<?php if ( $order->get_billing_email() ) : ?>
					<br/><?php echo esc_html( $order->get_billing_email() ); ?>
				<?php endif; ?>
			</address>
            <?php
        }else{
            ?>
            <address class="address">
                Tayler Holder<br>
                YeeMail<br>
                7400 Edwards Rd<br>
                Edwards Rd<br>
                (820) 555-999
			</address>
            <?php
        }
		$html = ob_get_contents();
        ob_end_clean();
        return $html;
	}
	public static function order_shipping(){
		$args = self::$args;
        $sent_to_admin = false;
        $plain_text = false;
        $email = "";
        foreach( $args as $key => $woo_datas ){
            $$key = $woo_datas;
        }
		ob_start();
        if(isset($order)){
            $shipping   = $order->get_formatted_shipping_address();
            if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && $shipping ) : 
                ?>
                <address class="address">
                    <?php echo wp_kses_post( $shipping ); ?>
                    <?php if ( $order->get_shipping_phone() ) : ?>
                        <br /><?php echo wc_make_phone_clickable( $order->get_shipping_phone() ); ?>
                    <?php endif; ?>
                </address>
                <?php
            endif;
        }else{
            ?>
            <address class="address">
                Tayler Holder<br>
                YeeMail<br>
                7400 Edwards Rd<br>
                Edwards Rd<br>
                (820) 555-999
			</address>
            <?php
        }
		$html = ob_get_contents();
        ob_end_clean();
        return $html;
	}
	public static function customer_notes($notes){
		ob_start();
		foreach ($notes as $note){
			?>
			<p>
			<?php echo wp_filter_post_kses($note->comment_content); ?>
			</p>
			<?php
		}
		$html = ob_get_contents();
        ob_end_clean();
        return $html;
	}
}
new Yeemail_Addons_Woocommerce_Shortcodes;