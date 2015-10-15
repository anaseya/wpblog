<?php 
/** index.php
 *
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mwsmall
 */
 
 get_header(); ?>
<?php 
	$home_text = get_theme_mod( 'mwsmall_home_text' );
	$htitle = get_theme_mod( 'mwsmall_home_title' );
	if ( !empty( $home_text ) ) { 
?>
<section class="home_text text-center col-lg-12 col-md-12 col-sm-12">
	<?php if ( !empty( $htitle ) ) { ?>
	<h2><?php echo get_theme_mod( 'mwsmall_home_title' ); ?></h2>
	<?php } ?>
	<p><?php echo get_theme_mod( 'mwsmall_home_text' ); ?></p>
</section>
<?php } ?>
<section id="primary" class="container content-area col-lg-9 col-md-9 col-sm-8">
	<div id="content" class="site-content" role="main">
		
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php get_template_part( 'content', get_post_format() ); ?>
				
			<?php endwhile; ?>
			
			<?php mwsmall_pagination_nav(); ?>
			
		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>
				
		<?php endif; ?>
  
    </div><!--/#content -->

</section><!--/.primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>