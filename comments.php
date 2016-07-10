<?php if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) ) return; ?>

<section id="comments">
<?php 
	if ( have_comments() ) : 
	global $comments_by_type;
	$comments_by_type = &separate_comments( $comments );
	if ( ! empty($comments_by_type['comment']) ) : 
?>
  <section id="comments-list" class="comments">
    <h1 class="comments-title">
      <?php comments_number(); ?>
    </h1>
    <?php if ( get_comment_pages_count() > 1 ) : ?>
    <nav id="comments-nav-above" class="comments-navigation" role="navigation">
      <div class="paginated-comments-links">
        <?php paginate_comments_links(); ?>
      </div>
    </nav>
    <?php endif; ?>
    <ul>
      <?php wp_list_comments(array(
	  'type' => 'comment',
	  'callback' => 'backup_comments',
	  'avatar_size'=> 60
	  )); ?>
    </ul>
    <?php if ( get_comment_pages_count() > 1 ) : ?>
    <nav id="comments-nav-below" class="comments-navigation" role="navigation">
      <div class="paginated-comments-links">
        <?php paginate_comments_links(); ?>
      </div>
    </nav>
    <?php endif; ?>
  </section>
  <?php 
endif; 
if ( ! empty($comments_by_type['pings']) ) : 
$ping_count = count($comments_by_type['pings']); 
?>
  <section id="trackbacks-list" class="comments">
    <h3 class="comments-title"><?php echo '<span>'.$ping_count.'</span> '.($ping_count > 1 ? __( 'Trackbacks', 'bauhausfm' ) : __( 'Trackback', 'bauhausfm' ) ); ?></h3>
    <ul>
      <?php wp_list_comments('type=pings&callback=bauhausfm_custom_pings'); ?>
    </ul>
  </section>
  <?php 
endif; 
endif;
if ( comments_open() ) comment_form();
?>
</section>
