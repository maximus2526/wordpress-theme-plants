<?php
/**
 * Theme functions
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

define( 'PLANTS_DIR_PATH', untrailingslashit( get_template_directory() ) );
define( 'PLANTS_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
define( 'PLANTS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets' );
define( 'PLANTS_PATH', untrailingslashit( get_template_directory() ) . '/assets' );
define( 'PLANTS_JS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/js' );
define( 'PLANTS_JS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/assets/js' );
define( 'PLANTS_IMG_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/img' );
define( 'PLANTS_CSS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/css' );
define( 'PLANTS_CSS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/assets/css' );
require_once PLANTS_DIR_PATH . '/inc/helpers/autoloader.php';


/**
 * Plants_get_theme_instance.
 *
 * @return void
 */
function plants_get_theme_instance() {
	PLANTS\Inc\THEME::get_instance();
}


/**
 * Custom_allow_svg_upload.
 *
 * @param  mixed $mimes
 * @return array
 */

function custom_allow_svg_upload( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter( 'upload_mimes', 'custom_allow_svg_upload' );


/**
 * Custom_allow_svg_in_content.
 *
 * @param  mixed $tags
 * @return array
 */
function custom_allow_svg_in_content( $tags ) {
	$tags['svg'] = array(
		'class'       => true,
		'width'       => true,
		'height'      => true,
		'viewbox'     => true,
		'xmlns'       => true,
		'fill'        => true,
		'aria-hidden' => true,
		'role'        => true,
		'focusable'   => true,
	);

	$tags['use'] = array(
		'href'       => true,
		'xlink:href' => true,
	);

	 return $tags;
}
add_filter( 'wp_kses_allowed_html', 'custom_allow_svg_in_content' );

plants_get_theme_instance();

if ( is_admin() ) {
	include_once 'inc/custom-settings/custom-settings.php';
}

