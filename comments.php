<?php
// comments.php

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    if (have_comments()) :
        ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number === 1) {
                echo esc_html__('1 Comment', 'plants');
            } else {
                echo $comments_number . esc_html__(' Comments', 'plants');
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments();
            ?>
        </ol>

        <?php
        the_comments_pagination();
        ?>

        <?php
    endif;
    ?>

    <?php
    comment_form();
    ?>

</div><!-- #comments -->
