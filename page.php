<?php
/**
 * Page.php show pages
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

get_header();
?>
<div class="container">
	<div class="row">
		<?php if ( 'on' !== get_post_meta( get_the_ID(), 'disable_sidebar', true ) ) : ?>
			<div class="col-3  col-sm-12">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
		<div class="col-<?php echo ( 'on' === get_post_meta( get_the_ID(), 'disable_sidebar', true ) && is_page() ) ? '12' : '9'; ?>  col-sm-12">
			<?php

			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
			endif;

			if ( ! plants_is_wc_exist() ) {
				echo esc_html__( "This functionality don't work, must be installed WooCommerce!", 'plants' );
			}
			?>
		</div>
	</div>
</div>

<?php
get_footer();
?>
