<?php
global $wpdb;
require_once(ABSPATH . "wp-admin/includes/upgrade.php");
if (count($wpdb->get_var("SHOW TABLES LIKE '" . wp_lightbox_bank_settings() . "'")) == 0)
{
	create_table_lightbox_settings();
}
function create_table_lightbox_settings()
{
	global $wpdb;
	$sql = "CREATE TABLE " . wp_lightbox_bank_settings() . "(
		setting_id INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		setting_key VARCHAR(100) NOT NULL,
		setting_value TEXT NOT NULL,
		PRIMARY KEY (setting_id)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE utf8_general_ci";
	dbDelta($sql);

	include_once (WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "/lib/include-lightbox-bank-settings.php");
}
?>