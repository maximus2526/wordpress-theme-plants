<?php
/**
 * Search.php show search result .
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

get_header();
?>
<div class='container'>
	<?php
	get_search_form();
	$args      = array(
		's' => get_search_query(),
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
		?>
		<h2><?php echo esc_html__( 'Search Results for ', 'plants' ) . ': ' . esc_html( get_query_var( 's' ) ); ?> </h2>;
		<?php
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			?>
			<li>
				<a href='<?php the_permalink(); ?>'><?php the_title(); ?></a>
			</li>
			<?php
		}
	else :
		?>
		<h2><?php esc_html__( 'Nothing Found', 'plants' ); ?></h2>
		<div class="alert alert-info">
			<p><?php echo esc_html__( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'plants' ); ?></p>
		</div>
	<?php endif; ?>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
