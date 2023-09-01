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
<div class="container">
 <?php
	get_search_form();
	$args      = array(
		's' => get_search_query(),
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		echo ( "<h2 style='font-weight:bold;color:#000'>Search Results for: " . esc_html( get_query_var( 's' ) ) . '</h2>' );
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			?>
   <li>
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
   </li>
			<?php
		}
	} else {
		?>
  <h2 style='font-weight:bold;color:#000'>Nothing Found</h2>
  <div class="alert alert-info">
   <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
  </div>
	<?php } ?>
 <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
