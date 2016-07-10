<footer class="entry-footer">


	<span class="cat-links"><?php _e( 'Categories: ', 'backup' ); ?><?php the_category( ', ' ); ?></span>
	<span class="tag-links"><?php the_tags(); ?></span>
	<?php if ( comments_open() ) { 
		echo '<span class="meta-sep">|</span> <span class="comments-link"><a href="' . get_comments_link() . '">' . sprintf( __( 'Comments', 'backup' ) ) . '</a></span>';
	} ?>

	<span class="author vcard"><?php the_author_posts_link(); ?></span>
	<span class="meta-sep"> | </span>
	<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>

	
</footer> 