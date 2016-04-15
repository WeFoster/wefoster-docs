<?php
/*
Template Name: Documentation Index
*/
?>


<?php get_template_part('header'); ?>

    <div class="main <?php do_action('wf_class_main'); ?>" role="main">

        <?php
          $args = array(
            'post_type' => 'wpkb-article',
            'post_status' => 'published'
          );
          // The Query
          $query = new WP_Query($args);
        ?>
        <?php if ($query->have_posts()) { while ($query->have_posts()) { $query->the_post(); ?>

            <?php get_template_part('templates/loops/docs');?>

        <?php }
        } else {
          echo 'No Testimonials Found';
        }
        wp_reset_postdata();?
        ?>



    </div><!-- /.main -->

<?php get_template_part('sidebar'); ?>
<?php get_template_part('footer'); ?>
