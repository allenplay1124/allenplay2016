<?php get_header(); ?>
<?php $_obj_post = get_post(); ?>
<div class="page-info">
	<div class="container">
		<h1><?php echo $_obj_post->post_title ?></h1>
	</div>
</div>

<div class="container">
<div class="content">
	<div class="article col-sm-9">
		<?php breadcrumb_init(); ?>
		<article class="single-content">
				<div class="article-meta">
					<i class="glyphicon glyphicon-time"></i>&nbsp;<?php echo DATE('Y-m-d H:i', strtotime($_obj_post->post_date)) ?>&nbsp;
					<i class="glyphicon glyphicon-user"></i>&nbsp;
					<a href="<?php echo get_the_author_meta('url', $_obj_post->post_author)?>"><?php echo get_the_author_meta('display_name', $_obj_post->post_author)?></a>&nbsp;
					<div class="post-content">
					<?php echo nl2br($_obj_post->post_content)?>
					</div>
				</div>
		</article>
			
		
	</div>
	<div class="sidebar col-sm-3">
	<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
