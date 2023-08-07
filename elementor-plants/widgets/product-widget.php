<?php
/**
 * Widget that display ploducts in slider and without
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

/**
 * Products_Widget
 */
class Products_Widget extends \Elementor\Widget_Base {

	/**
	 * get_name
	 *
	 * @return void
	 */
	public function get_name() {
		return 'products_widget';
	}

	/**
	 * get_title
	 *
	 * @return void
	 */
	public function get_title() {
		return esc_html__( 'Products Widget', 'elementor-addon' );
	}

	/**
	 * get_icon
	 *
	 * @return void
	 */
	public function get_icon() {
		return 'eicon-products';
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
	 * _register_controls
	 *
	 * @return void
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'elementor-addon' ),
			)
		);

		$this->add_control(
			'category',
			array(
				'label'   => esc_html__( 'Product Category', 'elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $this->get_product_categories(),
				'default' => 'all',
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => esc_html__( 'Number of Products', 'elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 4,
			)
		);

		$this->add_control(
			'is_slider',
			array(
				'label'   => esc_html__( 'Is slider', 'elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
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
				'label'   => esc_html__( 'Add To Container?', 'elementor-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no'  => false,
					'yes' => true,
				),
				'default' => 'no',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * render
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby'        => 'date',
			'order'          => 'DESC',
		);

		if ( $settings['category'] !== 'all' ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $settings['category'],
				),
			);
		}

		$products_query = new WP_Query( $args );

		if ( $products_query->have_posts() ) {
			if ( $settings['add_to_container'] === 'yes' ) {
				echo '<div class="container">';
			}
			if ( $settings['is_slider'] === 'yes' ) {
				echo '<div class="swiper">';
				echo '<div class="swiper-wrapper">';
			} else {
				echo '<div class="products display-flex gap">';
			}

			while ( $products_query->have_posts() ) {
				$products_query->the_post();
				global $product;
				if ( $settings['is_slider'] === 'yes' ) {
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

					echo '<p><a  class="scheme-dark title" href="' . get_permalink() . '">' . get_the_title() . '</a></p>';
					?>
					<div class="banner-rating">
						<?php

						$product_obj = wc_get_product( $product->get_id() );

						// Моя спроба виводити один віджет з іншого
						// require_once ('custom-stars-widget.php');
						// $stars = new Widget_Star_Rating_Plus($star_rating_settings);
						// $stars->render();

						$product_obj = wc_get_product( $product->get_id() );
						echo wc_get_rating_html( $product_obj->get_average_rating() );

						if ( $settings['is_slider'] === 'yes' ) {
							echo '</div>'; // end swiper slide
						}

						?>
					</div>
					<?php
					echo '<div class="product-add-to-cart gap">';
					woocommerce_template_loop_add_to_cart( array( 'button_text' => 'Select options' ) );
					echo '</div>';

					?>
				



				<?php
				echo ' </div>'; // swiper-slide ::end
			}

			wp_reset_postdata();
			if ( $settings['is_slider'] === 'yes' ) {
				echo '</div>'; // Close .swiper
				echo '<div class="swiper-button-prev"><img src="' . PLANTS_IMG_URI . '/svg/swiper/slider-left.svg" alt=""></div>';
				echo '<div class="swiper-button-next"><img src="' . PLANTS_IMG_URI . '/svg/swiper/slider-right.svg" alt=""></div>';
				echo '</div>'; // Close .swiper-wrapper
			} else {
				echo '</div>';
			}
			if ( $settings['add_to_container'] === 'yes' ) {
				echo '</div>';
			}
		} else {
			echo esc_html__( 'No products found.', 'elementor-addon' );
		}
	}

	/**
	 * get_product_categories
	 *
	 * @return void
	 */
	protected function get_product_categories() {
		$categories = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
			)
		);

		$category_options = array( 'all' => esc_html__( 'All Products', 'elementor-addon' ) );

		foreach ( $categories as $category ) {
			$category_options[ $category->term_id ] = $category->name;
		}

		return $category_options;
	}
}
