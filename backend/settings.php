<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Yeemail_Email_Settings {
	function __construct() { 
		 //add_action( 'admin_menu', array( $this, 'add_plugin_page' ) ); 
	}
	function add_plugin_page(){
		add_submenu_page('edit.php?post_type=yeemail_template','Settings', 'Settings', 'manage_options','yeemail-builder-settings', array($this,'settings_page')  );
		add_action( 'admin_init', array($this,'register_settings') );
	}
	function render_select($value = "",$templates = array()){
		?>
		<option><?php esc_html_e("Default","yeemail") ?></option>
		<?php
		foreach( $templates as $id => $template ){
			?>
			<option <?php selected($id,$value) ?>  value="<?php echo esc_attr($id) ?>"><?php echo esc_html( $template )?></option>
			<?php
		}
	}
	function settings_page(){
		$setings = get_option("yeemail_settings");
		if(isset($setings["default"])){
			$default = $setings["default"]; 
		}else{
			$default = "";
		}
		if(isset($setings["width"])){
			$width = $setings["width"]; 
		}else{
			$width = "640";
		}
		$template_list = get_posts( array("post_type"=>"yeemail_template","numberposts"=>-1) );
		$templates = array();
		foreach ( $template_list as $post ) {
			$post_id = $post->ID;
		   $templates[ $post_id ] = $post->post_title;
		}
		?>
		<div class="wrap">
		<h1><?php esc_html_e("Default Email Template ","yeemail_builder") ?></h1>
		<form method="post" action="options.php">
		    <?php settings_fields( 'yeemail_settings' ); ?>
		    <?php do_settings_sections( 'yeemail_settings' ); ?>
		    <table class="form-table">
		        <tr valign="top">
			        <th scope="row"><?php esc_html_e("Default Email Template","yeemail_builder") ?></th>
			        <td>
		        		<select name="yeemail_settings[default]">
		        			<?php 
		        			$this->render_select($default,$templates);
		        			?>
		        		</select>
		        		<?php esc_html_e("Applies to all emails","yeemail") ?>
			        </td>
		        </tr>
				<tr valign="top">
			        <th scope="row"><?php esc_html_e("Email Width","yeemail_builder") ?></th>
			        <td>
		        		<input type="number" class="small-text" name="yeemail_settings[width]" value="<?php echo esc_attr( $width ) ?>" />
		        		<?php esc_html_e("PX","yeemail") ?>
			        </td>
		        </tr>
		        <tr valign="top">
			        <th scope="row"><?php esc_html_e("Custom WP Email","yeemail") ?></th>
			        <td><hr>
			        </td>
			    </tr>
			    <tr valign="top">
			        <th scope="row"><?php esc_html_e("New User Notification Email","yeemail") ?></th>
			        <td>
			        	<select name="yeemail_settings[new_user_notification]">
		        			<?php
		        			if(isset($setings["new_user_notification"])){
		        				$new_user_notification = $setings["new_user_notification"];
		        			}else{
		        				$new_user_notification = "";
		        			} 
		        			$this->render_select($new_user_notification,$templates);
		        			?>
		        		</select>
			        </td>
			    </tr>
				<tr valign="top">
			        <th scope="row"><?php esc_html_e("Password Reset Email","yeemail") ?></th>
			        <td>
			        	<select name="yeemail_settings[password_rest]">
		        			<?php
		        			if(isset($setings["password_rest"])){
		        				$password_change_admin = $setings["password_rest"];
		        			}else{
		        				$password_change_admin = "";
		        			} 
		        			$this->render_select($password_change_admin,$templates);
		        			?>
		        		</select>
			        </td>
			    </tr>
			    <tr valign="top">
			        <th scope="row"><?php esc_html_e("New user notification email admin","yeemail") ?></th>
			        <td>
			        	<select name="yeemail_settings[new_user_notification_admin]">
		        			<?php
		        			if(isset($setings["new_user_notification_admin"])){
		        				$new_user_notification_admin = $setings["new_user_notification_admin"];
		        			}else{
		        				$new_user_notification_admin = "";
		        			} 
		        			$this->render_select($new_user_notification_admin,$templates);
		        			?>
		        		</select>
			        </td>
			    </tr>
			    <tr valign="top">
			        <th scope="row"><?php esc_html_e("Password change notification to the user","yeemail") ?></th>
			        <td>
			        	<select name="yeemail_settings[password_change]">
		        			<?php
		        			if(isset($setings["password_change"])){
		        				$password_change = $setings["password_change"];
		        			}else{
		        				$password_change = "";
		        			} 
		        			$this->render_select($password_change,$templates);
		        			?>
		        		</select>
			        </td>
			    </tr>
			    <tr valign="top">
			        <th scope="row"><?php esc_html_e("Password change notification to the admin","yeemail") ?></th>
			        <td>
			        	<select name="yeemail_settings[password_change_admin]">
		        			<?php
		        			if(isset($setings["password_change_admin"])){
		        				$password_change_admin = $setings["password_change_admin"];
		        			}else{
		        				$password_change_admin = "";
		        			} 
		        			$this->render_select($password_change_admin,$templates);
		        			?>
		        		</select>
			        </td>
			    </tr>
			    <tr valign="top">
			        <th scope="row"><?php esc_html_e("Comment notification","yeemail") ?></th>
			        <td>
			        	<select name="yeemail_settings[comment_notification]">
		        			<?php
		        			if(isset($setings["comment_notification"])){
		        				$comment_notification = $setings["comment_notification"];
		        			}else{
		        				$comment_notification = "";
		        			} 
		        			$this->render_select($comment_notification,$templates);
		        			?>
		        		</select>
			        </td>
			    </tr>
			    <tr valign="top">
			        <th scope="row"><?php esc_html_e("Modify the comment","yeemail") ?></th>
			        <td>
			        	<select name="yeemail_settings[modify_comment]">
		        			<?php
		        			if(isset($setings["modify_comment"])){
		        				$modify_comment = $setings["modify_comment"];
		        			}else{
		        				$modify_comment = "";
		        			} 
		        			$this->render_select($modify_comment,$templates);
		        			?>
		        		</select>
			        </td>
			    </tr>
			    <?php 
			    	/**
					 * Check if WooCommerce is active
					 **/
					if ( 
					  in_array( 
					    'woocommerce/woocommerce.php', 
					    apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) 
					  ) 
					) {
					    ?>
				<tr valign="top">
			        <th scope="row"><?php esc_html_e("WooCommerce","yeemail") ?></th>
			        <td><hr>
			        </td>
			    </tr>
				<tr valign="top">
			     	<th scope="row"><?php esc_html_e("New Order","yeemail") ?></th>
			        <td>
			        	<select name="yeemail_settings[new_order]">
		        			<?php
		        			if(isset($setings["new_order"])){
		        				$new_order = $setings["new_order"];
		        			}else{
		        				$new_order = "";
		        			} 
		        			$this->render_select($new_order,$templates);
		        			?>
		        		</select>
			        </td>
			    </tr>  
					    <?php
					}
			    ?>
		    </table>
		    <?php submit_button(); ?>
		</form>
		</div>
		<?php
	}
	function register_settings(){
		register_setting( 'yeemail_settings', 'yeemail_settings' );
	}
}
new Yeemail_Email_Settings;