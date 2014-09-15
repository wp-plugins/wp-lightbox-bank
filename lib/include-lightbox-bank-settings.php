<?php
$lightbox_settings = array();

$lightbox_settings["wp_galleries"] = "1";
$lightbox_settings["wp_caption_image"] = "1";
$lightbox_settings["attachment_image"] = "1";
$lightbox_settings["overlay_click"] = "true";
$lightbox_settings["error_message"] = "Could not load the item. Make sure the path is correct and item exist.";
$lightbox_settings["show_thumbnail"] = "false";
$lightbox_settings["lightbox_autoplay"] = "false";
$lightbox_settings["image_title"] = "true";
$lightbox_settings["image_caption"] = "true";
$lightbox_settings["text_align"] = "center";
$lightbox_settings["title_font_size"] = "16";
$lightbox_settings["title_font_weight"] = "500";
$lightbox_settings["title_font_family"] = "Verdana";
$lightbox_settings["title_font_style"] = "normal";
$lightbox_settings["caption_font_size"] = "12";
$lightbox_settings["caption_font_weight"] = "500";
$lightbox_settings["caption_font_family"] = "Verdana";
$lightbox_settings["caption_font_style"] = "normal";
$lightbox_settings["social_icons"] = "true";
$lightbox_settings["social_icons_position"] = "bottom";
$lightbox_settings["icons_alignment"] = "right";
$lightbox_settings["language_direction"] = "ltr";
$lightbox_settings["disable_other_lightbox"] = "true";

foreach ($lightbox_settings as $val => $innerKey)
{
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO " . wp_lightbox_bank_settings() . " (setting_key, setting_value) VALUES(%s, %s)",
			$val,
			$innerKey
		)
	);
}
?>