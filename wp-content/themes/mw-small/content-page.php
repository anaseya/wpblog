<?php
/**
 * @package mwsmall
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php
		the_content();
		wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'mwsmall' ), 'after' => '</div>' ) ); ?>
		<div class="clear"></div>
		<?php edit_post_link( __( 'Edit', 'mwsmall' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->