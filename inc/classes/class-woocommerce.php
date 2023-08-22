<?php
/**
 * Woocommerce support.
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

/**
 * WooCommerce
 */
class WooCommerce {


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
		add_action( 'after_setup_theme', 'theme_add_woocommerce_support' );
		add_action( 'wp_enqueue_scripts', 'theme_load_woocommerce_styles' );

	}

	/**
	 * Theme_add_woocommerce_support.
	 *
	 * @return void
	 */
	private function add_woocommerce_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	/**
	 * Theme_load_woocommerce_styles.
	 *
	 * @return void
	 */
	private function load_woocommerce_styles() {
		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_style( 'woocommerce-style', plugins_url( '/woocommerce/woocommerce.css' ), 1, 1 );
		}
	}

}
