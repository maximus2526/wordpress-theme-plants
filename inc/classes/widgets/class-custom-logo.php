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
			// ID of widget.
			'plants_custom_logo',
			// Widget name will appear in UI.
			esc_html__( 'Custom Logo', 'plants' ),
			// Widget description.
			array( 'description' => esc_html__( 'Display Custom Logo', 'plants' ) )
		);
	}



	/**
	 * Widget.
	 *
	 * @param  array  $args args.
	 * @param  object $instance instance.
	 * @return void
	 */
	public function widget( $args, $instance ) {
			the_custom_logo();
	}


	/**
	 * Form.
	 *
	 * @param  object $instance instance.
	 * @return void
	 */
	public function form( $instance ) {

	}


	/**
	 * Update.
	 *
	 * @param  object $new_instance new_instance.
	 * @param  object $old_instance old_instance.
	 * @return void
	 */
	public function update( $new_instance, $old_instance ) {

	}


}
