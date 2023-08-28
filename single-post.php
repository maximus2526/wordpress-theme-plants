<?php
/**
 * Single post show post pages
 *
 * @package  Plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

get_header();

?>
<div class="container">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			?>
			<div class="article-heading  display-flex column content-center gap">
				<div class="post-header scheme-dark">
					<?php
						the_taxonomies();
					?>
				</div>
				<div class="article-content display-flex column content-center">
					<div class="author">
						<?php echo esc_html__( 'Posted by', 'plants' ); ?>
						<?php the_author_meta( 'display_name', 1 ); ?>
					</div>
					<div class="article-header">
						<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
					</div>
					<div class="marks display-flex content-center">
						<?php
							the_tags( '' );
						?>
					</div>
				</div>
		</div>
			<?php
			the_post();
			?>
				<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
					<?php
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0];
					?>
					<img class='single-post-thumbnail' src="<?php echo esc_url( $image ); ?>" alt="single-post-thumbnail">
					<?php
				endif;
				the_content();
				if ( is_singular() ) {
					wp_enqueue_script( 'comment-reply' );
					comments_template();
				}
		}
	} else {
		get_template_part( 'template-parts/content/content-none' );
	};
	?>

</div>

<?php
get_footer();
?>
