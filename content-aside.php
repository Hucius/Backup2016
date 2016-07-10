<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
		<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
		</a>
		</header>
		
		<section>
		<?php the_content('…'); ?>
		</section>
		
	</article>