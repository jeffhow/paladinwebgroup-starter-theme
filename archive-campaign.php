<?php get_header(); ?>
<header class="header comic-header">
    <h1 class="comic-title" itemprop="name">Campaign</h1>
    <img 
        class="comic-masthead"
        src="<?php echo get_stylesheet_directory_uri()?>/assets/images/comics/campaign.svg" 
        alt="Campaign Masthead">
    <div class="archive-meta" itemprop="description">
        <?php if ( '' != get_the_archive_description() ) { echo esc_html( get_the_archive_description() ); } ?></div>
</header>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
<?php get_footer(); ?>