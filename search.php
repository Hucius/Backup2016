<?php get_header(); ?>
<section id="item-wrapper" role="main">


	<?php if ( have_posts() ) : ?>

		<header class="header">
			<h3 class="entry-title"><?php printf( __( 'Suchergebnisse für: %s', 'backup' ), get_search_query() ); ?></h3>
		</header>

		<div class="page items search">
			<?php while ( have_posts() ) : the_post(); ?>


				<article id="post-<?php the_ID(); ?>" class="item">


					<?php if ( has_post_thumbnail() ) { ?>
					<section class="thumb"> 
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('quad_600px'); ?></a> 
					</section>
					<?php } ?>
					<section class="entry-summary">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>

						<p class="url"><?php the_permalink(); ?></p>
					</section>

				</article>

			<?php endwhile; ?>
		</div>
		<?php get_template_part( 'nav', 'below' ); ?>
	<?php else : ?>
		<article id="post-0" class="post no-results not-found">
			<header class="header">
				<h2 class="entry-title"><?php _e( 'Nothing Found', 'backup' ); ?></h2>

			</header>
			<section class="entry-content">
				<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'backup' ); ?></p>
				<?php get_search_form(); ?>
			</section>
		</article>

	<?php endif; ?>

</section>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>