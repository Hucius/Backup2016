<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
		<div class="entry-content">
             <?php the_content() ?>
        </div>
		</a>
	</article>