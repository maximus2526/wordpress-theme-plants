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
	 * setup_hooks
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
	 * register_styles
	 *
	 * @return void
	 */
	public function register_styles() {
		 // Register styles.
		wp_register_style( 'base-css', get_template_directory_uri() . '/assets/css/base.css' );
		wp_register_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@10.0.4/swiper-bundle.min.css' );
		// Enqueue Styles.
		wp_enqueue_style( 'swiper-css' );
		wp_enqueue_style( 'base-css' );

	}

	/**
	 * register_scripts
	 *
	 * @return void
	 */
	public function register_scripts() {
		// Register scripts.
		wp_register_script( 'main-js', PLANTS_JS_URI . '/main.js', array(), filemtime( PLANTS_JS_DIR_PATH . '/main.js' ), true );
		wp_register_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10.0.4/swiper-bundle.min.js', array(), true );

		// Enqueue Scripts.
		wp_enqueue_script( 'swiper-js' );
		wp_enqueue_script( 'main-js' );

	}



}
