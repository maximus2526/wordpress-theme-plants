<div class="article display-flex align-center gap">
    <div class="article-img">
        <?php echo get_the_post_thumbnail() ?>
    </div>

    <div class="article-content-wrapper display-flex space-between align-center">
        <div class="article-content">
            <div class="author">
                Posted by
                <?php echo $post->post_author ?>
            </div>
            <div class="article-header">
                <?php the_title('<h3 class="entry-title">', '</h3>'); ?>
            </div>
        </div>
        <div class="continue-button">
            <a href="<?php echo get_permalink() ?>">
                Continue reading →
            </a>
        </div>

    </div>
</div>


</div>