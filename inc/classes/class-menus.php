<?php
/**
 * Register menus
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

/**
 * Menus
 */
class Menus {

	use Singleton;

	/**
	 * __construct
	 *
	 * @return void
	 */
	protected function __construct() {
		self::get_instance();
		$this->setup_hooks();

	}

	/**
	 * setup_hooks
	 *
	 * @return void
	 */
	protected function setup_hooks() {
		add_action( 'init', 'register_my_menus' );
	}

	/**
	 * register_my_menus
	 *
	 * @return void
	 */
	protected function register_my_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'header-menu' ),
			)
		);
	}

	/**
	 * Setup theme.
	 *
	 * @return void
	 */


}
