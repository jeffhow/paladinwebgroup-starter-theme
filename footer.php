</main>
<?php get_sidebar(); ?>
</div>
<footer id="footer" role="contentinfo" class="site-footer">
<div id="copyright">
&copy; <?php echo esc_html( date_i18n( __( 'Y', 'paladinwebgroup' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
</div>
<?php global $template; echo basename($template); ?>
</footer>
</div>
<?php wp_footer(); ?>

</body>
</html>