<?php
/**
 * Product-card.
 *
 * @package  Plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

if ( plants_is_wc_exist() ) {
	$product = wc_get_product( get_the_ID() );
	?>

<div class="col-4 col-md-6 col-sm-12">
	<div class="product-card">
		<?php
		if ( $product->is_on_sale() ) {
			echo '<span class="onsale"> ' . esc_html__( 'On Sale!', 'plants' ) . '</span>';
		}
		?>
		<a href="<?php echo esc_url( get_permalink() ); ?>"><img class="product-img" src="<?php echo esc_html( plants_get_product_img( 700, 800, $product ) ); ?>" alt="product img"></a>
		<div class="woocommerce-loop-product__title text-center">
			<h4><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( $product->get_title() ); ?></a></h4>
		</div>
		<div class="product-price text-center">
			<span class="price">
				<?php echo esc_html( $product->get_price() ); ?>
			</span>
			<span class="old-price">
				<?php echo esc_html( $product->get_regular_price() ); ?>
			</span>
			<?php echo do_shortcode( '[add_to_cart id=' . get_the_ID() . ' style="false" show_price="false" quantity="1" ]' ); ?>
		</div>
	</div>
</div>
	<?php
} else {
	echo esc_html__( "This functionality don't work, must be installed WooCommerce!", 'plants' );
}
?>
