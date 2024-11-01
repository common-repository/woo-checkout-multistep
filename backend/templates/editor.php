<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class yeemail_builder_editor {
    function __construct(){
      add_action("yeemail_builder_tab__editor",array($this,"yeemail_builder_tab__editor"));  
    }
    public static function get_color_pick($text = "Color Pick",$name = "", $value = "",$class =""){
       if($name == ""){
            $text_field = '<input type="text" value="#e7e7e7" class="builder__editor_color">';
       }else{
            $text_field = '<input type="text" name="'.$name.'" value="'.$value.'" class="'.$class.'">';
       }
        return '<div class="builder__editor--color">
                <label>'.$text.'</label>
                <div class="">
                    '.$text_field.'
                </div>
            </div>';
    }
    public static function get_padding() {
        return '<div class="builder__editor--padding">
                <div>
                    <label>'.__("Top","yeemail").'</label>
                    <input data-after_value="px" class="builder__editor--padding-top touchspin" type="text" placeholder="px" />
                </div>
                <div>
                    <label>'. __("Bottom","yeemail").'</label>
                    <input data-after_value="px" class="builder__editor--padding-bottom touchspin" type="text" placeholder="px" />
                </div>
                <div>
                    <label>'.__("Left","yeemail").'</label>
                    <input data-after_value="px" class="builder__editor--padding-left touchspin" type="text" placeholder="px" />
                </div>
                <div>
                    <label>'.__("Right","yeemail").'</label>
                    <input data-after_value="px" class="builder__editor--padding-right touchspin" type="text" placeholder="px" />
                </div>
            </div>';
    }
    function yeemail_builder_tab__editor(){
        ?>
        <div class="yeemail-builder-goback">
            <span class="dashicons dashicons-arrow-left-alt"></span>
            <span class="yeemail-builder-goback_edit"><?php esc_attr_e( "Edit", "yeemail" ) ?></span>
            <span class="yeemail-builder-goback_block"></span>
        </div>
        <div class="builder__editor--item builder__editor--item-setting_width">
            <label><?php esc_html_e("Email Width","yeemail") ?></label>
            <div class="builder__editor--button-setting_width builder__editor--button-settings">
                <?php
                    if(isset($_GET["post"])){
                        $post_template_id = sanitize_text_field( $_GET["post"] );
                        $width = get_post_meta( $post_template_id,'_mail_width',true);
                        if($width < 480 || $width== "" ){
                            $width = "640";   
                        }
                    }else{
                        $width = "640";
                    }
                ?>
                <div>
                    <input name="yeemail_settings_width" data-after_value="px" type="text" class="text_width touchspin" value="<?php echo esc_attr( $width ) ?>">
                    <p><?php esc_attr_e( "Email width must be 480px (min) - 900px (max) ", "yeemail") ?></p>
                </div>
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-html_editor">
            <div class="builder__editor--html_editor">
                <label><?php esc_html_e("HTML Code","yeemail") ?></label>
                <textarea class="builder__editor_html"></textarea>
            </div>
        </div> 
        <div class="builder__editor--item builder__editor--item-html">
            <textarea class="builder__editor--js"></textarea>
        </div>
        <div class="builder__editor--item builder__editor--item-video">
            <div class="builder__editor--video">
                <label><?php esc_html_e("Video URL","yeemail") ?></label>
                <input type="text" class="video_url">
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-image">
            <label><?php esc_html_e("Image","yeemail") ?></label>
            <div class="builder__editor--button-url">
                <label><?php esc_html_e("Source URL","yeemail") ?></label>
                <input type="text" class="image_url" placeholder="Source url">
                <input type="button" class="upload-editor--image button" value="Upload">
            </div>
            <div class="builder__editor--button-url">
                <label><?php esc_html_e("Alt","yeemail") ?></label>
                <input type="text" class="image_alt" placeholder="Image alt" >
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-button">
            <div class="builder__editor--button">
                <label><?php esc_html_e("Button","yeemail") ?></label>
                <div class="builder__editor--button-text">
                    <label><?php esc_html_e("Button text","yeemail") ?></label>
                    <input type="text" class="button_text" value="Button text">
                </div>
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("Button url","yeemail") ?></label>
                    <input type="text" class="button_url" placeholder="Button url" >
                </div>
                <div class="builder__editor--button-range">
                    <label><?php esc_html_e("Font size","yeemail") ?></label>
                    <input data-after_value="px" type="text" value="16" class="font_size touchspin" min="10" max="30">
                </div>
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-background">
            <?php echo yeemail_builder_editor::get_color_pick(esc_html__("Background color","yeemail")); // phpcs:ignore WordPress.Security.EscapeOutput ?>
            <div class="builder__editor--button-url">
                <label><?php esc_html_e("Background Image","yeemail") ?></label>
                <input type="text" class="image_url" placeholder="Source url">
                <input type="button" class="upload-editor--image button" value="Upload">
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-background_full">
            <label><?php esc_html_e("Enable Background Full Width","yeemail") ?></label>
            <div>
                <label class="yeemail-switch">
                    <input type="checkbox" class="background_full_width" >
                    <span class="yeemail-slider yeemail-round"></span>
                </label>
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-background_responsive">
            <label><?php esc_html_e("Enable Responsive","yeemail") ?></label>
            <div>
                <label class="yeemail-switch">
                    <input type="checkbox" class="background_responsive" >
                    <span class="yeemail-slider yeemail-round"></span>
                </label>
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-color">
            <?php echo yeemail_builder_editor::get_color_pick(esc_html__("Color","yeemail")); // phpcs:ignore WordPress.Security.EscapeOutput ?>
        </div>
        <div class="builder__editor--item builder__editor--item-link_color">
            <?php 
            $post_id = 0;
            $link_color = "#7f54b3";
            if(isset($_GET["post"])){
                $post_id = sanitize_text_field( $_GET["post"] );
                $link_color = get_post_meta( $post_id,'_yeemail_link_color',true);
                if($link_color == ""){
                    $link_color = "#7f54b3";
                }
            }
            echo yeemail_builder_editor::get_color_pick(esc_html__("Link Color","yeemail"),"yeemail_link_color",$link_color,"builder__editor_color_link"); // phpcs:ignore WordPress.Security.EscapeOutput ?>
        </div>
        <div class="builder__editor--item builder__editor--item-menu">
            <div class="builder__editor--item-menu-hidden hidden">
                <ul>
                    <li>
                        <label><?php esc_html_e("Text","yeemail") ?></label>
                        <input type="text" class="text"> 
                    </li>
                    <li>
                        <label><?php esc_html_e("Url","yeemail") ?></label>
                        <input type="text" class="text_url">
                    </li>
                    <li>
                        <label><?php esc_html_e("Background","yeemail") ?></label>
                        <input type="text" class="text_background" value="transparent">
                    </li>
                    <li>
                         <label><?php esc_html_e("Color","yeemail") ?></label>
                            <input type="text" value="#fff" class="text_color"> 
                    </li>
                </ul>
            </div>
           <div class="menu-content-tool">
           </div>
            <a class="yeemail_builder_add_menu button" href="#"><?php esc_html_e("Add menu","yeemail") ?></a>
        </div>
        <div class="builder__editor--item builder__editor--item-social">
            <label><?php esc_html_e("Social","yeemail") ?></label>
            <div class="builder__editor--social-facebook">
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("URL Facebook","yeemail") ?></label>
                    <input type="text" class="social_url" placeholder="URl" >
                </div>
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("Show/ hide","yeemail") ?></label>
                    <label class="yeemail-switch">
                        <input type="checkbox" class="social_show" >
                        <span class="yeemail-slider yeemail-round"></span>
                    </label>
                </div>
            </div>
            <div class="builder__editor--social-twitter">
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("URL Twitter","yeemail") ?></label>
                    <input type="text" class="social_url" placeholder="URl" >
                </div>
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("Show/ hide","yeemail") ?></label>
                    <label class="yeemail-switch">
                        <input type="checkbox" class="social_show" >
                        <span class="yeemail-slider yeemail-round"></span>
                    </label>
                </div>
            </div>
            <div class="builder__editor--social-instagram">
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("URL Instagram","yeemail") ?></label>
                    <input type="text" class="social_url" placeholder="URl" >
                </div>
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("Show/ hide","yeemail") ?></label>
                    <label class="yeemail-switch">
                        <input type="checkbox" class="social_show" >
                        <span class="yeemail-slider yeemail-round"></span>
                    </label>
                </div>
            </div>
            <div class="builder__editor--social-linkedin">
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("URL Linkedin","yeemail") ?></label>
                    <input type="text" class="social_url" placeholder="URl" >
                </div>
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("Show/ hide","yeemail") ?></label>
                    <label class="yeemail-switch">
                        <input type="checkbox" class="social_show" >
                        <span class="yeemail-slider yeemail-round"></span>
                    </label>
                </div>
            </div>
            <div class="builder__editor--social-whatsapp">
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("URL Whatsapp","yeemail") ?></label>
                    <input type="text" class="social_url" placeholder="URl" >
                </div>
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("Show/ hide","yeemail") ?></label>
                    
                    <label class="yeemail-switch">
                    <input type="checkbox" class="social_show" >
                        <span class="yeemail-slider yeemail-round"></span>
                    </label>
                </div>
            </div>
            <div class="builder__editor--social-youtube">
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("URL Whatsapp","yeemail") ?></label>
                    <input type="text" class="social_url" placeholder="URl" >
                </div>
                <div class="builder__editor--button-url">
                    <label><?php esc_html_e("Show/ hide","yeemail") ?></label>
                    <label class="yeemail-switch">
                        <input type="checkbox" class="social_show" >
                        <span class="yeemail-slider yeemail-round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-text-align">
            <label><?php esc_html_e("Text align","yeemail") ?></label>
            <div class="builder__editor--align">
                <a class="button__align builder__editor--align-left" data-value="left"><i class="yeemail_builder-icon icon-align-left"></i></a>
                <a class="button__align builder__editor--align-center" data-value="center"><i class="yeemail_builder-icon icon-align-justify"></i></a>
                <a class="button__align builder__editor--align-right" data-value="right"><i class="yeemail_builder-icon icon-align-right"></i></a>
                <input type="text" value="left" class="text_align hidden">
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-width">
            <div class="builder__editor--padding">
                <div>
                    <label><?php esc_html_e("Width","yeemail") ?></label>
                    <input data-after_value="px" type="text" class="text_width touchspin">
                </div>
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-height">
            <div class="builder__editor--padding">
                <div>
                    <label><?php esc_html_e("Height","yeemail") ?></label>
                    <input data-after_value="px" type="text" class="text_height touchspin">
                </div>
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-padding">
            <label><?php esc_html_e("Padding","yeemail") ?></label>
            <?php echo yeemail_builder_editor::get_padding() ;// phpcs:ignore WordPress.Security.EscapeOutput ?>
        </div>
        <div class="builder__editor--item builder__editor--item-margin">
            <label><?php esc_html_e("Margin","yeemail") ?></label>
            <?php echo yeemail_builder_editor::get_padding() ;// phpcs:ignore WordPress.Security.EscapeOutput ?>
        </div>
        <div class="builder__editor--item builder__editor--item-border">
            <label><?php esc_html_e("Border","yeemail") ?></label>
            <label><?php esc_html_e("Border Width","yeemail") ?></label>
            <div class="builder__editor--item-border-width">
                <?php echo yeemail_builder_editor::get_padding() ;// phpcs:ignore WordPress.Security.EscapeOutput ?>
                <label class="hidden"><?php esc_html_e("Border Style","yeemail") ?></label>
                <input type="text" value="solid" class="border_style hidden">
                <?php echo yeemail_builder_editor::get_color_pick(esc_html__("Border color","yeemail")) ;// phpcs:ignore WordPress.Security.EscapeOutput ?> 
            </div>
            <label><?php esc_html_e("Border radius","yeemail") ?></label>
            <div class="builder__editor--item-border-radius">
                <?php echo yeemail_builder_editor::get_padding() ;// phpcs:ignore WordPress.Security.EscapeOutput ?>
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-conditional_logic">
            <label><?php esc_html_e("Conditional Logic","yeemail") ?></label>
            <div class="builder__editor--item-border-conditional_logic">
                <?php
                $text = '<div class="text-pro">Update to pro version</div>';
                echo apply_filters( "yeemail_contional_logic_settings", $text ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                ?>
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-custom_css">
            <label><?php esc_html_e("Custom CSS","yeemail") ?></label>
            <div class="builder__editor--button-custom_css builder__editor--button-settings">
                    <?php 
                    $custom_css ="";
                    if(isset($_GET["post"])){
                        $post_id = sanitize_text_field( $_GET['post'] );
			            $custom_css = get_post_meta( $post_id,'_custom_css',true); 
                    }
                     ?>
                    <textarea name="custom_css" class="custom_css"><?php echo esc_attr( $custom_css ) ?></textarea>
            </div>
        </div>
        <div class="builder__editor--item builder__editor--item-settings">
            <label><?php esc_html_e("Settings","yeemail") ?></label>
            <div class="builder__editor--button-settings">
                <div class="builder__editor--button-settings-inner">
                    <label><?php esc_html_e("Enable/Disable Templates","yeemail") ?></label>
                    <div class="builder__settings_templates_container">
                        <?php
                            $templates_post = get_posts(array("numberposts"=>-1,"post_type"=>"yeemail_template","meta_key"=>"_mail_template","meta_value"=>"","meta_compare"=>"!="));
                            $woo_active = Yeemail_Settings_Builder_Backend::is_plugin_active("woocommerce");
                            $edd_active = Yeemail_Settings_Builder_Backend::is_plugin_active("edd");
                            foreach ( $templates_post as $post_template ) {
                                $post_template_id = $post_template->ID;
                                $status = get_post_meta( $post_template_id,'_status',true);
                                $mail_type = get_post_meta( $post_template_id,'_mail_type',true);
                                if( !$woo_active && $mail_type == "woocommerce" ){
                                    continue;
                                }
                                if( !$edd_active && $mail_type == "edd" ){
                                    continue;
                                }
                                $enable = false; 
                                if($status == "enable"){
                                    $enable = true;
                                }
                        ?>
                        <div class="builder__settings_templates_item">
                            <div class="builder__settings_templates_item_label">
                                <?php echo esc_html( $post_template->post_title) ?>
                            </div>
                            <div class="builder__settings_templates_item_input">
                                <label class="yeemail-switch">
                                    <input class="yeemail_settings_update yeemail_settings_update-<?php echo esc_attr( $post_template_id ) ?>" <?php checked( $enable ) ?> type="checkbox" value="<?php echo esc_attr( $post_template_id ) ?>">
                                    <span class="yeemail-slider yeemail-round"></span>
                                </label>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $post_id = 0;
            $mail_type = "";
            if(isset($_GET["post"])){
                $post_id = sanitize_text_field( $_GET["post"] );
                $mail_type = get_post_meta( $post_id,'_mail_type',true);
            }
            if($mail_type == "" || $mail_type == "other"){
        ?>
        <div class="builder__editor--item builder__editor--item-addons">
            <label><?php esc_html_e("Add-ons","yeemail") ?></label>
            <div class="builder__editor--button-custom_css builder__editor--button-settings">
                <?php 
                do_action( "yeemail_editor_addons",$post_id) ?>    
            </div>
        </div>
        <?php
            }
    }
}
new yeemail_builder_editor();