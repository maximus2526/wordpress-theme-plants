<?php
/**
 * Register menus
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

/**
 * Menus
 */
class Menus {


	use Singleton;

	/**
	 * Register_my_menus.
	 *
	 * @return void
	 */
	protected function register_my_menus() {
		register_nav_menus(
			get_nav_menu_locations()
		);
	}




}
