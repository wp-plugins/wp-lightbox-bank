<?php
//--------------------------------------------------------------------------------------------------------------//
// CODE FOR CREATING MENUS
//---------------------------------------------------------------------------------------------------------------//
global $wpdb,$current_user;
$role = $wpdb->prefix . "capabilities";
$current_user->role = array_keys($current_user->$role );
$role = $current_user->role[0];
switch($role)
{
	case "administrator":
		add_menu_page("WP Lightbox Bank", __("WP Lightbox Bank", wp_lightbox_bank), "read", "wp_lightbox_bank", "", plugins_url("/assets/images/icon.png" , dirname(__FILE__)));
		add_submenu_page("wp_lightbox_bank", "General Settings", __("General Settings", wp_lightbox_bank), "read", "wp_lightbox_bank", "wp_lightbox_bank");
		add_submenu_page("wp_lightbox_bank", "Display Settings", __("Display Settings", wp_lightbox_bank), "read", "wplb_display_settings", "wplb_display_settings");
		add_submenu_page("wp_lightbox_bank", "System Status", __("System Status", wp_lightbox_bank), "read", "wplb_system_status", "wplb_system_status");
		add_submenu_page("wp_lightbox_bank", "Recommendations", __("Recommendations", wp_lightbox_bank), "read", "wplb_recommendation", "wplb_recommendation");
		add_submenu_page("wp_lightbox_bank", "Our Other Services", __("Our Other Services", wp_lightbox_bank), "read", "wplb_other_services", "wplb_other_services");
	break;
	case "editor":
		add_menu_page("WP Lightbox Bank", __("WP Lightbox Bank", wp_lightbox_bank), "read", "light_box", "", plugins_url("/assets/images/icon.png" , dirname(__FILE__)));
		add_submenu_page("wp_lightbox_bank", "General Settings", __("General Settings", wp_lightbox_bank), "read", "wp_lightbox_bank", "wp_lightbox_bank");
		add_submenu_page("wp_lightbox_bank", "Display Settings", __("Display Settings", wp_lightbox_bank), "read", "wplb_display_settings", "wplb_display_settings");
		add_submenu_page("wp_lightbox_bank", "System Status", __("System Status", wp_lightbox_bank), "read", "wplb_system_status", "wplb_system_status");
		add_submenu_page("wp_lightbox_bank", "Recommendations", __("Recommendations", wp_lightbox_bank), "read", "wplb_recommendation", "wplb_recommendation");
		add_submenu_page("wp_lightbox_bank", "Our Other Services", __("Our Other Services", wp_lightbox_bank), "read", "wplb_other_services", "wplb_other_services");
	break;
	case "author":
		add_menu_page("WP Lightbox Bank", __("WP Lightbox Bank", wp_lightbox_bank), "read", "wp_lightbox_bank", "", plugins_url("/assets/images/icon.png" , dirname(__FILE__)));
		add_submenu_page("wp_lightbox_bank", "General Settings", __("General Settings", wp_lightbox_bank), "read", "wp_lightbox_bank", "wp_lightbox_bank");
		add_submenu_page("wp_lightbox_bank", "Display Settings", __("Display Settings", wp_lightbox_bank), "read", "wplb_display_settings", "wplb_display_settings");
		add_submenu_page("wp_lightbox_bank", "System Status", __("System Status", wp_lightbox_bank), "read", "wplb_system_status", "wplb_system_status");
		add_submenu_page("wp_lightbox_bank", "Recommendations", __("Recommendations", wp_lightbox_bank), "read", "wplb_recommendation", "wplb_recommendation");
		add_submenu_page("wp_lightbox_bank", "Our Other Services", __("Our Other Services", wp_lightbox_bank), "read", "wplb_other_services", "wplb_other_services");
	break;
}

//--------------------------------------------------------------------------------------------------------------//
// CODE FOR CREATING PAGES
//---------------------------------------------------------------------------------------------------------------//

if(!function_exists("wp_lightbox_bank"))
{
	function wp_lightbox_bank()
	{
		global $wpdb,$current_user,$user_role_permission;
		$role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$role);
		$role = $current_user->role[0];
		include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-header.php";
		include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-settings.php";
	}
}
if(!function_exists("wplb_system_status"))
{
	function wplb_system_status()
	{
		global $wpdb,$current_user,$user_role_permission,$wp_version;
		$role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$role);
		$role = $current_user->role[0];
		include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-header.php";
		include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-system-status.php";
	}
}
if(!function_exists("wplb_display_settings"))
{
	function wplb_display_settings()
	{
		global $wpdb,$current_user,$user_role_permission,$wp_version;
		$role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$role);
		$role = $current_user->role[0];
		include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-header.php";
		include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-display-settings.php";
	}
}
if(!function_exists("wplb_recommendation"))
{
	function wplb_recommendation()
	{
		global $wpdb,$current_user,$user_role_permission,$wp_version;
		$role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$role);
		$role = $current_user->role[0];
		include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-header.php";
		include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/recommended-plugins.php";
	}
}
if(!function_exists("wplb_other_services"))
{
	function wplb_other_services()
	{
		global $wpdb,$current_user,$user_role_permission,$wp_version;
		$role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$role);
		$role = $current_user->role[0];
		include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-header.php";
		include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/other-services.php";
	}
}
?>