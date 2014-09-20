<?php
//--------------------------------------------------------------------------------------------------------------//
// CODE FOR CREATING MENUS
//---------------------------------------------------------------------------------------------------------------//
global $wpdb,$current_user;
$lightbox_role = $wpdb->prefix . "capabilities";
$current_user->role = array_keys($current_user->$lightbox_role );
$lightbox_role = $current_user->role[0];
switch($lightbox_role)
{
	case "administrator":
		add_menu_page("WP Lightbox Bank", __("WP Lightbox Bank", wp_lightbox_bank), "read", "wp_lightbox_bank", "", plugins_url("/assets/images/icon.png" , dirname(__FILE__)));
		add_submenu_page("wp_lightbox_bank", "General Settings", __("General Settings", wp_lightbox_bank), "read", "wp_lightbox_bank", "wp_lightbox_bank");
		add_submenu_page("wp_lightbox_bank", "Display Settings", __("Display Settings", wp_lightbox_bank), "read", "wplb_display_settings", "wplb_display_settings");
		add_submenu_page("wp_lightbox_bank", "System Status", __("System Status", wp_lightbox_bank), "read", "wplb_system_status", "wplb_system_status");
	break;
	case "editor":
		add_menu_page("WP Lightbox Bank", __("WP Lightbox Bank", wp_lightbox_bank), "read", "light_box", "", plugins_url("/assets/images/icon.png" , dirname(__FILE__)));
		add_submenu_page("wp_lightbox_bank", "General Settings", __("General Settings", wp_lightbox_bank), "read", "wp_lightbox_bank", "wp_lightbox_bank");
		add_submenu_page("wp_lightbox_bank", "Display Settings", __("Display Settings", wp_lightbox_bank), "read", "wplb_display_settings", "wplb_display_settings");
		add_submenu_page("wp_lightbox_bank", "System Status", __("System Status", wp_lightbox_bank), "read", "wplb_system_status", "wplb_system_status");
	break;
	case "author":
		add_menu_page("WP Lightbox Bank", __("WP Lightbox Bank", wp_lightbox_bank), "read", "wp_lightbox_bank", "", plugins_url("/assets/images/icon.png" , dirname(__FILE__)));
		add_submenu_page("wp_lightbox_bank", "General Settings", __("General Settings", wp_lightbox_bank), "read", "wp_lightbox_bank", "wp_lightbox_bank");
		add_submenu_page("wp_lightbox_bank", "Display Settings", __("Display Settings", wp_lightbox_bank), "read", "wplb_display_settings", "wplb_display_settings");
		add_submenu_page("wp_lightbox_bank", "System Status", __("System Status", wp_lightbox_bank), "read", "wplb_system_status", "wplb_system_status");
	break;
}

//--------------------------------------------------------------------------------------------------------------//
// CODE FOR CREATING PAGES
//---------------------------------------------------------------------------------------------------------------//


function wp_lightbox_bank()
{
	global $wpdb,$current_user,$user_role_permission;
	$wplb_role = $wpdb->prefix . "capabilities";
	$current_user->role = array_keys($current_user->$wplb_role);
	$wplb_role = $current_user->role[0];
	include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-header.php";
	include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-settings.php";
}

function wplb_system_status()
{
	global $wpdb,$current_user,$user_role_permission,$wp_version;
	$wplb_role = $wpdb->prefix . "capabilities";
	$current_user->role = array_keys($current_user->$wplb_role);
	$wplb_role = $current_user->role[0];
	include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-header.php";
	include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-system-status.php";
}

function wplb_display_settings()
{
	global $wpdb,$current_user,$user_role_permission,$wp_version;
	$wplb_role = $wpdb->prefix . "capabilities";
	$current_user->role = array_keys($current_user->$wplb_role);
	$wplb_role = $current_user->role[0];
	include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-header.php";
	include_once WP_LIGHTBOX_BANK_BK_PLUGIN_DIR."views/wp-lightbox-bank-display-settings.php";
}
?>