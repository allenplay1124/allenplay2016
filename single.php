<?php get_header(); ?>
<?php $_obj_post = get_post(); ?>

<?php 
	$_arr_content = explode('<!--nextpage-->', $_obj_post->post_content);
	$_int_count_page = count($_arr_content);	
	$_arr_uri = explode('/', $_SERVER['REQUEST_URI']);
	if($_int_count_page > 1)
	{
		if(isset($_GET['page']) && $_GET['page'] != '')
			$page == $_GET['page'];
		else if(isset($_arr_uri[2]) && $_arr_uri[2] != '')
			$page == $_arr_url[2];
		else
			$page == 1;
	}

	the_post();
?>

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
					<i class="glyphicon glyphicon-bookmark"></i>&nbsp;
					<?php 
						$_arr_cate = get_the_category($_obj_post->ID);
						foreach($_arr_cate as $val2)
						{
							echo '<a class="label label-warning" href="'.esc_url(get_category_link($val2->cat_ID)).'">'. $val2->name . '</a> &nbsp;' ;
						}
					?>
					<i class="glyphicon glyphicon-tags"></i>&nbsp;
					<?php 
						$_arr_tag = wp_get_post_tags($_obj_post->ID);
						foreach($_arr_tag as $val2 )
						{
							echo '<a class="label label-info" href="'.get_tag_link($val2->term_id).'">'.$val2->name.'</a>&nbsp;';
						}
					?>
					<div class="post-content">
					<?php the_content()?>
					</div>
					<?php if($_int_count_page > 1){?>
						<nav>
							<ul class="pagination">
								<?php for($i = 1; $i <= $_int_count_page; $i++){?>
									<li <?php if($page == $i){?>class="active"<?php }?>><a href="<?php echo wp_get_shortlink() ?>&page=<?php echo $i ?>"><?php echo $i?></a></li>
								<?php }?>
							</ul>
						</nav>
					<?php }?>
				</div>
				<div class="author">
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'ID' ));?>
					</div>
					<div class="author-info">
						<h4><?php get_the_author() ?></h4>
						<?php the_author_meta( 'description' ); ?>
						<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">瀏覽全部文章 <?php get_the_author(); ?> <span class="meta-nav">&rarr;</span></a>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class="comments">
				<?php comments_template( 'comments.php' );?>
				</div>
		</article>
			
		
	</div>
	<div class="sidebar col-sm-3">
	<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>