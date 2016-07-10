<?php
 /* Template Name: tmpl_Jury_Overview
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

 <div id="overview" role="main" >
  <div class="post">
    <h1 class="entry-title">
      <?php the_title(); ?>
    </h1>
    
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
  </div>

  <div class="subpages" role="main">
    <?php
    $args = array(
    'orderby' => 'menu_order', // Allows users to set order of subpages (options: id, name, title, date, menu_order, ...)
    'order' => 'DESC',
    'numberposts' => '-1', 
    'post_parent' => $post->ID,
    'post_type' => 'page',
    'post_status' => 'publish'
    ); $postslist = get_posts($args);
    foreach ($postslist as $post) : setup_postdata($post); ?>
    <div class="entry mem-<?php
    foreach((get_the_category()) as $category) {
      echo $category->term_id . ' ';
    }
    ?>">
    <?php /* <a href="<?php echo  get_permalink($post->ID); ?>" rel="bookmark" title="<?php echo $page->post_title; ?>" class="item"> */ ?>
    <a href="<?php echo get_permalink(); ?>">
      <h3><?php echo $post->post_title; ?></h3>
      <div class="entry-content">
        
        
        <?php /* <div class="thumb"><?php echo get_the_post_thumbnail($post->ID, 'quad_600px'); ?></div> */ ?>

        <div class="entry-text">

          <ul>
            <?php
            global $id;
            wp_list_pages("title_li=&child_of=$id&show_date=modified
            &date_format=$date_format"); ?>
          </ul>
          
          <?php /* the_content(); */ ?>
        </div>
      </a>
    </div>
      <?php /*
        if(get_field('kurzbeschreibung'))
      {
        echo '<span class="desc">' . get_field('kurzbeschreibung') . '</span>';
      }  */
      ?>
    </span> </a> </div>
  <?php endforeach; ?>
</div>
</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
