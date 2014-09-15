<?php
global $wpdb;
$lightbox_settings = $wpdb->get_results
(
	"SELECT * FROM " . wp_lightbox_bank_settings() 
);

if (count($lightbox_settings) != 0) 
{
	$lightbox_settings_keys = array();
	for ($flag = 0; $flag < count($lightbox_settings); $flag++) {
		array_push($lightbox_settings_keys, $lightbox_settings[$flag]->setting_key);
	}
	
	$index = array_search("wp_galleries", $lightbox_settings_keys);
	$wp_galleries = intval($lightbox_settings[$index]->setting_value);
	
	$index = array_search("wp_caption_image", $lightbox_settings_keys);
	$wp_caption_image= intval($lightbox_settings[$index]->setting_value);
	
	$index = array_search("attachment_image", $lightbox_settings_keys);
	$attachment_image= intval($lightbox_settings[$index]->setting_value);
	
	$index = array_search("fit_to_screen", $lightbox_settings_keys);
	$fit_to_screen= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("overlay_click", $lightbox_settings_keys);
	$overlay_click= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("error_message", $lightbox_settings_keys);
	$error_message= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("show_thumbnail", $lightbox_settings_keys);
	$show_thumbnail= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("lightbox_autoplay", $lightbox_settings_keys);
	$lightbox_autoplay= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("image_title", $lightbox_settings_keys);
	$image_title= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("image_caption", $lightbox_settings_keys);
	$image_caption= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("image_caption_position", $lightbox_settings_keys);
	$image_caption_position= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("video_title", $lightbox_settings_keys);
	$video_title= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("video_caption", $lightbox_settings_keys);
	$video_caption= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("video_caption_position", $lightbox_settings_keys);
	$video_caption_position= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("text_align", $lightbox_settings_keys);
	$text_align= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("title_font_size", $lightbox_settings_keys);
	$heading_size= intval($lightbox_settings[$index]->setting_value);
	
	$index = array_search("title_font_weight", $lightbox_settings_keys);
	$title_font_weight= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("title_font_family", $lightbox_settings_keys);
	$title_font_family = $lightbox_settings[$index]->setting_value;
	
	$index = array_search("title_font_style", $lightbox_settings_keys);
	$title_font_style = $lightbox_settings[$index]->setting_value;
	
	$index = array_search("caption_font_size", $lightbox_settings_keys);
	$text_size= intval($lightbox_settings[$index]->setting_value);
	
	$index = array_search("caption_font_weight", $lightbox_settings_keys);
	$caption_font_weight= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("caption_font_family", $lightbox_settings_keys);
	$caption_font_family = $lightbox_settings[$index]->setting_value;
	
	$index = array_search("caption_font_style", $lightbox_settings_keys);
	$caption_font_style = $lightbox_settings[$index]->setting_value;
	
	$index = array_search("social_icons", $lightbox_settings_keys);
	$social_icons= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("social_icons_position", $lightbox_settings_keys);
	$social_icons_position= $lightbox_settings[$index]->setting_value;
	
	$index = array_search("icons_alignment", $lightbox_settings_keys);
	$icons_alignment = $lightbox_settings[$index]->setting_value;
	
	$index = array_search("language_direction", $lightbox_settings_keys);
	$language_direction = $lightbox_settings[$index]->setting_value;
	
	$index = array_search("disable_other_lightbox", $lightbox_settings_keys);
	$disable_other_lightbox= $lightbox_settings[$index]->setting_value;
	
}
?>