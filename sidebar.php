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
<?php

if ( is_active_sidebar( 'main-sidebar' ) ) {
	dynamic_sidebar( 'main-sidebar' );
}

