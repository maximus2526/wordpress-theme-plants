<?php
/**
 * Shop Page.
 *
 * @package  Plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

get_header();

?>
<main class="shop-page container">

	<?php
	woocommerce_breadcrumb();
	?>
 <div class="row">
 <?php
	if ( have_posts() ) {
		while ( have_posts() ) {

			the_post();
			get_template_part( 'template-parts/content/content-product-card' );
		}
		the_posts_pagination();
	} else {
		get_template_part( 'template-parts/content/content-none' );
	};
	?>
</main>
</div>
<?php
get_footer();
?>
