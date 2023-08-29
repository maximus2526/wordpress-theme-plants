<?php
/**
 * Content Post Card .
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

?>
<div id="blog-article  post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="row">
	<div class="col-12">
	<div class="article display-flex gap">
		<div class="article-img">
		<?php echo get_the_post_thumbnail(); ?>
		</div>

		<div class="article-content-wrapper display-flex space-between align-center">
			<div class="article-content">
				<div class="author">
					<?php echo esc_html__( 'Posted by', 'plants' ); ?>
					<img class="posted-by-avatar" src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ); ?>" alt="avatar">
					<?php the_author(); ?>
				</div>
				<div class="article-header">
					<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
				</div>
				<div class="marks">
					<?php
						the_tags( '' );
					?>
				</div>
			</div>
			<div class="continue-button">
				<a href="<?php echo esc_attr( get_permalink() ); ?>">
	<?php echo esc_html__( 'Continue reading →', 'plants' ); ?>
				</a>
			</div>
		</div>
	</div>
</div>
</div>
