<?php
/**
 * SideBar.php show sidebar
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

if ( is_active_sidebar( 'main-sidebar' ) && 'on' !== get_post_meta( get_the_ID(), 'disable_sidebar', true ) ) {
	dynamic_sidebar( 'main-sidebar' );
}
