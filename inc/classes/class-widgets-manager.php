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

use Html_Block;
use PLANTS\Inc\Traits\Singleton;
		use PLANTS\Inc\Widgets;
use PLANTS\Inc\Widgets\Block_Widget;
use PLANTS\Inc\Widgets\Custom_Logo;
use PLANTS\Inc\Widgets\Footer_Menus_Widget;
use PLANTS\Inc\Widgets\Social_Widget;
use Social_Links_Widget;

		/**
		 * Social_Widget
		 */
class Widgets_Manager {
	use Singleton;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}

	/**
	 * Register Widgets.
	 *
	 * @return void
	 */
	public function register_widgets() {
		register_widget( new Custom_Logo() );
		register_widget( new Footer_Menus_Widget() );
		register_widget( new Social_Widget() );
		register_widget( new Block_Widget() );
	}

}



