<?php get_header(); ?>

<?php 
    /** Custom Jumbotron query */
    $args = array (
        'posts_per_page' => 1, // just the newest
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
    $jumbo_query = new WP_Query($args);
    if ( $jumbo_query->have_posts() ) : 
        while ( $jumbo_query->have_posts() ) : 
            $jumbo_query->the_post();      
            $image = get_field('hero_image'); ?>

            <div class="jumbotron home <?php echo ($image) ? 'jumbotron-hero':''; ?>">
                <?php 
                    if( $image ):
                        // Image variables.
                        // $url = $image['url'];
                        $title = $image['title'];
                        $alt = $image['alt'];
                        $caption = $image['caption'];
        
                        // large size attributes.
                        $size = 'large';
                        $thumb = $image['sizes'][ $size ];
                        $width = $image['sizes'][ $size . '-width' ];
                        $height = $image['sizes'][ $size . '-height' ];
                        $url = $image['sizes']['large'];
                ?>
                    <img 
                        width="<?php echo $width; ?>"
                        height="<?php echo $height; ?>"
                        src="<?php echo esc_url($url); ?>" 
                        alt="<?php echo esc_attr($alt); ?>" 
                        class="fluid hero-image"  
                    />
                <?php endif; // has hero_image ?>
                <div class="jumbotron-statement">

                    <?php if (get_bloginfo( 'description' )): ?>
                        <div id="site-description" <?php if ( !is_single() ) { echo ' itemprop="description"'; } ?>>
                            <?php bloginfo( 'description' ); ?>
                        </div>
                    <?php endif; // has tagline ?>
                        
                    <p class="jumbotron-text"><?php the_field('mission_statement'); ?></p>

                    <?php 
                        $cta = get_field('call_to_action');
                        if( $cta ): 

                            $cta_url = $cta['url'];
                            $cta_title = $cta['title'];
                            $cta_target = $cta['target'] ? $cta['target'] : '_self';
                            ?>
                                <a 
                                    class="btn btn-cta" 
                                    href="<?php echo esc_url( $cta_url ); ?>" 
                                    target="<?php echo esc_attr( $cta_target ); ?>">
                                    <?php echo esc_html( $cta_title ); ?>
                                </a>
                    <?php endif; ?>

                </div>

            </div>

<?php 
        endwhile; // jumbo_query
    endif; // jumbo_query have_posts()
    wp_reset_postdata();
?>


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