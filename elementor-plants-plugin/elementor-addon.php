<?php
/**
 * Plugin Name: Plants
 * Description: Plants Required Plugin
 * Version:     1.0.0
 * Author:      Maxim Kliakhin
 * Author URI:  https://developers.elementor.com/
 * Text Domain: plants
 */

function register_widgets( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/product-widget.php' );
	require_once( __DIR__ . '/widgets/swiper-widget.php' );

	$widgets_manager->register( new \Products_Widget() );
	$widgets_manager->register( new \Swiper_Widget() );

}
add_action( 'elementor/widgets/register', 'register_widgets' );