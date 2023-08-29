<?php
/**
 * Archive.php
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

get_header();

?>

<div class="container">
<div class="row">
	<div class="col-12">
		<h3 class="green-text"><?php esc_html__( 'Archive', 'plants' ); ?></h3>
	</div>
</div>
<div class="row">

	<?php
	if ( have_posts() ) {

		// Load posts loop.
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content/content-post-card' );
		}
		wp_link_pages();
		the_posts_pagination();

	} else {

		// If no content, include the "No posts found" template.
		get_template_part( 'template-parts/content/content-none' );

	}
	?>
</div>
</div>
	<?php

	get_footer();

	?>