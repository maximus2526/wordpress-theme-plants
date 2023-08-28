<?php
/**
 * Main template file.
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

?>

<footer class="container">
	<div class="top-footer">
		<div class="row">
			<div class="col-6 left-side col-md-12">
				<div class="logo-section">
					<a href="/"><img src="<?php echo esc_url( PLANTS_IMG_URI ); ?>/svg/logo.svg" alt="Woodmart"></a>
				</div>
				<div class="subscribe-block display-flex column gap">
					<label for="footer-subscribe-input"><?php echo esc_html__( 'Join our newsletter	to	stay up to date on features and releases.', 'plants' ); ?></label>
					<form action="" method="post" id="footer-subscribe-input" class="subscribe-input display-flex gap-5">
						<input placeholder=<?php echo esc_html__( 'Enter your email', 'plants' ); ?> type="email" name="subscribe-email">
						<button class="button" type="submit"><?php echo esc_html__( 'Subscribe', 'plants' ); ?></button>
					</form>
					<div class="text">
					<?php echo esc_html__( 'By subscribing you agree to with our Privacy Policy and provide consent to receive updates from our company.', 'plants' ); ?>
					</div>
				</div>
				<div class="social">
					<a href=""><span class="social-icons">FB</span></a>
					<a href=""><span class="social-icons">TW</span></a>
					<a href=""><span class="social-icons">IN</span></a>
				</div>
			</div>		
			<div class="col-6 right-side display-flex justify-around col-md-12">
				<?php
					plants_get_footer_menus(); // Print footer menus.
				?>
			</div>
	</div>
</div>
	<div class="bottom-footer display-flex space-between align-center">
				<div class="rights">
					<span>
						<?php
							$footer_rights_text = plants_get_options()['footer_rights_text'];
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

