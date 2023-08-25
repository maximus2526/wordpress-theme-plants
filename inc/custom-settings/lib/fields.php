<?php
/**
 * Callbacks for render fields
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

if ( ! function_exists( 'plants_get_sanitizes_values' ) ) {
	/**
	 * Get_sanitizes_values.
	 *
	 * @param  mixed $options Option.
	 * @param  mixed $value Value.
	 * @return string
	 */
	function plants_get_sanitizes_values( $options, $value ) {
		return isset( $options[ $value ] ) ? esc_html( $options[ $value ] ) : '';
	}
}
// Header_section.

// Header banner.

if ( ! function_exists( 'plants_render_header_banner_text_field' ) ) {
	/**
	 * Render_header_banner_text_field.
	 *
	 * @return void
	 */
	function plants_render_header_banner_text_field() {
		$options = plants_get_options();
		?>
	<input type='text' name='plants_options[header_banner_info]' value='<?php echo esc_attr( plants_get_sanitizes_values( $options, 'header_banner_info' ) ); ?>'>
		<?php
	}
}

if ( ! function_exists( 'plants_header_banner_anchor' ) ) {

	/**
	 * Plants_header_banner_anchor.
	 *
	 * @return void
	 */
	function plants_header_banner_anchor() {
		$options = plants_get_options();
		?>
	<input type='url' name='plants_options[header_banner_anchor]' value='<?php echo esc_attr( plants_get_sanitizes_values( $options, 'header_banner_anchor' ) ); ?>'>

		<?php

	}
}

if ( ! function_exists( 'plants_hide_header_banner' ) ) {
	/**
	 * Plants_hide_header_banner.
	 *
	 * @return void
	 */
	function plants_hide_header_banner() {
		$options = plants_get_options();
		?>
	<select name='plants_options[header_banner_hide_option]'>
		<option value='Yes' <?php selected( plants_get_sanitizes_values( $options, 'header_banner_hide_option' ), 'Yes' ); ?>>Yes</option>
		<option value='No' <?php selected( plants_get_sanitizes_values( $options, 'header_banner_hide_option' ), 'No' ); ?>>No</option>

	</select>
		<?php

	}
}

// menu section.

if ( ! function_exists( 'plants_render_menu_choice_field' ) ) {
	/**
	 * Render_menu_choice_field.
	 *
	 * @return void
	 */
	function plants_render_menu_choice_field() {
		$options     = plants_get_options();
		$menus_names = wp_list_pluck( get_terms( 'nav_menu' ), 'name' );
		?>
	<select name='plants_options[header_menu]'>
		<?php
		foreach ( $menus_names as $name ) :
			?>
		<option value='<?php echo esc_html( $name ); ?>' <?php selected( plants_get_sanitizes_values( $options, 'header_menu' ), esc_html( $name ) ); ?>><?php echo esc_html( $name ); ?></option>
			<?php
		endforeach;
		?>
	</select>
		<?php
	}
}

if ( ! function_exists( 'plants_render_footer_menus_field' ) ) {
	/**
	 * Render_footer_menus_field.
	 *
	 * @return void
	 */
	function plants_render_footer_menus_field() {
		$options    = plants_get_options();
		$menu_names = wp_list_pluck( get_terms( 'nav_menu' ), 'name' );
		?>
		<?php
		$input_id = 1;
		foreach ( $menu_names as $name ) :
			$name = esc_attr( $name );

			?>
		</br>
		<div class="row">
			<input value="<?php echo esc_attr( isset( $options['menus_titles'][ $name ] ) ? $options['menus_titles'][ $name ] : '' ); ?>" placeholder="Menu title" type="text" name="plants_options[menus_titles][<?php echo esc_attr( $name ); ?>]">
			<label for="<?php echo 'footer_menu_' . (int) $input_id; ?>"><?php echo esc_html( $name ); ?></label>		
			<input <?php checked( isset( $options['show_menu'][ $name ] ) && $options['show_menu'][ $name ] === $name, true ); ?> id="<?php echo 'footer_menu_' . (int) $input_id; ?>" value="<?php echo esc_attr( $name ); ?>"  name='plants_options[show_menu][<?php echo esc_attr( $name ); ?>]' type="checkbox" />
			<?php
			if ( isset( $options['show_menu'][ $name ] ) && '' === $options['show_menu'][ $name ] ) {
				unset( $options['show_menu'][ $name ] );
			}
			?>
		</div>
			<?php

			$input_id++;
		endforeach;
		?>
		<?php
	}
}


if ( ! function_exists( 'plants_render_rights_field' ) ) {
	/**
	 * Render_rights_field.
	 *
	 * @return void
	 */
	function plants_render_rights_field() {
		$options = plants_get_options();
		?>
	<input type='text' name='plants_options[footer_rights_text]' value='<?php echo esc_attr( plants_get_sanitizes_values( $options, 'footer_rights_text' ) ); ?>'>
		<?php
	}
}
