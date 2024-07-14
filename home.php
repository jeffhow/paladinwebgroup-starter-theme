<?php get_header(); ?>

<?php
    get_template_part( 'template-parts/jumbotron', null,
        array( 'location' => 'home')
    );
?>

<?php
    get_template_part( 'template-parts/factoids', null,
        array( 'location' => 'home')
    );
?>

<section class="card-feed">

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