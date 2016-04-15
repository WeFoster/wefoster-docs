<?php while ( have_posts() ): the_post(); ?>

<div class="post-loop <?php do_action('wf_post_loop_class'); ?>">
    <article <?php post_class(); ?>>

      <header>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><i class="fa fa-codepen"></i> <?php the_title(); ?></a></h2>
      </header>

    <div class="entry-summary intro-paragraph">
    	<?php the_content(); ?>
    </div>

    <div class="categories">
      <?php $terms = get_the_terms( $post->ID, 'post_tag' );
      if ($terms && ! is_wp_error($terms)): ?>
          <?php foreach($terms as $term): ?>
              <a href="<?php echo get_term_link( $term->slug, 'post_tag'); ?>" rel="tag" class="idea-status-label idea-status-<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
          <?php endforeach; ?>
      <?php endif; ?>
    </div>

    </article>
</div>

<?php endwhile; ?>
