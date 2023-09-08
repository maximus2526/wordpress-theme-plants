<?php
/**
 * Custom Settings.
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

if ( ! function_exists( 'plants_styles_scripts_enqueue' ) ) {
	$url_parts = wp_parse_url( add_query_arg( null, null ) );
	isset( $url_parts['query'] ) ? parse_str( $url_parts['query'], $query_params ) : '';

	if ( ! function_exists( 'plants_styles_scripts_enqueue' ) ) {
		/**
		 * Custom Settings Enqueue Styles/Scripts.
		 *
		 * @return void
		 */
		function plants_styles_scripts_enqueue() { // TODO: НЕ ВІРНА ПЕРЕВІРКА! СТИЛІ Jq не підключає!
			$page_name = isset( $query_params['page'] ) ? $query_params['page'] : '';
			if ( 'theme-options' === $page_name ) {
				wp_enqueue_script( 'jquery-ui-slider' );
				wp_enqueue_style( 'jquery-ui', PLANTS_DIR_URI . '/inc/custom-settings/lib/assets/jquery-ui/jquery-ui.min.css', false, PLANTS_VERSION );
				wp_enqueue_style( 'plants-custom-settings', PLANTS_DIR_URI . '/inc/custom-settings/lib/assets/plants-custom-settings.css', false, PLANTS_VERSION );
				wp_enqueue_script( 'plants-custom-settings', PLANTS_DIR_URI . '/inc/custom-settings/lib/assets/plants-custom-settings.js', false, PLANTS_VERSION, true );
			}
		}
	}
	add_action( 'admin_enqueue_scripts', 'plants_styles_scripts_enqueue' );
}



if ( ! function_exists( 'plants_add_menu' ) ) {
	/**
	 * Plants_add_menu.
	 *
	 * @return void
	 */
	function plants_add_menu() {
		// Display Settings Page link under the “Appearance” Admin Menu.
		// add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function).
		$plants_settings_page = add_theme_page(
			esc_html__( 'Theme Customization', 'plants' ),
			esc_html__( 'Theme Customization', 'plants' ),
			'manage_options',
			'theme-options',
			'plants_option_page',
		);
	}
	add_action( 'admin_menu', 'plants_add_menu' );
}

// add new menu for theme-options page with page callback theme-options-page.

if ( ! function_exists( 'plants_get_settings' ) ) {
	/**
	 * Plants_get_settings.
	 *
	 * @return array
	 */
	function plants_get_settings() {
		$output = array();

		// put together the output array.
		$output['plants_option_name']     = 'plants_options';
		$output['plants_page_title']      = esc_html__( 'Theme Settings Page', 'plants' );
		$output['plants_page_sections']   = plants_options_page_sections();
		$output['plants_page_fields']     = plants_options_page_fields();
		$output['plants_contextual_help'] = '';

		return $output;
	}
}

if ( ! function_exists( 'plants_register_settings' ) ) {
	/**
	 * Plants_register_settings Register our setting.
	 *
	 * @return void
	 */
	function plants_register_settings() {
		// Get the settings sections array.
		$settings_output    = plants_get_settings();
		$plants_option_name = $settings_output['plants_option_name'];
		register_setting( $plants_option_name, $plants_option_name );
		if ( ! empty( $settings_output['plants_page_sections'] ) ) {
			// call the “add_settings_section” for each!
			foreach ( $settings_output['plants_page_sections'] as $id => $title ) {
				add_settings_section( $id, $title, '', plants_get_page_path() );
			}
			// call the add_settings_field for each!
			foreach ( $settings_output['plants_page_fields'] as $field ) {
				add_settings_field( $field['id'], $field['title'], $field['callback'], plants_get_page_path(), $field['section'], isset( $field['args'] ) ? $field['args'] : '' );
			}
		}
	}
	add_action( 'admin_init', 'plants_register_settings' );

	// Includes section.
	require_once 'lib/fields.php';
	require_once 'lib/theme-options.php';
	require_once 'lib/settings-page.php';

}


