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
 * plants_options_page_sections
 *
 * @return void
 */
function plants_options_page_sections() {
	$sections = array();
	// $sections[$id] = __($title, 'plants');
	$sections['header_promo_section'] = __( 'Header Promo Section:', 'plants' );
	$sections['header_menu_choice']   = __( 'Header Menu Section:', 'plants' );
	$sections['footer_section']       = __( 'Footer Section:', 'plants' );

	return $sections;
}


/**
 * plants_options_page_fields
 *
 * @return void
 */
function plants_options_page_fields() {
	 // Banner section
	$options[] = array(
		'section'  => 'header_promo_section',
		'id'       => 'plants_header_banner_text',
		'title'    => __( 'Text:', 'plants' ),
		'callback' => 'render_header_banner_text_field',
	);

	$options[] = array(
		'section'  => 'header_promo_section',
		'id'       => 'plants_hide_banner',
		'title'    => __( 'Show:', 'plants' ),
		'callback' => 'plants_hide_header_banner',
	);

	$options[] = array(
		'section'  => 'header_promo_section',
		'id'       => 'plants_enter_anchor',
		'title'    => __( 'Enter link for banner:', 'plants' ),
		'callback' => 'plants_header_banner_anchor',
	);

	$options[] = array(
		'section'  => 'header_menu_choice',
		'id'       => 'plants_header_menu_choice',
		'title'    => __( 'Choice menu:', 'plants' ),
		'callback' => 'render_menu_choice_field',
	);

	// Footer Section

	$options[] = array(
		'section'  => 'footer_section',
		'id'       => 'plants_another_section',
		'title'    => __( 'Footer field:', 'plants' ),
		'callback' => 'render_footer_menus_field',
	);

	return $options;
}


