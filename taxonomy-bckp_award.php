<?php get_header(); ?>
<?php $tax_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
<?php $active_term = $tax_term->slug ?>
<?php $active_term_name = $tax_term->name ?>
<?php $active_term_desc = $tax_term->description ?>


<div class="item-wrapper">
  <div class="taxonomy-nav">

    <?php include(  locate_template( 'parts/taxonomy-nav.php' )  ); ?>

  </div>

  <div class="items">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <?php include(  locate_template( 'parts/taxonomy-film-item.php' )  ); ?>
      
    <?php endwhile; endif; wp_reset_query(); ?>

  </div>
</div>

<?php get_footer(); ?>