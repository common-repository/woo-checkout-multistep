<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action( 'yeemail_builder_block_html', "yeemail_builder_block_main_load" );
function yeemail_builder_block_main_load($type) {
	$type["block"]["main"]["editor"]["container"]["show"]= ["background","color","link_color","padding","setting_width","custom_css","settings","addons"];
    $padding = yeemail_builder_global_data::$padding;
    $boder = yeemail_builder_global_data::$border;
    $settings = array_merge($padding,$boder);
    $type["block"]["main"]["editor"]["container"]["style"]= array_merge($padding,array(
                ".builder__editor--item-background .builder__editor_color"=>"background-color",
                ".builder__editor--item-color .builder__editor_color"=>"color",
            ));
	return $type;
}
class yeemail_builder_global_data {
    public static $padding = array(
        ".builder__editor--padding .builder__editor--padding-top"=>"padding-top",
        ".builder__editor--padding .builder__editor--padding-bottom"=>"padding-bottom",
        ".builder__editor--padding .builder__editor--padding-left"=>"padding-left",
        ".builder__editor--padding .builder__editor--padding-right"=>"padding-right",
    );
    public static $margin = array(
        ".builder__editor--margin .builder__editor--padding-top"=>"margin-top",
        ".builder__editor--margin .builder__editor--padding-bottom"=>"margin-bottom",
        ".builder__editor--margin .builder__editor--padding-left"=>"margin-left",
        ".builder__editor--margin .builder__editor--padding-right"=>"margin-right",
    );
    public static $text_align = array(
        ".builder__editor--item-text-align .text_align"=>"text-align"
    );
    public static $border = array(
        ".builder__editor--item-border-width .builder__editor--padding-top"=>"border-top-width",
        ".builder__editor--item-border-width .builder__editor--padding-bottom"=>"border-bottom-width",
        ".builder__editor--item-border-width .builder__editor--padding-left"=>"border-left-width",
        ".builder__editor--item-border-width .builder__editor--padding-right"=>"border-right-width",
        ".builder__editor--item-border-width .border_style"=>"border-style",
        ".builder__editor--item-border-width .builder__editor_color"=>"border-color",
        ".builder__editor--item-border-radius .builder__editor--padding-top"=>"border-top-left-radius",
        ".builder__editor--item-border-radius .builder__editor--padding-bottom"=>"border-bottom-right-radius",
        ".builder__editor--item-border-radius .builder__editor--padding-left"=>"border-bottom-left-radius",
        ".builder__editor--item-border-radius .builder__editor--padding-right"=>"border-top-right-radius",
    );
}