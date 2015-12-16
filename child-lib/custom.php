<?php

//Remove Gravatar Calls
//add_filter('bp_core_fetch_avatar_no_grav', '__return_true');

// Hide Admin
//add_filter('show_admin_bar', '__return_false');

function my_facetwp_is_main_query( $is_main_query, $query ) {
    if ( isset( $query->query_vars['facetwp'] ) ) {
        $is_main_query = true;
    }
    return $is_main_query;
}
add_filter( 'facetwp_is_main_query', 'my_facetwp_is_main_query', 10, 2 );

/**
* Add a hook for WPFacet
*
*/
function wfc_facetclass() {
  if ( is_front_page() ): ?>
  facetwp-template
<?php endif;
}
add_action( 'class_main','wfc_facetclass' );

function wfc_facet_pagination() {
  if ( is_front_page() ): ?>

  <?php echo facetwp_display( 'pager' ); ?>

<?php endif;
}
add_action( 'after_loop','wfc_facet_pagination' );

/**
* Add Facets to Articles
*
*/
function wfc_facet_tricks() {
  if ( is_front_page() ): ?>

  <article class="widget">

    <h4><i class="fa fa-filter"></i>Search</h4>

    <?php
    // Display a facet
    echo facetwp_display( 'facet', 'documentation' );
    ?>

  </article>


<?php endif;
}
add_action( 'open_sidebar','wfc_facet_tricks' );

/**
* Add Facets to Articles
*
*/
function wfc_back_widget() {
  if ( is_singular('wpkb-article') ):?>

  <article class="widget back-to-docs">

    <h4><i class="fa fa-chevron-left"></i> <a href="<?php echo site_url();?>">Back to Documentation</a></h4>

  </article>


<?php endif;
}
add_action( 'close_sidebar','wfc_back_widget', 100 );

function wfc_kb_archive() {
  if ( is_tax() ):

    function wf_member_main_filter() {
      //Change our class for .main
      $class = 'col-sm-12';
      //Return it
      return $class;
    }

    //Add the main class filter
    add_filter( 'wff_main_class', 'wf_member_main_filter' );

    //Remove our sidebar completelys
    add_filter('wff_sidebar_type', '__return_false');
 endif;
}
add_action( 'template_redirect','wfc_kb_archive' );

/**
 * Add GitHub Link After Content
 *
 */
function wfc_show_github_link() { ?>

    <span class="edit-on-github">
        <i class="fa fa-github"></i> <?php echo get_the_github_edit_link(); ?>
    </span>

<?
}
add_action( 'close_entry_content','wfc_show_github_link' );
add_action( 'open_post_meta','wfc_show_github_link' );
