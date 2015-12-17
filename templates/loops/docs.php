<?php
//This loads the right template in FacetWP
while ( have_posts() ): the_post();

if (get_post_type() == 'wpkb-article') {
    get_template_part('templates/loops/documentation');
} else {
    get_template_part('templates/loops/gistpen');
};

endwhile;
?>
