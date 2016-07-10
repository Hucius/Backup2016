<?php
/**
*
* Template Name: Übersicht bckp_home (overview-bckp-home.php)
*
*
**/
?>
<?php get_header(); ?>

<div class="item-wrapper" role="main">

	<div>
		<?php

		$taxonomy = 'bckp_home';
		$tax_terms = get_terms($taxonomy);
		?>


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
      // load Jury Overview for this award / Subpages of this in the CMS
      include(  locate_template( 'parts/overview-film-item.php' )  );
    ?>
    
	</div>

</div>

	<?php get_footer(); ?>