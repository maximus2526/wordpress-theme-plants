<?php
// comments.php

// Проверяем, открыты ли комментарии для данной записи
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // Выводим список комментариев
    if (have_comments()) :
    ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number === 1) {
                echo '1 Comment';
            } else {
                echo $comments_number . ' Comments';
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            // Выводим каждый комментарий
            wp_list_comments();
            ?>
        </ol>

        <?php
        // Показываем пагинацию комментариев, если есть несколько страниц
        the_comments_pagination();
        ?>

    <?php
    endif;
    ?>

    <?php
    // Выводим форму комментариев
    comment_form();
    ?>

</div><!-- #comments -->
