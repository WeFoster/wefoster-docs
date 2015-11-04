<?php
/*
Template Name: Documentation Index
*/
?>


<?php get_template_part('header'); ?>

    <div class="main <?php do_action('class_main'); ?>" role="main">

      <?php
      // Let's query for the Testimonial Posts
      $args = array(
        'post_type' => 'wpkb-article',
        'post_status' => 'published',
        'facetwp' => true // we added this
      );

      // The Query
      $query = new WP_Query($args); ?>


      <?php if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
          ?>
          <?php get_template_part('templates/loops/docs');
          ?>

          <?php

        }
      } else {
        echo 'No Testimonials Found';
      }
      ?>

      <?php wp_reset_postdata();?>



    </div><!-- /.main -->

<?php get_template_part('sidebar'); ?>
<?php get_template_part('footer'); ?>
