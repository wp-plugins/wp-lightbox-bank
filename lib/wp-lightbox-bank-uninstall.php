<?php
global $wpdb;
$sql = "DROP TABLE " . wp_lightbox_bank_settings();
$wpdb->query($sql);
?>