<?php
include WP_LIGHTBOX_BANK_BK_PLUGIN_DIR . "/lib/get-wp-lightbox-bank-setting.php";
if($wp_galleries == "1" || $wp_caption_image == "1" || $attachment_image == "1")
{
	echo "<style>
	#lightGallery-slider .info .desc
	{
		direction: ".$language_direction." !important;
		text-align: ". $text_align." !important;
	}
	#lightGallery-slider .info .title
	{
		direction: ". $language_direction." !important;
		text-align: ". $text_align." !important;
	}
	</style>";
?>
<script type="text/javascript">
	var string=".wp-lightbox-bank,",ie,ieVersion,lightease;
	jQuery(document).ready(function($){
		var lightbox_select = $('a[href$=".bmp"],a[href$=".gif"],a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".BMP"],a[href$=".GIF"],a[href$=".JPG"],a[href$=".JPEG"],a[href$=".PNG"]');
		lightbox_select.addClass("wp-lightbox-bank");
		<?php
			if($wp_galleries == "1") 
			{
				?>
				string += ".gallery-item, ";
				<?php
			}
			if($wp_caption_image == "1")
			{
				?>
				string += ".wp-caption > a, ";
				<?php
			}
			if($attachment_image == "1")
			{
				?>
				string += "a:has(img[class*=wp-image-])";
				<?php
			}
		?>
		if (navigator.appName == "Microsoft Internet Explorer") {
			//Set IE as true
			ie = true;
			//Create a user agent var
			var ua = navigator.userAgent;
			//Write a new regEx to find the version number
			var re = new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");
			//If the regEx through the userAgent is not null
			if (re.exec(ua) != null) {
				//Set the IE version
				ieVersion = parseInt(RegExp.$1);
			}
		}
		if(ie = true && ieVersion <= 9)
		{
			lightease = "";
		}
		else
		{
			lightease = "ease";
		}
		var selector = string.replace(/,\s*$/, "");
		jQuery(selector).lightGallery({
			caption : <?php echo $image_title;?>,
			desc : <?php echo $image_caption;?>,
			disableOther : <?php echo $disable_other_lightbox;?>,
			closable : <?php echo $overlay_click;?>,
			errorMessage : "<?php echo $error_message;?>",
			easing: lightease
		});
	});
	
</script>
<?php 
}
?>