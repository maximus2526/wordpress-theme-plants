
<?php get_header();  ?>

<div class="single-post-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="article-content-wrapper display-flex space-between">
            <div class="article-content">
                <div class="author">
                    Posted by <?php the_author(); ?>
                </div>
                <div class="article-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </div>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    <?php endwhile; endif; ?>
</div>

<?php get_footer();  ?>