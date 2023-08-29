<?php
/**
 * Content Single Product.
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

?>

<div class="container">
		<?php woocommerce_breadcrumb(); ?>
		<div class="row">
			<div class="single-product-galery col-7 col-md-12">
				<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
			</div>
			<div class="single-product-short-description col-5 col-md-12">
			<?php do_action( 'woocommerce_single_product_summary' ); ?>
			</div>
		</div>
</div>
