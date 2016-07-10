<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
		<?php the_content('',''); ?>
		</a>
	</article>