<?php get_header(); ?>
<?php get_slider()?>

<?php
	$_arr_uri = explode('/', $_SERVER['REQUEST_URI']);
	if(isset($_GET['paged']) && $_GET['paged'] != '')
		$args['offset'] = ((int)$_GET['paged'] - 1) * 6;
	else if($_arr_uri[1] == 'page')
		$args['offset'] = ((int)$_arr_uri[2] - 1) * 6;
	else
		$args['offset'] = 0;

	$args['posts_per_page'] = 6;
?>
<?php $_arr_data = get_posts($args);?>
<div class="container container_bg">
    <div class="content">

    </div>
				<div class="clearfix"></div>
				<?php wp_pagenavi(); ?>
</div>





<?php get_footer(); ?>

<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
</script>
