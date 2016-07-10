<?php
/*
Programm Ajax Post
*/
?>
<?php
	$post = get_post($_POST['id']);
?>
<?php if ($post) : ?>
	<?php setup_postdata($post); ?>
	<?php edit_post_link('Edit', '', ''); ?>
	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		
		<div class="entry"> 
			<?php the_content('Read the rest of this entry &raquo;'); ?>
		</div>

		
	</div>
<?php endif; ?>