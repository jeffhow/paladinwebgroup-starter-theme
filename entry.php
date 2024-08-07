<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( is_front_page() ): 
        // front page -> skip the entry-header and just display the content
        get_template_part('entry', 'content');
    else: ?>
        <header>
            <?php 
                if ( is_singular() ) { 
                    echo '<h1 class="entry-title" itemprop="headline">'; 
                } elseif (get_post_type() != "post") {
                    echo '<h3 class="entry-title">'; 
                } else { 
                    echo '<h2 class="entry-title">'; 
                } 
            ?>
            <a 
                href="<?php the_permalink(); ?>" 
                title="<?php the_title_attribute(); ?>"
                rel="bookmark"><?php the_title(); ?></a>

            <?php 
                if ( is_singular() ) { 
                    echo '</h1>'; 
                } elseif (get_post_type() != "post") {
                    echo '</h3>';
                } else { 
                    echo '</h2>'; 
                } 
            ?>
            <?php edit_post_link(); ?>

            <?php if ( !is_search() ) { get_template_part( 'entry', 'meta' ); } ?>
        </header>
        <?php get_template_part( 'entry', ( is_front_page() || is_home() || is_front_page() && is_home() || is_archive() || is_search() ? 'summary' : 'content' ) ); ?>
        <?php if ( is_singular() ) { get_template_part( 'entry-footer' ); } ?>

    <?php endif; ?>
</article>