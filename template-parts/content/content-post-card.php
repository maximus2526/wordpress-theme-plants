<?php
/**
 * Content Post Card
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

$options        = array(
	'post_type'      => 'post',
	'posts_per_page' => isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : 3,
);
$articles_query = new WP_Query( $options );

if ( $articles_query->have_posts() ) {
	while ( $articles_query->have_posts() ) {
		$articles_query->the_post();
		?>

		<div class="article display-flex align-center gap">
			<div class="article-img">
				<?php echo get_the_post_thumbnail(); ?>
			</div>

			<div class="article-content-wrapper display-flex space-between align-center">
				<div class="article-content">
					<div class="author">
						Posted by <?php the_author(); ?>
					</div>
					<div class="article-header">
						<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
					</div>
				</div>
				<div class="continue-button">
					<a href="<?php echo get_permalink(); ?>">
						Continue reading →
					</a>
				</div>
			</div>
		</div>

		<?php
	}
	wp_reset_postdata();
} else {
	echo esc_html__( 'No articles found.', 'plants' );
}
?>
