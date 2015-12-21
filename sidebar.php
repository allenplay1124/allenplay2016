<aside id="sidebar">
	<div class="search">
		<form method="get" action="<?php echo home_url( '/' ); ?>">
			<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
			<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
		</form>
	</div>
	<?php dynamic_sidebar('sidebar'); ?>
</aside>	
