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
	 * get_name
	 *
	 * @return void
	 */
	public function get_name() {
		return esc_html__( 'subscribe_widget', 'plants' );
	}

	/**
	 * get_title
	 *
	 * @return void
	 */
	public function get_title() {
		return esc_html__( 'Subscribe Form Widget', 'elementor-addon' );
	}

	/**
	 * get_icon
	 *
	 * @return void
	 */
	public function get_icon() {
		return 'eicon-star';
	}

	/**
	 * get_categories
	 *
	 * @return void
	 */
	public function get_categories() {
		return array( 'theme-widgets' );
	}

	/**
	 * render
	 *
	 * @return void
	 */
	protected function render() {       ?>
		<form action="" method="post" id="footer-subscribe-input" class="subscribe-input display-flex gap-5">
			<input placeholder="Enter your email" type="email" name="subscribe-email">
			<button class="button" type="submit">Subscribe</button>
		</form>
		<?php
	}
}
