<?php 
    /** Custom Factoid query */
   
    /** 
     * The ?? assigns a default value in the case of NULL or invalid key
     * @ref: https://www.php.net/manual/en/language.operators.comparison.php#language.operators.comparison.coalesce
     */ 
    $location = $args['location'] ?? 'default';
    

    $factoid_args = array (
        'posts_per_page' => -1, // all
        'post_type' => 'factoid',
        'tax_query' => array(
            array(
                'taxonomy' => 'theme-location',
                'field' => 'slug',
                'terms' => $location
                // 'terms' => 'front-page'
            )
        )
    );
    $factoid_query = new WP_Query($factoid_args);
    if ( $factoid_query->have_posts() ) : ?>
        <section class="card-feed factoids">
            <?php while ( $factoid_query->have_posts() ) : 
                $factoid_query->the_post(); 
                
                $is_icon = get_field('icon_factoid');
                $icon = get_field('font-awesome_icon');
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
                    <?php if ($is_icon): ?>
                        <div class="large-text">
                            <i class="<?php echo esc_html($icon); ?>"></i>
                        </div>
                    <?php else: ?>
                        <div class="large-text"><?php echo esc_html($large_text); ?></div>
                    <?php endif; ?>
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
                    <?php edit_post_link('Edit <i class="fa-solid fa-pen-to-square"></i>'); ?>
                </div>
            <?php endwhile; ?>
    
        </section>
<?php 
    endif; 
    wp_reset_postdata();
?>