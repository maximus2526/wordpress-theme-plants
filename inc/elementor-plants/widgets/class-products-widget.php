<?php
/**
 * Widget that display ploducts in slider and without
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

use \Elementor\Controls_Manager;

/**
 * Products_Widget
 */
class Products_Widget extends \Elementor\Widget_Base {


	/**
	 * Get_name.
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_html__( 'products_widget', 'plants' );
	}

	/**
	 * Get_title.
	 *
	 * @return text
	 */
	public function get_title() {
		return esc_html__( 'Products Widget', 'plants' );
	}

	/**
	 * Get_icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return esc_html( 'eicon-products' );
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
		if ( plants_is_wc_exist() ) {
			$this->start_controls_section(
				'section_content',
				array(
					'label' => esc_html__( 'Content', 'plants' ),
				)
			);

			$this->add_control(
				'category',
				array(
					'label'   => esc_html__( 'Product Category', 'plants' ),
					'type'    => Controls_Manager::SELECT,
					'options' => $this->get_product_categories(),
					'default' => 'all',
				)
			);

			$this->add_control(
				'posts_per_page',
				array(
					'label'   => esc_html__( 'Number of Products', 'plants' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 4,
				)
			);

			$this->add_control(
				'is_slider',
				array(
					'label'   => esc_html__( 'Is slider', 'plants' ),
					'type'    => Controls_Manager::SWITCHER,
					'options' => array(
						'no'  => false,
						'yes' => true,
					),
					'default' => 'no',
				)
			);

			$this->add_control(
				'add_to_container',
				array(
					'label'   => esc_html__( 'Add To Container?', 'plants' ),
					'type'    => Controls_Manager::SWITCHER,
					'options' => array(
						'no'  => false,
						'yes' => true,
					),
					'default' => 'no',
				)
			);
			$this->end_controls_section();
		} else {
			$this->start_controls_section(
				'section_content',
				array(
					'label' => esc_html__( 'Content', 'plants' ),
				)
			);
			$this->add_control(
				'is_slider',
				array(
					'label' => esc_html__( "This functionality don't work, must be installed WooCommerce!", 'plants' ),
				)
			);

			$this->end_controls_section();
		}
	}

	/**
	 * Render.
	 *
	 * @return void
	 */
	protected function render() {
		if ( plants_is_wc_exist() ) {
			echo esc_html__( "This functionality don't work, must be installed WooCommerce!", 'plants' );
			return;
		} else {
			$settings = $this->get_settings_for_display();

			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => $settings['posts_per_page'],
				'orderby'        => 'date',
				'order'          => 'DESC',
			);

			if ( 'all' !== $settings['category'] ) {
				$args['tax_query'] = array( // phpcs:ignore
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'term_id',
						'terms'    => $settings['category'],
					),
				);
			}

			$products_query = new WP_Query( $args );

			if ( $products_query->have_posts() ) {
				if ( 'yes' === $settings['add_to_container'] ) {
					echo '<div class="container">';
				}
				if ( 'yes' === $settings['is_slider'] ) {
					echo '<div class="swiper">';
					echo '<div class="swiper-wrapper">';
				} else {
					echo '<div class="products display-flex gap">';
				}

				while ( $products_query->have_posts() ) {
					$products_query->the_post();
					global $product;
					if ( 'yes' === $settings['is_slider'] ) {
						echo '<div  style="text-align: center;" class="swiper-slide">';
					}
					?>
					<div style="text-align: center;" class="product ">
						<?php
						if ( has_post_thumbnail() ) {
							echo '<div class="product-image">';
							the_post_thumbnail( 'thumbnail', array( 'style' => 'width: 100%;height: 400px;' ) );
							echo '</div>';
						}

						echo '<p><a  class="scheme-dark title" href="' . esc_url( get_permalink() ) . '">' . wp_kses_post( get_the_title() ) . '</a></p>';
						?>
						<div class="banner-rating">
							<?php
							$product_obj = wc_get_product( $product->get_id() );

							if ( 'yes' === $settings['is_slider'] ) {
								echo '</div>'; // end swiper slide.
							}

							?>
						</div>
					<?php
					echo '<div class="product-add-to-cart gap">';
					woocommerce_template_loop_add_to_cart( array( 'button_text' => 'Select options' ) );
					echo '</div>';
					echo ' </div>'; // swiper-slide ::end.
				}

				wp_reset_postdata();
				if ( 'yes' === $settings['is_slider'] ) {
					echo '</div>'; // Close .swiper.
					echo '<div class="swiper-button-prev"><img src="' . esc_url( PLANTS_IMG_URI ) . '/svg/swiper/slider-left.svg" alt=""></div>';
					echo '<div class="swiper-button-next"><img src="' . esc_url( PLANTS_IMG_URI ) . '/svg/swiper/slider-right.svg" alt=""></div>';
					echo '</div>'; // Close .swiper-wrapper.
				} else {
					echo '</div>';
				}
				if ( 'yes' === $settings['add_to_container'] ) {
					echo '</div>';
				}
			} else {
				echo esc_html__( 'No products found.', 'plants' );
			}
		}
	}

	/**
	 * Get_product_categories.
	 *
	 * @return array
	 */
	protected function get_product_categories() {
		$categories = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
			)
		);

		$category_options = array( 'all' => esc_html__( 'All Products', 'plants' ) );

		foreach ( $categories as $category ) {
			$category_options[ $category->term_id ] = $category->name;
		}

		return $category_options;
	}
}
