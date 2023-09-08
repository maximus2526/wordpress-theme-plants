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
 * Social_Widget
 */
class Social_Widget extends WP_Widget {
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct(
			// ID of widget.
			'plants_social_widget',
			// Widget name will appear in UI.
			esc_html__( 'Social Widget', 'plants' ),
			// Widget description.
			array( 'description' => esc_html__( 'Sample widget based on WPBeginner Tutorial', 'plants' ) )
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
