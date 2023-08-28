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
			<div class="display-flex gap">
			<?php
				the_taxonomies();
			?>
			</div>
			<?php

			the_post();
			?>
				<h2 class='title'>
				<?php the_title(); ?>
				</h2>
				<?php
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
