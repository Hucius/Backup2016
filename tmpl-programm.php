<?php
/**
*
* Template Name: tmpl_Programm
* Description: Programm
*
*
**/
?>
<?php get_header(); ?>

<div class="events-wrapper" role="main">
	
	<div class="events">
		<div class="days">

			<?php
			$catArgs = array('taxonomy'=>'datum');
			$categories = get_categories('taxonomy=datum&post_type=event');
			$days = array("Mi","Do","Fr","Sa","So");
			$i = 0;
			?>
			<?php foreach ($categories as $category) : ?>
				<div class="days-list" >
					<a href="#" data-day="<?php echo clean($category->name); ?>">
						<?php 
						echo $days[$i]." ";
						$i++;
						$zeichenkette = $category->name;
						$suchmuster = '/(\d+)\. (\w+)/';
						$ersetzung = '<span class="number">${1}.</span><span class="month">$2</span>';
						echo preg_replace($suchmuster, $ersetzung, $zeichenkette);
						?>
					</a>
				</div>
			<?php endforeach; ?>
			<?php wp_reset_query();
			?>
		</div>


		<?php ?>
  <?php //look into the functions.php to customize this output
  list_events_by_taxonomy( 'event', 'datum' ); ?>
</div>

</div>

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
