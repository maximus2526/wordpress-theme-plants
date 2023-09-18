<?php
/**
 * Include all assets
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
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
		/**
		* Hooks.
		*/
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_font_preload' ) );
		add_filter( 'style_loader_tag', array( $this, 'style_loader_tag_filter_preload' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_assets' ) );
	}

	/**
	 * Enqueue_font_preload.
	 *
	 * @return void
	 */
	public function enqueue_font_preload() {
		wp_enqueue_style( 'font-handle', PLANTS_FONTS_PATH . '/Satoshi-Light.woff2', array(), PLANTS_VERSION );
	}

	/**
	 * Style_loader_tag_filter_preload.
	 *
	 * @param  string $html   HTML.
	 * @param  string $handle Handle.
	 * @return string
	 */
	public function style_loader_tag_filter_preload( $html, $handle ) {
		if ( 'font-handle' === $handle ) {
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
		// Enqueue Styles.
		wp_enqueue_style( 'plants-base', PLANTS_DIR_URI . '/assets/css/base.css', array(), PLANTS_VERSION );
		wp_enqueue_style( 'plants-swiper', PLANTS_DIR_URI . '/assets/css/swiper/swiper-min.css', array(), PLANTS_VERSION );
		wp_enqueue_style( 'magnific-popup', PLANTS_DIR_URI . '/assets/css/pop-up/magnific-popup.min.css', array(), '1.1.0' );
		wp_enqueue_style( 'plants-magnetic', PLANTS_DIR_URI . '/assets/css/pop-up/plants-magnetic.css', array(), PLANTS_VERSION );
	}

	/**
	 * Register_scripts.
	 *
	 * @return void
	 */
	public function register_scripts() {
		// Enqueue Scripts.
		wp_enqueue_script( 'plants-swiper', PLANTS_DIR_URI . '/assets/js/swiper-min.js', array(), PLANTS_VERSION, true );
		wp_enqueue_script( 'plants-main', PLANTS_JS_URI . '/plants_main.js', 'jquery', PLANTS_VERSION, true );
		wp_enqueue_script( 'magnific-popup', PLANTS_JS_URI . '/jquery.magnific-popup.min.js', 'jquery', '1.1.0', true );
	}

	/**
	 * Add_media_script.
	 *
	 * @return void
	 */
	public function add_admin_assets() {
		wp_enqueue_media();
		wp_enqueue_script( 'admin-js', PLANTS_JS_URI . '/plants_admin.js', array( 'jquery' ), PLANTS_VERSION, false );
		wp_enqueue_style( 'custom-admin-style', PLANTS_CSS_URI . '/admin/plants-admin.css', array(), PLANTS_VERSION );
		wp_enqueue_style( 'custom-admin-style', PLANTS_CSS_URI . '/admin/plants-admin.css', array(), PLANTS_VERSION );
	}

}


