<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action("yeemail_builder_tab_block","yeemail_builder_block_image",30);
function yeemail_builder_block_image(){
	?>
	<li>
		<div class="momongaDraggable" data-type="image">
            <i class="yeemail_builder-icon icon-picture"></i>
            <div class="yeemail-tool-text"><?php esc_html_e("Image","yeemail") ?></div>
        </div>
    </li>
	<?php
}
add_action( 'yeemail_builder_block_html', "yeemail_builder_block_image_load" );
function yeemail_builder_block_image_load($type){
    $type["block"]["image"]["builder"] = '
<div class="builder-elements" >
    <div class="builder-elements-content builder-elements-content-img" data-type="image">
        <img style="width:150px;height:39px;" src="'.YEEMAIL_PLUGIN_URL.'images/your-image.png" alt="">
    </div>
</div>';
    //Show editor
    $type["block"]["image"]["editor"]["container"]["show"]= ["padding","image","text-align","width","height","conditional_logic"];
    //Style container
    $container_style = array(
            ".builder__editor--item-background .builder__editor_color"=>"background-color",
            ".builder__editor--item-background .image_url"=>"background-image",
        );
    $text_align = yeemail_builder_global_data::$text_align;
    $padding = yeemail_builder_global_data::$padding;
    $border = yeemail_builder_global_data::$border;
    $inner_style = array(
            ".builder__editor--item-background .builder__editor_color"=>"background-color",
            ".builder__editor--item-width .text_width"=>"width",
            ".builder__editor--item-height .text_height"=>"height",
        );
    $type["block"]["image"]["editor"]["container"]["style"]= array_merge($padding,$text_align);
    $type["block"]["image"]["editor"]["inner"]["style"]=["img" => array_merge($border,$inner_style)];
    $type["block"]["image"]["editor"]["inner"]["attr"]= ["img"=>[
        ".builder__editor--item-image .image_url"=>"src",
        ".builder__editor--item-image .image_alt"=>"alt"]];
    return $type;
}