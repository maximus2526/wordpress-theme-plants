<div class="article display-flex align-center gap">
    <div class="article-img">
        <?php echo get_the_post_thumbnail() ?>
    </div>

    <div class="article-content-wrapper display-flex space-between">
        <div class="article-content">
            <div class="author">
                Posted by
                <?php echo $post->post_author ?>
            </div>
            <div class="article-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </div>
        </div>

        <div class="continue-button display-flex text-center ">
            <a href="#" class="button">
                Continue reading
            </a>
        </div>
    </div>


</div>