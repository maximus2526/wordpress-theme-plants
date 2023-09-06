<?php
/**
 * Callbacks for render fields
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

// Global settings.

if ( ! function_exists( 'plants_slider_field' ) ) {
	/**
	 * Plants_render_global_settings_field.
	 *
	 * @param array $args Field's args.
	 * @return void
	 */
	function plants_slider_field( $args ) {
		?>
		<div class="current-value">
			<b><span style="color:green" id="container-slider-result"><?php echo esc_html__( 'Current: ', 'plants' ) . (int) $args['field_result'] . esc_html( ' px.' ); ?></span></b>
		</div>
		<div class="value-changer">
			<div id="<?php echo esc_html( $args['slider_unique_name'] ); ?>"></div>
			<input id="<?php echo esc_html( $args['hidden_input_unique_name'] ); ?>" value="<?php echo (int) $args['field_result']; ?>" type="hidden" name="plants_options[<?php echo esc_html( $args['field_unique_name'] ); ?>]">
		</div>
		<?php
	}
}




if ( ! function_exists( 'plants_boolean_choice' ) ) {
	/**
	 * Plants_boolean_selection.
	 *
	 * @param array $args Field's args.
	 * @return void
	 */
	function plants_boolean_selection( $args ) {
		?>
	<select name='plants_options[<?php echo esc_html( $args['name'] ); ?>]'>
		<option value='<?php echo esc_attr__( 'Yes', 'plants' ); ?>' <?php selected( plants_get_options( $args['name'] ), esc_html__( 'Yes', 'plants' ) ); ?>><?php echo esc_html__( 'Yes', 'plants' ); ?></option>
		<option value='<?php echo esc_html__( 'No', 'plants' ); ?>' <?php selected( plants_get_options( $args['name'] ), esc_html__( 'No', 'plants' ) ); ?>><?php echo esc_html__( 'No', 'plants' ); ?></option>
	</select>
		<?php
	}
}

if ( ! function_exists( 'plants_multiple_choice' ) ) {
	/**
	 * Plants_multiple_choice field.
	 *
	 * @param array $args Field's args.
	 * @return void
	 */
	function plants_multiple_choice( $args ) {
		?>
	<select name='plants_options[<?php echo esc_html( $args['name'] ); ?>]'>
		<?php
		foreach ( $args['multiple'] as $single ) :
			?>
		<option value='<?php echo esc_html( $single ); ?>' <?php selected( plants_get_options( $args['name'] ), esc_html( $single ) ); ?>><?php echo esc_html( $single ); ?></option>
			<?php
		endforeach;
		?>
	</select>
		<?php
	}
}

if ( ! function_exists( 'plants_custom_footer_menus_field' ) ) {
	/**
	 * Render_footer_menus_field. Custom field.
	 *
	 * @return void
	 */
	function plants_custom_footer_menus_field() {
		$menu_names = wp_list_pluck( get_terms( 'nav_menu' ), 'name' );
		if ( 0 === $menu_names ) {
			echo esc_html__( 'No avaible menus', 'plants' );
			return;
		}
		?>
		<?php
		$menus_title_options = plants_get_options( 'menus_titles' );
		$show_menu_options   = plants_get_options( 'show_menu' );
		foreach ( $menu_names as $input_id => $name ) {
			$name = esc_attr( $name );
			$input_id++;
			?>
		</br>
		<div class="row">
			<input value="<?php echo esc_attr( isset( $menus_title_options[ $name ] ) ? $menus_title_options[ $name ] : '' ); ?>" placeholder=<?php echo esc_attr__( 'Menu title', 'plants' ); ?> type="text" name="plants_options[menus_titles][<?php echo esc_attr( $name ); ?>]">
			<label for="<?php echo 'footer_menu_' . (int) $input_id; ?>"><?php echo esc_html( $name ); ?></label>		 
			<input <?php checked( isset( $show_menu_options[ $name ] ) && $show_menu_options[ $name ] === $name, true ); ?> id="<?php echo 'footer_menu_' . (int) $input_id; ?>" value="<?php echo esc_attr( $name ); ?>"  name='plants_options[show_menu][<?php echo esc_attr( $name ); ?>]' type="checkbox" />
		</div>
			<?php

		}
		?>
		<?php
	}
}

if ( ! function_exists( 'plants_text_field' ) ) {
	/**
	 * Plants_render_text_field.
	 *
	 * @param array $args Field's args.
	 * @return void
	 */
	function plants_text_field( $args ) {
		?>
		<input type='<?php echo isset( $args['type'] ) ? esc_html( $args['type'] ) : 'text'; ?>' name='plants_options[<?php echo esc_html( $args['name'] ); ?>]' value='<?php echo esc_attr( plants_get_options( $args['name'] ) ); ?>'>
		<?php
	}
}
