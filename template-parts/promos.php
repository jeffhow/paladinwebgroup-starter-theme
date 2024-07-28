
<?php // Ad space
// global $post; 
$this_page_name = str_replace(" ", "-", strtolower($post->post_title)); // campaign or paledragon

$promo_args = array(
    'posts_per_page' => 3, 
    'post_type' => 'promo',
    'tax_query' => array(
        array(
            'taxonomy' => 'theme_location',
            'field' => 'slug',
            'terms' => array(get_post_type(), 'comics', $this_page_name),
            // don't include all books that are children
            'include_children' => false 
        ),
    )
);

$promo_query = new WP_Query($promo_args);
if ( $promo_query->have_posts() ) : ?>
    <aside class="updates">

        <?php while ( $promo_query->have_posts() ) : 
            $promo_query->the_post(); 
            $image = get_field('horizontal_image');
            // $v_image = get_field('vertical_image');
            $description = get_field('description');
            $cta = get_field('cta_link');
        ?>
            <section>
            <?php if ($image):
                // Image variables.
                $title = $image['title'];
                $alt = $image['alt'];
                $caption = $image['caption']; 
                // large size attributes.
                $size = 'full-page';
                $width = $image['sizes'][ $size . '-width' ];
                $height = $image['sizes'][ $size . '-height' ];
                $url = $image['sizes'][$size];
                // $h_url = $image['sizes']['h-promo'];
                // $v_url = $v_image['sizes']['v-promo'];
                $srcset = wp_get_attachment_image_srcset( $image['id'], array( 'medium', 'medium_large', 'large' ) );
            ?>
                <?php if ($cta) : 
                    $cta_url = $cta['url'];
                    $cta_title = $cta['title'];
                    $cta_target = $cta['target'] ? $cta['target'] : '_self';
                ?>
                    <a 
                        href="<?php echo esc_url($cta_url); ?>"
                        title="<?php echo esc_attr($cta_title); ?>"
                        target="<?php echo esc_attr($cta_target); ?>"
                    >
                <?php endif; ?>
                    <img 
                        width="<?php echo $width; ?>"
                        height="<?php echo esc_attr($height); ?>"
                        srcset="<?php echo esc_attr($srcset); ?>"
                        src="<?php echo esc_url($url); ?>" 
                        alt="<?php echo esc_attr($alt); ?>" 
                        title="<?php echo esc_attr($title); ?>" 
                        class="fluid hero-image"  
                    />
                <?php if ($cta) : ?>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <?php edit_post_link('Edit <i class="fa-solid fa-pen-to-square"></i>'); ?>  
            </section>
        <?php endwhile; ?>
    </aside>
<?php 
    wp_reset_postdata();
endif; 
?>