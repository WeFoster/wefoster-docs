<?php
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

function add_kb_taxonomies() {
  register_taxonomy_for_object_type( 'wpkb-category', 'gistpen' );
  register_taxonomy_for_object_type( 'wpkb-keyword', 'gistpen' );
}
 // Add to the admin_init hook of your theme functions.php file
add_action( 'init', 'add_kb_taxonomies' );

function wfc_kb_archive() {
  if ( is_tax() ): ?>

  <article class="widget">
        <?php  echo term_description( ); ?>
  </article>

 <?php endif;
}
add_action( 'open_sidebar','wfc_kb_archive' );

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
