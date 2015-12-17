<div class="post-loop <?php do_action('post_loop_class'); ?>">
    <article <?php post_class(); ?>>

      <header>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><i class="fa fa-file-text-o"></i> <?php the_title(); ?></a></h2>
      </header>

    <div class="entry-summary intro-paragraph">
    	<?php the_excerpt(); ?>
    </div>

    <div class="categories">
      <?php $terms = get_the_terms( $post->ID, 'wpkb-category' );
      if ($terms && ! is_wp_error($terms)): ?>
          <?php foreach($terms as $term): ?>
              <a href="<?php echo get_term_link( $term->slug, 'wpkb-category'); ?>" rel="tag" class="idea-status-label idea-status-<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
          <?php endforeach; ?>
      <?php endif; ?>
    </div>

    </article>
</div>
