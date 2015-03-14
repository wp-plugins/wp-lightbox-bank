<?php
global $wpdb,$current_user;
if (!is_user_logged_in()) {
	return;
}

$sql = "DROP TABLE " . wp_lightbox_bank_settings();
$wpdb->query($sql);
?>