<?php
/**
 * @package mwsmall
 */

get_header(); ?>
 
<section id="primary" class="container content-area col-lg-9 col-md-9 col-sm-8">
	<div id="content" class="site-content" role="main">
		
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h2 class="page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'mwsmall' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'mwsmall' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'mwsmall' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'mwsmall' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'mwsmall' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'mwsmall' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'mwsmall');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'mwsmall');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'mwsmall' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'mwsmall' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'mwsmall' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'mwsmall' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'mwsmall' );

						else :
							_e( 'Archives', 'mwsmall' );

						endif;
					?>
				</h2>
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