<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<header class="header">
    <h1 class="entry-title" itemprop="name">
        <?php printf( esc_html__( 'Search Results for: %s', 'paladinwebgroup' ), get_search_query() ); ?></h1>
</header>
<?php while ( have_posts() ) : the_post(); ?>
    <div class="search-result-item">

        <?php get_template_part( 'entry' ); ?>
        <div class="thumbnail-container">
            <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('thumbnail');
                }
            ?>
        </div>
    </div>

<?php endwhile; ?>
<?php get_template_part( 'nav', 'below' ); ?>
<?php else : ?>
<article id="post-0" class="post no-results not-found">
    <header class="header">
        <h1 class="entry-title" itemprop="name"><?php esc_html_e( 'Nothing Found', 'paladinwebgroup' ); ?></h1>
    </header>
    <div class="entry-content" itemprop="mainContentOfPage">
        <p><?php esc_html_e( 'Sorry, nothing matched your search. Please try again.', 'paladinwebgroup' ); ?></p>
        <?php get_search_form(); ?>
    </div>
</article>
<?php endif; ?>
<?php get_footer(); ?>