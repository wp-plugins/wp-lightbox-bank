<?php
switch($wp_role)
{
	case "administrator":
		$user_role_permission = "manage_options";
	break;
	case "editor":
		$user_role_permission = "publish_pages";
	break;
	case "author":
		$user_role_permission = "publish_posts";
	break;
}

if (!current_user_can($user_role_permission))
{
	return;
}
else
{ 
	if(isset($_REQUEST["param"]))
	{
		if($_REQUEST["param"] == "update_lightbox_settings")
		{
			$lightbox_setting_array = array();
			$lightbox_setting_array["wp_galleries"] = isset($_REQUEST["ux_chk_galleries"]) ? "1" :"0" ;
			$lightbox_setting_array["wp_caption_image"] = isset($_REQUEST["ux_chk_imagecaption"]) ? "1" : "0";
			$lightbox_setting_array["attachment_image"]= isset($_REQUEST["ux_chk_attachmentimage"]) ? "1" : "0";
			$lightbox_setting_array["overlay_click"]= isset($_REQUEST["ux_chk_overlayclick"]) ? "true" : "false";
			$lightbox_setting_array["error_message"] = stripslashes(esc_attr($_REQUEST["ux_cb_errormsg"]));
			$lightbox_setting_array["language_direction"] = esc_attr($_REQUEST["ux_rdl_enablelanguage"]);
			$lightbox_setting_array["disable_other_lightbox"] = isset($_REQUEST["ux_chk_disablelightbox"]) ? "true" : "false";
		
			foreach ($lightbox_setting_array as $val => $innerKey) 
			{
				$wpdb->query
				(
					$wpdb->prepare
					(
						"UPDATE " . wp_lightbox_bank_settings() . " SET setting_value = %s WHERE setting_key = %s",
						$innerKey ,
						$val 
					)
				);
			}
			die();
		}
		elseif($_REQUEST["param"] == "update_display_settings")
		{
			$display_setting_array = array();
			$display_setting_array["image_title"]= isset($_REQUEST["ux_image_title"]) ? "true" : "false";
			$display_setting_array["image_caption"] = isset($_REQUEST["ux_chk_image_caption"]) ? "true" : "false";
			$display_setting_array["text_align"] = esc_attr($_REQUEST["ux_text_align"]);
			foreach ($display_setting_array as $val => $innerKey)
			{
				$wpdb->query
				(
					$wpdb->prepare
					(
						"UPDATE " . wp_lightbox_bank_settings() . " SET setting_value = %s WHERE setting_key = %s",
						$innerKey ,
						$val
					)
				);
			}
			die();
		}
		elseif ($_REQUEST["param"] == "restore_settings")
		{
			$sql = "TRUNCATE TABLE " . wp_lightbox_bank_settings();
			$wpdb->query($sql);
			
			include_once (WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "/lib/include-lightbox-bank-settings.php");
			die();
		}
	}
}	
 ?>