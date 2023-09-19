<?php
/**
 * Display categories menus
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

/**
 * Categories_Menus_Widget
 */
class Categories_Menus_Widget extends Widget_Base {




	/**
	 * Get_name.
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_html( 'categories_menus_widget' );
	}

	/**
	 * Get_title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Categories Menus Widget', 'plants' );
	}

	/**
	 * Get_icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return esc_html( 'eicon-library-save' );
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
	 * Register_controls.
	 *
	 * @return void
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'display_category_menu',
			array(
				'label' => esc_html__( 'Display Categories Menu', 'plants' ),
			)
		);

		$this->add_control(
			'categories_count',
			array(
				'label'   => esc_html__( '(max for row: 12) Count: ', 'plants' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 12,
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render.
	 *
	 * @return void
	 */
	protected function render() {
		if ( ! plants_is_wc_exist() ) {
			echo esc_html__( "This functionality don't work, must be installed WooCommerce!", 'plants' );
			return;
		} else {
			$settings = $this->get_settings_for_display();

			$categories = get_categories(
				array(
					'hide_empty' => 0,
					'number'     => $settings['categories_count'],
					'taxonomy'   => 'product_cat',
				)
			);
			?>
		<div class="container">
			<div class="row row-spacing">
				<?php
				foreach ( $categories as $category ) {
					$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
					?>
					<div class="col-<?php echo (int) round( 12 / count( $categories ) ); ?> content-center">
						<div class="category-block display-flex column gap-5 content-center">
							<div class="category-img">
								<?php
								echo wp_get_attachment_image( $thumbnail_id, array( 75, 75 ) );
								?>
							</div>
							<div class="category-name">
								<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">	<?php echo esc_html( $category->name ); ?></a>
							</div>
							<div class="product-count text">
								<?php
								echo (int) $category->count . esc_html__( ' products.', 'plants' );
								?>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
			<?php
		}
	}
}
