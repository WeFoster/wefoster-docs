<?php get_template_part('header'); ?>

<div class="container plugin-header-wrap">

  <div class="col-sm-12">
  <?php
      get_template_part( 'templates/plugin-header' );
  ?>
  </div>
</div>

<div class="container <?php do_action('class_container'); ?>">
  <div class="content row row-offcanvas row-offcanvas-left">
    <div class="main col-xs-12 col-sm-9 <?php do_action('class_main'); ?>" role="main">

  <?php do_action('before_single_content'); ?>


  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?>>


      <div class="entry-content <?php do_action('entry_content_class'); ?>">

        <div id="plugin-tabs" class="tab-content">

          <div class="tab-pane fade active in" id="description">
            <?php
              get_template_part( 'templates/description' );
            ?>
          </div>

          <div class="tab-pane fade" id="installation">
            <?php
              get_template_part( 'templates/installation' );
            ?>
          </div>

          <div class="tab-pane fade" id="faq">
            <?php
              get_template_part( 'templates/faq' );
            ?>
          </div>

          <div class="tab-pane fade" id="screenshots">
            <?php
              get_template_part( 'templates/screenshots' );
            ?>
          </div>

          <div class="tab-pane fade" id="other-notes">
            <?php
              get_template_part( 'templates/other-notes' );
            ?>
          </div>

          <div class="tab-pane fade" id="changelog">
            <?php
              get_template_part( 'templates/changelog' );
            ?>
          </div>

        </div>

      </div>

      <?php get_template_part('templates/author-box'); ?>

      <footer>
        <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'wefoster'), 'after' => '</p></nav>')); ?>
      </footer>

      <?php comments_template('/templates/comments.php'); ?>

    </article>
  <?php endwhile; ?>



	  <?php do_action('after_single_content'); ?>

      </div><!-- /.main -->

  <?php get_template_part('sidebar'); ?>

    </div><!-- /.content -->
  </div><!-- /.wrap -->

<?php get_template_part('footer'); ?>
