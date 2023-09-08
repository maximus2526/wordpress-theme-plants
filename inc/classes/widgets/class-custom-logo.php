<?php
/**
 * Theme adding support
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use WP_Widget;


/**
 * Custom_Logo_Widget
 */
class Custom_Logo extends WP_Widget {
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct(
			'plants_custom_logo',
			esc_html__( 'Custom Logo', 'plants' ),
			array( 'description' => esc_html__( 'Display Custom Logo', 'plants' ) )
		);
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}



	/**
	 * Widget.
	 *
	 * @param  array  $args args.
	 * @param  array $instance instance.
	 * @return void
	 */
	public function widget( $args, $instance ) {
			the_custom_logo();
	}


	/**
	 * Register Widgets.
	 *
	 * @return void
	 */
	public function register_widgets() {
		register_widget( __CLASS__ );
	}
}
