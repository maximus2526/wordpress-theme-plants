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
	 * @return void
	 */
	public function get_name() {
		return esc_html__( 'user_panel_widget', 'plants' );
	}

	/**
	 * Get_title.
	 *
	 * @return void
	 */
	public function get_title() {
		return esc_html__( 'User Panel Widget', 'elementor-addon' );
	}

	/**
	 * Get_icon.
	 *
	 * @return void
	 */
	public function get_icon() {
		return 'eicon-user-circle-o';
	}

	/**
	 * Get_categories.
	 *
	 * @return void
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
				<a href><img src="<?php echo esc_html__(PLANTS_IMG_URI, 'plants'); ?>/svg/search.svg" alt="search-sign"></a>
			</div>
			<div class="auth display-flex gap-5">
				<a href="">Login</a> / <a href="/wp-login.php?action=register">Register</a>

			</div>
			<div class="cart-section display-flex gap ">
				<div class="favorite">
					<a href class="display-flex gap-5">
						<img src="<?php echo esc_html__(PLANTS_IMG_URI, 'plants'); ?>/svg/profile-icons/favorite.svg" alt>
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
						<img src="<?php echo PLANTS_IMG_URI; ?>/svg/profile-icons/cart.svg" alt>
						<span class="cart-count">
							<?php echo (int) $woocommerce->cart->get_cart_contents_count(); ?>
						</span>
					</a>
				</div>

			</div>
		</div>
		<?php
	}
}
