<?php
/**
 * Menu Dropdown
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

use \Elementor\Plugin as Plugin;

// $menus = wp_get_nav_menus();
// foreach ( $menus as $single_menu ) {
// var_dump( $single_menu );
// }

$dropdown_data = get_option( 'dropdown-nav-menu-options' ) ?? '';
?>
<div data-id="<?php echo (int) $dropdown_data['nav_menu_item_id']; ?>" class="scheme-dark menus-item-dropdown-section">
	<?php

	if ( is_plugin_active( 'elementor/elementor.php' ) && $dropdown_data ) {
		echo Plugin::instance()->frontend->get_builder_content( $dropdown_data['html_block_id'] ); // phpcs:ignore
	} else {
		// the_content(); TODO
	}
	?>
</div>
