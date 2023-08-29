<?php
/**
 * Single Product show product pages
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
			the_post();
			?>
				<?php
				get_template_part( 'template-parts/content/content-single-product' );
		}
	} else {
		get_template_part( 'template-parts/content/content-none' );
	};
	?>

</div>

<?php
get_footer();
?>
