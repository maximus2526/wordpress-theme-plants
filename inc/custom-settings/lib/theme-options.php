<?php
/**
 * Theme options
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

if ( ! function_exists( 'plants_options_page_sections' ) ) {
	/**
	 * Plants_options_page_sections.
	 *
	 * @return array
	 */
	function plants_options_page_sections() {
		$sections                         = array();
		$sections['global_settings']      = esc_html__( 'Global settings:', 'plants' );
		$sections['header_promo_section'] = esc_html__( 'Header Promo Section:', 'plants' );
		$sections['header_menu_choice']   = esc_html__( 'Header Menu Section:', 'plants' );
		$sections['footer_section']       = esc_html__( 'Footer Section:', 'plants' );

		return $sections;
	}
}

if ( ! function_exists( 'plants_options_page_fields' ) ) {
	// TODO: EACH of type inputs must have 1 control.
	/**
	 * Plants_options_page_fields.
	 *
	 * @return array Options array.
	 */
	function plants_options_page_fields() {
		// Global settings.
		$options[] = array(
			'section'  => 'global_settings',
			'id'       => 'global_settings',
			'title'    => esc_html__( 'Choice width of site container:', 'plants' ),
			'callback' => 'plants_render_global_settings_field',
			'args'     => '',
		);

		// Global settings.
		$options[] = array(
			'section'  => 'global_settings',
			'id'       => 'global_settings2',
			'title'    => esc_html__( 'Choice width of site container:', 'plants' ),
			'callback' => 'plants_render_global_settings_field',
		);

		// Banner section.
		$options[] = array(
			'section'  => 'header_promo_section',
			'id'       => 'plants_header_banner_text',
			'title'    => esc_html__( 'Text:', 'plants' ),
			'callback' => 'plants_render_header_banner_text_field',
		);

		$options[] = array(
			'section'  => 'header_promo_section',
			'id'       => 'plants_hide_banner',
			'title'    => esc_html__( 'Show:', 'plants' ),
			'callback' => 'plants_hide_header_banner',
		);

		$options[] = array(
			'section'  => 'header_promo_section',
			'id'       => 'plants_enter_anchor',
			'title'    => esc_html__( 'Enter link for banner:', 'plants' ),
			'callback' => 'plants_header_banner_anchor',
		);

		$options[] = array(
			'section'  => 'header_menu_choice',
			'id'       => 'plants_header_menu_choice',
			'title'    => esc_html__( 'Choice menu:', 'plants' ),
			'callback' => 'plants_render_menu_choice_field',
		);

		// Footer Section.

		$options[] = array(
			'section'  => 'footer_section',
			'id'       => 'plants_another_section',
			'title'    => esc_html__( 'Footer field:', 'plants' ),
			'callback' => 'plants_render_footer_menus_field',
		);

		$options[] = array(
			'section'  => 'footer_section',
			'id'       => 'plants_rights_section',
			'title'    => esc_html__( 'Footer rights field:', 'plants' ),
			'callback' => 'plants_render_rights_field',
		);

		return (array) $options;
	}
}

