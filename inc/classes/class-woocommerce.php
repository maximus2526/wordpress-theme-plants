<?php
/**
 * Woocommerce support.
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
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
		if ( plants_is_wc_exist() ) {
			$this->setup_hooks();
		}
	}

	/**
	 * Setup_hooks.
	 *
	 * @return void
	 */
	protected function setup_hooks() {
		add_action( 'after_setup_theme', array( $this, 'add_woocommerce_support' ) );
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
		add_filter( 'woocommerce_post_class', array( $this, 'add_products_column' ) );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 10 );
		add_filter( 'woocommerce_enqueue_styles', array( $this, 'dequeue_styles' ) );
		add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
		add_action( 'woocommerce_before_main_content', array( $this, 'print_container' ), 10, 0 );
		add_action( 'woocommerce_after_main_content', array( $this, 'print_end_container' ), 99 );
		add_action( 'woocommerce_after_single_product_summary', array( $this, 'css_clear_fix' ), 9, 0 );
		add_filter( 'woocommerce_show_page_title', '__return_empty_array' );
		if ( 'on' === get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'disable_sidebar', true ) && null !== get_option( 'woocommerce_shop_page_id' ) ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}

	}




	/**
	 * Css_clear_fix.
	 *
	 * @return void
	 */
	public function css_clear_fix() {
		echo '<div class="clearfix"></div>';
	}

	/**
	 * Print container div in single product.
	 *
	 * @return void
	 */
	public function print_container() {
		echo '<div class="container">';

	}

	/**
	 * Print container </div> in end single product.
	 *
	 * @return void
	 */
	public function print_end_container() {
		echo '</div>';
	}

	/**
	 * Dequeue_styles.
	 *
	 * @param  array $enqueue_styles WC Styles.
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
	 * @param string $class Class.
	 *
	 * @return string
	 */
	public function add_products_column( $class ) {
		if ( is_shop() ) {
			$class[] = 'col-4';
			$class[] = 'col-md-6';
			$class[] = 'col-sm-12';
			$class[] = 'content-center';
			$class[] = 'display-flex column';
		}
		return $class;
	}
}
