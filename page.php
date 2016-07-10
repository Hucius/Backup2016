<?php get_header(); ?>
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

<?php get_footer(); ?>