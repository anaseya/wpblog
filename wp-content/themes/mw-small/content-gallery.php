<?php
/**
 * @package mwsmall
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header post-gallery">

		<div class="flexslider">
		<?php 
		$args = array(
			'post_parent' => $post->ID,
			'post_type' => 'attachment',
			'orderby' => 'menu_order', // you can also sort images by date or be name
			'order' => 'ASC',
			'numberposts' => -1, // number of images (slides)
			'post_mime_type' => 'image',
			'post_status'    => null,
		);

		if ( $images = get_children( $args ) ) {
			// if there are no images in post, don't display anything
			echo '<ul class="slides">';

					foreach( $images as $image ) {
						echo '<li>';
						echo wp_get_attachment_image( $image->ID, 'blog_img' );
						echo '</li>';
					}
					
			echo '</ul>'; 
		} ?>

		</div>
 
		<div class="mw_title">
			<div class="entry-time">				
				<?php if ( ('j M Y') == get_option( 'date_format' ) ) : ?>
					<span class="day"><?php echo get_the_date('j'); ?></span>
					<span class="month"><?php echo get_the_date('M'); ?></span> /
					<span class="year"><?php echo get_the_date('Y'); ?></span>
				<?php else : ?>
					<span class="mw-date-format"><?php echo get_the_date(); ?></span>
				<?php endif; ?>		
			</div>
			<h1 class="entry-title col-lg-8 col-sm-6 col-xs-7"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php mwsmall_post_icon(); ?>
			<?php if( is_sticky() ) { ?> <span class="sticky-post"><i class="fa fa-star-o fa-2x"></i></span> <?php } ?>

		</div><!-- .entry-title -->

	</header><!-- .entry-header -->
	
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary clearfix">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content clearfix">
		<?php the_content( __( '[...]', 'mwsmall' ) );	?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<span class="author-link fa fa-user"></span><?php the_author_posts_link() ?>
		<span class="cat-link fa  fa-folder-open"></span><?php the_category(', '); ?>
		<?php the_tags( '<span class="tag-link fa fa-tags"></span>', ', ', '' ); ?>
		<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
		<span class="comments-link fa fa-comments"></span><?php comments_popup_link('0', '1', '%', 'comments-link', ''); ?>
		<?php endif; ?>
		<a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e( 'Read more', 'mwsmall' ); ?><span> &rarr;</span></a>
	</footer><!-- #entry-meta -->
	
	
</article><!-- #post-## -->