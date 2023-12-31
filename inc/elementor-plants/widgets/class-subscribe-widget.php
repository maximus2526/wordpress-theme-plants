<?php
/**
 * Subscribe-Widget: diplay subscribe form
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

/**
 * Subscribe_Widget
 */
class Subscribe_Widget extends \Elementor\Widget_Base {


	/**
	 * Get_name.
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_html( 'subscribe_widget' );
	}

	/**
	 * Get_title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Subscribe Form Widget', 'plants' );
	}

	/**
	 * Get_icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return esc_html( 'eicon-star' );
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
	 * Render.
	 *
	 * @return void
	 */
	protected function render() {          ?>
		<form action="" method="post" id="footer-subscribe-input" class="subscribe-input display-flex gap-5">
			<input placeholder="<?php esc_html__( 'Enter your email', 'plants' ); ?>" type="email" name="subscribe-email">
			<button class="button" type="submit"><?php echo esc_html__( 'Subscribe', 'plants' ); ?></button>
		</form>
		<?php
	}
}
