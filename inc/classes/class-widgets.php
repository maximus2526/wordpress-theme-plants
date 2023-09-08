<?php
/**
 * Theme adding support
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

/**
 * Social_Widget
 */
class Widgets {
	use Singleton;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		require_once 'widgets/class-footer-menus-widget.php';
		require_once 'widgets/class-custom-logo.php';
		new Footer_Menus_Widget();
		new Custom_Logo();
	}


}


