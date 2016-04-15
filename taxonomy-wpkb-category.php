<?php
 /**
 * This is the template that is used to display single Pages
 *
 * @since 1.0
 * @package WeFoster Framework
 */
 // get the currently queried taxonomy term, for use later in the template file
$term = get_queried_object();
 ?>

 <?php get_template_part('header'); ?>

    <?php do_action('wf_before_page'); ?>

     <div class="main <?php do_action('wf_class_main'); ?>" role="main">
         <?php
         //Use to Load to Page Title. see lib/actions.php
         do_action('wf_before_page_content');
         ?>

         <?php
         // Define the query
         $args = array(
           'post_type' => 'wpkb-article',
           'wpkb-category' => $term->slug
         );
         $query = new WP_Query( $args );

         if ($query->have_posts()) {

           // Start the Loop
           while ( $query->have_posts() ) : $query->the_post(); ?>

           <div class="post-loop <?php do_action('post_loop_class'); ?>">
             <article <?php post_class(); ?>>

               <header>
                 <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><i class="fa fa-file-text-o"></i> <?php the_title(); ?></a></h2>
               </header>

               <div class="entry-summary intro-paragraph">
                 <?php //the_content(); ?>
               </div>

             </article>
           </div>
         <?php endwhile;
       }
       // use reset postdata to restore orginal query
       wp_reset_postdata();
       ?>

      <?php do_action('wf_close_page_content'); ?>
     </div><!-- /.main -->

    <?php do_action('wf_after_page'); ?>

 <?php get_template_part('sidebar'); ?>
 <?php get_template_part('footer'); ?>
