<?php get_header(); ?>
<header class="header comic-header">
    <h1 class="comic-title" itemprop="name">Pale Dragon</h1>
    <img 
        class="comic-masthead"
        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/comics/paledragon.svg" 
        alt="Pale Dragon Masthead">
    <div class="archive-meta" itemprop="description">
        <?php if ( '' != get_the_archive_description() ) { echo esc_html( get_the_archive_description() ); } ?></div>
</header>

<?php // Latest episode full content

/** Custom Comic Query */


$comic_args = array(
    'posts_per_page' => 1, // latest
    'post_type' => 'paledragon',
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
                <img 
                    width="<?php echo $width; ?>"
                    height="<?php echo esc_attr($height); ?>"
                    srcset="<?php echo esc_attr($srcset); ?>"
                    src="<?php echo esc_url($url); ?>" 
                    alt="<?php echo esc_attr($alt); ?>" 
                    title="<?php echo esc_attr($title); ?>" 
                    class="fluid comic-page-art"  
                />
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

        </section><!-- /.comic-page -->

    <?php endwhile; ?>
            
<?php 
    wp_reset_postdata();
endif; 
?>

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