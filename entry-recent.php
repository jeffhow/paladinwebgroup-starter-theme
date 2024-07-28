<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header>
            <h3 class="entry-title">
            <a 
                href="<?php the_permalink(); ?>" 
                title="<?php the_title_attribute(); ?>"
                rel="bookmark"><?php the_title(); ?></a>

            </h3>
            <?php edit_post_link(); ?>

            <?php get_template_part( 'entry', 'meta' );  ?>
        </header>
        <?php get_template_part( 'entry',  'summary' ); ?>

</article>