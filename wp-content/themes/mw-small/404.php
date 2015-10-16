<?php
/**
 * @package mwsmall
 */

 get_header(); ?>

<section class="error404 not-found content-area col-lg-9 col-md-8 col-sm-9">

	<header class="page-header">
		<h2 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'mwsmall' ); ?></h2>
	</header><!-- .entry-header -->
	
	<div class="entry-content clearfix">

		<p class="sub-info"><?php _e( 'It looks like nothing was found at this location. Maybe try our search?', 'mwsmall' ); ?></p>
		<?php get_search_form(); ?>

	</div><!-- .entry-content -->	
	
</section><!-- .error404 -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>