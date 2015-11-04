<div class="post-loop <?php do_action('post_loop_class'); ?>">
    <article <?php post_class(); ?>>

      <header>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><i class="fa fa-file-text-o"></i> <?php the_title(); ?></a></h2>
      </header>

    <div class="entry-summary intro-paragraph">
    	<?php the_excerpt(); ?>
    </div>

    </article>
</div>
