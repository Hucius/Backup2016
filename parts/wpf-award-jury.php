  <div id="overview">
    <div id="page-content">
      <div class="page">
        <h2>Weimar Poetry Film Award Jury</h2>
      </div>
    </div>
    <div class="subpages" role="main">
      <?php
      $args = array(
                  'orderby' => 'menu_order', // Allows users to set order of subpages (options: id, name, title, date, menu_order, ...)
                  'order' => 'DESC',
                  'numberposts' => '-1', 
                  'post_parent' => $post->ID,
                  'post_type' => 'page',
                  'post_status' => 'publish'
                  ); 

      $postslist = get_posts($args);
      
      foreach ($postslist as $post) : setup_postdata($post); ?>

      <div class="entry mem-">
        <a href="<?php echo get_permalink(); ?>">
          <h3><?php echo $post->post_title; ?></h3>
          <div class="entry-content">

            <?php $color = array(220, 220, 220); ?>
            
            <div class="jury-thumb" style='background-image: url(<?php echo colorize(get_the_post_thumbnail_src(get_the_post_thumbnail($post->ID, 'medium')), $color); ?>)'></div>

            <div class="entry-text">

              <ul>
                <?php
                global $id;
                wp_list_pages("title_li=&child_of=$id&show_date=modified
                &date_format=$date_format"); ?>
              </ul>
              
              <?php /* the_content(); */ ?>
            </div>
          </div>
        </a>
      </div>
            <?php /*
              if(get_field('kurzbeschreibung'))
            {
              echo '<span class="desc">' . get_field('kurzbeschreibung') . '</span>';
            }  */
            ?>

          <?php endforeach; ?>
        </div>
      </div>