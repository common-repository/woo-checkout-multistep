<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Yeemail_Addons_Woocommerce_Main {
    function __construct(){
        if(Yeemail_Settings_Builder_Backend::is_plugin_active("woocommerce")){
            add_action("yeemail_builder_tab_block_addons",array($this,"block_text"),100);
            add_filter('yeemail_builder_block_html', array($this,"load_settings"));
            add_action("yeemail_builder_tab__editor",array($this,"builder_email_tab__editor"),2);
            add_filter( 'woocommerce_email_setting_columns', array( $this, 'email_setting_columns' ) );
		    add_action( 'woocommerce_email_setting_column_yeyeemail_template', array( $this, 'column_template' ) );
        } 
    }
    public function email_setting_columns( $array ) {
		if ( isset( $array['actions'] ) ) {
			unset( $array['actions'] );
			return array_merge(
				$array,
				array(
					'yeyeemail_template' => '',
					'actions'  => '',
				)
			);
		}
		return $array;
	}
    public function column_template( $email ) {
		$email_id = $email->id;
        $template_id = Yeemail_Builder_Frontend::get_email_id_template_by_type($email_id);
        if($template_id && $template_id > 0){
            $link = get_edit_post_link( $template_id);
        }else{
            $link = get_edit_post_link( $template_id);
        }
		?>
        <td class="wc-email-settings-table-template">
			<a class="button alignright" target="_blank" href="<?php echo  esc_url( $link ) ?>"><?php  esc_html_e( 'Customize with YeeMail', 'yeemail' ) ?></a>
        </td>
        <?php
	}
    function get_blocks(){
        $data = array(
            array(
                "type"=>"order_detail",
                "title" => esc_html__("Order Detail","yeemail"),
                "icon" => "dashicons dashicons-tagcloud",
                "shortcode" => '[yeemail_woo_order_detail]'
            ),
            array(
                "type"=>"yeemail_woo_order_addesses",
                "title" => esc_html__("Billing Shipping Address","yeemail"),
                "icon" => "dashicons dashicons-text-page",
                "shortcode" => "[yeemail_woo_order_addresses]"
            ),
            array(
                "type"=>"yeemail_woo_order_billing",
                "title" => esc_html__("Billing Address","yeemail"),
                "icon" => "dashicons dashicons-id-alt",
                "shortcode" => "[yeemail_woo_order_billing]"
            ),
            array(
                "type"=>"yeemail_woo_order_shipping",
                "title" => esc_html__("Shipping Address","yeemail"),
                "icon" => "dashicons dashicons-car",
                "shortcode" => "[yeemail_woo_order_shipping]"
            ),
            array(
                "type"=>"customer_notes",
                "title" => esc_html__("Customer Notes","yeemail"),
                "icon" => "dashicons dashicons-feedback",
                "shortcode" => "[yeemail_woo_customer_notes]"
            ),
            array(
                "type"=>"yeemail_item_download",
                "title" => esc_html__("Order Item Download","yeemail"),
                "icon" => "dashicons dashicons-editor-kitchensink",
                "shortcode" => "[yeemail_woo_item_download]"
            ),
       );
       return $data;
    }
    function block_text(){
        ?>
        <div class="builder__widget--inner">
            <div class="builder__widget_tab builder__widget_addons">
                <div class="builder__widget_tab_title"><span class="builder__widget_tab_title_t"><?php esc_attr_e( "WooCommerce", "yeemail") ?></span><span class="builder__widget_tab_title_icon dashicons dashicons-arrow-down-alt2"></span><span class="builder__widget_tab_title_icon dashicons dashicons-arrow-up-alt2"></span></div>
                <ul class="momongaPresets momongaPresets_data">
                    <?php
                    foreach ($this->get_blocks() as $value) {
                        ?>
                        <li>
                            <div class="momongaDraggable" data-type="<?php echo esc_attr($value["type"]) ?>">
                                <i class="emailbuilder-icon <?php echo esc_html($value["icon"]) ?>"></i>
                                <div class="yeemail-tool-text"><?php echo esc_html($value["title"]) ?></div>
                            </div>
                        </li>
                        <?php
                    }
                    do_action( "yeemail_builder_tab_block_addons_woocommerce");
                    ?>
                </ul>
            </div>
        </div>
        <?php
    }
    function load_settings($type){
        foreach ($this->get_blocks() as $value) {
            $data_html ="";
            $padding = yeemail_builder_global_data::$padding;
            $text_align = yeemail_builder_global_data::$text_align;
            $container_show = array("text-align","padding","background","condition");
            $container_style = array(
                    ".builder__editor--item-background .builder__editor_color"=>"background-color",
                    ".builder__editor--item-background .image_url"=>"background-image",
                );
            $inner_attr = array(".text-content"=>array(".builder__editor--html .builder__editor--js"=>"html"),".text-content-data"=>array(".builder__editor--html .builder__editor--js"=>"html_hide"));
            switch ($value["type"]) {
                case "order_detail":
                    $container_show[] = "detail-template";
                    $inner_attr[".text-content-save"] = array(".builder__editor--item-detail-template .detail-template"=>"data-template",
                                                                ".builder__editor--item-detail-template .detail-img"=>"data-showimg",
                                                                ".builder__editor--item-detail-template .detail-totals"=>"data-totals",
                                                                ".builder__editor--item-detail-template .detail-sku"=>"data-sku",
                                                                ".builder__editor--item-detail-template .detail-des"=>"data-showdes",
                                                                );
                    $data_html = '<div class="text-content-save" data-template="default" data-showimg="no" data-totals="yes" data-sku="no" data-showdes="no"></div>';
                    $type["block"][$value["type"]]["builder"] = '
                    <div class="builder-elements">
                            <div class="builder-elements-content" data-type="'.$value["type"].'" >
                                <div class="text-content-data hidden">'.$value["shortcode"].'</div>
                                <div class="text-content">'.Yeemail_Addons_Woocommerce_Shortcodes::product_details().'</div>
                            </div>
                        </div>';
                    break;
                case "yeemail_woo_order_addesses":
                    $type["block"][$value["type"]]["builder"] = '
                    <div class="builder-elements">
                        <div class="builder-elements-content" data-type="'.esc_attr($value["type"]).'" >
                            <div class="text-content-data hidden">'.esc_attr($value["shortcode"]).'</div>
                            <div class="text-content">'.Yeemail_Addons_Woocommerce_Shortcodes::order_addresses().'</div>
                            '.$data_html.'
                        </div>
                    </div>';
                    break;
                case "yeemail_woo_order_billing":
                    $type["block"][$value["type"]]["builder"] = '
                    <div class="builder-elements">
                        <div class="builder-elements-content" data-type="'.esc_attr($value["type"]).'" >
                            <div class="text-content-data hidden">'.esc_attr($value["shortcode"]).'</div>
                            <div class="text-content">'.Yeemail_Addons_Woocommerce_Shortcodes::order_billing().'</div>
                            '.$data_html.'
                        </div>
                    </div>';
                    break;
                case "yeemail_woo_order_shipping":
                    $type["block"][$value["type"]]["builder"] = '
                    <div class="builder-elements">
                        <div class="builder-elements-content" data-type="'.esc_attr($value["type"]).'" >
                            <div class="text-content-data hidden">'.esc_attr($value["shortcode"]).'</div>
                            <div class="text-content">'.Yeemail_Addons_Woocommerce_Shortcodes::order_shipping().'</div>
                            '.$data_html.'
                        </div>
                    </div>';
                        break;
                case "yeemail_item_download":
                    $type["block"][$value["type"]]["builder"] = '
                    <div class="builder-elements">
                        <div class="builder-elements-content" data-type="'.esc_attr($value["type"]).'" >
                            <div class="text-content-data hidden">'.esc_attr($value["shortcode"]).'</div>
                            <div class="text-content">'.do_shortcode($value["shortcode"]).'</div>
                            '.$data_html.'
                        </div>
                    </div>';
                        break;    
                default:
                    $type["block"][$value["type"]]["builder"] = '
                    <div class="builder-elements">
                        <div class="builder-elements-content" data-type="'.esc_attr($value["type"]).'" >
                            <div class="text-content-data hidden">'.esc_attr($value["shortcode"]).'</div>
                            <div class="text-content">'.do_shortcode($value["shortcode"]).'</div>
                            '.$data_html.'
                        </div>
                    </div>';
                    break;
            }
            $type["block"][$value["type"]]["editor"]["container"]["show"]= $container_show;
            $type["block"][$value["type"]]["editor"]["container"]["style"]= array_merge($padding,$container_style,$text_align);
            $type["block"][$value["type"]]["editor"]["inner"]["style"]= array();
            $type["block"][$value["type"]]["editor"]["inner"]["attr"] = $inner_attr;
        }
        $container_show = array("text-align","padding","background","html");
        $type["block"]["woocommerce_data"]["builder"] = '
           <div class="builder-elements">
                <div class="builder-elements-content" data-type="woocommerce_data" >
                    <div class="text-content-data hidden"></div>
                    <div class="text-content">'.esc_attr__("Choose data shortcode","yeemail").'</div>
                </div>
            </div>';
        $type["block"]["woocommerce_data"]["editor"]["container"]["show"]= $container_show;
        $type["block"]["woocommerce_data"]["editor"]["container"]["style"]= array_merge($padding,$container_style,$text_align);
        $type["block"]["woocommerce_data"]["editor"]["inner"]["style"]= array();
        $type["block"]["woocommerce_data"]["editor"]["inner"]["attr"] = $inner_attr;
        return $type; 
    }
    function builder_email_tab__editor($post){
        ?>
        <div class="builder__editor--item builder__editor--item-detail-template">
            <div class="builder__editor--video">
                <label><?php esc_html_e("Template","yeemail") ?></label>
                <select class="detail-template">
                    <option value="default"><?php esc_html_e("Default","yeemail") ?></option>
                    <option value="template-1"><?php esc_html_e("Template 1","yeemail") ?></option>
                    <option value="template-2"><?php esc_html_e("Template 2","yeemail") ?></option>
                    <option value="template-3"><?php esc_html_e("Template 3","yeemail") ?></option>
                    <option value="template-4"><?php esc_html_e("Template 4","yeemail") ?></option>
                </select>
            </div>
            <div class="builder__editor--video">
                <label><?php esc_html_e("Show image","yeemail") ?></label>
                <select class="detail-img">
                    <option value="no"><?php esc_html_e("No","yeemail") ?></option>
                    <option value="yes"><?php esc_html_e("Yes","yeemail") ?></option>
                </select>
            </div>
            <div class="builder__editor--video">
                <label><?php esc_html_e("Show item totals Price","yeemail") ?></label>
                <select class="detail-total_price">
                    <option value="no"><?php esc_html_e("No","yeemail") ?></option>
                    <option value="yes"><?php esc_html_e("Yes","yeemail") ?></option>
                </select>
            </div>
            <div class="builder__editor--video">
                <label><?php esc_html_e("Show item totals","yeemail") ?></label>
                <select class="detail-totals">
                    <option value="no"><?php esc_html_e("No","yeemail") ?></option>
                    <option value="yes"><?php esc_html_e("Yes","yeemail") ?></option>
                </select>
            </div>
            <div class="builder__editor--video">
                <label><?php esc_html_e("Show item SKU","yeemail") ?></label>
                <select class="detail-sku">
                    <option value="no"><?php esc_html_e("No","yeemail") ?></option>
                    <option value="yes"><?php esc_html_e("Yes","yeemail") ?></option>
                </select>
            </div>
            <div class="builder__editor--video">
                <label><?php esc_html_e("Show item short description","yeemail") ?></label>
                <select class="detail-des">
                    <option value="no"><?php esc_html_e("No","yeemail") ?></option>
                    <option value="yes"><?php esc_html_e("Yes","yeemail") ?></option>
                </select>
            </div>
        </div>
        <?php
    }
}
new Yeemail_Addons_Woocommerce_Main;