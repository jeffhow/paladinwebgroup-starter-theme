<?php get_header(); ?>

<div id="site-description" <?php if ( !is_single() ) { echo ' itemprop="description"'; } ?>>
<?php bloginfo( 'description' ); ?>
<?php 

/** Custom Jumbotron query */
$args = array (
    'posts_per_page' => 2,
    'post_type' => 'jumbotron',
    'tax_query' => array(
        array(
            'taxonomy' => 'jumbotron-location',
            'field' => 'slug',
            'terms' => 'home'
            // 'terms' => 'front-page'
        )
    )
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) : 
    while ( $the_query->have_posts() ) : 
        $the_query->the_post();        
        
            $image = get_field('hero_image');
            if( $image ):
                // Image variables.
                $url = $image['url'];
                $title = $image['title'];
                $alt = $image['alt'];
                $caption = $image['caption'];

                // Thumbnail size attributes.
                $size = 'thumbnail';
                $thumb = $image['sizes'][ $size ];
                $width = $image['sizes'][ $size . '-width' ];
                $height = $image['sizes'][ $size . '-height' ];
                echo 'foo';
                print_r($image['sizes']['large']);
            ?>
    

            <a href="<?php echo esc_url($url); ?>"  title="<?php echo esc_attr($title); ?>">
                <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($alt); ?>" />
            </a>
        <?php
            endif;
            // the_field('hero_image');
            the_field('mission_statement');
            the_field('call_to_action');
        endwhile;
    endif;
    wp_reset_postdata();
?>
</div>

<?php
    /** Normal Loop Query */
    if ( have_posts() ) : 
        while ( have_posts() ) : 
            the_post();
            get_template_part( 'entry' );
            comments_template();
        endwhile; 
    endif; 
?>

<?php get_template_part( 'nav', 'below' ); ?>
<?php get_footer(); ?>