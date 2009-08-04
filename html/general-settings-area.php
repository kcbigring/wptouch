<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3><?php _e( "General Settings", "wptouch" ); ?></h3>

			<div class="wptouch-left-content">
				<h4><?php _e( "Home Page Re-Direction", "wptouch" ); ?></h4>
				<p><?php echo sprintf( __( "WPtouch by default follows your %sWordPress &raquo; Reading Options%s. You can also set a different one for WPtouch.", "wptouch"), '<a href="options-reading.php">', '</a>' ); ?></p>

				<h4><?php _e( "Site Title", "wptouch" ); ?></h4>
				<p><?php _e( "You can shorten your site title here so it won't be truncated by WPtouch.", "wptouch" ); ?></p>



				<h4><?php _e( "Excluded Categories", "wptouch" ); ?></h4>
				<p><?php _e( "Choose categories you want excluded from the main post listings in WPtouch.", "wptouch" ); ?></p>

				<h4><?php _e( "Font Options", "wptouch" ); ?></h4>
				<p><?php _e( "Set the default size and alignment for text.", "wptouch" ); ?></p>

				<br /><br />
				
				<h4><?php _e( "Post Listings Options", "wptouch" ); ?></h4>
				<p><?php _e( "Select which post-meta items are shown under titles on the main, search, &amp; archives pages.", "wptouch" ); ?></p>
				<p><?php _e( "Also, choose if excerpts are shown/hidden (default is hidden).", "wptouch" ); ?></p>
			</div>

			<div class="wptouch-right-content">
				<p><label for="home-page"><strong><?php _e( "WPtouch Home Page", "wptouch" ); ?></strong></label></p>
				<?php $pages = bnc_get_pages_for_icons(); ?>
				<?php if ( count( $pages ) ) { ?>
					<?php wp_dropdown_pages( 'show_option_none=WordPress Settings&name=home-page&selected=' . bnc_get_selected_home_page()); ?>
				<?php } else {?>
					<strong class="no-pages"><?php _e( "You have no pages yet. Create some first!", "wptouch" ); ?></strong>
				<?php } ?>

				<br /><br />

				<ul class="wptouch-make-li-italic">
					<li><input type="text" class="no-right-margin" name="header-title" value="<?php $str = $wptouch_settings['header-title']; echo stripslashes($str); ?>" /><?php _e( "Site title text", "wptouch" ); ?></li>
				</ul>

				<br />

				<ul class="wptouch-make-li-italic">			
				<li><input name="excluded-cat-ids" class="no-right-margin" type="text" value="<?php $str = $wptouch_settings['excluded-cat-ids']; echo stripslashes($str); ?>" /><?php _e( "Comma list of Category ID's, eg: 1,2,3", "wptouch" ); ?></li>
				</ul>

				<br />

				<ul class="wptouch-make-li-italic">
					<li><select name="style-text-size">
							<option <?php if ($wptouch_settings['style-text-size'] == "small-text") echo " selected"; ?> value="small-text"><?php _e( "Regular", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['style-text-size'] == "medium-text") echo " selected"; ?> value="medium-text"><?php _e( "Medium", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['style-text-size'] == "large-text") echo " selected"; ?> value="large-text"><?php _e( "Large", "wptouch" ); ?></option>
						   </select>
						   <?php _e( "Font size", "wptouch" ); ?>
					</li>
					<li><select name="style-text-justify">
							<option <?php if ($wptouch_settings['style-text-justify'] == "left-justified") echo " selected"; ?> value="left-justified"><?php _e( "Left", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['style-text-justify'] == "full-justified") echo " selected"; ?> value="full-justified"><?php _e( "Full", "wptouch" ); ?></option>
						</select>
						<?php _e( "Font justification", "wptouch" ); ?>
					</li>
				</ul>	
				
				<br />
				
				<ul>
					<li>
						<input type="checkbox" class="checkbox" name="enable-main-name" <?php if (isset($wptouch_settings['enable-main-name']) && $wptouch_settings['enable-main-name'] == 1) echo('checked'); ?> />
						<label for="enable-authorname"> <?php _e( "Show Author's Name", "wptouch" ); ?></label>
					</li>			
					<li>
						<input type="checkbox" class="checkbox" name="enable-main-categories" <?php if (isset($wptouch_settings['enable-main-categories']) && $wptouch_settings['enable-main-categories'] == 1) echo('checked'); ?> />
						<label for="enable-categories"> <?php _e( "Show Categories", "wptouch" ); ?></label>
					</li>			
					<li>
						<input type="checkbox" class="checkbox" name="enable-main-tags" <?php if (isset($wptouch_settings['enable-main-tags']) && $wptouch_settings['enable-main-tags'] == 1) echo('checked'); ?> />
						<label for="enable-tags"> <?php _e( "Show Tags", "wptouch" ); ?></label>
					</li>			
					<li>
						<input type="checkbox" class="checkbox" name="enable-post-excerpts" <?php if (isset($wptouch_settings['enable-post-excerpts']) && $wptouch_settings['enable-post-excerpts'] == 1) echo('checked'); ?> />
						<label for="enable-excerpts"><?php _e( "Hide Excerpts", "wptouch" ); ?></label>
					</li>
				</ul>	
			</div>
			
	<div class="wptouch-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->