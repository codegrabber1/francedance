<?php
/**
 * The Theme Options page
 *
 * This page is implemented using the Settings API
 * http://codex.wordpress.org/Settings_API
 *
 * @package  codegramcwer
 * @file     options.php
 * @author   codegramcwer [Oleg Poruchenko]
 * @link    [makecodework@gmail.com]
 */
/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 *
 */
add_action( 'admin_init', 'mcw_register_admin_scripts' );

function mcw_register_admin_scripts() {
	wp_enqueue_style( 'mcw_colorpicker_css', get_template_directory_uri() . '/framework/options/css/color-picker.css' );
	wp_enqueue_style( 'mcw_theme_options_css', get_template_directory_uri() . '/framework/options/css/mcw_options.css' );
	wp_enqueue_style('thickbox');
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script('mcw_colorpicker', get_template_directory_uri() . '/framework/options/js/colorpicker.js', array( 'jquery' ));
	wp_enqueue_script('mcw_select_js', get_template_directory_uri() . '/framework/options/js/jquery.customSelect.min.js', array( 'jquery' ));
	wp_enqueue_script( 'mcw_theme_optionsjs', get_template_directory_uri() . '/framework/options/js/options.js', array( 'jquery', 'mcw_select_js' ) );
}

/*
 * ==================
 * Set default options.
 * ==================
*/
function mcw_init_options(){
	$options = get_options( 'mcw_options' );
	if ( false === $options ) {
		$options = mcw_default_options();
	}
	update_option( 'mcw_options', $options );
}
add_action( 'after_setup_theme', 'mcw_init_options', 9 );
/*
 * ==================
 * Register the options page.
 * ==================
*/
function mcw_theme_add_page() {
	$mcw_options_page = add_theme_page( __( 'Theme options', 'francedance' ), __( 'Theme options', 'francedance' ), 'edit_theme_options', 'mcw_options', 'mcw_theme_options_page' );
	add_action( 'admin_print_styles-' . $mcw_options_page, 'mcw_theme_options_scripts' );
}
add_action( 'admin_menu', 'mcw_theme_add_page' );

/*
 * ==================
 * Include scripts to the options page only.
 * ==================
*/
function mcw_theme_options_scripts(){
	if ( ! did_action( 'mcw_enqueue_media' ) ){
		wp_enqueue_media();
	}
	wp_enqueue_script('mcw_upload', get_template_directory_uri() .'/framework/options/js/upload.js', array('jquery'));
}
/*
 * ==================
 * Output the options page.
 * ==================
*/
function mcw_theme_options_page(){
	?>
	<div id="mcw_admin">
		<header class="header">
			<div class="main">
				<div class="left">
					<h2><?php echo _e('Theme settings', 'francedance'); ?></h2>
				</div>
				<div class="theme_info">Theme_info</div>
			</div>
		</header> <!-- /header -->
        <div class="options-wrap">
               <div class="tabs">
                   <ul>
                       <li class="general first"><a href="#general"><i class="icon-cogs"></i><?php echo _e('General', 'francedance'); ?></a></li>
                       <li class="contact"><a href="#contact"><i class="icon-cogs"></i><?php echo _e('Contact', 'francedance'); ?></a></li>
                       <li><a href="#"></a></li>
                       <li class="reset"><a href="#reset"><i class="icon-refresh"></i><?php echo _e( 'Reset', 'francedance' );?></a></li>
                   </ul>
               </div>
            <div class="options_form">
                <?php if( isset( $_GET['settings-update'] ) ):?>
                    <div class="update fade">
                        <p>
			                <?php _e( 'Theme setup has been updated successfully', '' );?>
                        </p>
                    </div>
                <?php endif;?>
                <form action="options.php" method="post">
                    <?php settings_fields( 'mcw_options' )?>
                    <?php $options = get_option( 'mcw_options' )?>
                    <div class="tab_content">
                        <div id="general" class="tab_block">
                            <h2><?php _e( 'Main Settings', 'francedance' );?></php></h2>
                            <div class="fields_wrap">
                                <div class="field infobox">
                                    <p><strong>
			                                <?php _e( 'How to upload an image?', 'francedance' );?>
                                        </strong></p>
	                                <?php _e( 'You can manually specify the URL for the logo and other images or download the image from your computer.', 'francedance' );?>
                                </div>
                                <h3><?php _e( 'Header settings', 'francedance' );?></h3>
                                <div class="field field-upload">
                                    <label for="mcw_logo_url"><?php _e( 'Download the logo', 'francedance' );?></label>
                                    <input type="text" id="mcw_options[mcw_logo_url]" class="upload_image" name="mcw_options[mcw_logo_url]" value="<?php echo esc_attr($options['mcw_logo_url']); ?>">

                                    <input class="upload_image_button" id="mcw_logo_upload_button" type="button" value="Upload" />
                                    <span class="description long updesc"><?php _e('Upload a logo image or specify a path. Max width: 300px.', 'codegramcwer'); ?>
                             </span>
                                </div>
                                <div class='field'>
                                    <label><?php _e( 'Choose the color', 'francedance' );?></label>
                                    <div id="mcw_topheader_color_selector" class="color-pic"><div style="background-color:<?php echo $options['mcw_topheader_color']?>"></div></div>
                                    <input style="width: 80px; margin-right: 5px" id="mcw_topheader_color" type="text" name="mcw_options[mcw_topheader_color]" value="<?php echo $options['mcw_topheader_color'];?>">
                                    <span class="description chkdesc"><?php _e( 'Choose a color for the main elements of the template (lines, buttons, top menu of the site).', 'codegramcwer' ); ?></span>
                                </div>
                                <div class='field'>
                                    <label><?php _e( 'Choose the links color', 'francedance' );?></label>
                                    <div id="mcw_links_color_selector" class="color-pic"><div style="background-color:<?php echo $options['mcw_links_color']?>"></div></div>
                                    <input style="width: 80px; margin-right: 5px" id="mcw_links_color" type="text" name="mcw_options[mcw_links_color]" value="<?php echo $options['mcw_links_color'];?>">
                                    <span class="description chkdesc"><?php _e( 'Choose a color of the links.', 'francedance' ); ?></span>
                                </div>
                                <h3><?php _e( 'Set social links', 'francedance' );?></h3>
                                <div class="field">
                                    <label for="mcw_options[mcw_fb_url]"><?php _e( 'Facebook URL', 'francedance' );?></label>
                                    <input type="text" id="mcw_options[mcw_fb_url]" name="mcw_options[mcw_fb_url]" value="<?php echo esc_attr( $options['mcw_fb_url'] );?>" />
                                    <span class="description long"><?php _e( "Enter full facebook-URL starting with <strong> https:// </strong>, or leave blank.", 'francedance' );?></span>
                                </div>
                                <div class="field">
                                    <label for="mcw_options[mcw_inst_url]"><?php _e( 'Instagram URL', 'francedance' );?></label>
                                    <input type="text" id="mcw_options[mcw_inst_url]" name="mcw_options[mcw_inst_url]" value="<?php echo esc_attr( $options['mcw_inst_url'] );?>" />
                                    <span class="description long"><?php _e( "Enter full instagram-URL starting with <strong> https:// </strong>, or leave blank.", 'francedance' );?></span>
                                </div>
                            </div>
                        </div>  <!-- #general -->
                        <div id="reset" class="tab_block">
                            <h2><?php _e( 'Reset', 'francedance' ); ?></h2>
                            <div class="fields_wrap">
                                <div class="field warningbox">
                                    <p><strong><?php _e( 'Atention!', 'francedance' );?></strong></p>
	                                <?php _e( 'You will lose all your theme settings and your own side panels. The theme will reset the original settings.', 'francedance' );?>
                                </div>
                                <div class="field">
                                    <p class="reset-info"><?php _e( 'If you want to restore the initial settings, click on the button.', 'francedance' );?></p>
                                    <input type="submit" name="mcw_option[reset]" class="button-primary" value="<?php _e( 'Reset the initial settings', 'francedance' );?>">
                                </div>
                            </div>
                        </div>
                    </div>

            </div>  <!-- .options_form-->
        </div>    <!-- .options-wrap-->
        <div class="options-footer">
            <input type="submit" name="mcw_options[submit]" class="button-primary" value="<?php _e( 'Save Settings', 'francedance' ); ?>" />
        </div>
        </form>
	</div> <!-- #mcw_admin-->
	<?php
}