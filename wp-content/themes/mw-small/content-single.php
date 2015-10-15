<?php
/**
 * @package mwsmall
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		if ( get_post_format() == 'video' ){ 
			$class_single = 'post-video';
		} else if ( get_post_format() == 'audio' ){ 
			$class_single = 'post-audio';
		} else if ( get_post_format() == 'gallery' ){ 
			$class_single = 'post-gallery';
		} else {
			$class_single = 'mw_single';
		}
	?>
	<header class="entry-header <?php echo $class_single; ?>">
		
		<?php if ( get_post_format() == 'gallery' ) {
			?>
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
		<?php } else if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<?php the_post_thumbnail('blog_img'); ?>
		<?php endif; ?>

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
			<h1 class="entry-title col-lg-8 col-sm-6 col-xs-7"><?php the_title(); ?></h1>
			<?php mwsmall_post_icon(); ?>

		</div><!-- .entry-title -->

	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php
		the_content( __( '[...]', 'mwsmall' ) );
		wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'mwsmall' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	
	<footer class="entry-meta">
		<span class="author-link fa fa-user"></span><?php the_author_posts_link() ?>
		<span class="cat-link fa  fa-folder-open"></span><?php the_category(', '); ?>
		<?php the_tags( '<span class="tag-link fa fa-tags"></span>', ', ', '' ); ?>
	</footer><!-- #entry-meta -->

</article><!-- #post-## -->