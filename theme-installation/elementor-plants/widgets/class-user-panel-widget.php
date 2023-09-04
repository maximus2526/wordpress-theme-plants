<?php
/**
 * Display user panel
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

/**
 * User_Panel_Widget
 */
class User_Panel_Widget extends \Elementor\Widget_Base {


	/**
	 * Get_name.
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_html__( 'user_panel_widget', 'plants' );
	}

	/**
	 * Get_title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'User Panel Widget', 'plants' );
	}

	/**
	 * Get_icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return esc_html( 'eicon-user-circle-o' );
	}

	/**
	 * Get_categories.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'theme-widgets' );
	}

	/**
	 * _register_controls
	 *
	 * @return void
	 */
	protected function _register_controls(){}

	/**
	 * Render.
	 *
	 * @return void
	 */
	protected function render() {       ?>
		<div class="profile-section display-flex align-center gap col-right scheme-dark">
			<div class="search-field">
				<a href><img src="<?php echo esc_html( esc_url( PLANTS_IMG_URI ) ); ?>/svg/search.svg" alt="search-sign"></a>
			</div>
			<div class="auth display-flex gap-5">
				<a href=""><?php esc_html__( 'Login', 'plants' ); ?></a> / <a href="/wp-login.php?action=register"><?php esc_html__( 'Register', 'plants' ); ?></a>

			</div>
			<?php if ( plants_is_wc_exist() ) : ?>
				<div class="cart-section display-flex gap ">
					<div class="favorite">
						<a href class="display-flex gap-5">
							<img src="<?php echo esc_html( esc_url( PLANTS_IMG_URI ) ); ?>/svg/profile-icons/favorite.svg" alt>
							<span class="favorite-count">0</span>
						</a>
					</div>
					<div class="cart">
						<?php
						global $woocommerce;
						if ( ! WC()->cart ) {
							return;
						}
						?>
						<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="display-flex gap-5">
							<img src="<?php echo esc_url( PLANTS_IMG_URI ); ?>/svg/profile-icons/cart.svg" alt>
							<span class="cart-count">
								<?php echo (int) $woocommerce->cart->get_cart_contents_count(); ?>
							</span>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
