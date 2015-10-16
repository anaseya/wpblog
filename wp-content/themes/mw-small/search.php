<?php
/**
 * @package mwsmall
 */

get_header(); ?>
 
<section id="primary" class="container content-area col-lg-9 col-md-9 col-sm-8">
	<div id="content" class="site-content" role="main">
		
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'mwsmall' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			</header><!-- .page-header -->
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