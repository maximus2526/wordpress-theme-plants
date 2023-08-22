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

/**
 * Articles_Widget
 */
class Articles_Widget extends Elementor\Widget_Base {

	/**
	 * Get_name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'article_widget';
	}

	/**
	 * Get_title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Article Widget', 'elementor-addon' );
	}

	/**
	 * Get_icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-post';
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
				'label'   => esc_html__( 'Articles Category', 'elementor-addon' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->get_article_categories(),
				'default' => 'all',
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => esc_html__( 'Number of Articles', 'elementor-addon' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
			)
		);

		$this->add_control(
			'is_slider',
			array(
				'label'   => esc_html__( 'Is slider', 'elementor-addon' ),
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
				'label'   => esc_html__( 'Add To Container?', 'elementor-addon' ),
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
			$args['tax_query'] = array(
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
					?>
					<div class="swiper-slide darken-image" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>');">
						<div class="article-banner">
							<div class="banner-content  scheme-light">
								<div class="banner-header">
									<a href="<?php echo esc_attr( get_permalink() ); ?>">
										<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
									</a>
								</div>
								<div class="banner-description opacity-80">
									<?php the_excerpt(); ?>
								</div>
							</div>
						</div>
					</div>

					<?php
				}

				echo '</div>'; // Close .swiper-wrapper.
				echo '</div>'; // Close .swiper.
			} else {
				?>
				<div class="row">
				<?php
				while ( $articles_query->have_posts() ) {
					$articles_query->the_post();
					?>

			<div class="col-12">
				<div class="article display-flex align-center gap">
					<div class="article-img">
					<?php echo get_the_post_thumbnail(); ?>
					</div>

					<div class="article-content-wrapper display-flex space-between align-center">
						<div class="article-content">
							<div class="author">
								Posted by
								<?php the_author(); ?>
							</div>
							<div class="article-header">
								<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
							</div>
						</div>
						<div class="continue-button">
							<a href="<?php echo esc_attr( get_permalink() ); ?>">
								Continue reading →
							</a>
						</div>
					</div>
				</div>
			</div>

					<?php
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

		$category_options = array( 'all' => esc_html__( 'All Articles', 'elementor-addon' ) );

		foreach ( $categories as $category ) {
			$category_options[ $category->term_id ] = $category->name;
		}

		return $category_options;
	}
}
