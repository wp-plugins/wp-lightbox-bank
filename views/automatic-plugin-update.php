<?php
switch($role)
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
	?>
	<form id="frm_wplb_plugin_update" class="layout-form wplb-page-width" method="post">
		<div class="fluid-layout">
			<div class="layout-span12 responsive">
				<div class="widget-layout">
					<div class="widget-layout-title">
						<h4>
							<?php _e("Wp Lightbox Bank Plugin Update", wp_lightbox_bank); ?>
						</h4>
					</div>
					<div class="widget-layout-body">
						<div class="fluid-layout">
							<div class="layout-span12 responsive">
								<div class="layout-control-group" style="margin: 10px 0 0 0 ;">
									<label class="layout-control-label"><?php _e("Plugin Updates", wp_lightbox_bank); ?> :</label>
									<div class="layout-controls-radio">
										<?php $lightbox_bank_updates = get_option("lightbox-bank-automatic-update");?>
										<input type="radio" name="ux_lightbox_update" id="ux_enable_update" onclick="wp_lightbox_bank_autoupdate(this);" <?php echo $lightbox_bank_updates == "1" ? "checked=\"checked\"" : "";?> value="1"><label style="vertical-align: baseline;"><?php _e("Enable", wp_lightbox_bank); ?></label>
										<input type="radio" name="ux_lightbox_update" id="ux_disable_update" onclick="wp_lightbox_bank_autoupdate(this);" <?php echo $lightbox_bank_updates == "0" ? "checked=\"checked\"" : "";?> style="margin-left: 10px;" value="0"><label style="vertical-align: baseline;"><?php _e("Disable", wp_lightbox_bank); ?></label>
									</div>
								</div>
								<div class="layout-control-group" style="margin:10px 0 10px 0 ;">
									<strong><i>This feature allows the plugin to update itself automatically when a new version is available on WordPress Repository.<br/>This allows to stay updated to the latest features. If you would like to disable automatic updates, choose  the disable option above.</i></strong>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		function wp_lightbox_bank_autoupdate(control)
		{
			var lightbox_bank_updates = jQuery(control).val();
			jQuery.post(ajaxurl, "lightbox_bank_updates="+lightbox_bank_updates+"&param=lightbox_bank_plugin_updates&action=lightbox_settings_library", function()
			{
			});
		}
		
	</script>
	<?php 
}
?>