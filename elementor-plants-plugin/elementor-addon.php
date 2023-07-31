<?php
/**
 * Plugin Name: Plants
 * Description: Plants Required Plugin
 * Version:     1.0.0
 * Author:      Maxim Kliakhin
 * Author URI:  https://developers.elementor.com/
 * Text Domain: plants
 */

if (!defined('ABSPATH')) {
    exit; // Защита от прямого доступа к файлу
}
function register_widgets( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/product-widget.php' );

	$widgets_manager->register( new \Products_Widget() );

}
function custom_elementor_widget_category($elements_manager)
{
    $elements_manager->add_category(
		
        'theme-widgets',
        [
            'title' => __('Theme Widgets', 'plants'), 
            'icon' => 'fa fa-plug', 
        ]
		
    );
}

add_action('elementor/elements/categories_registered', 'custom_elementor_widget_category');


add_action( 'elementor/widgets/register', 'register_widgets' );