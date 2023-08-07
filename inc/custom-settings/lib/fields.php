<?php
/**
 * Callbacks for render fields
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

/**
 * get_sanitizes_values
 *
 * @param  mixed $options
 * @param  mixed $value
 * @return void
 */
function get_sanitizes_values( $options, $value ) {
	 return isset( $options[ $value ] ) ? esc_html__( $options[ $value ], 'plants' ) : '';
}

// header_section

// header banner

/**
 * render_header_banner_text_field
 *
 * @return void
 */
function render_header_banner_text_field() {
	$options = get_option( 'plants_options' );
	?>
	<input type='text' name='plants_options[header_banner_info]' value='<?php echo get_sanitizes_values( $options, 'header_banner_info' ); ?>'>

	<?php
}

/**
 * plants_header_banner_anchor
 *
 * @return void
 */
function plants_header_banner_anchor() {
	$options = get_option( 'plants_options' );
	?>
	<input type='url' name='plants_options[header_banner_anchor]' value='<?php echo get_sanitizes_values( $options, 'header_banner_anchor' ); ?>'>

	<?php

}

/**
 * plants_hide_header_banner
 *
 * @return void
 */
function plants_hide_header_banner() {
	$options = get_option( 'plants_options' );
	?>
	<select name='plants_options[header_banner_hide_option]'>
		<option value='Yes' <?php selected( get_sanitizes_values( $options, 'header_banner_hide_option' ), 'Yes' ); ?>>Yes</option>
		<option value='No' <?php selected( get_sanitizes_values( $options, 'header_banner_hide_option' ), 'No' ); ?>>No</option>

	</select>
	<?php

}

// menu section

/**
 * render_menu_choice_field
 *
 * @return void
 */
function render_menu_choice_field() {
	$options = get_option( 'plants_options' );
	?>
   
		<?php
		// if (isset(has_nav_menu()))  Зроби потім перевірку
		$locations = get_nav_menu_locations();
		var_dump( $locations );
		$menus_name = array();
		foreach ( $locations as $location ) {
			var_dump( $location );
			$menus_names[] = wp_get_nav_menu_name( $location );
		}

		var_dump( $menus_name );
		?>



	<?php
}



// footer sections
function render_footer_menus_field() {
	$options = get_option( 'plants_options' );
}
