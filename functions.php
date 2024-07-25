<?php

$theme = wp_get_theme();
define('THEME_VERSION', $theme->Version); // gets version written in your style.css

add_action('after_setup_theme', 'paladinwebgroup_setup');
function paladinwebgroup_setup()
{
    load_theme_textdomain('paladinwebgroup', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'navigation-widgets'));
    add_theme_support('appearance-tools');
    add_theme_support('woocommerce');

    // full-page (max-width) image
    add_image_size('full-page', 1280);

    // promo images
    add_image_size('v-promo', 325);
    add_image_size('h-promo', 782);

    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1920;
    }
    register_nav_menus(array(
        'main-menu' => esc_html__('Main Menu', 'paladinwebgroup'),
        'social-menu' => esc_html__('Social Menu', 'paladinwebgroup'),
        'corporate-menu' => esc_html__('Corporate Menu', 'paladinwebgroup'),
        'seo-menu' => esc_html__('SEO Menu', 'paladinwebgroup'),
        'contact-menu' => esc_html__('Contact Menu', 'paladinwebgroup'),
    ));
}

add_action('wp_enqueue_scripts', 'paladinwebgroup_enqueue');
function paladinwebgroup_enqueue()
{
    wp_enqueue_style('paladinwebgroup-styles', get_stylesheet_uri(), array(), THEME_VERSION, 'all');
    wp_enqueue_style('paladinwebgroup-main-styles', get_template_directory_uri() . '/assets/css/main.css', array('paladinwebgroup-styles'), THEME_VERSION, 'all');
    wp_enqueue_script('jquery');
    wp_enqueue_script('darkmode', get_template_directory_uri() . '/assets/js/darkmode.js', array(), THEME_VERSION, true);
    wp_enqueue_script('nav', get_template_directory_uri() . '/assets/js/nav.js', array(), THEME_VERSION, true);
    wp_enqueue_script('unclickable', get_template_directory_uri() . '/assets/js/unclickable.js', array(), THEME_VERSION, true);
}

add_action('wp_footer', 'paladinwebgroup_footer');
function paladinwebgroup_footer()
{
?>
    <script>
        jQuery(document).ready(function($) {
            var deviceAgent = navigator.userAgent.toLowerCase();
            if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
                $("html").addClass("ios");
                $("html").addClass("mobile");
            }
            if (deviceAgent.match(/(Android)/)) {
                $("html").addClass("android");
                $("html").addClass("mobile");
            }
            if (navigator.userAgent.search("MSIE") >= 0) {
                $("html").addClass("ie");
            } else if (navigator.userAgent.search("Chrome") >= 0) {
                $("html").addClass("chrome");
            } else if (navigator.userAgent.search("Firefox") >= 0) {
                $("html").addClass("firefox");
            } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                $("html").addClass("safari");
            } else if (navigator.userAgent.search("Opera") >= 0) {
                $("html").addClass("opera");
            }
        });
    </script>
<?php
}
add_filter('document_title_separator', 'paladinwebgroup_document_title_separator');
function paladinwebgroup_document_title_separator($sep)
{
    $sep = esc_html('|');
    return $sep;
}
add_filter('the_title', 'paladinwebgroup_title');
function paladinwebgroup_title($title)
{
    if ($title == '') {
        return esc_html('...');
    } else {
        return wp_kses_post($title);
    }
}
function paladinwebgroup_schema_type()
{
    $schema = 'https://schema.org/';
    if (is_single()) {
        $type = "Article";
    } elseif (is_author()) {
        $type = 'ProfilePage';
    } elseif (is_search()) {
        $type = 'SearchResultsPage';
    } else {
        $type = 'WebPage';
    }
    echo 'itemscope itemtype="' . esc_url($schema) . esc_attr($type) . '"';
}
add_filter('nav_menu_link_attributes', 'paladinwebgroup_schema_url', 10);
function paladinwebgroup_schema_url($atts)
{
    $atts['itemprop'] = 'url';
    return $atts;
}
if (!function_exists('paladinwebgroup_wp_body_open')) {
    function paladinwebgroup_wp_body_open()
    {
        do_action('wp_body_open');
    }
}
add_action('wp_body_open', 'paladinwebgroup_skip_link', 5);
function paladinwebgroup_skip_link()
{
    echo '<a href="#content" class="skip-link screen-reader-text" tabindex="1">' . esc_html__('Skip to the content', 'paladinwebgroup') . '</a>';
}
add_filter('the_content_more_link', 'paladinwebgroup_read_more_link');
function paladinwebgroup_read_more_link()
{
    if (!is_admin()) {
        return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">' . sprintf(__('...%s', 'paladinwebgroup'), '<span class="screen-reader-text">  ' . esc_html(get_the_title()) . '</span>') . '</a>';
    }
}
add_filter('excerpt_more', 'paladinwebgroup_excerpt_read_more_link');
function paladinwebgroup_excerpt_read_more_link($more)
{
    if (!is_admin()) {
        global $post;
        return ' <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">' . sprintf(__('...%s', 'paladinwebgroup'), '<span class="screen-reader-text">  ' . esc_html(get_the_title()) . '</span>') . '</a>';
    }
}
add_filter('big_image_size_threshold', '__return_false');
add_filter('intermediate_image_sizes_advanced', 'paladinwebgroup_image_insert_override');
function paladinwebgroup_image_insert_override($sizes)
{
    unset($sizes['medium_large']);
    unset($sizes['1536x1536']);
    unset($sizes['2048x2048']);
    return $sizes;
}
add_action('widgets_init', 'paladinwebgroup_widgets_init');
function paladinwebgroup_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar Widget Area', 'paladinwebgroup'),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('wp_head', 'paladinwebgroup_pingback_header');
function paladinwebgroup_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('comment_form_before', 'paladinwebgroup_enqueue_comment_reply_script');
function paladinwebgroup_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
function paladinwebgroup_custom_pings($comment)
{
?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url(comment_author_link()); ?></li>
<?php
}
add_filter('get_comments_number', 'paladinwebgroup_comment_count', 0);
function paladinwebgroup_comment_count($count)
{
    if (!is_admin()) {
        global $id;
        $get_comments = get_comments('status=approve&post_id=' . $id);
        $comments_by_type = separate_comments($get_comments);
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

/**
 * Add FA icons to menu items via ACF
 * Add "unclickable" option to menu items via ACF
 * https://www.advancedcustomfields.com/resources/adding-fields-menu-items/
 */

 add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
    
    // loop
    foreach( $items as &$item ) {
        
        // vars
        $icon = get_field('icon', $item);
        $unclickable = get_field('unclickable', $item);

        // append icon
        if( $icon ) {
            
            $item->title = '<i class="' . $icon . '"></i> ' . $item->title;
            
        }
        
        // convert unclickable
        if ($unclickable) {
            // add new class to class array
            $item->classes[] = 'unclickable';
        }
        
    }
    
    
    // return
    return $items;
    
}

/**
 * Add Header option to menus via ACF
 * https://www.advancedcustomfields.com/resources/adding-fields-menus/
 */
add_filter('wp_nav_menu_items', 'my_wp_nav_menu_items', 10, 2);

function my_wp_nav_menu_items( $items, $args ) {
    
    // get menu
    $menu = wp_get_nav_menu_object($args->menu);
            
    // vars
    $menu_header = get_field('menu_header', $menu);
    if ($menu_header) {
        // prepend logo
        $menu_header_item = '<li class="menu-item-header">' . $menu_header . '</li>';
        
        // append style
        // $html_color = '<style type="text/css">.navigation-top{ background: '.$color.';}</style>';
        
        // append html
        $items = $menu_header_item . $items;
    }
        
    // return
    return $items;
    
}



/**
 * Custom comic taxonomy args
 */
function my_pre_get_posts( $query ) {
    
    // do not modify queries in the admin
    if( is_admin() ) {
        
        return $query;
        
    }
    
    // only modify queries for 'comics' post type
    if( is_comic($query)) {
        // this overrides local custom query args
        // $query->set('posts_per_page', 5);
        $query->set('orderby', 'meta_value');    
        $query->set('meta_key', 'episode');    
        $query->set('order', 'DESC'); 
    }
    
    // return
    return $query;

}
add_action('pre_get_posts', 'my_pre_get_posts');

/**
 * Set up custom comic body classes
 */
add_filter('body_class', 'comics_body_class');
function comics_body_class($classes) {
    if ( is_comic() ) {
        $classes[] = get_post_type();
        $classes[] = 'comic';
        if ( is_archive() ) {
            $classes[] = 'comic-feed';
        } else {
            $classes[] = 'comic-single';
        }
    }
    
    return $classes;
}

/**
 * Register full-page image size in the admin menu
 */
add_filter( 'image_size_names_choose', 'my_custom_sizes' );

function my_custom_sizes( $sizes ) {
return array_merge( $sizes, array(
'full-page' => __( 'Full Page' ),
) );
}
/**
 * prev_post_link and next_post_link
 * 
 */
// add back to beginning and back to latest buttons on post_nav on comics
add_filter( 'previous_post_link', function( $output, $format, $link, $post ) {

    if (is_comic()) {
        $args = array(
            'numberposts' => 1,
            'post_type' => get_post_type(),
            'meta_query' => array(
                array(
                    'key'   => 'episode',
                    'value' => '1',
                )
            )
        );
        $first_post = get_posts( $args );

        if ($post) {
    
            $output = sprintf(
                '<div class="nav-prev"><a href="%1$s" title="%2$s"><i class="fa-solid fa-caret-left"></i><span class="label"> %2$s</span></a></div>',
                get_permalink(  $post->ID ),
                get_the_title(  $post->ID )
            );
            $first_link = sprintf(
                '<div class="nav-first"><a href="%1$s" title="%2$s"><i class="fa-solid fa-backward"></i><span class="label"> First Episode</span></a></div>',
                get_permalink( $first_post[0]->ID ),
                get_the_title( $first_post[0]->ID )
            );
        } else { // if post is empty, were're on page 1 already
            $output = sprintf(
                '<div class="nav-previous"><a class="unclickable" title="%1$s" rel="prev"><span class="meta-nav"><i class="fa-solid fa-caret-left" aria-hidden="true"></i></span><span class="label"> %1$s</span></a></div>', get_the_title( $first_post[0]->ID )
            );
            $first_link = sprintf(
                '<div class="nav-first"><a class="unclickable" title="%1$s" rel="first"><i class="fa-solid fa-backward"></i><span class="label"> First Episode</span></a></div>',
                get_the_title( $first_post[0]->ID )
            );
        }

        echo $first_link . $output;
    }
}, 10, 4 );

add_filter( 'next_post_link', function( $output, $format, $link, $post ) {
    if (is_comic()) {
        $args = array(
            'numberposts' => 1,
            // 'orderby' => 'meta_value',
            // 'meta_key' => 'episode',
            'order' => 'DESC',
            'post_type' => get_post_type() ,
            'meta_query' => array(
                array(
                    'key'   => 'episode',
                    // 'value' => 'yes',
                )
            )
        );
        //'numberposts=1&order=ASC'
        $last_post = get_posts( $args );
        if ($post) {
            $output = sprintf(
                '<div class="nav-next"><a href="%1$s" title="%2$s"><span class="label">%2$s </span><i class="fa-solid fa-caret-right"></i></a></div>',
                get_permalink( $post->ID ),
                get_the_title( $post->ID )
            );
            $last_link = sprintf(
                '<div class="nav-last"><a href="%1$s" title="%2$s"><span class="label">Last Episode </span><i class="fa-solid fa-forward"></i></a></div>',
                get_permalink( $last_post[0]->ID ),
                get_the_title( $last_post[0]->ID )
            );
        } else { // if $post is empty we're already on the last post
            $output = sprintf(
                '<div class="nav-next"><a class="unclickable" title="%1$s"><span class="label">%1$s </span><i class="fa-solid fa-caret-right"></i></a></div>',
                get_the_title( $last_post[0]->ID )
            );
            $last_link = sprintf(
                '<div class="nav-last"><a class="unclickable" title="%1$s"><span class="label">Last Episode </span><i class="fa-solid fa-forward"></i></a></div>',
                get_the_title( $last_post[0]->ID )
            );

        }

        echo $output . $last_link;
    }
}, 10, 4 );


/**
 * is_comic returns bool
 * this helper function is used throughout this file
 * Update this for every new comic
 */
function is_comic($query=[]) {
    if( isset($query->query_vars['post_type']) ) {
        return (
            $query->query_vars['post_type'] == 'campaign' ||
            $query->query_vars['post_type'] == 'paledragon'
        );
    }
    return get_post_type() == 'campaign' || get_post_type() == 'paledragon';
}

?>
