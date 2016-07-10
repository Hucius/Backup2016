<?php global $wp_query; 
$language = pll_current_language(); 
if ( $wp_query->max_num_pages > 1 ) { 
	?>

	<nav id="nav-below" class="navigation" role="navigation">
		<?php if( $language == 'de' ) { ?>
		<div class="nav-previous"><?php next_posts_link(sprintf( __( '%s zurück', 'backup' ), '<span class="meta-nav">&larr;</span>' ) ) ?></div>
		<div class="nav-next"><?php previous_posts_link(sprintf( __( 'weiter %s', 'backup' ), '<span class="meta-nav">&rarr;</span>' ) ) ?></div>
		<? } ?>
		<?php if( $language == 'en' ) { ?>
		<div class="nav-previous"><?php next_posts_link(sprintf( __( '%s older', 'backup' ), '<span class="meta-nav">&larr;</span>' ) ) ?></div>
		<div class="nav-next"><?php previous_posts_link(sprintf( __( 'newer %s', 'backup' ), '<span class="meta-nav">&rarr;</span>' ) ) ?></div>
		<? } ?>
	</nav>
	<?php } ?>