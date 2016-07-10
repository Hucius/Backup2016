<?php
 /* Template Name: tmpl_Jury
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

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div id="overview" class="bckp" role="main" >
    <div class="post">
      <h1 class="entry-title">
        <?php the_title(); ?>
      </h1>
      
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </div>

  <?php endwhile; endif; ?>

  <div class="items" role="main">

    <?php
    $args = array(
    'orderby' => 'menu_order', // Allows users to set order of subpages (options: id, name, title, date, menu_order, ...)
    'order' => 'ASC',
    'numberposts' => '-1', 
    'post_parent' => $post->ID,
    'post_type' => 'page',
    'post_status' => 'publish'
    ); $postslist = get_posts($args);
    foreach ($postslist as $post) : setup_postdata($post); ?>
    <div class="item  

    <?php echo $active_term; ?>
    country-<?php echo get_post_meta(get_the_ID(), "wpcf-land",true) ?> 
    y<?php echo get_post_meta(get_the_ID(), "wpcf-jahr",true) ?> 
    <?php echo clean(get_post_meta(get_the_ID(), "wpcf-hochschule",true)) ?> ">
    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">

      <div class="item-image"><?php echo get_the_post_thumbnail(get_the_ID(), 'quad_600px'); ?></div>

      
      
      <div class="item-specs">
        <h2><?php the_title() ?></h2>
        
        
      </div>

    </a>
  </div>
<?php endforeach; ?>
</div>
</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>