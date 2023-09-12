<?php
/**
 * Menu Dropdown
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */
use PLANTS\Inc;
?>
<div class="scheme-dark menus-item-dropdown">
	<?php
	$dropdown_data = Inc\Admin_Menu_Fields::get_instance()->dropdown_data_getter();
	var_dump( $dropdown_data );
	wp_nav_menu(
		array(
			'menu' => 'header_menu',
		)
	);
	?>
</div>
