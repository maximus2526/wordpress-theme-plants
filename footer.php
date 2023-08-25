<?php
/**
 * Main template file.
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

use Elementor\Element_Section;
use PLANTS\Inc\Menus;

?>

<footer class="container">
	<div class="top-footer display-flex">
		<div class="left-side">
			<section class="sidebar">

				<aside>
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</aside>

			</section>

			<div class="logo-section">
				<a href="/"><img src="<?php echo esc_url( PLANTS_IMG_URI ); ?>/svg/logo.svg" alt="Woodmart"></a>
			</div>
			<div class="subscribe-block display-flex column gap">
				<label for="footer-subscribe-input">Join our newsletter
					to
					stay up to date on features and releases.</label>
				<form action="" method="post" id="footer-subscribe-input" class="subscribe-input display-flex gap-5">
					<input placeholder="Enter your email" type="email" name="subscribe-email">
					<button class="button" type="submit">Subscribe</button>
				</form>
				<div class="text">
					By subscribing you agree to with our Privacy Policy
					and
					provide consent to receive updates from our company.
				</div>
			</div>
			<div class="social">
				<a href=""><span class="social-icons">FB</span></a>
				<a href=""><span class="social-icons">TW</span></a>
				<a href=""><span class="social-icons">IN</span></a>
			</div>
		</div>


		<div class="right-side display-flex justify-around">
		<?php
		$menu_names        = get_option( 'plants_options' )['show_menu'];
		$menu_titles       = get_option( 'plants_options' )['menus_titles'];
		$arrays_difference = array_keys( array_diff_key( $menu_titles, $menu_names ) );

		foreach ( $arrays_difference as $name ) {
			unset( $menu_titles[ $name ] );
		}
		$menus = array_combine( $menu_names, $menu_titles );
		foreach ( $menus as $menu_name => $menu_title ) :
			?>
			<div class="footer-nav display-flex column scheme-dark">
				<div class="nav-title"><?php echo esc_html( $menu_title ); ?></div>
				<?php
				wp_nav_menu(
					array(
						'menu' => $menu_name,
					)
				);
				?>
			</div>
			<?php
			endforeach;
		?>
		</div>
	</div>
	</div>
	<div class="bottom-footer display-flex space-between align-center">
		<div class="rights">
			<span>
				<?php
					$footer_rights_text = get_option( 'plants_options' )['footer_rights_text'];
					echo esc_html( $footer_rights_text );
				?>
			</span>
		</div>
		<div class="partners">
			<img src="<?php echo esc_url( PLANTS_IMG_URI ); ?>/svg/partners.svg" alt>
		</div>
	</div>
</footer>


<?php
wp_footer();
?>
</body>

</html>

