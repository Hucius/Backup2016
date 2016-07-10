<?php
function clean($string) {
   $umlaute = array("ä", "ö", "ü","Ä","Ö","Ü","ß",".");
   $doppelbuchstaben = array("ae", "oe", "ue","AE","OE","UE","ss","-");
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace ($umlaute,$doppelbuchstaben,$string);  
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   $string = strtolower($string);
   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

if ( ! function_exists( 'filter_tag' ) ) {
  function filter_tag($query) {
    if ($query->is_tag) {
    $query->set('post_type', array('post', 'film'));
    };
    return $query;
  };
}
add_filter('pre_get_posts', 'filter_tag');

if ( ! function_exists( 'filter_search' ) ) {
  function filter_search($query) {
    if ($query->is_search) {
    $query->set('post_type', array('post', 'page','film'));
    };
    return $query;
  };
}
  
add_filter('pre_get_posts', 'filter_search');


add_theme_support( 'post-formats', array( 'aside', 'image','video' ) );

add_image_size( 'preview', 300, 200, array( 'center', 'center' ) );

// get taxonomies terms links
function custom_taxonomies_terms_links(){
  // get post by post id
  $post = get_post( $post->ID );

  // get post type by post
  $post_type = $post->post_type;

  // get post type taxonomies
  $taxonomies = get_object_taxonomies( $post_type, 'objects' );

  $out = array();
  foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

    // get the terms related to post
    $terms = get_the_terms( $post->ID, $taxonomy_slug );

    if ( !empty( $terms ) ) {
      $out[] = "<h2>" . $taxonomy->label . "</h2>\n<ul>";
      foreach ( $terms as $term ) {
        $out[] =
          '  <li><a href="'
        .    get_term_link( $term->slug, $taxonomy_slug ) .'">'
        .    $term->name
        . "</a></li>\n";
      }
      $out[] = "</ul>\n";
    }
  }

  return implode('', $out );
}


add_filter( 'template_include', 'var_template_include', 1000 );
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_theme_template'];
    else
        return $GLOBALS['current_theme_template'];
}

function get_the_post_thumbnail_src($img)
{
  return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}

function imageCreateFromAny($filepath) { 
    $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize() 
    $allowedTypes = array( 
        1,  // [] gif 
        2,  // [] jpg 
        3,  // [] png 
        6   // [] bmp 
    ); 
    if (!in_array($type, $allowedTypes)) { 
        return false; 
    } 
    switch ($type) { 
        case 1 : 
            $im = imageCreateFromGif($filepath); 
        break; 
        case 2 : 
            $im = imageCreateFromJpeg($filepath); 
        break; 
        case 3 : 
            $im = imageCreateFromPng($filepath); 
        break; 
        case 6 : 
            $im = imageCreateFromBmp($filepath); 
        break; 
    }    
    return $im;  
} 
 
function colorize($image, $color) {

  if (extension_loaded('gd') && function_exists('gd_info')) {
    // statt "$image_path" hier den von WP benannten
    // filepath verwenden
     
    $image_path = $image;
     
    $path_info = pathinfo($image_path);
     
    $modified_image_dir = get_site_url()."/wp-content/uploads/orangize/";
    $modified_image_path = $modified_image_dir . basename($image_path);

    
     
    if (!file_exists("./wp-content/uploads/orangize/".basename($image_path))) {
     
      // Werte tweaken für optimale Einstellungen:
      $contrast_level = 0.5;
      $grayscale_level = 0.5;
      $fill_color = array(45,40,42);
      $fill_alpha = 0.2;
      //get opposite color
        $opposite = array(255 - $color[0], 255 - $color[1], 255 - $color[2]);

      $img = imageCreateFromAny($image_path);
      

      
      imagefilter($img, IMG_FILTER_GRAYSCALE, intval($grayscale_level * 100));
      imagefilter($img, IMG_FILTER_CONTRAST, intval($contrast_level * 0));

      imagefilter($img, IMG_FILTER_COLORIZE, -$opposite[0], -$opposite[1], -$opposite[2]);
      imagefilter($img, IMG_FILTER_COLORIZE, $fill_color[0], $fill_color[1], $fill_color[2], intval($fill_alpha * 255));
      
     
      //header('Content-Type: image/jpeg');
      //imagejpeg($img, $modified_image_path, 100);
      imagejpeg($img, "./wp-content/uploads/orangize/".basename($image_path), 80);
      imagedestroy($img);
    }


     
    $image_path = $modified_image_path;

    return $image_path;

    

  } else {
    echo "PHP GD library is NOT installed on your web server";
  }

  //die ("Error" . " File: " . __FILE__ . " on line: " . __LINE__);
}



function list_posts_by_taxterm(  $atts  ){

            extract( shortcode_atts( array(
                'post_type' => $post_type,
                'taxonomy' => $taxonomy,
                'tax_term' => $tax_term
            ), $atts ) );

        
            $query_args = array(
                'post_type' => $post_type,
                "$taxonomy" => $tax_term,
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'ignore_sticky_posts' => true
            );
            
            $my_query = new WP_Query( $query_args ); ?>

            <ul class="tax-items">
            <?php
  if($my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); 
  ?>
          
          <li class="item-term  

    <?php echo $tax_term->slug; ?>
        country-<?php echo get_post_meta(get_the_ID(), "wpcf-land",true) ?> 
        y<?php echo get_post_meta(get_the_ID(), "wpcf-jahr",true) ?> 
        <?php echo clean(get_post_meta(get_the_ID(), "wpcf-hochschule",true)) ?> ">
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">

            <div class='item-title'>
              <?php the_title() ?>
            </div>
           
         

            </a>
        </li>

  <?php 
  endwhile; endif;?>
  </ul>
  <?php wp_reset_query();
}
add_shortcode('listpostsbytaxterm','list_posts_by_taxterm');


add_shortcode('listpostsbytaxonomy','list_posts_by_taxonomy');
// http://gilbert.pellegrom.me/wordpress-list-posts-by-taxonomy/
function list_posts_by_taxonomy( $post_type, $taxonomy, $get_terms_args = array(), $wp_query_args = array() ){
    $tax_terms = get_terms( $taxonomy, $get_terms_args );
    if( $tax_terms ){
        foreach( $tax_terms  as $tax_term ){
            $query_args = array(
                'post_type' => $post_type,
                "$taxonomy" => $tax_term->slug,
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'ignore_sticky_posts' => true
            );
            $query_args = wp_parse_args( $wp_query_args, $query_args );

            $my_query = new WP_Query( $query_args );
            if( $my_query->have_posts() ) { ?>
                <!-- <h2 id="<?php echo $tax_term->slug; ?>" class="tax_term-heading"><?php echo $tax_term->name; ?></h2> -->
                
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                 

                	<div class="item  

		<?php echo $tax_term->slug; ?>
        country-<?php echo get_post_meta(get_the_ID(), "wpcf-land",true) ?> 
        y<?php echo get_post_meta(get_the_ID(), "wpcf-jahr",true) ?> 
        <?php echo clean(get_post_meta(get_the_ID(), "wpcf-hochschule",true)) ?> ">

<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">

            <div class='item-info'>
              <h2><?php the_title() ?></h2>

            </div>

            <div class="item-image">
            <div class="thumb">
              <?php echo get_the_post_thumbnail(get_the_ID(), 'quad_400px'); ?>
              </div>

            <div class="item-specs">
              
              <span class="author"><?php echo get_post_meta(get_the_ID(), "wpcf-verantwortliche",true) ?></span>
              <span class="university"><?php echo get_post_meta(get_the_ID(), "wpcf-hochschule",true) ?></span>
              <span class="release-infos"><span class="country"><?php echo get_post_meta(get_the_ID(), "wpcf-land",true) ?></span>—<span class="year"><?php echo get_post_meta(get_the_ID(), "wpcf-jahr",true) ?></span>, <span class="duration"><?php echo get_post_meta(get_the_ID(), "wpcf-laufzeit",true) ?></span>
            </span>
            </div>
           </div>
            
            <div class="item-details">
                <?php the_content() ?>
              </div>

          
            </a>
            
        </div>


                <?php endwhile; ?>
               
                <?php
            }
            wp_reset_query();
        }
    }
}

// http://gilbert.pellegrom.me/wordpress-list-posts-by-taxonomy/
function list_events_by_taxonomy( $post_type, $taxonomy, $get_terms_args = array(), $wp_query_args = array() ){
    $tax_terms = get_terms( $taxonomy, $get_terms_args );
    if( $tax_terms ){
        foreach( $tax_terms  as $tax_term ){
            $query_args = array(
                'post_type' => $post_type,
                "$taxonomy" => $tax_term->slug,
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'ignore_sticky_posts' => true,
                'orderby' => 'meta_value',
                'meta_key' => 'wpcf-zeit-beginn',
                'order' => 'ASC'
            );
            $query_args = wp_parse_args( $wp_query_args, $query_args );

            $my_query = new WP_Query( $query_args );

              

            if( $my_query->have_posts() ) { ?>
                

        

                <div class="day <?php echo clean($tax_term->name) ?>">
                <!-- <h1  class="tax_term-heading "><?php echo $tax_term->name; ?></h1> -->

                
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>

                 
                  <div class="item  

    <?php echo $tax_term->slug; ?>
        begin-<?php echo clean(get_post_meta(get_the_ID(), "wpcf-zeit-beginn",true)) ?> 
        end-<?php echo clean(get_post_meta(get_the_ID(), "wpcf-zeit-ende",true)) ?> 
        ">


            <div class='item-info'>
       
       <?php

          $pprRedUrl = get_post_meta(get_the_ID(), '_pprredirect_url', true);
          $pprActive = get_post_meta(get_the_ID(), '_pprredirect_active',true);

       ?>
              


<?php // check for plugin using plugin name
if($pprActive == '1' && $pprRedUrl != ''){ ?>
  <h2><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
<?php } else {  ?>
  <h2 rel="<?php the_permalink(); ?>"><?php the_title() ?></h2>
<?php } ?>
              
              <div class="loading"></div>
              <div class="item-details">
                <div class="your_post_here">
                <?php // the_content() ?>
                </div>
              </div>
              <span class="time">
              <?php echo get_post_meta(get_the_ID(), "wpcf-zeit-beginn",true) ?> &rsaquo;
              <?php echo get_post_meta(get_the_ID(), "wpcf-zeit-ende",true) ?>
              </span>
              <span class="location">
                <?php 
                  $terms = wp_get_post_terms( get_the_ID(), 'location' , array('fields' => 'all') ); 
                  echo $terms[0]->name
                ?>
              </span>
            </div>
           
            <div class="item-image"><?php echo get_the_post_thumbnail(get_the_ID(), 'medium'); ?></div>
            
              
              
            
        </div>


                <?php endwhile; ?>
                </div>
               
                <?php
            }
            wp_reset_query();
        }
    }
}

// Add support for Jetpack Infinite Scroll
/*
add_theme_support( 'infinite-scroll', array(
  'container'  => 'index',
) );

function infinite_scroll_init() {
    add_theme_support( 'infinite-scroll', array(
        'type' => 'scroll',
        'footer_widgets' => false,
        'container' => 'index',
        'wrapper' => false,
        'render'    => 'backup_infinite_scroll_render',
        'posts_per_page' => false
    ) );
}
add_action( 'init', 'infinite_scroll_init' );

function backup_infinite_scroll_render() {
    get_template_part( 'content', get_post_format() );
}
*/


function new_excerpt_more( $more ) {
  return ' …';
}
add_filter('excerpt_more', 'new_excerpt_more');


add_action( 'after_setup_theme', 'backup_setup' );
function backup_setup()
{
	load_theme_textdomain( 'backup', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 640;
	register_nav_menus(
		array( 'primary' =>  'hauptmenu' )
	);
}

add_action('after_setup_theme', 'backup_load_scripts');
function backup_load_scripts()
{
	if ( !is_admin() ) {
	$myurl = get_template_directory_uri() . '/js/';
  wp_enqueue_script('jquery','','','',false);
	//wp_enqueue_script('jquery-url',"{$myurl}jquery.getUrlParam.js",array('jquery'),'',true);
  wp_enqueue_script('imagesloaded',"http://imagesloaded.desandro.com/imagesloaded.pkgd.min.js",'','',true);
  wp_enqueue_script('infinitescroll',"{$myurl}jquery.infinitescroll.min.js",'','',true);
	wp_enqueue_script('inf_scroll_manual',"{$myurl}manual-trigger.js",'','',true);
  wp_enqueue_script('isotope',"http://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.0/isotope.pkgd.min.js",'','',true);
	
  wp_enqueue_script('tweenMax','//cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js','','',true);
  wp_enqueue_script('datGui','http://dat-gui.googlecode.com/git/build/dat.gui.min.js','','',true);
	wp_enqueue_script('background_animation',"{$myurl}background.animation.js",'','',true);
  wp_enqueue_script('responsive-nav',"{$myurl}responsive-nav.min.js",'','',false);

	wp_enqueue_script('main',"{$myurl}main.min.js",'','',true);
	
	}
}

function my_post_queries( $query ) {
  if(is_tax()){
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', 50);
    }
  }
add_action( 'pre_get_posts', 'my_post_queries' );

function exclude_press_from_news( $query ) {
  if(is_home()){
      // show 50 posts on custom taxonomy pages
      $excluded = array( '-1099','199' );
      set_query_var( 'category__not_in', $excluded );
    }
  }
add_action( 'pre_get_posts', 'exclude_press_from_news' );


add_action( 'comment_form_before', 'backup_enqueue_comment_reply_script' );
function backup_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}


add_filter( 'the_title', 'backup_title' );
function backup_title( $title ) {
if ( $title == '' ) {
    return '&rarr;';
  } else {
    return $title;
  }
}

/*
add_filter( 'wp_title', 'backup_filter_wp_title' );
function backup_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
*/


add_action( 'widgets_init', 'backup_widgets_init' );
function backup_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'backup' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}


function backup_custom_pings( $comment )
{
	$GLOBALS['comment'] = $comment;
	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
	
	<?php 
	}


	add_filter( 'get_comments_number', 'backup_comments_number' );
	function backup_comments_number( $count )
	{
		if ( !is_admin() ) {
			global $id;
			$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
			return count( $comments_by_type['comment'] );
		} else {
			return $count;
		}
}

/*
 *  Anfügen des Blognamens an alle Seitentitel
 */
add_filter('wp_title', 'bauhausfm_filter_wp_title');
function bauhausfm_filter_wp_title($title)
{
  return $title . esc_attr(get_bloginfo('name'));
}

/*
 *  Angepasste Ausgabe von Pingbacks
 */
function bauhausfm_custom_pings($comment)
{
  $GLOBALS['comment'] = $comment;
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
  <?php 
}

/*
 *  Ausgabe von Kommentarzahlen 
 */
add_filter('get_comments_number', 'bauhausfm_comments_number');
function bauhausfm_comments_number($count)
{
  if (!is_admin()) {
    global $id;
    $comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
    return count($comments_by_type['comment']);
  } else {
    return $count;
  }
}

/*
 *  Angepasste Kommentarausgabe
 */
function backup_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }
?>
    <<?php echo $tag ?> 
    <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
      <div id="div-comment-<?php comment_ID() ?>" class="comment-body column-row clearfix">
    <?php endif; ?>
    <div class="comment-author vcard column two">
      <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    </div>
<?php if ($comment->comment_approved == '0') : ?>
    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
    <br />
<?php endif; ?>

    <div class="column ctext">
        
        <div class="comment-meta">
    <strong><?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?></strong> / 
        
        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
      <?php
        /* translators: 1: date, 2: time */
        printf( __('%1$s'), get_comment_date()) ?></a> /
         <span class="reply">
    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </span>  
        <?php edit_comment_link(__('Edit'),' / ','' );
      ?>
        </div>
          
    <?php comment_text() ?>
        </div>
        

    
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php
        }

?>
<?php # -*- coding: utf-8 -*-
/**
 * Plugin Name: T5 Comment Textarea On Top
 * Description: Makes the textarea the first field of the comment form.
 * Version:     2012.04.30
 * Author:      Thomas Scholz <info@toscho.de>
 * Author URI:  http://toscho.de
 * License:     MIT
 * License URI: http://www.opensource.org/licenses/mit-license.php
 */

// We use just one function for both jobs.
add_filter( 'comment_form_defaults', 't5_move_textarea' );
add_action( 'comment_form_top', 't5_move_textarea' );

/**
 * Take the textarea code out of the default fields and print it on top.
 *
 * @param  array $input Default fields if called as filter
 * @return string|void
 */
function t5_move_textarea( $input = array () )
{
    static $textarea = '';

    if ( 'comment_form_defaults' === current_filter() )
    {
        // Copy the field to our internal variable …
        $textarea = $input['comment_field'];
        // … and remove it from the defaults array.
        $input['comment_field'] = '';
        return $input;
    }

    print apply_filters( 'comment_form_field_comment', $textarea );
}

function bdw_get_images() {
 
    // Get the post ID
    $iPostID = $post->ID;
 
    // Get images for this post
    $arrImages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $iPostID );
 
    // If images exist for this page
    if($arrImages) {
 
        // Get array keys representing attached image numbers
        $arrKeys = array_keys($arrImages);
 
        /******BEGIN BUBBLE SORT BY MENU ORDER************
        // Put all image objects into new array with standard numeric keys (new array only needed while we sort the keys)
        foreach($arrImages as $oImage) {
            $arrNewImages[] = $oImage;
        }
 
        // Bubble sort image object array by menu_order TODO: Turn this into std "sort-by" function in functions.php
        for($i = 0; $i < sizeof($arrNewImages) - 1; $i++) {
            for($j = 0; $j < sizeof($arrNewImages) - 1; $j++) {
                if((int)$arrNewImages[$j]->menu_order > (int)$arrNewImages[$j + 1]->menu_order) {
                    $oTemp = $arrNewImages[$j];
                    $arrNewImages[$j] = $arrNewImages[$j + 1];
                    $arrNewImages[$j + 1] = $oTemp;
                }
            }
        }
 
        // Reset arrKeys array
        $arrKeys = array();
 
        // Replace arrKeys with newly sorted object ids
        foreach($arrNewImages as $oNewImage) {
            $arrKeys[] = $oNewImage->ID;
        }
        ******END BUBBLE SORT BY MENU ORDER**************/
 
        // Get the first image attachment
        $iNum = $arrKeys[0];
 
        // Get the thumbnail url for the attachment
        $sThumbUrl = wp_get_attachment_thumb_url($iNum);
 
        // UNCOMMENT THIS IF YOU WANT THE FULL SIZE IMAGE INSTEAD OF THE THUMBNAIL
        //$sImageUrl = wp_get_attachment_url($iNum);
 
        // Build the <img> string
        $sImgString = '<a href="' . get_permalink() . '">' .
                            '<img src="' . $sThumbUrl . '" width="150" height="150" alt="Thumbnail Image" title="Thumbnail Image" />' .
                        '</a>';
 
        // Print the image
        echo $sImgString;
    }
}

