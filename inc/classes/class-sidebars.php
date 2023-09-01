<?php
/**
 * Sidebars support.
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

/**
 * MetaBoxes
 */
class Sidebars {
	use Singleton;

	/**
	 * __construct
	 *
	 * @return void
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Setup_hooks.
	 *
	 * @return void
	 */
	protected function setup_hooks() {
		add_action( 'widgets_init', array( $this, 'register_wp_sidebars' ) );
	}


	/**
	 * Register_wp_sidebars.
	 *
	 * @return void
	 */
	public function register_wp_sidebars() {
		register_sidebar(
			array(
				'id'            => 'main-sidebar',
				'name'          => 'Main-Sidebar',
				'description'   => 'Drag here widgets.',
				'before_widget' => '<div id="%1$s" class="main-sidebar widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}



}
