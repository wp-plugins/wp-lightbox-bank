<script>
jQuery(document).ready(function()
{
	jQuery(".nav-tab-wrapper > a#<?php echo $_REQUEST["page"];?>").addClass("nav-tab-active");
});
</script>
<?php
switch($_REQUEST["page"])
{
	case "wp_lightbox_bank":
		$page = "General Settings";
	break;
	case "wplb_display_settings":
		$page = "Display Settings";
	break;
	case "wplb_system_status":
		$page = "System Status";
	break;
}
?>
<h2 class="nav-tab-wrapper" style="max-width: 1000px;">
	<a class="nav-tab " id="wp_lightbox_bank" href="admin.php?page=wp_lightbox_bank"><?php _e("General Settings", wp_lightbox_bank);?></a>
	<a class="nav-tab " id="wplb_display_settings" href="admin.php?page=wplb_display_settings"><?php _e("Display Settings", wp_lightbox_bank);?></a>
	<a class="nav-tab " id="wplb_system_status" href="admin.php?page=wplb_system_status"><?php _e("System Status", wp_lightbox_bank);?></a>
</h2>