<?php
/*Plugin Name: bS5 Post App Slider
Plugin URI: https://bootscore.me/plugins/bs-post-app-slider/
Description: Post App Slider for bootScore theme https://bootscore.me. Use Shortcode like this [bs-post-app-slider type="post" category="sample-category" order="ASC" orderby="title" posts="12"] and read readme.txt in PlugIn folder for options.
Version: 5.0.0.2
Author: Bastian Kreiter
Author URI: https://crftwrk.de
License: GPLv2
*/




// Register Styles and Scripts
function app_slider_scripts() {
    
    wp_register_style( 'app-style', plugins_url('css/app-style.css', __FILE__) );
        wp_enqueue_style( 'app-style' );
    }

add_action('wp_enqueue_scripts','app_slider_scripts');
// Register Styles and Scripts End



/**
 * Locate template.
 *
 * Locate the called template.
 * Search Order:
 * 1. /themes/theme/bs5-post-app-slider/$template_name
 * 2. /themes/theme/$template_name
 * 3. /plugins/bs5-post-app-slider/templates/$template_name.
 *
 * @since 1.0.0
 *
 * @param 	string 	$template_name			Template to load.
 * @param 	string 	$string $template_path	Path to templates.
 * @param 	string	$default_path			Default path to template files.
 * @return 	string 							Path to the template file.
 */
function bs_post_app_slider_locate_template( $template_name, $template_path = '', $default_path = '' ) {

	// Set variable to search in bs5-post-app-slider folder of theme.
	if ( ! $template_path ) :
		$template_path = 'bs5-post-app-slider/';
	endif;

	// Set default plugin templates path.
	if ( ! $default_path ) :
		$default_path = plugin_dir_path( __FILE__ ) . 'templates/'; // Path to the template folder
	endif;

	// Search template file in theme folder.
	$template = locate_template( array(
		$template_path . $template_name,
		$template_name
	) );

	// Get plugins template file.
	if ( ! $template ) :
		$template = $default_path . $template_name;
	endif;

	return apply_filters( 'bs_post_app_slider_locate_template', $template, $template_name, $template_path, $default_path );

}


/**
 * Get template.
 *
 * Search for the template and include the file.
 *
 * @since 1.0.0
 *
 * @see bs_post_app_slider_locate_template()
 *
 * @param string 	$template_name			Template to load.
 * @param array 	$args					Args passed for the template file.
 * @param string 	$string $template_path	Path to templates.
 * @param string	$default_path			Default path to template files.
 */
function bs_post_app_slider_get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {

	if ( is_array( $args ) && isset( $args ) ) :
		extract( $args );
	endif;

	$template_file = bs_post_app_slider_locate_template( $template_name, $tempate_path, $default_path );

	if ( ! file_exists( $template_file ) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
		return;
	endif;

	include $template_file;

}


/**
 * Templates.
 *
 * This func tion will output the templates
 * file from the /templates.
 *
 * @since 1.0.0
 */

function bs_post_app_slider() {

	return bs_post_app_slider_get_template( 'post-app-slider.php' );

}
add_action('wp_head', 'bs_post_app_slider');

