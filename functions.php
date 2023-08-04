<?php
/**
 * Theme Functions.
 *
 * @package PLANTS
 */



    define('PLANTS_DIR_PATH', untrailingslashit(get_template_directory()));
    define('PLANTS_DIR_URI', untrailingslashit(get_template_directory_uri()));
    define('PLANTS_URI', untrailingslashit(get_template_directory_uri()) . '/assets');
    define('PLANTS_PATH', untrailingslashit(get_template_directory()) . '/assets');
    define('PLANTS_JS_URI', untrailingslashit(get_template_directory_uri()) . '/assets/js');
    define('PLANTS_JS_DIR_PATH', untrailingslashit(get_template_directory()) . '/assets/js');
    define('PLANTS_IMG_URI', untrailingslashit(get_template_directory_uri()) . '/assets/img');
    define('PLANTS_CSS_URI', untrailingslashit(get_template_directory_uri()) . '/assets/css');
    define('PLANTS_CSS_DIR_PATH', untrailingslashit(get_template_directory()) . '/assets/css');

require_once PLANTS_DIR_PATH . '/inc/helpers/autoloader.php';


function plants_get_theme_instance()
{
    PLANTS\Inc\THEME::get_instance();
}

function custom_allow_svg_upload( $mimes )
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'custom_allow_svg_upload');
function custom_allow_svg_in_content( $tags )
{
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
add_filter('wp_kses_allowed_html', 'custom_allow_svg_in_content');

plants_get_theme_instance();

if (is_admin()) {
    include_once 'inc/custom-settings/custom-settings.php';
}

