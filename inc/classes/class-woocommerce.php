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
		$this->plants_setup_hooks();
	}

	/**
	 * setup_hooks
	 *
	 * @return void
	 */
	protected function plants_setup_hooks() {
		add_action( 'after_setup_theme', 'theme_add_woocommerce_support' );
		add_action( 'wp_enqueue_scripts', 'theme_load_woocommerce_styles' );

	}

	/**
	 * theme_add_woocommerce_support
	 *
	 * @return void
	 */
	function plants_add_woocommerce_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	/**
	 * theme_load_woocommerce_styles
	 *
	 * @return void
	 */
	function plants_load_woocommerce_styles() {
		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_style( 'woocommerce-style', plugins_url( '/woocommerce/woocommerce.css' ) );
		}
	}

}
