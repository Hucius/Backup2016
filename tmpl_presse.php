<?php
/**
*
* Template Name: tmpl_Presse
* Description: Indexseite für Pressemitteilungen (WP News mit der Katerie XY)
*
*
**/
?>
<?php get_header(); ?>

<?php global $wp_query;
$language = pll_current_language(); ?>

<section id="presse" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</div>
			<section class="entry-content">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
				<?php the_content(); ?>
				<?php edit_post_link(); ?>
				<div class="entry-links"><?php wp_link_pages(); ?></div>
			</section>
		</article>
		<?php // if ( ! post_password_required() ) comments_template( '', true ); ?>
	<?php endwhile; endif; ?>
</section>

<h2><?php if( $language == 'de' ) { echo 'Pressemitteilungen'; } else { echo 'Press'; } ?></h2>
<section id="index" role="main">

	<?php 

	if (have_posts()) {

		if( $language == 'de' ) {
			$the_query = new WP_Query( 'cat=199' );
		} 
		if ( $language == 'en' ) {
			$the_query = new WP_Query( 'cat=1099' );
		}
// The Loop
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
		get_template_part( 'content', get_post_format() );
		endwhile;

	}

/* Restore original Post Data 
 * NB: Because we are using new WP_Query we aren't stomping on the 
 * original $wp_query and it does not need to be reset.
*/
wp_reset_postdata();
?>
</section>

<?php get_template_part( 'nav', 'below' ); ?>


<?php //get_sidebar(); ?>
<?php get_footer(); ?>
