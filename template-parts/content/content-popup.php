<?php
/**
 * Content PopUp
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

	use \Elementor\Plugin as Plugin;

	$popup_width = plants_get_options( 'popup_width', 600 );
	$html_block  = plants_get_options( 'plants_popup_html_block' );
	$all_blocks  = plants_get_html_blocks_data();
?>

<div id="promo-popup" style="width: <?php echo esc_attr( $popup_width ); ?>px;" class="bg-popup mfp-with-anim hide">
	<?php
	foreach ( $all_blocks as $block_id => $block ) {
		if ( $block === $html_block ) {
			echo Plugin::instance()->frontend->get_builder_content( 	$block_id  ); // phpcs:ignore
		}
	}
	?>
</div>
