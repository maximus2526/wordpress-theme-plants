<?php
/**
 * Theme options
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */



/**
 * Plants_options_page_sections.
 *
 * @return array
 */
function plants_options_page_sections() {
	$sections                         = array();
	$sections['header_promo_section'] = esc_html__( 'Header Promo Section:', 'plants' );
	$sections['header_menu_choice']   = esc_html__( 'Header Menu Section:', 'plants' );
	$sections['footer_section']       = esc_html__( 'Footer Section:', 'plants' );

	return $sections;
}


/**
 * Plants_options_page_fields.
 *
 * @return array
 */
function plants_options_page_fields() {
	 // Banner section.
	$options[] = array(
		'section'  => 'header_promo_section',
		'id'       => 'plants_header_banner_text',
		'title'    => esc_html__( 'Text:', 'plants' ),
		'callback' => 'render_header_banner_text_field',
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
		'callback' => 'render_menu_choice_field',
	);

	// Footer Section.

	$options[] = array(
		'section'  => 'footer_section',
		'id'       => 'plants_another_section',
		'title'    => esc_html__( 'Footer field:', 'plants' ),
		'callback' => 'render_footer_menus_field',
	);

	$options[] = array(
		'section'  => 'footer_section',
		'id'       => 'plants_rights_section',
		'title'    => esc_html__( 'Footer rights field:', 'plants' ),
		'callback' => 'render_rights_field',
	);

	return $options;
}


