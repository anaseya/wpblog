<?php
/**
 * @package mwsmall
 */
?>

<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<input type="text" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'mwsmall' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<button class="searchsubmit" type="submit"><?php _e( '<i class="fa fa-search"></i>', 'mwsmall'); ?></button>	
</form>