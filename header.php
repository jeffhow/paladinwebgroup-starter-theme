<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php paladinwebgroup_schema_type(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <?php get_template_part('/template-parts/google-fonts', 'google-fonts') ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="wrapper" class="hfeed">
        <header id="header" role="banner" class="site-header">
            <div id="branding">
                <div id="site-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                    <?php echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" itemprop="url" tabindex="2">'; ?>
                        <h1>
                            <img class="site-logo" src="<?php echo get_template_directory_uri();?>/assets/images/deadline-comics.svg" alt="deadline comics logo">
                            <?php echo '<span itemprop="name" class="hide-visually">' . esc_html( get_bloginfo( 'name' ) ) . '</span>'; ?>
                        </h1>
                    </a>
                </div>
                
            </div>
            <nav 
                class="site-nav" 
                id="menu" 
                role="navigation" 
                itemscope itemtype="https://schema.org/SiteNavigationElement"
                aria-expanded="false"><!-- menu -->
                
                <div class="nav-container">
                    <!-- nav -->
                        <?php 
                            wp_nav_menu( 
                                array( 
                                    'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s" tabindex="-1">%3$s</ul>',
                                ) 
                            ); 
                        ?>
                    <!-- search -->
                        <div id="search"><?php get_search_form(); ?></div>
                    <!-- Dk-mode -->
                    <div class="form-check form-switch dark-mode-switch dk-mode-toggle">
                            <label class="form-check-label" aria-label="Toggle dark-mode">
                                <input class="form-check-input" type="checkbox" role="switch" id="dark-mode-toggle" checked="">
                                <i class="fa-sharp fa-solid fa-eclipse" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    <a href="#" class="skip-link screen-reader-text" id="close-menu-btn">Close Menu</a>
                </nav>
                <!-- menu -->
            <button class="nav-toggle " 
                    tabindex="3"
                    aria-label="Navigation menu" 
                    aria-haspopup="true" 
                    aria-controls="menu">
                <span class="line line-1"></span>
                <span class="line line-2"></span>
                <span class="line line-3"></span>
            </button>
        </header>
        <div id="container">
            <main id="content" role="main" class="site-main">