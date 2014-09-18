<?php
/*
Plugin Name: Wp Lightbox Bank
Plugin URI: http://tech-banker.com
Description: WP Lightbox Bank is the perfect responsive image lightbox for WordPress galleries.
Author: Tech Banker
Version: 1.0
Author URI: http://tech-banker.com
*/

if (!class_exists('Wp_Lightbox_Bank')) {
	class Wp_Lightbox_Bank
	{
		// Silence is golden
	}
}

/////////////////////////////////////  Define  WP Instagam Bank  Constants  ////////////////////////////////////////
if (!defined("WP_LIGHTBOX_BANK_BK_PLUGIN_DIR")) define("WP_LIGHTBOX_BANK_BK_PLUGIN_DIR",  plugin_dir_path( __FILE__ ));
if (!defined("WP_LIGHTBOX_BANK_BK_PLUGIN_DIRNAME")) define("WP_LIGHTBOX_BANK_BK_PLUGIN_DIRNAME", plugin_basename(dirname(__FILE__)));
if (!defined("wp_lightbox_bank")) define("wp_lightbox_bank", "wp-lightbox-bank");

/////////////////////////////////////  Include Menus on Dashboard ////////////////////////////////////////

function create_global_menus_for_lightbox()
{
	include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR. "lib/wp-lightbox-bank-menus.php";
}

function lightbox_admin_panel_css_calls()
{
	wp_enqueue_style("framework.css", plugins_url("/assets/css/framework.css" , __FILE__));
	wp_enqueue_style("system-message.css", plugins_url("/assets/css/system-message.css" , __FILE__));
	wp_enqueue_style("lightbox-custom.css", plugins_url("/assets/css/lightbox-custom.css" , __FILE__));
}

function lightbox_admin_panel_js_calls()
{
	wp_enqueue_script("jquery");
	wp_enqueue_script("jquery.validate.min.js", plugins_url("/assets/js/jquery.validate.min.js" , __FILE__));
}

/////////////////////////////////////  Call CSS & JS Scripts - Front End ////////////////////////////////////////

function lightbox_front_end_panel_js_calls()
{
	wp_enqueue_script("jquery");
	wp_enqueue_script("wp-lightbox-bank.js", plugins_url("/assets/js/wp-lightbox-bank.js" , __FILE__));
}

function lightbox_front_end_panel_css_calls()
{
	wp_enqueue_style("wp-lightbox-bank.css", plugins_url("/assets/css/wp-lightbox-bank.css" , __FILE__));
}

/////////////////////////////////////  Call Install Script on Plugin Activation  ////////////////////////////////////////
 
 
function lightbox_plugin_install_script()
{
	include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "lib/wp-lightbox-bank-install.php";
}

////////////////////////////////////  Call Uninstall Script on Plugin Uninstall  ////////////////////////////////////////

function lightbox_plugin_uninstall_script()
{
	//include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "/lib/wp-lightbox-bank-uninstall.php";
}

////////////////////////////////////  Action Library for Ajax  ////////////////////////////////////////


if(isset($_REQUEST["action"]))
{
	switch($_REQUEST["action"])
	{
		case "lightbox_settings_library":
		add_action( "admin_init", "lightbox_settings_library");
		function lightbox_settings_library()
		{
			global $wpdb,$current_user,$user_role_permission;
			$wp_role = $wpdb->prefix . "capabilities";
			$current_user->role = array_keys($current_user->$wp_role);
			$wp_role = $current_user->role[0];
			include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "lib/wp-lightbox-bank-settings-class.php";
		}
		break;
	}
}

/////////////////////////////////////  Functions for including frontend scritp  ////////////////////////////////////////

function add_frontend_script()
{
	include_once(WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "front-views/wp-lightbox-bank-frontend.php");
}

/////////////////////////////////////  Functions for Returing Table Names  ////////////////////////////////////////

function wp_lightbox_bank_settings()
{
	global $wpdb;
	return $wpdb->prefix . "lightbox_bank_settings";
}

/////////////////////////////////////  Function for Admin Bar Menu //////////////////////////////////////////////

function add_lightbox_bank_icon($meta = TRUE)
{
	global $wp_admin_bar,$wpdb,$current_user;
	$wplb_role = $wpdb->prefix . "capabilities";
	$current_user->role = array_keys($current_user->$wplb_role);
	$wplb_role = $current_user->role[0];
	if (!is_user_logged_in()) {
		return;
	}
	
	switch ($wplb_role) {
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
		break;
	}
}


///////////////////////////////////  Call Hooks   //////////////////////////////////////////////////////////////

add_action("admin_init", "lightbox_admin_panel_css_calls");
add_action("admin_init", "lightbox_admin_panel_js_calls");
add_action("wp_head", "lightbox_front_end_panel_css_calls");
add_action("wp_head", "lightbox_front_end_panel_js_calls");
add_action("wp_head", "add_frontend_script");
register_activation_hook(__FILE__, "lightbox_plugin_install_script");
register_uninstall_hook(__FILE__, "lightbox_plugin_uninstall_script");
add_action("admin_menu", "create_global_menus_for_lightbox");
add_action("admin_bar_menu", "add_lightbox_bank_icon", 100);
?>