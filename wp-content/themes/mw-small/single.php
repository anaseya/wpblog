<?php
/**
 * @package mwsmall
 */

 get_header();?>

<section id="primary" class="container content-area  col-lg-9 col-md-9 col-sm-8">

		<main id="main" class="site-main" role="main">
		
		<?php while ( have_posts()) : the_post(); 
		
			get_template_part( 'content', 'single' ); 
		
		?>
		
		<nav class="navigation post-navigation" role="navigation">
		<?php

			previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav"><i class="fa fa-angle-double-left"></i></span> %title' );
			next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav"><i class="fa fa-angle-double-right"></i></span>' ); 
		
		?>
		</nav>
	
		<?php comments_template('', true); ?>
		
		<?php endwhile; ?>
		
		</main><!-- #main -->
	
</section><!--/.primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>