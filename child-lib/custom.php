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
