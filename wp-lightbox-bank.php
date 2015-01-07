<?php
/*
Plugin Name: Wp Lightbox Bank Standard Edition
Plugin URI: http://tech-banker.com
Description: WP Lightbox Bank is the perfect responsive image lightbox for WordPress galleries.
Author: Tech Banker
Version: 1.1.3
Author URI: http://tech-banker.com
*/

if (!class_exists('Wp_Lightbox_Bank')) {
	class Wp_Lightbox_Bank
	{
		// Silence is golden
	}
}

/////////////////////////////////////  Define  WP Instagam Bank  Constants  ////////////////////////////////////////
if (!defined("WP_LIGHTBOX_BANK_FILE")) define("WP_LIGHTBOX_BANK_FILE","wp-lightbox-bank/wp-lightbox-bank.php");
if (!defined("WP_LIGHTBOX_BANK_BK_PLUGIN_DIR")) define("WP_LIGHTBOX_BANK_BK_PLUGIN_DIR",  plugin_dir_path( __FILE__ ));
if (!defined("WP_LIGHTBOX_BANK_BK_PLUGIN_DIRNAME")) define("WP_LIGHTBOX_BANK_BK_PLUGIN_DIRNAME", plugin_basename(dirname(__FILE__)));
if (!defined("wp_lightbox_bank")) define("wp_lightbox_bank", "wp-lightbox-bank");
if (!defined("tech_bank")) define("tech_bank", "tech-banker");

/////////////////////////////////////  Include Menus on Dashboard ////////////////////////////////////////

if(!function_exists("create_global_menus_for_lightbox"))
{
	function create_global_menus_for_lightbox()
	{
		include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR. "lib/wp-lightbox-bank-menus.php";
	}
}
if(!function_exists("lightbox_admin_panel_css_calls"))
{
	function lightbox_admin_panel_css_calls()
	{
		wp_enqueue_style("lightbox-bank-framework.css", plugins_url("/assets/css/framework.css" , __FILE__));
		wp_enqueue_style("system-message.css", plugins_url("/assets/css/system-message.css" , __FILE__));
		wp_enqueue_style("lightbox-custom.css", plugins_url("/assets/css/lightbox-custom.css" , __FILE__));
	}
}

if(!function_exists("lightbox_admin_panel_js_calls"))
{
	function lightbox_admin_panel_js_calls()
	{
		wp_enqueue_script("jquery");
		wp_enqueue_script("jquery.validate.min.js", plugins_url("/assets/js/jquery.validate.min.js" , __FILE__));
	}
}
/////////////////////////////////////  Call CSS & JS Scripts - Front End ////////////////////////////////////////
if(!function_exists("lightbox_front_end_panel_js_calls"))
{
	function lightbox_front_end_panel_js_calls()
	{
		wp_enqueue_script("jquery");
		wp_enqueue_script("wp-lightbox-bank.js", plugins_url("/assets/js/wp-lightbox-bank.js" , __FILE__));
	}
}

if(!function_exists("lightbox_front_end_panel_css_calls"))
{
	function lightbox_front_end_panel_css_calls()
	{
		wp_enqueue_style("wp-lightbox-bank.css", plugins_url("/assets/css/wp-lightbox-bank.css" , __FILE__));
	}
}
/////////////////////////////////////  Call Install Script on Plugin Activation  ////////////////////////////////////////
 
if(!function_exists("lightbox_plugin_install_script"))
{
	function lightbox_plugin_install_script()
	{
		global $wpdb;
		if (is_multisite())
		{
			$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach($blog_ids as $blog_id)
			{
				switch_to_blog($blog_id);
				if(file_exists(WP_LIGHTBOX_BANK_BK_PLUGIN_DIR. "lib/wp-lightbox-bank-install.php"))
				{
					include WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "lib/wp-lightbox-bank-install.php";
				}
				restore_current_blog();
			}
		}
		else
		{
			if(file_exists(WP_LIGHTBOX_BANK_BK_PLUGIN_DIR. "lib/wp-lightbox-bank-install.php"))
			{
				include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "lib/wp-lightbox-bank-install.php";
			}
		}
	}
}
////////////////////////////////////  Call Uninstall Script on Plugin Uninstall  ////////////////////////////////////////
if(!function_exists("lightbox_plugin_uninstall_script"))
{
	function lightbox_plugin_uninstall_script()
	{
		//include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "/lib/wp-lightbox-bank-uninstall.php";
	}
}

////////////////////////////////////  Action Library for Ajax  ////////////////////////////////////////


if(isset($_REQUEST["action"]))
{
	switch($_REQUEST["action"])
	{
		case "lightbox_settings_library":
		add_action( "admin_init", "lightbox_settings_library");
		if(!function_exists("lightbox_settings_library"))
		{
			function lightbox_settings_library()
			{
				global $wpdb,$current_user,$user_role_permission;
				if(is_super_admin())
				{
					$wp_role = "administrator";
				}
				else
				{
					$wp_role = $wpdb->prefix . "capabilities";
					$current_user->role = array_keys($current_user->$wp_role);
					$wp_role = $current_user->role[0];
				}
				include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "lib/wp-lightbox-bank-settings-class.php";
			}
		}
		break;
	}
}

/////////////////////////////////////  Functions for including frontend scritp  ////////////////////////////////////////
if(!function_exists("add_frontend_script"))
{
	function add_frontend_script()
	{
		include_once(WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "front-views/wp-lightbox-bank-frontend.php");
	}
}

/////////////////////////////////////  Functions for Returing Table Names  ////////////////////////////////////////

function wp_lightbox_bank_settings()
{
	global $wpdb;
	return $wpdb->prefix . "lightbox_bank_settings";
}

/////////////////////////////////////  Function for Admin Bar Menu //////////////////////////////////////////////
if(!function_exists("add_lightbox_bank_icon"))
{
	function add_lightbox_bank_icon($meta = TRUE)
	{
		global $wp_admin_bar,$wpdb,$current_user;
		if(is_super_admin())
		{
			$role = "administrator";
		}
		else
		{
			$role = $wpdb->prefix . "capabilities";
			$current_user->role = array_keys($current_user->$role);
			$role = $current_user->role[0];
		}
		if (!is_user_logged_in()) {
			return;
		}
		
		switch ($role) {
			case "administrator":
				$wp_admin_bar->add_menu(array(
						"id" => "wp_lightbox_bank_links",
						"title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
					 height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />WP Lightbox Bank"),
						"href" => __(site_url() . "/wp-admin/admin.php?page=wp_lightbox_bank"),
				));
				
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_general_settings_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wp_lightbox_bank",
						"title" => __("General Settings", wp_lightbox_bank))
				);
				
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_display_settings_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wplb_display_settings",
						"title" => __("Display Settings", wp_lightbox_bank))
				);
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_system_status_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wplb_system_status",
						"title" => __("System Status", wp_lightbox_bank))
				);
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_recommendation_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wplb_recommendation",
						"title" => __("Recommendations", wp_lightbox_bank))
				);
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_other_services_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wplb_other_services",
						"title" => __("Our Other Services", wp_lightbox_bank))
				);
			break;
			case "editor":
				$wp_admin_bar->add_menu(array(
						"id" => "wp_lightbox_bank_links",
						"title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
					 height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />WP Lightbox Bank"),
						"href" => __(site_url() . "/wp-admin/admin.php?page=wp_lightbox_bank"),
				));
					
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_general_settings_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wp_lightbox_bank",
						"title" => __("General Settings", wp_lightbox_bank))
				);
					
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_display_settings_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wplb_display_settings",
						"title" => __("Display Settings", wp_lightbox_bank))
				);
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_system_status_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wplb_system_status",
						"title" => __("System Status", wp_lightbox_bank))
				);
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_recommendation_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wplb_recommendation",
						"title" => __("Recommendations", wp_lightbox_bank))
				);
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_other_services_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wplb_other_services",
						"title" => __("Our Other Services", wp_lightbox_bank))
				);
			break;
			case "author":
				$wp_admin_bar->add_menu(array(
						"id" => "wp_lightbox_bank_links",
						"title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
					 height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />WP Lightbox Bank"),
						"href" => __(site_url() . "/wp-admin/admin.php?page=wp_lightbox_bank"),
				));
					
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_general_settings_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wp_lightbox_bank",
						"title" => __("General Settings", wp_lightbox_bank))
				);
					
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_display_settings_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wplb_display_settings",
						"title" => __("Display Settings", wp_lightbox_bank))
				);
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_system_status_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wplb_system_status",
						"title" => __("System Status", wp_lightbox_bank))
				);
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_recommendation_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wplb_recommendation",
						"title" => __("Recommendations", wp_lightbox_bank))
				);
				$wp_admin_bar->add_menu(array(
						"parent" => "wp_lightbox_bank_links",
						"id" => "wp_lightbox_bank_other_services_links",
						"href" => site_url() . "/wp-admin/admin.php?page=wplb_other_services",
						"title" => __("Our Other Services", wp_lightbox_bank))
				);
			break;
		}
	}
}
//--------------------------------------------------------------------------------------------------------------//
// CODE FOR PLUGIN UPDATE MESSAGE
//--------------------------------------------------------------------------------------------------------------//
if(!function_exists("lightbox_bank_plugin_update_message"))
{
	function lightbox_bank_plugin_update_message($args)
	{
		$response = wp_remote_get( 'https://plugins.svn.wordpress.org/wp-lightbox-bank/trunk/readme.txt' );
		if ( ! is_wp_error( $response ) && ! empty( $response['body'] ) )
		{
			// Output Upgrade Notice
			$matches        = null;
			$regexp         = '~==\s*Changelog\s*==\s*=\s*[0-9.]+\s*=(.*)(=\s*' . preg_quote($args['Version']) . '\s*=|$)~Uis';
			$upgrade_notice = '';
			if ( preg_match( $regexp, $response['body'], $matches ) ) {
				$changelog = (array) preg_split('~[\r\n]+~', trim($matches[1]));
				$upgrade_notice .= '<div class="framework_plugin_message">';
				foreach ( $changelog as $index => $line ) {
					$upgrade_notice .= "<p>".$line."</p>";
				}
				$upgrade_notice .= '</div> ';
				echo $upgrade_notice;
			}
		}
	}
}
///////////////////////////////////  Call Hooks   //////////////////////////////////////////////////////////////

add_action("admin_init", "lightbox_admin_panel_css_calls");
add_action("admin_init", "lightbox_admin_panel_js_calls");
add_action("wp_head", "lightbox_front_end_panel_css_calls");
add_action("wp_head", "lightbox_front_end_panel_js_calls");
add_action("wp_head", "add_frontend_script");
add_action("in_plugin_update_message-".WP_LIGHTBOX_BANK_FILE,"lightbox_bank_plugin_update_message" );
register_activation_hook(__FILE__, "lightbox_plugin_install_script");
register_uninstall_hook(__FILE__, "lightbox_plugin_uninstall_script");
add_action("admin_menu", "create_global_menus_for_lightbox");
add_action("admin_bar_menu", "add_lightbox_bank_icon", 100);
add_action( "network_admin_menu", "create_global_menus_for_lightbox" );
?>