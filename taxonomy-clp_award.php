<?php get_header(); ?>

<?php $tax_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
<?php $active_term = $tax_term->slug ?>
<?php $active_term_name = $tax_term->name ?>
<?php $active_term_desc = $tax_term->description ?>

<?php 

$term_slug = get_query_var( 'term' );
$taxonomyName = get_query_var( 'taxonomy' );
$current_term = get_term_by( 'slug', $term_slug, $taxonomyName );
$term_id = $current_term->term_id;
$saved_data = get_tax_meta($term_id,'ba_wysiwyg_field_id');
?>

<div class="item-wrapper">
  <div class="taxonomy-nav">

    <?php include(  locate_template( 'parts/taxonomy-nav.php' )  ); ?>

  </div>
  
  <?php if ( $saved_data != '') { ?>
  <div id="page-content" class="bckp" role="main" >
    <article id="post-<?php the_ID(); ?>" class="page">
      
      
      <div class="entry-content taxonomy-introduction">
        <?php echo $saved_data; ?>
      </div>

    </article>
  </div>
  <?php } ?>

  <?php wp_reset_query(); ?>

  <strong><?php echo get_query_var('post_type'); ?></strong>
  <div class="items">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <?php include(  locate_template( 'parts/taxonomy-film-item.php' )  ); ?>
      
    <?php endwhile; endif; wp_reset_query(); ?>

</div>
</div>

<?php get_footer(); ?>