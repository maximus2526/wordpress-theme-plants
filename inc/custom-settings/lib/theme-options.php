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
			'id'       => 'container_width',
			'title'    => esc_html__( 'Choice width of site container:', 'plants' ),
			'callback' => 'plants_slider_field',
			'args'     => array(
				'field_unique_name'  => 'global_container',
				'slider_unique_name' => 'container-slider',
				'field_result'       => null !== plants_get_options( 'global_container' ) ? (int) plants_get_options( 'global_container' ) : 1024,
				'min'                => '1024',
				'max'                => '2000',
			),
		);

		$options[] = array(
			'section'  => 'global_settings',
			'id'       => 'container_width2',
			'title'    => esc_html__( 'Choice width of site container:', 'plants' ),
			'callback' => 'plants_slider_field',
			'args'     => array(
				'field_unique_name'  => 'global_container2',
				'slider_unique_name' => 'container-slider2',
				'field_result'       => null !== plants_get_options( 'global_container2' ) ? (int) plants_get_options( 'global_container2' ) : 1024,
				'min'                => '1024',
				'max'                => '2000',
			),
		);

		// Banner section.
		$options[] = array(
			'section'  => 'header_promo_section',
			'id'       => 'plants_header_banner_text',
			'title'    => esc_html__( 'Text:', 'plants' ),
			'callback' => 'plants_text_field',
			'args'     => array( 'name' => 'header_banner_info' ),
		);

		$options[] = array(
			'section'  => 'header_promo_section',
			'id'       => 'plants_hide_banner',
			'title'    => esc_html__( 'Show:', 'plants' ),
			'callback' => 'plants_boolean_selection',
			'args'     => array(
				'name' => 'header_banner_hide_option',
			),
		);

		$options[] = array(
			'section'  => 'header_promo_section',
			'id'       => 'plants_enter_anchor',
			'title'    => esc_html__( 'Enter link for banner:', 'plants' ),
			'callback' => 'plants_text_field',
			'args'     => array(
				'name' => 'header_banner_anchor',
				'type' => 'url',
			),
		);

		$options[] = array(
			'section'  => 'header_menu_choice',
			'id'       => 'plants_header_menu_choice',
			'title'    => esc_html__( 'Choice menu:', 'plants' ),
			'callback' => 'plants_multiple_choice',
			'args'     => array(
				'name'     => 'header_menu',
				'multiple' => wp_list_pluck( get_terms( 'nav_menu' ), 'name' ),
			),
		);

		// Footer Section.

		$options[] = array(
			'section'  => 'footer_section',
			'id'       => 'plants_rights_section',
			'title'    => esc_html__( 'Footer rights field:', 'plants' ),
			'callback' => 'plants_text_field',
			'args'     => array( 'name' => 'footer_rights_text' ),
		);

		return (array) $options;
	}
}

