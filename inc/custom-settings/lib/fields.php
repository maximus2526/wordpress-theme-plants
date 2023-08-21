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
 * Render_header_banner_text_field.
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
 * Plants_header_banner_anchor.
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
 * Plants_hide_header_banner.
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
 * Render_menu_choice_field.
 *
 * @return void
 */
function render_menu_choice_field() {
	$options     = get_option( 'plants_options' );
	$menus_names = wp_list_pluck( get_terms( 'nav_menu' ), 'name' );
	?>
	<select name='plants_options[header_menu]'>
	<?php
	foreach ( $menus_names as $name ) :
		?>
		<option value='<?php echo esc_html__( $name, 'plants' ); ?>' <?php selected( get_sanitizes_values( $options, 'header_menu' ), esc_html__( $name, 'plants' ) ); ?>><?php echo esc_html__( $name, 'plants' ); ?></option>
		<?php
	endforeach;
	?>
	</select>
	<?php
}


/**
 * Render_footer_menus_field.
 *
 * @return void
 */
function render_footer_menus_field() {
	$options     = get_option( 'plants_options' );
	$menus_names = wp_list_pluck( get_terms( 'nav_menu' ), 'name' );
	?>
	<?php
	$input_id = 1;
	foreach ( $menus_names as $name ) :
		$name = esc_attr( $name );
		?>
		</br>
		<div class="row">
			<!-- Не зберігає, value пусте -->
			<input value="<?php echo get_sanitizes_values( $options, $name . '_menu_title' ); ?>" placeholder="Menu header" type="text" name="plants_options[<?php echo $name . '_menu_title'; ?> ]">
			<label for="<?php echo 'footer_menu_' . $input_id; ?>"><?php echo $name; ?></label>
			<input <?php checked( get_sanitizes_values( $options, $name ), $name ); ?> id="<?php echo 'footer_menu_' . $input_id; ?>" value="<?php echo $name; ?>"  name='plants_options[<?php echo $name; ?>]' type="checkbox" />
		</div>
		<?php
		$input_id++;
	endforeach;

	?>
	<?php
}



/**
 * Render_rights_field.
 *
 * @return void
 */

function render_rights_field() {
	$options = get_option( 'plants_options' );
	?>
	
	<input type='text' name='plants_options[footer_rights_text]' value='<?php echo esc_attr( get_sanitizes_values( $options, 'footer_rights_text' ) ); ?>'>

	<?php
}
