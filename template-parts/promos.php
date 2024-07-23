<?php // Ad space
$promo_args = array(
    'posts_per_page' => 3, 
    'post_type' => 'promo',
    'tax_query' => array(
        array(
            'taxonomy' => 'theme_location',
            'field' => 'slug',
            'terms' => array(get_post_type(), 'comics'),
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
            $h_image = get_field('horizontal_image');
            $v_image = get_field('vertical_image');
            $description = get_field('description');
            $cta = get_field('cta_link');
        ?>
            <section>
            <?php if ($v_image && $h_image): 
                $h_url = $h_image['sizes']['h-promo'];
                $v_url = $v_image['sizes']['v-promo'];
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
                    <picture>
                        <source 
                            media="(min-width: 782px)" 
                            srcset="<?php echo esc_url($v_url); ?>" />
                        <source 
                            media="(max-width: 782px)" 
                            srcset="<?php echo esc_url($h_url); ?>" />
                        <img 
                            src="<?php echo esc_url($v_url); ?>" 
                            alt="<?php echo esc_attr($description); ?>" 
                            class="fluid" />
                    </picture>
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