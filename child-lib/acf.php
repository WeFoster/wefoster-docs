<?php
/**
 * Show Required Reading
 *
 */
function wfd_required_reading() { ?>
          <?php
          // get field value
           $posts = get_field('required_reading');

           if( $posts ): ?>

           <div class="further-reading kb-box alert alert-warning">

             <h4><i class="fa fa-exclamation-circle"></i> Required Reading</h4>

             <p>The articles below are referenced in this article, so make sure you've read them! </p>

               <ul>
                   <?php foreach ($posts as $p): ?>
                       <li>
                          <a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
                       </li>
                   <?php endforeach; ?>
               </ul>

            </div>
           <?php endif; ?>

<?
}
add_action( 'open_entry_content','wfd_required_reading', 10 );

function wfd_further_reading() { ?>
                <?php
                // get field value
                 $posts = get_field('further_reading');

                 if( $posts ): ?>

                 <div class="further-reading kb-box alert alert-info">

                  <h4><i class="fa fa-bookmark"></i> Ready to continue?</h4>
                     <ul>
                         <?php foreach ($posts as $p): ?>
                             <li>
                                <a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
                             </li>
                         <?php endforeach; ?>
                     </ul>

                             </div>
                 <?php endif; ?>
<?
}
add_action( 'wpkb_after_article_content','wfd_further_reading', 999  );

/**
 * Show Recommended Reading
 *
 */
function wfd_recommened_reading() { ?>

              <?php
              // get field value
               $posts = get_field('additional_reading');

               if( $posts ):
                   // switch to multisite
                   switch_to_blog( $posts['site_id'] ); ?>

                   <div class="recommended-reading kb-box box-padding-half">

                     <h4><i class="fa fa-link"></i> Additional Resources</h4>

                   <ul>
                       <?php foreach ($posts['selected_posts'] as $acf_post): ?>
                           <li>
                               <a target="_blank" href="<?php echo $acf_post->guid; ?>"><?php echo $acf_post->post_title; ?></a>
                           </li>
                       <?php endforeach; ?>
                   </ul>
                   <?php restore_current_blog(); // IMPORTANT switch back to current site?>
                  </div>
               <?php endif; ?>


<?
}
add_action( 'wpkb_after_article_content','wfd_recommened_reading', -999 );
