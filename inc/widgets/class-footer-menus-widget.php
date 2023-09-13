<?php
/**
 * Footer_Menus_Widget
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

namespace PLANTS\Inc\Widgets;

use WP_Widget;

/**
 * Social_Widget
 */
class Footer_Menus_Widget extends WP_Widget {
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct(
			// ID of widget.
			'plants_menus_widget',
			// Widget name will appear in UI.
			esc_html__( 'Footer Menus Widget', 'plants' ),
			// Widget description.
			array( 'description' => esc_html__( 'Menus widget.', 'plants' ) )
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
		// before and after widget arguments are defined by themes.
		$selected_menu = isset( $instance['menu-select'] ) ? $instance['menu-select'] : '';
		echo wp_kses_post( $args['before_widget'] );

		if ( $instance['title'] ) {
			echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['title'] ) . wp_kses_post( $args['after_title'] );
		}
		?>
		<?php
		wp_nav_menu( $selected_menu );
		// This is where you run the code and display the output.

		echo wp_kses_post( $args['after_widget'] );
	}


	/**
	 * Form.
	 *
	 * @param  array $instance instance.
	 * @return void
	 */
	public function form( $instance ) {
		$selected_menu = isset( $instance['menu-select'] ) ? $instance['menu-select'] : '';

		// Widget admin form.
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'menu-select' ) ); ?>"><?php echo esc_html__( 'Menu:', 'plants' ); ?></label>
			<?php
			if ( isset( $instance['title'] ) ) {
				$title = $instance['title'];
			} else {
				$title = esc_html__( 'New title', 'plants' );
			}
			?>
			<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?> )"><?php echo esc_html__( 'Title:', 'plants' ); ?></label>
			<input class="widget-field" id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'menu-select' ) ); ?>"><?php echo esc_html__( 'Menu:', 'plants' ); ?></label>
			<select class="widget-field" id="<?php echo esc_attr( $this->get_field_id( 'menu-select' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'menu-select' ) ); ?>">
				<?php foreach ( wp_list_pluck( get_terms( 'nav_menu' ), 'name' ) as $menu ) : ?>
					<option value="<?php echo esc_attr( $menu ); ?>" <?php selected( $selected_menu, $menu ); ?>><?php echo esc_html( $menu ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
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
		$instance                = $old_instance;
		$instance['title']       = sanitize_text_field( $new_instance['title'] );
		$instance['menu-select'] = sanitize_text_field( $new_instance['menu-select'] );
		return $instance;
	}

}
