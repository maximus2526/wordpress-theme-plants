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
		<div class="slider-field">
			<div class="current-value">
				<b><span style="color:green" class="slider-result"><?php echo esc_html__( 'Current: ', 'plants' ) . (int) $args['field_result'] . esc_html( ' px.' ); ?></span></b>
			</div>
			<div class="value-changer">
				<div data-range="{'min': '<?php echo (int) $args['min']; ?>','max': '<?php echo (int) $args['max']; ?>'}"  class="jquery-slider"></div>
				<input value="<?php echo (int) $args['field_result']; ?>" type="hidden" name="plants_options[<?php echo esc_html( $args['field_unique_name'] ); ?>]">
			</div>
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
		<option value='<?php echo esc_attr( 'yes' ); ?>' <?php selected( plants_get_options( $args['name'] ), esc_attr( 'yes' ) ); ?>><?php echo esc_html__( 'Yes', 'plants' ); ?></option>
		<option value='<?php echo esc_attr( 'no' ); ?>' <?php selected( plants_get_options( $args['name'] ), esc_attr( 'no' ) ); ?>><?php echo esc_html__( 'No', 'plants' ); ?></option>
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
