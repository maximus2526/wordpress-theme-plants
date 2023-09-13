<?php
/**
 * Menu Dropdown
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

use \Elementor\Plugin as Plugin;

$result        = array();
$dropdown_data = get_option( 'dropdown-nav-menu-options' ) ?? '';
$query         = new WP_Query(
	array(
		'meta_key' => 'menus-selection',
	)
);
// var_dump($query);
while ( $query->have_posts() ) {
	$query->the_post();
	the_title(); 
	var_dump( get_post_meta( the_ID(), 'menus-selection', true ) );
}

?>
<div data-id="<?php echo (int) $dropdown_data['nav_menu_item_id']; ?>" class="scheme-dark menus-item-dropdown-section">
	<?php
	if ( is_plugin_active( 'elementor/elementor.php' ) && $dropdown_data ) {
		echo Plugin::instance()->frontend->get_builder_content( $dropdown_data['html_block_id'] ); // phpcs:ignore
	} else {
		$post = get_post( $posts_id );
		echo wp_kses_post( $post->post_content );
	}
	?>
</div>
