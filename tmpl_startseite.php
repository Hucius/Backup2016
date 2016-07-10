<?php
/* Template Name: tmpl_Startseite
*
* The template for displaying all subpages of a parent Page.
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site will use a
* different template.
*
* @package backup_festival
* @since backup_festival 1.0
*/
?>
<?php get_header(); ?>

<?php global $wp_query;
$language = pll_current_language(); ?>

<!-- <div id="start" class="clearfix">

    <?php if (have_posts()) : while (have_posts()) : the_post();?>

          <?php the_content(); ?>

    <?php endwhile; endif; ?> -->

<section id="page-content" role="main">


  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div>
        <h1 class="entry-title"><?php the_title(); ?></h1>
      </div>
      <section class="entry-content">

        <?php the_content(); ?>
        <?php edit_post_link(); ?>
        <div class="entry-links"><?php wp_link_pages(); ?></div>
      </section>
    </article>
    
    <?php // if ( ! post_password_required() ) comments_template( '', true ); ?>
  <?php endwhile; endif; ?>


</section>
<!-- getting latest post -->
            <div id="index" class="latest-news">
              <?php
              $query = new WP_Query( array ( 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => '3' ) );

              while ( $query->have_posts() ) :
                $query->the_post();
              require( locate_template( 'content-news.php')  );
              endwhile;
              ?>
            </div>


        <br class="clearfix" />

<?php get_footer(); ?>