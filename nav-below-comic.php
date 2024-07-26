<?php 
// don't call this if there's only one post
if (get_previous_post() || get_next_post()) {
    $args = array(
        'prev_text' => '<span class="meta-nav"><i class="fa-solid fa-caret-left"></i></span> %title',
        'next_text' => '%title <span class="meta-nav"><i class="fa-solid fa-caret-right"></i></span>'
    );
    the_post_navigation( $args );
}
 
?>
