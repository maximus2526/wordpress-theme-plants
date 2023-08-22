<?php
/**
 * Theme Sidebars.
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

/**
 * Class Assets
 */
class Sidebars {


	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * To register action/filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {
		/**
		 * Actions
		 */
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
		add_action( 'widgets_init', array( $this, 'register_some_widget' ) );

	}

	/**
	 * Register widgets.
	 *
	 * @action widgets_init
	 */
	public function register_sidebars() {
		register_sidebar(
			array(
				'name'          => 'Footer',
				'id'            => 'sidebar-1',
				'description'   => 'Footer area for widgets',
				'before_widget' => '<div class="widget widget-footer">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

	}

	/**
	 * Plants_register_some_widget.
	 *
	 * @return void
	 */
	public function register_some_widget() {
		register_widget( 'PLANTS\Inc\Some_Widget' );
	}

}
