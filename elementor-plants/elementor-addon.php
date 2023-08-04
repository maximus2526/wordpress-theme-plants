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
function register_widgets( $widgets_manager )
{

    include_once __DIR__ . '/widgets/product-widget.php';
    include_once __DIR__ . '/widgets/article-widget.php';
    include_once __DIR__ . '/widgets/menus-widget.php';
    include_once __DIR__ . '/widgets/custom-stars-widget.php';
    include_once __DIR__ . '/widgets/user-panel-widget.php';
    include_once __DIR__ . '/widgets/logo-widget.php';
    include_once __DIR__ . '/widgets/subscribe-widget.php';
    include_once __DIR__ . '/widgets/social-widget.php';
    include_once __DIR__ . '/widgets/partners-widget.php';

    $widgets_manager->register(new \Products_Widget());
    $widgets_manager->register(new \Articles_Widget());
    $widgets_manager->register(new \Menus_Widget());
    $widgets_manager->register(new \Widget_Star_Rating_Plus());
    $widgets_manager->register(new \User_Panel_Widget());
    $widgets_manager->register(new \Custom_Logo_Widget());
    $widgets_manager->register(new \Subscribe_Widget());
    $widgets_manager->register(new \Social_Links_Widget());
    $widgets_manager->register(new \Partners_Links_Widget());

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


add_action('elementor/widgets/register', 'register_widgets');
