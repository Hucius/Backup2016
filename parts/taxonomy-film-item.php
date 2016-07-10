<div class="item  

      <?php echo $active_term; ?>
      country-<?php echo get_post_meta(get_the_ID(), "wpcf-land",true) ?> 
      y<?php echo get_post_meta(get_the_ID(), "wpcf-jahr",true) ?> 
      <?php echo clean(get_post_meta(get_the_ID(), "wpcf-hochschule",true)) ?> ">
      <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">

        <div class="item-image"><?php echo get_the_post_thumbnail(get_the_ID(), 'medium'); ?></div>



        <div class="item-specs">
          <h2><?php the_title() ?></h2>
          <?php if (  get_post_meta(get_the_ID(), "wpcf-verantwortliche",true) != '' )  { ?>
          <span class="author"><?php echo get_post_meta(get_the_ID(), "wpcf-verantwortliche",true) ?></span>
          <?php } ?>
          <?php if(  get_post_meta(get_the_ID(), "wpcf-hochschule",true) != ''  ) { ?>
          <span class="university"><?php echo get_post_meta(get_the_ID(), "wpcf-hochschule",true) ?></span>
          <?php } ?>

          <span class="release-infos">
            <span class="country"><?php echo get_post_meta(get_the_ID(), "wpcf-land",true) ?></span>—
            <span class="year"><?php echo get_post_meta(get_the_ID(), "wpcf-jahr",true) ?></span>, 
            <span class="duration"><?php echo get_post_meta(get_the_ID(), "wpcf-laufzeit",true) ?></span>
          </span>
        </div>

      </a>
    </div>