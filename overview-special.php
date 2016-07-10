<?php
/**
*
* Template Name: Übersicht Special Award (overview-special.php)
* Description: Archivseite
*
*
**/
?>
<?php get_header(); ?>

<div class="item-wrapper" role="main">

	<div>
		<?php

		$taxonomy = 'special';
		$tax_terms = get_terms($taxonomy);
		?>


		<?php /* CONTENT OF THIS PAGE */ ?>
    <?php if (have_posts()) : while (have_posts()) : the_post();?>
      <div id="page-content">
        <div class="page">
          <h2><?php the_title(); ?></h2>
          <?php the_content(); ?>
        </div>
      </div>
    <?php endwhile; endif; ?>

    <?php /* RENDERED ITEMS FROM Custom Post Type 'FILM' */ ?>
     <?php
       include(  locate_template( 'parts/overview-film-item.php' )  );
    ?>
   <?php 
    // check for subpages, this will be displayed as jury
    $children = get_pages('child_of='.$post->ID);
    if( count( $children ) != 0 ) {
      include(  locate_template( 'parts/wpf-award-jury.php' )  );
    } else {

    }
    ?>
    
</div>

</div>


<?php get_footer(); ?>
