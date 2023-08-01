<?php
/**
 * Theme Functions.
 *
 * @package THEME
 */


if (!defined('THEME_DIR_PATH')) {
	define('THEME_DIR_PATH', untrailingslashit(get_template_directory()));
}

if (!defined('THEME_DIR_URI')) {
	define('THEME_DIR_URI', untrailingslashit(get_template_directory_uri()));
}

if (!defined('THEME_URI')) {
	define('THEME_URI', untrailingslashit(get_template_directory_uri()) . '/assets');
}

if (!defined('THEME_PATH')) {
	define('THEME_PATH', untrailingslashit(get_template_directory()) . '/assets');
}

if (!defined('THEME_JS_URI')) {
	define('THEME_JS_URI', untrailingslashit(get_template_directory_uri()) . '/assets/js');
}

if (!defined('THEME_JS_DIR_PATH')) {
	define('THEME_JS_DIR_PATH', untrailingslashit(get_template_directory()) . '/assets/js');
}

if (!defined('THEME_IMG_URI')) {
	define('THEME_IMG_URI', untrailingslashit(get_template_directory_uri()) . '/assets/img');
}

if (!defined('THEME_CSS_URI')) {
	define('THEME_CSS_URI', untrailingslashit(get_template_directory_uri()) . '/assets/css');
}

if (!defined('THEME_CSS_DIR_PATH')) {
	define('THEME_CSS_DIR_PATH', untrailingslashit(get_template_directory()) . '/assets/css');
}


require_once THEME_DIR_PATH . '/inc/helpers/autoloader.php';


function theme_get_theme_instance()
{
	PLANTS\Inc\THEME::get_instance();
}

function custom_allow_svg_upload( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'custom_allow_svg_upload' );
function custom_allow_svg_in_content( $tags ) {
    $tags['svg'] = array(
        'class' => true,
        'width' => true,
        'height' => true,
        'viewbox' => true,
        'xmlns' => true,
        'fill' => true,
        'aria-hidden' => true,
        'role' => true,
        'focusable' => true,
    );

    $tags['use'] = array(
        'href' => true,
        'xlink:href' => true,
    );

    return $tags;
}
add_filter( 'wp_kses_allowed_html', 'custom_allow_svg_in_content' );

theme_get_theme_instance();

include 'inc/helpers/custom-settings.php';