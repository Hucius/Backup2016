<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <?php echo '<meta name="viewport" content="width=device-width" />' ?>
    <title><?php wp_title( ' | ', true, 'right' ); ?></title>

    <script type="text/javascript" src="//use.typekit.net/tuo5yrf.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

    <link rel="stylesheet" type="text/css" href="<?php /* echo get_stylesheet_uri(); */ ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/screen.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/content.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/grid_static.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/events.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/comments.css" />

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <?php 
// If the current user can manage options(ie. an admin)

    // Print the saved global
    if ( current_user_can( 'manage_options' )  ) {
        echo "Current Template: ";
        echo get_current_template(); 
    }
    ?>

<div id="wrapper">  
  <video autoplay loop poster="<?php echo get_template_directory_uri(); ?>/img/polina.png" id="bgvid">
    <source src="<?php echo get_template_directory_uri(); ?>/img/animation.mp4" alt="backup festival weimar" type="video/mp4">
  </video>
      
  <header id="header" role="banner">
    <section id="logo">
      <a href="<?php echo home_url(); ?>">  
	     <img src="<?php echo get_template_directory_uri(); ?>/img/backup_2016_logo_web.png" alt="backup festival weimar" />
      </a>
    </section>
      
    <nav id="menu" role="navigation">
          <? wp_nav_menu(array('theme_location' => 'primary')); ?>
    </nav>

      <div id="lang-switch">
          <ul>
              <?php 
              pll_the_languages(array(
                'display_names_as' => 'slug'
                )); 
                ?>
            </ul>
        </div>

      <div id="social-media-channels">
           <ul>
             <li><a href="https://twitter.com/backup_festival" class="tw">Tw</a></li>
             <li><a href="https://www.facebook.com/backupfestival" class="fb">Fb</a></li>
             <li><a href="http://www.youtube.com/user/backupfestival" class="yt">Yt</a></li>
         </ul>
     </div>

      <div id="searchit">
        <a><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/search-icon.svg" width="20px" height="20px" /></a>
      </div>     
     

    <div class="searchbox">
        <div class="inner">
            <?php get_search_form(); ?>
        </div>
    </div>
  </header>