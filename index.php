<?php get_header(); ?>
<section id="index" role="main">

<?php /* Press Releases are excluded from news -> see functions.php exclude_press_from_news() */ ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'content', get_post_format() ); ?>

<?php comments_template(); ?>
<?php endwhile; endif; ?>
</section>
<?php get_template_part( 'nav', 'below' ); ?> 


<?php //get_sidebar(); ?>
<?php get_footer(); ?>