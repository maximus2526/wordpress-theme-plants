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

if ( ! function_exists( 'plants_render_global_settings_field' ) ) {
	/**
	 * Plants_render_global_settings_field.
	 *
	 * @return void
	 */
	function plants_render_global_settings_field() {
		echo (int) plants_get_options( 'global_container' );
		?>

		<!-- <div id="container-slider"></div> -->
	<input value="<?php echo (int) plants_get_options( 'global_container' ); ?>" min="1024" max="2000" id="container-slider" type="range" name="plants_options[global_container]">
		<script>  
		// Range slider
		const $ = jQuery;
		$(document).ready(() => {
			$("#container-slider").slider( {
				range: "max",
				min: 1024, // min value.
				max: 2000, // max value.
				step: 1,
				value: 1024, // default value of slider.
				slide: function(event, ui) {
					$("#amount").val(ui.value);
				}
			});
		}); 
		</script>  
		<?php
	}
}

// Header banner.

if ( ! function_exists( 'plants_render_header_banner_text_field' ) ) {
	/**
	 * Render_header_banner_text_field.
	 *
	 * @return void
	 */
	function plants_render_header_banner_text_field() {
		?>
	<input type='text' name='plants_options[header_banner_info]' value='<?php echo esc_attr( plants_get_options( 'header_banner_info' ) ); ?>'>
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
		?>
	<input type='url' name='plants_options[header_banner_anchor]' value='<?php echo esc_attr( plants_get_options( 'header_banner_anchor' ) ); ?>'>

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
		?>
	<select name='plants_options[header_banner_hide_option]'>
		<option value='<?php echo esc_attr__( 'Yes', 'plants' ); ?>' <?php selected( plants_get_options( 'header_banner_hide_option' ), esc_html__( 'Yes', 'plants' ) ); ?>><?php echo esc_html__( 'Yes', 'plants' ); ?></option>
		<option value='<?php echo esc_html__( 'No', 'plants' ); ?>' <?php selected( plants_get_options( 'header_banner_hide_option' ), esc_html__( 'No', 'plants' ) ); ?>><?php echo esc_html__( 'No', 'plants' ); ?></option>

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
		$menus_names = wp_list_pluck( get_terms( 'nav_menu' ), 'name' );
		?>
	<select name='plants_options[header_menu]'>
		<?php
		foreach ( $menus_names as $name ) :
			?>
		<option value='<?php echo esc_html( $name ); ?>' <?php selected( plants_get_options( 'header_menu' ), esc_html( $name ) ); ?>><?php echo esc_html( $name ); ?></option>
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
		$menu_names = wp_list_pluck( get_terms( 'nav_menu' ), 'name' );
		if ( 0 === $menu_names ) {
			echo esc_html__( 'No avaible menus', 'plants' );
			return;
		}
		?>
		<?php
		$input_id            = 1;
		$menus_title_options = plants_get_options( 'menus_titles' );
		$show_menu_options   = plants_get_options( 'show_menu' );
		foreach ( $menu_names as $name ) {
			$name = esc_attr( $name );
			?>
		</br>
		<div class="row">
			<input value="<?php echo esc_attr( isset( $menus_title_options[ $name ] ) ? $menus_title_options[ $name ] : '' ); ?>" placeholder=<?php echo esc_attr__( 'Menu title', 'plants' ); ?> type="text" name="plants_options[menus_titles][<?php echo esc_attr( $name ); ?>]">
			<label for="<?php echo 'footer_menu_' . (int) $input_id; ?>"><?php echo esc_html( $name ); ?></label>		 
			<input <?php checked( isset( $show_menu_options[ $name ] ) && $show_menu_options[ $name ] === $name, true ); ?> id="<?php echo 'footer_menu_' . (int) $input_id; ?>" value="<?php echo esc_attr( $name ); ?>"  name='plants_options[show_menu][<?php echo esc_attr( $name ); ?>]' type="checkbox" />
		</div>
			<?php

			$input_id++;
		}
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
		?>
	<input type='text' name='plants_options[footer_rights_text]' value='<?php echo esc_attr( plants_get_options( 'footer_rights_text' ) ); ?>'>
		<?php
	}
}
