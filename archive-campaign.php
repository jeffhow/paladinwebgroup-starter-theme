<?php get_header(); ?>
<header class="header comic-header">
    <h1 class="comic-title" itemprop="name">Campaign</h1>
    <img 
        class="comic-masthead"
        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/comics/campaign.svg" 
        alt="Campaign Masthead">
    <div class="archive-meta" itemprop="description">
        <?php if ( '' != get_the_archive_description() ) { echo esc_html( get_the_archive_description() ); } ?></div>
</header>

<?php // Latest episode full content

/** Custom Comic Query */


$comic_args = array(
    'posts_per_page' => 1, // latest
    'post_type' => get_post_type(),
);
// echo print_r($comic_args);
$comic_query = new WP_Query($comic_args);

if ( $comic_query->have_posts() ) : ?>
    <?php while ( $comic_query->have_posts() ) : 
        $comic_query->the_post(); 
        $image = get_field('page_art');
    ?>
        <section class="comic-page">
            <h2 class="episode-title">Episode <?php the_field('episode');?>: <?php the_field('page_title'); ?></h2>

            <?php if ($image) : 
                // Image variables.
                $title = $image['title'];
                $alt = $image['alt'];
                $caption = $image['caption'];

                // large size attributes.
                $size = 'full-page';
                $width = $image['sizes'][ $size . '-width' ];
                $height = $image['sizes'][ $size . '-height' ];
                $url = $image['sizes'][$size];

                // build srcset
                $srcset = wp_get_attachment_image_srcset( $image['id'], array( 'medium', 'medium_large', 'large', 'full-page' ) );
            ?>
            <section class="page-art">
                <img 
                    width="<?php echo $width; ?>"
                    height="<?php echo esc_attr($height); ?>"
                    srcset="<?php echo esc_attr($srcset); ?>"
                    src="<?php echo esc_url($url); ?>" 
                    alt="<?php echo esc_attr($alt); ?>" 
                    title="<?php echo esc_attr($title); ?>" 
                    class="fluid comic-page-art"  
                />
            </section>

            <?php endif; ?>

            <aside class="full-script">
                <?php the_field('full_script'); ?>
            </aside>
            
            <aside class="comic-blog">
                <?php the_content(); ?>
            </aside>
            
            <footer class="comic-footer">
                <nav class="comic-nav">
                    <?php get_template_part( 'nav', 'below-comic' ); ?>
                </nav>
            </footer>

            
        <?php endwhile; ?>
            
    <?php 
wp_reset_postdata();
endif; 
?>

<?php // Ad space
$promo_args = array(
    'posts_per_page' => 3, 
    'post_type' => 'promo',
    'tax_query' => array(
        array(
            'taxonomy' => 'theme_location',
            'field' => 'slug',
            'terms' => array('campaign', 'comics'),
            // don't include all books that are children
            'include_children' => false 
        ),
    )
);
/**
 * @todo: 
 * 4. build the sidebar 
 *  - H image
 *  - V image
 *  - Ad Description (for aria?)
 *  - CTA link (for the image)
 *  - hide the editor
 *  - PHP elements <-- Here
 * 
 * 5. style the sidebar 
 */ 
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

</section><!-- /.comic-page -->


<?php if ( have_posts() ) : // recent posts ?>
    <section class="comic-feed">
        <h2>Recent Posts</h2>
        <div class="comic-cards">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'entry' ); ?>
            <?php endwhile; ?>
            <?php get_template_part( 'nav', 'below' ); ?>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>