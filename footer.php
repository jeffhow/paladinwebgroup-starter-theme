</main>
<?php get_sidebar(); ?>
</div>
<footer id="footer" role="contentinfo" class="site-footer">

<?php if ( 
    has_nav_menu('social-menu') || 
    has_nav_menu('corporate-menu') || 
    has_nav_menu('seo-menu') || 
    has_nav_menu('contact-menu')):
?>

<div class="menus">
    <?php if (has_nav_menu('social-menu')): ?>
        <nav class="social-nav">
            <?php 
                wp_nav_menu( 
                    array( 
                        'theme_location' => 'social-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>',
                        'items_wrap' => '<ul id="%1$s" class="%2$s" tabindex="-1">%3$s</ul>',
                    ) 
                ); 
            ?>
        </nav>
    <?php endif; ?>
    <?php if (has_nav_menu('corporate-menu')): ?>
        <nav class="corporate-nav">
            <?php 
                wp_nav_menu( 
                    array( 
                        'theme_location' => 'corporate-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>',
                        'items_wrap' => '<ul id="%1$s" class="%2$s" tabindex="-1">%3$s</ul>',
                    ) 
                ); 
            ?>
        </nav>
    <?php endif; ?>
    <?php if (has_nav_menu('seo-menu')): ?>
        <nav class="seo-nav">
            <?php 
                wp_nav_menu( 
                    array( 
                        'theme_location' => 'seo-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>',
                        'items_wrap' => '<ul id="%1$s" class="%2$s" tabindex="-1">%3$s</ul>',
                    ) 
                ); 
            ?>
        </nav>
    <?php endif; ?>
    <?php if (has_nav_menu('contact-menu')): ?>
        <nav class="contact-nav">
            <?php 
                wp_nav_menu( 
                    array( 
                        'theme_location' => 'contact-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>',
                        'items_wrap' => '<ul id="%1$s" class="%2$s" tabindex="-1">%3$s</ul>',
                    ) 
                ); 
            ?>
        </nav>
    <?php endif; ?>
</div> <!-- /.menus -->
<?php endif; // has any menu ?>

<?php if (get_bloginfo( 'description' )): ?>
    <div id="site-description" <?php if ( !is_single() ) { echo ' itemprop="description"'; } ?>>
        <?php bloginfo( 'description' ); ?>
    </div>
<?php endif; // has tagline ?>

<div id="copyright">
    &copy; <?php echo esc_html( date_i18n( __( 'Y', 'paladinwebgroup' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
</div>


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