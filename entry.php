<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<header>
		<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
		<?php if ( is_singular() ) { echo '<h1 class="entry-title">'; } else { echo '<h2 class="entry-title">'; } ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a><?php if ( is_singular() ) { echo '</h1>'; } else { echo '</h2>'; } ?>
	</header>

	<?php get_template_part( 'entry', ( is_archive() || is_search() ? 'summary' : 'content' ) ); ?>

	<footer class="entry-footer">
		<span class="cat-links"><?php _e( 'Kategorie: ', 'backup' ); ?><?php the_category( ', ' ); ?></span>
		<span class="tag-links"><?php the_tags(); ?></span>
		<?php if ( comments_open() ) { 
			echo '<span class="meta-sep">|</span> <span class="comments-link"><a href="' . get_comments_link() . '">' . sprintf( __( 'Kommentare', 'backup' ) ) . '</a></span>';
		} ?>

		<span class="author vcard"><?php the_author_posts_link(); ?></span>
		<span class="meta-sep"> | </span>
		<?php edit_post_link("e"); ?>
	</footer> 

	
</article>