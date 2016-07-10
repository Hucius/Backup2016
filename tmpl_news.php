<?php
/**
*
* Template Name: tmpl_News
* Description: Indexseite für Pressemitteilungen (WP News mit der Katerie XY)
*
*
**/
?>
<?php get_header(); ?>

<!-- get user current language version -->
<?php global $wp_query;
$language = pll_current_language(); ?>

<!-- get all posts -->
<section id="index" role="main">
              <?php
              $query = new WP_Query( array ( 'orderby' => 'date', 'order' => 'DESC') );

              while ( $query->have_posts() ) :
                $query->the_post();
              require( locate_template( 'content-news.php')  );
              endwhile;
              ?>
</section>

<?php get_footer(); ?>