<?php
/**
 * Show Recommended Reading
 *
 */
function wfd_recommened_reading() { ?>
        <div class="recommended-reading">

          <h3>Additional Resources</h3>

              <?php
              // get field value
               $posts = get_field('additional_reading');

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
add_action( 'wpkb_after_article_content','wfd_recommened_reading', 10 );

function wfd_further_reading() { ?>
        <div class="further-reading">

          <h3>What's next?</h3>

                <?php
                // get field value
                 $posts = get_field('further_reading');

                 if( $posts ): ?>
                     <ul>
                         <?php foreach ($posts as $p): ?>
                             <li>
                                <a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
                             </li>
                         <?php endforeach; ?>
                     </ul>
                 <?php endif; ?>

        </div>
<?
}
add_action( 'wpkb_after_article_content','wfd_further_reading', -999 );
