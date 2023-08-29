<?php
/**
 * Plugin Name: Plants
 * Description: Plants Required Plugin
 * Version:     1.0.0
 * Author:      Maxim Kliakhin
 * Author URI:  https://developers.elementor.com/
 * Text Domain: plants
 *
 * @package plants
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register_widgets.
 *
 * @param  mixed $widgets_manager
 * @return void
 */
function register_widgets( $widgets_manager ) {
	include_once __DIR__ . '/widgets/class-products-widget.php';
	include_once __DIR__ . '/widgets/class-articles-widget.php';
	include_once __DIR__ . '/widgets/class-menus-widget.php';
	include_once __DIR__ . '/widgets/class-user-panel-widget.php';
	include_once __DIR__ . '/widgets/class-custom-logo-widget.php';
	include_once __DIR__ . '/widgets/class-subscribe-widget.php';
	include_once __DIR__ . '/widgets/class-social-links-widget.php';
	include_once __DIR__ . '/widgets/class-partners-links-widget.php';

	$widgets_manager->register( new \Products_Widget() );
	$widgets_manager->register( new \Articles_Widget() );
	$widgets_manager->register( new \Menus_Widget() );
	$widgets_manager->register( new \User_Panel_Widget() );
	$widgets_manager->register( new \Custom_Logo_Widget() );
	$widgets_manager->register( new \Subscribe_Widget() );
	$widgets_manager->register( new \Social_Links_Widget() );
	$widgets_manager->register( new \Partners_Links_Widget() );

}

/**
 * Custom_elementor_widget_category.
 *
 * @param mixed $elements_manager
 * @return void
 */
function custom_elementor_widget_category( $elements_manager ) {
	$elements_manager->add_category(
		'theme-widgets',
		array(
			'title' => __( 'Theme Widgets', 'plants' ),
			'icon'  => 'fa fa-plug',
		)
	);
}

add_action( 'elementor/elements/categories_registered', 'custom_elementor_widget_category' );


add_action( 'elementor/widgets/register', 'register_widgets' );