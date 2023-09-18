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
		$sections['widget_section']       = esc_html__( 'Widget Section:', 'plants' );
		$sections['popup_section']        = esc_html__( 'PopUp Section:', 'plants' );

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

		// Popup section.
		$options[] = array(
			'section'  => 'popup_section',
			'id'       => 'plants_hide_popup',
			'title'    => esc_html__( 'Enable PopUp:', 'plants' ),
			'callback' => 'plants_boolean_selection',
			'args'     => array(
				'name' => 'popup_enable_option',
			),
		);

		$options[] = array(
			'section'  => 'popup_section',
			'id'       => 'promo_popup_width',
			'title'    => esc_html__( 'Width:', 'plants' ),
			'callback' => 'plants_text_field',
			'args'     => array( 'name' => 'popup_width' ),
		);

		$options[] = array(
			'section'  => 'popup_section',
			'id'       => 'plants_popup_html_block',
			'title'    => esc_html__( 'Choice html block:', 'plants' ),
			'callback' => 'plants_multiple_choice',
			'args'     => array(
				'name'     => 'plants_popup_html_block',
				'multiple' => plants_get_html_blocks_data(),
			),
		);

		// Site width.

		$options[] = array(
			'section'  => 'global_settings',
			'id'       => 'container_width',
			'title'    => esc_html__( 'Choice width of site container:', 'plants' ),
			'callback' => 'plants_slider_field',
			'args'     => array(
				'field_name' => 'field-container-width',
				'default'    => 1024,
				'min'        => 1024,
				'max'        => 2000,
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
		// Widget.

		$options[] = array(
			'section'  => 'widget_section',
			'id'       => 'plants_widget_column_choice',
			'title'    => esc_html__( 'Select footer sidebar columns:', 'plants' ),
			'callback' => 'plants_multiple_choice',
			'args'     => array(
				'name'     => 'widget_column_choice',
				'multiple' => range( 1, 6 ),
			),
		);

		return (array) $options;
	}
}
