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
 * Idea Stream Search
 *
 */
function wfd_search() { ?>
<div class="site-search">
  <form action="" method="get">
      <div class="input-group col-sm-9">
         <div class="input-group-addon"><i class="fa fa-search"></i></div>
            <input class="form-control" type="text" placeholder="Start typing to search...." name="s" id="s" value="" data-swplive="true"/> <!-- data-swplive="true" enables SearchWP Live Search -->
      </div><!-- /input-group -->
  </form>
</div>
<?
}
add_action( 'open_primary_navigation','wfd_search' );

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
