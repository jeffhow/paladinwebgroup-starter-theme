<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php the_field('book_title'); ?>

<?php get_template_part( 'entry' ); ?>
<?php if ( comments_open() && !post_password_required() ) { comments_template( '', true ); } ?>
<?php endwhile; endif; ?>
<footer class="comic-footer">
    <nav class="comic-nav">
        <?php get_template_part( 'nav', 'below-comic' ); ?>
    </nav>
</footer>
<?php get_footer(); ?>