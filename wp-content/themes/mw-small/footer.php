<?php
/**
 * @package mwsmall
 */

?>		
		</div><!-- #content -->
	</div><!-- .container -->
<!--footer-->
		<footer id="colophon" role="contentinfo">

			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4">	
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 1') ) : ?>
						<?php endif; ?>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4">	
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 2') ) : ?>
						<?php endif; ?>
					</div>	
					<div class="col-lg-4 col-md-4 col-sm-4">	
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 3') ) : ?>
						<?php endif; ?>		
					</div>
				</div>
			</div>
			<div class="footer_info">
				<div class="container">
					<div class="row">
						<div class="f_left col-lg-6 col-md-6 col-sm-6">
							<?php _e('Copyright', 'mwsmall'); ?> &copy; <?php echo date("Y") ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>. <?php $txtfoo = get_theme_mod( 'mwsmall_text_footer' ); ?><?php if( $txtfoo != '') { echo esc_html( $txtfoo ); } else { _e('All Rights Reserved.', 'mwsmall'); } ?>
						</div>
						<div class="f_right col-lg-6 col-md-6 col-sm-6">
							<?php _e( 'Proudly powered by', 'mwsmall' ); ?> <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'mwsmall' ) ); ?>" rel="generator" target="_blank">WordPress</a> 
							<?php _e( 'Theme by', 'mwsmall' ); ?> <a target="_blank" href="<?php echo esc_url( __( 'http://www.mwthemes.net', 'mwsmall' ) ); ?>">MW Themes</a>
						</div>
					</div>
				</div>
			</div>

		</footer>
<!--//footer-->
</div><!-- #page -->

<?php wp_footer();?>
 
</body>
</html>