<?php
/**
* Hide Sidebar until JS is done.
*
*/
function wfc_sidebar_class() {?>
  js-flash
<?php
}
add_action( 'class_inner_sidebar','wfc_sidebar_class' );


/**
* Add Facets to Articles
*
*/
function wfc_site_header() {?>

  <article class="widget site-header">

    <h4><a href="<?php echo site_url();?>">WeFoster Docs</a></h4>

  </article>


<?php
}
add_action( 'open_sidebar','wfc_site_header', 1 );
