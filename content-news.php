

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header>
		<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header>
		<section class="entry-content">
			<?php if ( has_post_thumbnail() ) { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
				<?php the_post_thumbnail('preview'); } ?>
			</a>
		</section>

</article>