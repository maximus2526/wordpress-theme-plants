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
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			the_content();

		endwhile;
	endif;

	?>

</div>

<?php
get_footer();
?>
