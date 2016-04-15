<?php
/**
 * Add Facets to Articles.
 */
function wfc_back_widget()
{
if (is_singular('wpkb-article')) :?>
  <article class="widget back-to-docs">
    <h4><i class="fa fa-chevron-left"></i> <a href="<?php echo site_url();
    ?>">Back to Documentation</a></h4>
  </article>
<?php endif;
}
add_action('wf_close_sidebar', 'wfc_back_widget', 100);

function wfc_toc()
{
if (is_singular('wpkb-article')) :?>
  <article class="widget back-to-docs">
    <h4><i class="fa fa-binoculars"></i> Contents</h4>

    <div id="toc"></div>
  </article>
<?php endif;
}
add_action('wf_open_sidebar', 'wfc_toc', 100);


function add_kb_taxonomies()
{
    register_taxonomy_for_object_type('wpkb-category', 'gistpen');
    register_taxonomy_for_object_type('wpkb-keyword', 'gistpen');
}
// Add to the admin_init hook of your theme functions.php file.
add_action('init', 'add_kb_taxonomies');

function wfc_kb_archive()
{
    if (is_tax()) :
        $term = get_queried_object();
    ?>

    <article class="widget">

      <h4>Documentation</h4>

		<?php
        $term_id = get_queried_object_id();
    $args = array(
        'post_type' => 'wpkb-article',
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => array(
          array(
            'taxonomy' => 'wpkb-category',
            'terms' => $term_id,
            'include_children' => false,
          ),
        ),
        );
        // The Query
        $query = new WP_Query($args);
    ?>
		<?php if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        ?>

					  <ul class="list-unstyled">
				<li>
				  <a href="<?php the_permalink();
        ?>">
				  <i class="fa fa-file-text"></i> <?php the_title();
        ?>
				</a>
					  </li>
					</ul>

					<?php

    }
} else {
    echo 'No Docs Found';
}
    wp_reset_postdata();
    ?>

  </article>


  <article class="widget">

    <h4>Code Snippets</h4>

    <?php
    // Define the query
    $args = array(
      'post_type' => 'gistpen',
      'wpkb-category' => $term->slug,
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<ul class="list-unstyled">';
        // Start the Loop
        while ($query->have_posts()) : $query->the_post();
        ?>
		<li>
        <a href="<?php the_permalink();
        ?>"><i class="fa fa-codepen"></i> <?php the_title();
        ?></a>
		</li>
		<?php endwhile;
        echo '</ul>';
    } else {
        echo 'No Code Snippets Found';
    }
    // use reset postdata to restore orginal query
    wp_reset_postdata();
    ?>

</article>

<?php endif;
}
add_action('wf_open_sidebar', 'wfc_kb_archive');

/**
 * Add GitHub Link After Content.
 */
function wfc_show_github_link()
{
    ?>

  <span class="edit-on-github">
    <i class="fa fa-github"></i> <?php echo get_the_github_edit_link();
    ?>
  </span>

	<?php

}
add_action('wf_close_entry_content', 'wfc_show_github_link');
add_action('wf_open_post_meta', 'wfc_show_github_link');
