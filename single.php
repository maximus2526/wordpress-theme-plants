<?php
/**
 * Single.php show post/product pages
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
	if ( is_product() ) {
		woocommerce_content();
		comments_template();
	} elseif ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
				<h2 class='title'>
				<?php the_title(); ?>
				</h2>
				<?php
				the_content();
				comments_template();
		}
	} else {
		get_template_part( 'template-parts/content/content-none' );
	};
	?>

</div>

<?php
get_footer();
?>
