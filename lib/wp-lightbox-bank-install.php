<?php
global $wpdb;
require_once(ABSPATH . "wp-admin/includes/upgrade.php");
$lightbox_version = get_option("lightbox-bank-pro-edition");
if(!function_exists("create_table_lightbox_settings"))
{
	function create_table_lightbox_settings()
	{
		global $wpdb;
		$sql = "CREATE TABLE " . wp_lightbox_bank_settings() . "(
			setting_id INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
			setting_key VARCHAR(100) NOT NULL,
			setting_value TEXT NOT NULL,
			PRIMARY KEY (setting_id)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE utf8_general_ci";
		dbDelta($sql);

		include (WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "/lib/include-lightbox-bank-settings.php");
	}
}

if (count($wpdb->get_var("SHOW TABLES LIKE '" . wp_lightbox_bank_settings() . "'")) == 0)
{
	create_table_lightbox_settings();
}

if($lightbox_version == "")
{
	update_option("lightbox-bank-automatic-update", "1");
	update_option("lightbox-bank-pro-edition", "1.0");
}
?>