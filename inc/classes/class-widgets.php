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
			add_action( 'widgets_init', 'register_widgets' );
	}


	/**
	 * Register Widgets.
	 *
	 * @return void
	 */
	public function register_widgets() {
		require_once 'widgets/class-social-widget.php';
		register_widget( 'wpb_widget' );
	}

}


