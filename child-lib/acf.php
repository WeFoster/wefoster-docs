<?php
/**
 * Show Recommended Reading
 *
 */
function wfd_recommened_reading() { ?>
        <div class="recommended-reading">

          <h3>Further Reading</h3>

              <?php
              // get field value
               $posts = get_field('further_reading');

               if( $posts ):
                   // switch to multisite
                   switch_to_blog( $posts['site_id'] ); ?>
                   <ul>
                       <?php foreach ($posts['selected_posts'] as $acf_post): ?>
                           <li>
                               <a href="<?php echo $acf_post->guid; ?>"><?php echo $acf_post->post_title; ?></a>
                           </li>
                       <?php endforeach; ?>
                   </ul>
                   <?php restore_current_blog(); // IMPORTANT switch back to current site?>
               <?php endif; ?>

        </div>

<?
}
add_action( 'wpkb_after_article_content','wfd_recommened_reading', 1 );
