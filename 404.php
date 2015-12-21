<?php get_header(); ?>
<?php show_slider()?>
<div class="container">
<div class="content">
		<div class="article col-sm-9">
				<h1>404 找不到網頁</h1>
			<p>
				抱歉，找不到您所要的頁面，或許已經移除、暫時關閉或發生錯誤。
			</p>
			<p>
				您可經由<a href="<?php bloginfo('url');?>" title="回到首頁">回到首頁</a>或以下分類及時間找到您所要的內容，或以下搜尋框：
			</p>
			<?php get_search_form(); ?>
			<h2>依分類查詢</h2>
			<ul class="errorlist">
				<?php wp_list_categories('orderby=ID&show_count=1&use_desc_for_title=0&title_li=&style=list');?>
			</ul>
		</article>

			
		</div>

	
	<div class="sidebar col-sm-3">
	<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>

<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
</script>
