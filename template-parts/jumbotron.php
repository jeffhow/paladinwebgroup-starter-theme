<?php 
    /** Custom Jumbotron query */

    /** 
     * The ?? assigns a default value in the case of NULL or invalid key
     * @ref: https://www.php.net/manual/en/language.operators.comparison.php#language.operators.comparison.coalesce
     */ 
    $location = $args['location'] ?? 'default';

    $jumbo_args = array(
        'posts_per_page' => 1, // just the newest
        'post_type' => 'jumbotron',
        'tax_query' => array(
            array(
                'taxonomy' => 'theme_location',
                'field' => 'slug',
                'terms' => $location
                // 'terms' => 'front-page'
            )
        )
    );
    $jumbo_query = new WP_Query($jumbo_args);
    if ( $jumbo_query->have_posts() ) : 
        while ( $jumbo_query->have_posts() ) : 
            $jumbo_query->the_post();      
            $image = get_field('hero_image'); ?>
            <div class="jumbotron <?php echo ($image) ? 'jumbotron-hero':''; ?>">
            
                <?php 

                    $text_color = get_field('text_color');
                    $background_color = get_field('background_color');

                    if( $image ):

                        // Image variables.
                        $title = $image['title'];
                        $alt = $image['alt'];
                        $caption = $image['caption'];
        
                        // large size attributes.
                        $size = 'large';
                        $width = $image['sizes'][ $size . '-width' ];
                        $height = $image['sizes'][ $size . '-height' ];
                        $url = $image['sizes'][$size];

                        // build srcset
                        $srcset = wp_get_attachment_image_srcset( $image['id'], array( 'medium', 'medium_large', 'large' ) );
                ?>
                
                    <img 
                        width="<?php echo $width; ?>"
                        height="<?php echo esc_attr($height); ?>"
                        srcset="<?php echo esc_attr($srcset); ?>"
                        src="<?php echo esc_url($url); ?>" 
                        alt="<?php echo esc_attr($alt); ?>" 
                        title="<?php echo esc_attr($title); ?>" 
                        class="fluid hero-image"  
                    />
                <?php endif; // has hero_image ?>

                <?php 
                    $v_placement = strtolower(get_field('vertical_placement')); 
                    $h_placement = strtolower(get_field('horizontal_placement'));
                ?>
                <div class="jumbotron-statement 
                    <?php echo esc_attr($v_placement) . ' ' . esc_attr($h_placement); ?>"
                    style="<?php 
                        echo esc_attr( $text_color ? "color: $text_color;" : "" ); 
                        echo esc_attr( $background_color ? "background-color: $background_color; " : "" ); 
                        ?>"
                >
                        
                    <p class="jumbotron-text"><?php the_field('jumbotron_header'); ?></p>
                    
                    <?php the_content(); ?>

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
                
                <?php edit_post_link('Edit <i class="fa-solid fa-pen-to-square"></i>'); ?>
            </div>

<?php 
        endwhile; // jumbo_query
        wp_reset_postdata();
    endif; // jumbo_query have_posts()
?>