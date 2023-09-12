<?php
/**
 * Main template file.
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

$page_id = get_the_ID();
if ( is_home() ) {
	$page_id = get_option( 'page_for_posts' );
} elseif ( is_shop() ) {
	$page_id = get_option( 'woocommerce_shop_page_id' );
}
?>
<div class="clearfix"></div>
<?php
if ( 'on' !== get_post_meta( $page_id, 'disable_footer', true ) ) :
	?>
<footer class="container">
	<div class="top-footer">
	<div class="row">
	<?php
	$widget_count = plants_get_options( 'widget_column_choice', 1 );
	foreach ( range( 1, $widget_count ) as $sidebar_id ) :
		?>
		<div class="col-<?php echo (int) ceil( 12 / (int) $widget_count ); ?>">
			<?php
			if ( is_active_sidebar( 'footer-sidebar-' . $sidebar_id ) ) {
				dynamic_sidebar( 'footer-sidebar-' . $sidebar_id );
			}
			?>
		</div>
			<?php
		endforeach;
	?>

	</div>
	</div>
	<div class="bottom-footer display-flex space-between align-center">
		<div class="rights">
			<span>
				<?php
				$footer_rights_text = plants_get_options( 'footer_rights_text' );
				echo esc_html( $footer_rights_text );
				?>
			</span>
		</div>
		<div class="partners">
			<img src="<?php echo esc_url( PLANTS_IMG_URI ); ?>/svg/partners.svg" alt>
		</div>
	</div>
</footer>
	<?php
	endif;
	wp_footer();
?>
</body>

</html>
