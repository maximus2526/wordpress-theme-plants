<?php
/**
 * Content None
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

?> 
<div class="container">
<?php
if ( is_search() ) :
	?>

	<p><?php echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'plants' ); ?></p>
	<?php get_search_form(); ?>

	<?php else : ?>

	<p><?php echo esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'plants' ); ?></p>
		<?php get_search_form(); ?>

<?php endif; ?>
</div>
