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
          <?php wp_reset_postdata();?>
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

function wfd_kb_snippets() { ?>

  <?php
  $posts = get_field('link_snippet_to_kb_article');

  // get selected people

  if( $posts )
  {?>

    <h2 id="codesnippets"><i class="fa fa-codepen"></i> Code Examples</h2>

    <p>Below are some Code Examples that help you get started.</p>

  	<?php foreach( $posts as $post )
  	{
      $id = $post->ID;
  		?>
  		<?php echo do_shortcode('[gistpen id='. $id .']' ); ?>
  		<?php
  	}
  }
}
add_action( 'wpkb_after_article_content','wfd_kb_snippets', -999  );

//Bidirectional Linking of Snippets and Docs.
function bidirectional_acf_update_value( $value, $post_id, $field  ) {

	// vars
	$field_name = $field['name'];
	$global_name = 'is_updating_' . $field_name;


	// bail early if this filter was triggered from the update_field() function called within the loop below
	// - this prevents an inifinte loop
	if( !empty($GLOBALS[ $global_name ]) ) return $value;


	// set global variable to avoid inifite loop
	// - could also remove_filter() then add_filter() again, but this is simpler
	$GLOBALS[ $global_name ] = 1;


	// loop over selected posts and add this $post_id
	if( is_array($value) ) {

		foreach( $value as $post_id2 ) {

			// load existing related posts
			$value2 = get_field($field_name, $post_id2, false);


			// allow for selected posts to not contain a value
			if( empty($value2) ) {

				$value2 = array();

			}


			// bail early if the current $post_id is already found in selected post's $value2
			if( in_array($post_id, $value2) ) continue;


			// append the current $post_id to the selected post's 'related_posts' value
			$value2[] = $post_id;


			// update the selected post's value
			update_field($field_name, $value2, $post_id2);

		}

	}


	// find posts which have been removed
	$old_value = get_field($field_name, $post_id, false);

	if( is_array($old_value) ) {

		foreach( $old_value as $post_id2 ) {

			// bail early if this value has not been removed
			if( is_array($value) && in_array($post_id2, $value) ) continue;


			// load existing related posts
			$value2 = get_field($field_name, $post_id2, false);


			// bail early if no value
			if( empty($value2) ) continue;


			// find the position of $post_id within $value2 so we can remove it
			$pos = array_search($post_id, $value2);


			// remove
			unset( $value2[ $pos] );


			// update the un-selected post's value
			update_field($field_name, $value2, $post_id2);

		}

	}


	// reset global varibale to allow this filter to function as per normal
	$GLOBALS[ $global_name ] = 0;


	// return
    return $value;

}

add_filter('acf/update_value/name=link_snippet_to_kb_article', 'bidirectional_acf_update_value', 10, 3);
