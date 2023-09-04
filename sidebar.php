<?php
/**
 * SideBar.php show sidebar
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

?>
<div class="container">
<?php
if ( is_active_sidebar( 'main-sidebar' ) && 'on' !== get_post_meta( get_the_ID(), 'disable_sidebar', true ) && ! is_shop() ) {
	dynamic_sidebar( 'main-sidebar' );
}
?>
</div>
