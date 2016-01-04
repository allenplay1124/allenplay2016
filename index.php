<?php get_header(); ?>
<?php get_slider()?>
<?php
$args = array(
	'posts_per_page'   => 5,
	'offset'           => 0,
	'category'         => array(7,14,35),
	'category_name'    => '',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'post',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	       => '',
	'post_status'      => 'publish',
	'suppress_filters' => true
);
$posts_array = get_posts( $args );
echo_array($posts_array);
?>
<?php get_footer(); ?>

<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
</script>
