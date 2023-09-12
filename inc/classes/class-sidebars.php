<?php
/**
 * Sidebars support.
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;


/**
 * Sidebars
 */
class Sidebars {


	use Singleton;

	/**
	 * __construct
	 *
	 * @return void
	 */
	protected function __construct() {
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
				'id'             => 'main-sidebar',
				'name'           => esc_html__( 'Main-Sidebar', 'plants' ),
				'description'    => esc_html__( 'Drag here widgets.', 'plants' ),
				'before_widget'  => '<div id="%1$s" class="widget %2$s">',
				'after_widget'   => '</div>',
				'before_sidebar' => '<div id="%1$s" class="main-sidebar">',
				'after_sidebar'  => '</div>',
				'before_title'   => '<h3 class="widget-title">',
				'after_title'    => '</h3>',
			)
		);
		// Register footer columns.

		foreach ( range( 1, ( plants_get_options( 'widget_column_choice', 1 ) ) ) as $sidebar_id ) {
			register_sidebar(
				array(
					'id'             => 'footer-sidebar-' . $sidebar_id,
					'name'           => esc_html__( 'Footer-Sidebar-Column-' ) . $sidebar_id,
					'description'    => esc_html__( 'Drag here widgets.', 'plants' ),
					'before_widget'  => '<div id="%1$s" class="widget %2$s">',
					'after_widget'   => '</div>',
					'after_sidebar'  => '</div>',
					'before_sidebar' => '<div id="%1$s" class="footer-sidebar-column">',
					'before_title'   => '<h3 class="widget-title">',
					'after_title'    => '</h3>',
				)
			);
		}
	}

}
