<?php
/**
 * Comments template
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" <?php echo comment_class( 'comments-area' ); ?> >

	<?php
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
		<?php
		$comments_number = get_comments_number();
		if ( 1 === $comments_number ) {
			echo esc_html__( '1 Comment ', 'plants' );
		} else {
			echo (int) $comments_number . esc_html__( ' Comments', 'plants' );
		}
		?>
		</h2>

		<ol class="comment-list">
		<?php
		wp_list_comments(
			array(
				'style' => 'color:black;',
			)
		);
		?>
		</ol>

		<?php
		the_comments_pagination();
		?>

		<?php
	endif;
	?>

	<?php

	$args = array(

		'label_submit'  => esc_html__( 'Post Comment', 'plants' ),
		'fields'        => array(
			'author'    => '<div class="name-email-inputs display-flex gap"><input id="author" name="author" type="text" value="" size="30"  />',
			'email'     => '<input id="email" name="email" type="email" value="" size="30"  /></div>',
			'your_site' => '<div class="comment-email comment-block"><input id="email" name="email" type="email" value="" size="30"  /></div>',
		),
		'comment_field' => '<div class="comment-form-comment"><textarea id="comment" name="comment" 
        aria-required="true"></textarea></div>',
		'submit_field'  => '<div class="form-submit">%1$s %2$s</div>',
	);
	comment_form( $args );
	?>

</div><!-- #comments -->

