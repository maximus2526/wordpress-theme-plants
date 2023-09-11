<?php
/**
 * Html_Block_Widget
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

namespace PLANTS\Inc\Widgets;

use WP_Widget;
use \Elementor\Plugin as Plugin;
/**
 * Html_Block_Widget
 */
class Block_Widget extends WP_Widget {

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct(
			'plants_html_blocks',
			esc_html__( 'HTML Block', 'plants' ),
			array( 'description' => esc_html__( 'Display custom elementor Html blocks.', 'plants' ) )
		);

	}



	/**
	 * Widget.
	 *
	 * @param  array $args args.
	 * @param  array $instance instance.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );
		$posts_id = $instance['html-block-select'];
		echo Plugin::instance()->frontend->get_builder_content( $posts_id ); // phpcs:ignore
		echo wp_kses_post( $args['after_widget'] );
	}

	/**
	 * Form.
	 *
	 * @param  array $instance instance.
	 * @return void
	 */
	public function form( $instance ) {
		$post_data = plants_get_html_blocks_data();
		?>
		<select class="widget-field" id="<?php echo esc_attr( $this->get_field_id( 'html-block-select' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'html-block-select' ) ); ?>">
		<?php foreach ( $post_data  as $post_id => $post_name ) : ?>
			<option value="<?php echo esc_attr( $post_id ); ?>" <?php selected( $post_name, $post_name ); ?>><?php echo esc_html( $post_name ); ?></option>
		<?php endforeach; ?>
	</select>
		<?php
	}

		/**
		 * Update.
		 *
		 * @param  array $new_instance new_instance.
		 * @param  array $old_instance old_instance.
		 * @return array
		 */
	public function update( $new_instance, $old_instance ) {
		$instance                      = $old_instance;
		$instance['html-block-select'] = sanitize_text_field( $new_instance['html-block-select'] );
		return $instance;
	}


}


