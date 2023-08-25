<?php
/**
 * Content Post Card with swiper functionality.
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

?>

<div class="swiper-slide darken-image" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>');">
						<div class="article-banner">
							<div class="banner-content  scheme-light">
								<div class="banner-header">
									<a href="<?php echo esc_attr( get_permalink() ); ?>">
										<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
									</a>
								</div>
<div class="banner-description opacity-80">
<?php the_excerpt(); ?>
</div>
</div>
</div>
</div>
