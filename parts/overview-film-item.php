<div class="overview items">
  <?php
  foreach ($tax_terms as $tax_term) {
    echo '

    <div class="item '.$tax_term->slug.'">' . 
      '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>'; ?>

      <?php
      $query_args = array(
        'post_type' => 'film',
        "$taxonomy" => $tax_term->slug,
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'ignore_sticky_posts' => true,
        'orderby' => 'rand',
        );

        $my_query = new WP_Query( $query_args ); ?>

        <?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

          <?php 

          if( $tax_term->slug == 'award-blau' ||  $tax_term->slug == 'award-blue' ) { 
            $color = array(90, 150, 180); 
          }
          elseif( $tax_term->slug == 'award-rot' ||  $tax_term->slug == 'award-red' ) { 
            $color = array(227, 113, 113); 
          }
          elseif( $tax_term->slug == 'award-gruen' ||  $tax_term->slug == 'award-green' ) { 
            $color = array(120, 180, 90); 
          }
          elseif( $tax_term->slug == 'award-pink-de' ||  $tax_term->slug == 'award-pink-en' ) { 
            $color = array(227, 113, 219); 
          }
          elseif( $tax_term->slug == 'award-schwarz' ||  $tax_term->slug == 'award-black' ) { 
            $color = array(120, 120, 120); 
          }
          elseif( $tax_term->slug == 'award-lila' ||  $tax_term->slug == 'award-purple' ) { 
            $color = array(160, 113, 227); 
          }
          elseif( $tax_term->slug == 'award-orange' ||  $tax_term->slug == 'award-orange-en' ) { 
            $color = array(240, 140, 0); 
          }
          else {
                // exhibit, special
            $color = array(255,158,28);
          }

          ?> 

          <div class="item-image" style="background-image: url(
            <?php 
            echo colorize(  get_the_post_thumbnail_src(  get_the_post_thumbnail(  get_the_ID(), 'medium')  ), $color ); ?>  );">
          </div>

        <?php endwhile; endif; wp_reset_query(); ?>

        <?php echo '
        <div class="title"><h2>' . $tax_term->name.'</h2></div>
        <div class="description"><span>'.str_replace("|","</span><span>",$tax_term->description).'</span></div>
      </a>
    </div>';
  }
  ?>
</div>