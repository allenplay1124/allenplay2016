<?php get_header(); ?>

<?php 
	if(isset($_GET['paged']) && $_GET['paged'] != '')
		$args['offset'] = (int)$_GET['paged'] * 5;
	else
		$args['offset'] = (int)$_GET['paged'] * 5;
			
	$args['posts_per_page'] = 6;
			
	$_str_archive_name = '';
			
	if(isset($_GET['cat']) && $_GET['cat'] != '')
	{
		$args['category'] = $_GET['cat'];
		$_obj_cat = get_category($_GET['cat']);
		$_str_archive_name = $_obj_cat->name;
	}
				
			
	if(isset($_GET['tag']) && $_GET['tag'] != '')
	{
		$args['tag'] = $_GET['tag'];
		$_str_archive_name = $_GET['tag'];
	}
	
	if($_str_archive_name == '')
	{
		$_arr_uri = explode('/', $_SERVER['REQUEST_URI']);
		
		if($_arr_uri[1] == 'tag')
		{
			$args['tag'] = $_arr_uri[2];
			$_str_archive_name = $_arr_uri[2];
		}
		if($_arr_uri[1] == 'category')
		{
			$_int_cate_id = get_cat_ID(urldecode($_arr_uri[2]));
			$args['category'] = $_int_cate_id;
 
			$_str_archive_name = urldecode($_arr_uri[2]);
		}
	}

?>
<div class="page-info">
	<div class="container">
		<h1>【<?php echo $_str_archive_name?>】 相關文章：</h1>
	</div>
</div>
<div class="container">
<?php $_arr_data = get_posts($args);?>

<div class="content">
		<div class="article col-sm-9">、
			<?php breadcrumb_init(); ?>
		<div class="post-container">
				<?php foreach($_arr_data as $key => $val){?>
				<article class="article-content img-thumbnail">
					<div class="article-post">
					<h3 class="article-title"><a href="<?php echo wp_get_shortlink($val->ID); ?>"><?php echo $val->post_title; ?></a></h3>
					<div class="article-meta">
						<span><i class="glyphicon glyphicon-time"></i>&nbsp;<?php echo DATE('Y-m-d', strtotime($val->post_date)) ?> &nbsp;</span>
						<span><i class="glyphicon glyphicon-user"></i>&nbsp;<a href="<?php echo get_the_author_meta('url', $val->post_author)?>"><?php echo get_the_author_meta('display_name', $val->post_author)?></a>&nbsp;</span>
						<span><i class="glyphicon glyphicon-comment"></i>&nbsp;
						<?php
							$_arr_comment = get_comment_count($val->ID);
							echo $_arr_comment['approved'];
							// echo_array(get_comment_count($val->ID));
						?>
						</span>
					</div>
						
						<?php if(has_post_thumbnail($val->ID)){?>
							<a href="<?php echo wp_get_shortlink($val->ID);  ?>">
							<div class="article-cover"><img class="img-rounded" src="<?php echo get_img_url($val->ID, array(360,180))?>" width="360"></div>
							</a>
						<?php }?>
						<?php echo mb_substr(strip_tags($val->post_content) , 0, 120, 'utf-8');?>
						</div>
						<div>
						<span><i class="glyphicon glyphicon-bookmark"></i>&nbsp;
							<?php 
								$_arr_cate = get_the_category($val->ID);
								foreach($_arr_cate as $val2)
								{
									echo '<a class="label label-warning" href="'.esc_url(get_category_link($val2->cat_ID)).'">'. $val2->name . '</a> &nbsp;' ;
								}
							?>										
						</span>
						
						<div class="post-tags"><i class="glyphicon glyphicon-tags"></i>&nbsp;
							<?php 
								$_arr_tag = wp_get_post_tags($val->ID);
								foreach($_arr_tag as $val2 )
								{
									echo '<a class="label label-info" href="'.get_tag_link($val2->term_id).'">'.$val2->name.'</a>&nbsp;';
								}
								
							?>
						</div>
						</div>
						<div class="more"><a class="btn btn-primary btn-more" href="<?php echo wp_get_shortlink($val->ID); ?>"><i class="glyphicon glyphicon-eye-open"></i> 完整閱讀</a></div>
				</article>
			  <?php }?>
				</div>
				<div class="clearfix"></div>
			
		</div>

	
	<div class="sidebar col-sm-3">
	<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>