<?php
/**
 * @package mwsmall
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header post-quote <?php if ( ! has_post_thumbnail()){ ?>no-image <?php } ?>">
	
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
				<?php the_post_thumbnail('blog_img'); ?>
			<?php endif; ?>
			
		<div class="entry-content post-quote clearfix">
			<?php the_content( __( '[...]', 'mwsmall' ) );	?>
		</div><!-- .entry-content -->
		
		<div class="mw_title">

			<?php mwsmall_post_icon(); ?>
			<?php if( is_sticky() ) { ?> <span class="sticky-post"><i class="fa fa-star-o fa-2x"></i></span> <?php } ?>

		</div><!-- .entry-title -->

	</header><!-- .entry-header -->
	
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary clearfix">
		<?php //the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php endif; ?>
	
</article><!-- #post-## -->