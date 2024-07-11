</main>
<?php get_sidebar(); ?>
</div>
<footer id="footer" role="contentinfo" class="site-footer">
<div id="copyright">
&copy; <?php echo esc_html( date_i18n( __( 'Y', 'paladinwebgroup' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
</div>

<?php if (get_bloginfo( 'description' )): ?>
    <div id="site-description" <?php if ( !is_single() ) { echo ' itemprop="description"'; } ?>>
        <?php bloginfo( 'description' ); ?>
    </div>
<?php endif; // has tagline ?>

<?php  // delete this Block in production
    echo '<p style="background-color: red; color: yellow; font-size: 2rem; padding: 1rem;">';
    global $template; echo basename($template); 
    echo '</p>';
?>
</footer>
</div>
<?php wp_footer(); ?>

</body>
</html>