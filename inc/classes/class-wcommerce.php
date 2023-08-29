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
 * WCommerce
 */
class WCommerce {

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

		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
		add_filter( 'woocommerce_post_class', array( $this, 'add_products_column' ) );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 10 );
		add_action( 'after_setup_theme', array( $this, 'add_woocommerce_support' ) );
		add_filter( 'woocommerce_enqueue_styles', array( $this, 'dequeue_styles' ) );
	}

	/**
	 * Dequeue_styles.
	 *
	 * @param  mixed $enqueue_styles WC Styles.
	 * @return array
	 */
	public function dequeue_styles( $enqueue_styles ) {

		unset( $enqueue_styles['woocommerce-general'] );
		unset( $enqueue_styles['woocommerce-layout'] );
		unset( $enqueue_styles['woocommerce-smallscreen'] );

		return $enqueue_styles;
	}

	/**
	 * Add_woocommerce_support.
	 *
	 * @return void
	 */
	public function add_woocommerce_support() {
					add_theme_support( 'woocommerce' );
	}
	/**
	 * Add to products column system.
	 *
	 * @param mixed $class Class.
	 *
	 * @return string
	 */
	public function add_products_column( $class ) {

		if ( is_shop() ) {
			unset( $class );
			$class[] = 'product';
			$class[] = 'col-4';
			$class[] = 'col-md-6';
			$class[] = 'col-sm-12';
			$class[] = 'content-center';
			$class[] = 'display-flex column';
		}

		return $class;
	}



}
