<?php
/**
 * Post Types support.
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;


/**
 * Post Types.
 */
class Post_Types {


	use Singleton;

	/**
	 * __construct
	 *
	 * @return void
	 */
	protected function __construct() {
		add_action( 'init', array( $this, 'create_posttypes' ) );
		add_action( 'after_switch_theme', array( $this, 'add_elementor_support' ) );
	}


	/**
	 * Create_posttype.
	 *
	 * @return void
	 */
	public function create_posttypes() {
		register_post_type(
			'html-block',
			array(
				'labels'      => array(
					'name'          => esc_html( 'Html ' ) . esc_html__( 'Blocks', 'plants' ),
					'singular_name' => esc_html( 'Html ' ) . esc_html__( 'Block', 'plants' ),
				),
				'public'      => true,
				'has_archive' => false,
				'rewrite'     => array( 'slug' => 'html-block' ),
			)
		);
	}


	/**
	 * Add_elementor_support.
	 *
	 * @return void
	 */
	public function add_elementor_support() {
		$cpt_support = get_option( 'elementor_cpt_support' );
		if ( ! $cpt_support ) {
			$cpt_support = array( 'html-block' );
			update_option( 'elementor_cpt_support', $cpt_support );
		} elseif ( ! in_array( 'html-block', $cpt_support, true ) ) {
			$cpt_support[] = 'html-block';
			update_option( 'elementor_cpt_support', $cpt_support );
		}
	}
}


