<?php get_header(); ?>
<?php 
    /** Custom Jumbotron query */
    $jumbo_args = array (
        'posts_per_page' => 1, // just the newest
        'post_type' => 'jumbotron',
        'tax_query' => array(
            array(
                'taxonomy' => 'theme-location',
                'field' => 'slug',
                'terms' => 'front-page'
                // 'terms' => 'front-page'
            )
        )
    );
    $jumbo_query = new WP_Query($jumbo_args);
    if ( $jumbo_query->have_posts() ) : 
        while ( $jumbo_query->have_posts() ) : 
            $jumbo_query->the_post();      
            $image = get_field('hero_image'); ?>

            <div class="jumbotron home <?php echo ($image) ? 'jumbotron-hero':''; ?>">
                <?php 
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
                    style="background-color: <?php the_field('background-color'); ?>;"
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

            </div>

<?php 
        endwhile; // jumbo_query
    endif; // jumbo_query have_posts()
    wp_reset_postdata();
?>

<?php 
    /** Custom Factoid query */
    $factoid_args = array (
        'posts_per_page' => -1, // all
        'post_type' => 'factoid',
        'tax_query' => array(
            array(
                'taxonomy' => 'theme-location',
                'field' => 'slug',
                'terms' => 'front-page'
                // 'terms' => 'front-page'
            )
        )
    );
    $factoid_query = new WP_Query($factoid_args);
    if ( $factoid_query->have_posts() ) : ?>
        <section class="card-feed factoids">
            <?php while ( $factoid_query->have_posts() ) : 
                $factoid_query->the_post(); 

                $large_text = get_field('large_text');
                $small_text = get_field('small_text');
                $text_color = get_field('text_color');
                $background_color = get_field('background_color');

                $background_image = get_field('background_image'); 
            ?>
                <div 
                    class="factoid <?php echo esc_attr($background_image ? 'factoid-image' : ''); ?>" 
                    style="<?php 
                        echo esc_attr( $text_color ? "color: $text_color; " : "" ); 
                        echo esc_attr( $background_color ? "background-color: $background_color; " : "" ); 
                        ?>
                    ">
                    <div class="large-text"><?php echo esc_html($large_text); ?></div>
                    <div class="small-text"><?php echo esc_html($small_text); ?></div>
                    
                    <?php if ($background_image):
                        // Image variables.
                        $title = $background_image['title'];
                        $alt = $background_image['alt'];
        
                        // large size attributes.
                        $size = 'medium';
                        $width = $background_image['sizes'][ $size . '-width' ];
                        $height = $background_image['sizes'][ $size . '-height' ];
                        $url = $background_image['sizes'][$size];

                        // build srcset
                        $srcset = wp_get_attachment_image_srcset( $background_image['id'], array( 'thumb', 'medium', 'medium_large' ) );?>
                        
                        <img 
                            width="<?php echo $width; ?>"
                            height="<?php echo esc_attr($height); ?>"
                            srcset="<?php echo esc_attr($srcset); ?>"
                            src="<?php echo esc_url($url); ?>" 
                            alt="<?php echo esc_attr($alt); ?>" 
                            title="<?php echo esc_attr($title); ?>" 
                            class="fluid factoid-image"  
                        />
                        
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
    
        </section>
    <?php endif; ?> 


<section class="front-page-content">
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
</section>

<?php get_template_part( 'nav', 'below' ); ?>
<?php get_footer(); ?>