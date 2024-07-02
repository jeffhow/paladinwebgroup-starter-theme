<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php paladinwebgroup_schema_type(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <?php get_template_part('/assets/inc/google-fonts', 'google-fonts') ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="wrapper" class="hfeed">
        <header id="header" role="banner" class="site-header">
            <div id="branding">
                <div id="site-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                    <?php
                        if ( is_front_page() || is_home() || is_front_page() && is_home() ) { 
                            echo '<h1>'; 
                        }
                        
                        echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" itemprop="url"><span itemprop="name">' . esc_html( get_bloginfo( 'name' ) ) . '</span></a>';
                        
                        if ( is_front_page() || is_home() || is_front_page() && is_home() ) {
                            echo '</h1>'; 
                        }
?>
                </div>
                <div id="site-description" <?php if ( !is_single() ) { echo ' itemprop="description"'; } ?>>
                    <?php bloginfo( 'description' ); ?></div>
            </div>
            <nav 
                class="site-nav" 
                id="menu" 
                role="navigation" 
                itemscope itemtype="https://schema.org/SiteNavigationElement"
                aria-expanded="false">
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>

                
                <div id="search"><?php get_search_form(); ?></div>
                
                <div class="form-check form-switch dark-mode-switch">
                    <label class="form-check-label" aria-label="Toggle dark-mode">
                        <input class="form-check-input" type="checkbox" role="switch" id="dark-mode-toggle" checked="">
                    </label>
                    <i class="fa-sharp fa-solid fa-eclipse" aria-hidden="true"></i>
                </div>
            </nav>
            <button class="nav-toggle" 
                    aria-label="Navigation menu" 
                    aria-haspopup="true" 
                    aria-controls="menu">
                <span class="line line-1"></span>
                <span class="line line-2"></span>
                <span class="line line-3"></span>
            </button>
        </header>
        <div id="container">
            <main id="content" role="main">