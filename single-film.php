<?php get_header(); ?>

<?php global $wp_query;
$language = pll_current_language(); ?>



<section id="single-film" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<section class="film-infos">
				
				<h3>
					<?php
					
					$terms = get_the_terms( get_the_ID() , 'special' );
					
					if ( !empty( $terms ) ){ 
						foreach( $terms as $term ) {  
							echo $term->name;
						}
					}
		
					$terms = get_the_terms( get_the_ID() , 'bckp_award' );
					if ( !empty( $terms ) ){ 
						foreach( $terms as $term ) {  
							echo $term->name;
						}
					}
					?>
				</h3>

				<?php if ( is_singular() ) { echo '<h1 class="entry-title">'; } else { echo '<h2 class="entry-title">'; } ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a><?php if ( is_singular() ) { echo '</h1>'; } else { echo '</h2>'; } ?>
				
				<div class="release-infos">
					<span class="author"><?php echo get_post_meta(get_the_ID(), "wpcf-verantwortliche",true) ?></span>
					<span class="university"><?php echo get_post_meta(get_the_ID(), "wpcf-hochschule",true) ?></span>
					<span class="release-info">
						<?php if ( get_post_meta(get_the_ID(), "wpcf-land",true) != '' && get_post_meta(get_the_ID(), "wpcf-jahr",true) != ''  ) { ?>
						<span class="country"><?php echo get_post_meta(get_the_ID(), "wpcf-land",true) ?></span>
						—<span class="year"><?php echo get_post_meta(get_the_ID(), "wpcf-jahr",true) ?></span>, 
						<?php } ?>
						<span class="duration"><?php echo get_post_meta(get_the_ID(), "wpcf-laufzeit",true) ?></span>

					</span>
				</div>
				<div class="film-content">
					<div class="synopsis">
						<?php the_content(); ?>
					</div>
					<section class="award-infos">
						

						<div>
							
							
							
							<footer class="footer">

								<nav id="" class="film-navigation" role="navigation">
									<div class="backto"> &laquo;		
										<?php
										if (  get_the_terms( get_the_ID() , 'bckp_award' ) != '' ) {
											$terms = get_the_terms( get_the_ID() , 'bckp_award' );
											foreach( $terms as $term ) {  

												if ( !empty( $terms ) ){
													if ( is_singular( 'film' ) ) {
														$term_link = get_term_link( $term->slug, 'bckp_award' );
						//print_r( $term_link  );
														if ( is_wp_error( $term_link ) ) {
							//print_r( $term_link  );
														} else {
															if ( $language == 'de' ) {
																echo '<a href="'. esc_url(  $term_link  ) . '">Zur Übersicht</a>';
															}
															if (  $language == 'en') {
																echo '<a href="'. esc_url(  $term_link  ) . '">Back to Overview</a>';
															}
														}
													}
												}
											}
										} 
										if (  get_the_terms( get_the_ID() , 'special' ) != '' ) {
											
											$terms = get_the_terms( get_the_ID() , 'special' );
											
											foreach( $terms as $term ) {  
												if ( !empty( $terms ) ){
													if ( is_singular( 'film' ) ) {
														$term_link = get_term_link( $term->slug, 'special' );
						//print_r( $term_link  );
														if ( is_wp_error( $term_link ) ) {
							//print_r( $term_link  );
														} else {
															if ( $language == 'de' ) {
																echo '<a href="'. esc_url(  $term_link  ) . '">Zur Übersicht</a>';
															}
															if (  $language == 'en') {
																echo '<a href="'. esc_url(  $term_link  ) . '">Back to Overview</a>';
															}
														}	
														
													}
												}
											}
										}
										?>
									</div>
									<div class="nav-next-prev">
										<?php 
										if( $language == 'de' ) { 
											previous_post_link( '%link', '<span class="meta-nav">&lsaquo; Zurück</span>' );
											next_post_link( '%link', '<span class="meta-nav">Weiter &rsaquo;</span>' );
										}
										if ($language == 'en') { 
											previous_post_link( '%link', '<span class="meta-nav">&lsaquo; Prev</span>' );
											next_post_link( '%link', '<span class="meta-nav">Next &rsaquo;</span>' );
										} ?>

									</div>
								</nav>
							</footer>
						</div>


						<?php wp_reset_query(); ?>
					</section>

				</div>
			</section>

			<section class="film-gallery">
				<ul>
					<?php if ( has_post_thumbnail() ) { 
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
						$featured_thumb = get_the_post_thumbnail($page->ID,"medium");
						echo "<li class='featured'>". $featured_thumb ."</li>"; 
					} ?>

					<!-- <?php

					global $polylang;
					$post_ids = $polylang->get_translations('post', $post->ID);
		//$post_ids[de]
					

					?>  -->
					<!-- <?php if ( $post->post_type == 'film' && $post->post_status == 'publish' ) {
						$attachments = get_posts( array(
							'post_type' => 'attachment',
							'posts_per_page' => 4,
							'post_mime_type' => 'image',
							'post_parent' => $post_ids[de],
							'exclude'     => get_post_thumbnail_id($post->ID)
							) );

						if ( $attachments ) {
							foreach ( $attachments as $attachment ) {
								$class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
								$thumbimg = wp_get_attachment_image( $attachment->ID, 'medium', false );
								echo '<li class="' . $class . '">' . $thumbimg . '</li>';
							}
							
						}
					}
					wp_reset_query();
					?> -->
				</ul>
			</section>


			


			
		</article>


		<?php edit_post_link(); ?>

		<?php // if ( ! post_password_required() ) comments_template( '', true ); ?>
	<?php endwhile; endif; ?>



</section>

<?php get_footer(); ?>