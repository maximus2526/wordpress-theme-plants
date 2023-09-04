<?php
/**
 * Index.php
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

get_header();
?>
<div class="container">
	<h3 class="green-text"><?php esc_html__( 'Blog', 'plants' ); ?></h3>
	<div class="row">
		<div class="col-3 <?php echo ( 'on' === get_post_meta( $blog_page_id, 'disable_sidebar', true ) ) ? 'disabled' : ''; ?>">
			<?php get_sidebar(); ?>
		</div>
		<div class="col-<?php echo ( 'on' === get_post_meta( $blog_page_id, 'disable_sidebar', true ) ) ? '12' : '9'; ?>">
		<?php if ( is_home() && ! empty( single_post_title( '', false ) ) ) : ?>
			<?php
			if ( have_posts() ) {

				// Load posts loop.
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content/content-post-card' );
				}
				wp_link_pages();
				the_posts_pagination();
			} else {
				// If no content, include the "No posts found" template.
				get_template_part( 'template-parts/content/content-none' );
			}
			?>
		</div>
	</div>

</div>
			<?php
			get_footer();
			endif;
		?>
