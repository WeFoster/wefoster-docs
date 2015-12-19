<div class="post-loop-wrap">
    <div class="post-loop-inner">

        <div class="loop-post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail()?>
            </a>
        </div>

        <h4 class="post-title">
            <a href="<?php the_permalink(); ?>">
                <span><?php the_title(); ?></span>
            </a>
        </h4>

        <div class="post-container">
            <div class="post-excerpt">
                <?php the_excerpt(); ?>
            </div>
        </div>

    </div>
</div>
