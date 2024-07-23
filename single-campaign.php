<?php get_header(); ?>
<?php if ( have_posts() ) : 
    while ( have_posts() ) : 
    the_post();
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

<?php endwhile; endif; ?>

<?php get_template_part( 'template-parts/promos'); ?>

</section><!-- /.comic-page -->


<?php 
    if ( comments_open() && !post_password_required() ) { 
        comments_template( '', true );
    } 
?>

<?php get_footer(); ?>