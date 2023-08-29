<?php
/**
 * Include all assets
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

/**
 * Assets
 */
class Assets {

	use Singleton;

	/**
	 * __construct
	 *
	 * @return void
	 */
	protected function __construct() {
		// load class.
		$this->setup_hooks();
	}

	/**
	 * Setup_hooks.
	 *
	 * @return void
	 */
	protected function setup_hooks() {
		/**
		* Actions.
		*/
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );

	}

	/**
	 * Register_styles.
	 *
	 * @return void
	 */
	public function register_styles() {
		 // Register styles.
		wp_register_style( 'base-css', get_template_directory_uri() . '/assets/css/base.css', array(), true );
		wp_register_style( 'swiper-css', get_template_directory_uri() . '/assets/css/swiper/swiper-min.css', array(), true );
		// Enqueue Styles.
		wp_enqueue_style( 'swiper-css' );
		wp_enqueue_style( 'base-css' );

	}

	/**
	 * Register_scripts.
	 *
	 * @return void
	 */
	public function register_scripts() {
		// Register scripts.
		wp_register_script( 'main-js', PLANTS_JS_URI . '/main.js', array(), filemtime( PLANTS_JS_DIR_PATH . '/main.js' ), true );
		wp_register_script( 'swiper-js', get_template_directory_uri() . '/assets/js/swiper-min.js', array(), true, true );

		// Enqueue Scripts.
		wp_enqueue_script( 'swiper-js' );
		wp_enqueue_script( 'main-js' );

	}



}
