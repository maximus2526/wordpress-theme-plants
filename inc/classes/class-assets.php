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
		   * Hooks.
		   */
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_font_preload' ) );
		add_filter( 'style_loader_tag', array( $this, 'style_loader_tag_filter_preload' ), 10, 2 );
	}

	/**
	 * Enqueue_font_preload.
	 *
	 * @return void
	 */
	public function enqueue_font_preload() {
		wp_enqueue_style( 'example-font-handle', PLANTS_FONTS_PATH . '/Satoshi-Light.woff2', array(), true );
	}


	/**
	 * Style_loader_tag_filter_preload.
	 *
	 * @param  mixed $html HTML.
	 * @param  mixed $handle Handle.
	 * @return html
	 */
	public function style_loader_tag_filter_preload( $html, $handle ) {
		if ( 'example-font-handle' === $handle ) {
			$new_html = str_replace( 'text/css', 'font/woff2', $html );
			return str_replace( "rel='stylesheet'", "rel='preload' as='font' crossorigin='anonymous'", $new_html );
		}
		return $html;
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
		wp_register_script( 'plants-main-js', PLANTS_JS_URI . '/plants_main.js', array(), filemtime( PLANTS_JS_DIR_PATH . '/plants_main.js' ), true );
		wp_register_script( 'swiper-js', get_template_directory_uri() . '/assets/js/swiper-min.js', array(), true, true );

		// Enqueue Scripts.
		wp_enqueue_script( 'swiper-js' );
		wp_enqueue_script( 'plants-main-js' );
		if ( ! is_admin() ) {
			wp_enqueue_script( 'jquery' );
		}
	}
}
