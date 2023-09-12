<?php
/**
 * Widget that show articles in slider and without
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

/**
 * Articles_Widget
 */
class Articles_Widget extends Widget_Base {


	/**
	 * Get_name.
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_html__( 'article_widget', 'plants' );
	}

	/**
	 * Get_title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Article Widget', 'plants' );
	}

	/**
	 * Get_icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return esc_html( 'eicon-post' );
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
	protected function _register_controls() { // phpcs:ignore
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'plants' ),
			)
		);

		$this->add_control(
			'category',
			array(
				'label'   => esc_html__( 'Articles Category', 'plants' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->get_article_categories(),
				'default' => 'all',
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => esc_html__( 'Number of Articles', 'plants' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
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
				'type'    => Controls_Manager::SELECT,
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
	 * Render.
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$args = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby'        => 'date',
			'order'          => 'DESC',
		);

		if ( 'all' !== $settings['category'] ) {
			$args['tax_query'] = array( // phpcs:ignore
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $settings['category'],
				),
			);
		}

		$articles_query = new WP_Query( $args );

		if ( $articles_query->have_posts() ) {
			if ( 'yes' === $settings['add_to_container'] ) {
				echo '<div class="container">';
			}
			if ( 'yes' === $settings['is_slider'] ) {
				echo '<div class="swiper-banner">';
				echo '<div class="swiper-wrapper ">';

				while ( $articles_query->have_posts() ) {
					$articles_query->the_post();
					get_template_part( 'template-parts/content/content-post-card-swiper' );
				}

				echo '</div>'; // Close .swiper-wrapper.
				echo '</div>'; // Close .swiper.
			} else {
				?>
				<div class="row">
					<?php
					while ( $articles_query->have_posts() ) {
						$articles_query->the_post();

						get_template_part( 'template-parts/content/content-post-card' );
					}
					?>
				</div>
				<?php
			}

			wp_reset_postdata();

			if ( 'yes' === $settings['add_to_container'] ) {
				echo '</div>';
			}
		} else {
			echo esc_html__( 'No articles found.', 'plants' );
		}
	}



	/**
	 * Get_article_categories.
	 *
	 * @return array
	 */
	protected function get_article_categories() {
		$categories = get_terms(
			array(
				'taxonomy'   => 'category',
				'hide_empty' => true,
			)
		);

		$category_options = array( 'all' => esc_html__( 'All Articles', 'plants' ) );

		foreach ( $categories as $category ) {
			$category_options[ $category->term_id ] = $category->name;
		}

		return $category_options;
	}
}
