<?php
include_once('theme-options.php');
/**
 * 側邊欄.
 */
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => '側邊欄',
        'id' => 'sidebar',
        'description' => '顯示於每個網頁的右方。',
        'before_widget' => '<section id="%1$s" class="sidebar-right">',
        'after_widget' => '</section>',
        'before_title' => '<h1 class="sidebar-title">',
        'after_title' => '</h1>',
    ));
}
/**
 * Bootstrap 主選單.
 */
require_once 'wp_bootstrap_navwalker.php';

register_nav_menus(
    array(
        'primary-menu' => __('nav'),
    )
);
/**
 * 分頁.
 */
function wp_pagenavi()
{
    global $wp_query;
    $_obj_post_count = wp_count_posts();
    $max = ceil($_obj_post_count->publish / 6);
    if (!$current = get_query_var('paged')) {
        $current = 1;
    }
    $args['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $args['total'] = $max;
    $args['current'] = $current;
    $args['type'] = 'array';
    $args['prev_text'] = '<';
    $args['next_text'] = '>';
    $_arr_pages = paginate_links($args);

    $_str_page = '<nav>';
    $_str_page .= '<ul class="pagination">';
    $_str_page .= '<li class="disabled"><a href="#">共'.$max.'頁</a></li>';
    foreach ($_arr_pages as $key => $val) {
        if (substr($val, 0, 2) == '<s') {
            $_str_page .= '<li class="active">'.$val.'</li>';
        } else {
            $_str_page .= '<li>'.$val.'</li>';
        }
    }
    $_str_page .= '</ul>';
    $_str_page .= '</nav>';
    echo $_str_page;
}

/**
 * 顯示滑動圖.
 */
function get_slider()
{
    //滑動頁數量
    $_int_count_slider = 5;
    //取得文章資料
    $_obj_posts = get_posts(array(
                                    'numberposts' => $_int_count_slider,
                                    'meta_key' => '_thumbnail_id',
                                ));
    //將物件轉陣列
    $_arr_posts = obj_to_array($_obj_posts);

    //取得特色圖網址
    foreach($_arr_posts as $val){
        $val['url_thumb_img'] = wp_get_attachment_url( get_post_thumbnail_id($val['ID']) );
        $_arr_slider_posts[] = $val;
    }

    include_once 'slider.php';

}
function show_slider()
{
    $_int_max_slider = 5;

    //取得所有文章
    $_arr_data = get_posts(array('numberposts' => $_int_max_slider));
    foreach ($_arr_data as $key => $val) {
        $_arr_data[$key] = get_object_vars($val);
    }

    $_str_slider = '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">';
    $_str_slider .= '<ol class="carousel-indicators">';
    for ($i = 0; $i < $_int_max_slider; ++$i) {
        if (has_post_thumbnail($_arr_data[$i]['ID'])) {
            $_str_slider .= '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" ';

            if ($i == 0) {
                $_str_slider .= 'class="active" ></li>';
            } else {
                $_str_slider .= '></li>';
            }
        }
    }
    $_str_slider .= '</ol>';
    $_str_slider .= '<div class="carousel-inner" role="listbox">';
    for ($i = 0; $i < $_int_max_slider; ++$i) {
        if (has_post_thumbnail($_arr_data[$i]['ID'])) {
            if ($i == 0) {
                $_str_slider .= '<div class="item active">';
            } else {
                $_str_slider .= '<div class="item">';
            }

            $_str_slider .= '<a href="'.wp_get_shortlink($_arr_data[$i]['ID']).'">';
            $_str_slider .= '<div class="slider-fill" style="background-image:url(\''.get_img_url($_arr_data[$i]['ID']).'\')"></div>';
            $_str_slider .= '<div class="carousel-caption">';
            $_str_slider .= '<div class="slider-caption">';
            $_str_slider .= '<div class="slider-title">'.$_arr_data[$i]['post_title'].'</div>';
            $_str_slider .= '<div class="slider-content">'.mb_substr(strip_tags($_arr_data[$i]['post_content']), 0, 128, 'utf-8').'...</div>';
            $_str_slider .= '</div>';
            $_str_slider .= '</div>';
            $_str_slider .= '</div>';
            $_str_slider .= '</a>';
        }
    }
    $_str_slider .= '</div>';
    $_str_slider .= '<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">';
    $_str_slider .= '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
    $_str_slider .= '<span class="sr-only">Previous</span>';
    $_str_slider .= '</a>';
    $_str_slider .= '<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">';
    $_str_slider .= '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
    $_str_slider .= '<span class="sr-only">Next</span>';
    $_str_slider .= '</a>';
    $_str_slider .= '</div>';

    echo $_str_slider;
}
/**
 * 取得圖片網址.
 *
 * @param Integer $_int_post_id 文章ID
 * @param Array   $_arr_size    圖檔大小
 */
function get_img_url($_int_post_id = 0, $_arr_size = '')
{
    if ($_arr_size == '') {
        $_arr_size = array(700, 300);
    }

    $_str_img = get_the_post_thumbnail($_int_post_id, $_arr_size);

    preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $_str_img, $_arr_img);

    return $_arr_img[1][0];
}
/**
 * 自動換行.
 *
 * @param String $_str_string 轉換字串
 */
function my_nl2br($_str_sting = '')
{
    $_str_sting = nl2br($_str_sting);
    $_str_sting = preg_replace('!(<pre.*?>)(.*?)</pre>!ise', " stripslashes('$1') .  stripslashes(clean_pre('$2'))  . '</pre>' ", $_str_sting);

    return $_str_sting;
}
/**
 * 麵包屑.
 */
function breadcrumb_init()
{
    global $post;

    $_str_breadcrumb = '<ol class="breadcrumb">';
    $_str_breadcrumb .= '<li><a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a></li>';
    if (is_single()) {
        foreach (get_the_category() as $category) {
            $_str_breadcrumb .= '<li><a href="'.get_category_link($category->term_id).'">'.$category->cat_name.'</a></li>';
        }
    }
    $_str_breadcrumb .= '<li class="active">';
    if (is_category()) {
        $_str_breadcrumb .= single_cat_title('', false);
    } elseif (is_tag()) {
        $_str_breadcrumb .= single_tag_title('', false);
    } elseif (is_day()) {
        $_str_breadcrumb .=    get_the_time(get_option('date_format'));
    } elseif (is_month()) {
        $_str_breadcrumb .=    get_the_time('F, Y');
    } elseif (is_year()) {
        $_str_breadcrumb .= get_the_time('Y');
    } elseif (is_page()) {
        $_str_breadcrumb .=    get_the_title();
    } else {
        $_str_breadcrumb .=    get_the_title();
    }
    $_str_breadcrumb .= '</li>';
    $_str_breadcrumb .= '</ol>';
    echo $_str_breadcrumb;
}
/**
 * 會員介紹.
 */
function add_user_porfile($contactmethods)
{
    $contactmethods['google'] = 'Google+ 個人網址';
    $contactmethods['facebook'] = 'Facebook 個人網址';
    $contactmethods['description_url'] = '個人介紹頁';

    return $contactmethods;
}
add_filter('user_contactmethods', 'add_user_porfile', 10, 1);

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}
/**
 * 取得特徵圖.
 */
function get_feature_image()
{
    global $post, $posts;
    $first_img = '';
    if (has_post_thumbnail()) {
        $first_img = wp_get_attachment_url(get_post_thumbnail_id());
    } else {
        ob_start();
        ob_end_clean();
        $output = preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $post->post_content, $matches);
        $first_img = $matches[1];
    }

    return $first_img;
}
/**
 * facebook meta.
 */
function insert_fb_in_head()
{
    global $post;
    if (is_home()) {
        echo '<meta property="fb:admins" content="管理員的 Facebook 帳號 ID" />';
        echo "\n";
        echo '<meta property="fb:app_id" content="網站 Facebook APP 的 ID" />';
        echo "\n";
        echo '<meta property="og:type" content="website"/>';
        echo "\n";
        echo '<meta property="og:title" content="'.get_bloginfo('name').'"/>';
        echo "\n";
        echo '<meta property="og:description" content="'.get_bloginfo('description').'"/>';
        echo "\n";
        echo '<meta property="og:url" content="'.get_bloginfo('url').'"/>';
        echo "\n";
        echo '<meta property="og:site_name" content="'.get_bloginfo('name').'"/>';
        echo "\n";
        echo '<meta property="og:locale" content="zh_tw">';
        echo "\n";
    }
    if (!is_singular()) {
        return;
    }
    $post_excerpt = ($post->post_excerpt) ? $post->post_excerpt : trim(str_replace("\r\n", ' ', strip_tags($post->post_content)));
    $description = mb_substr($post_excerpt, 0, 160, 'UTF-8');
    $description .= (mb_strlen($post_excerpt, 'UTF-8') > 160) ? '…' : '';
    echo "\n";
    echo '<meta property="fb:admins" content="管理員的 Facebook 帳號 ID" />';
    echo "\n";
    echo '<meta property="fb:app_id" content="網站 Facebook APP 的 ID" />';
    echo "\n";
    echo '<meta property="og:title" content="'.get_the_title().'"/>';
    echo "\n";
    echo '<meta property="og:description" content="'.$description.'"/>';
    echo "\n";
    echo '<meta property="og:type" content="article"/>';
    echo "\n";
    echo '<meta property="og:url" content="'.get_permalink().'"/>';
    echo "\n";
    echo '<meta property="og:site_name" content="'.get_bloginfo('name').'"/>';
    echo "\n";
    echo '<meta property="og:image" content="'.get_feature_image().'" />';
    echo "\n";
    echo '<link rel="image_src" type="image/jpeg" href="'.get_feature_image().'" />';
    echo "\n";
    echo '<meta property="og:locale" content="zh_tw">';
    echo "\n";
}
add_action('wp_head', 'insert_fb_in_head', 10);
/*
 * 印出陣列值
 */
if (!function_exists('echo_array')) {
    function echo_array($_arr_data)
    {
        echo '<PRE>';
        print_r($_arr_data);
        echo '</PRE>';
    }
}
/*
 * 文章分頁
 */
add_filter(‘mce_buttons’, ’wysiwyg_editor’);
function wysiwyg_editor($mce_buttons)
{
    $pos = array_search(‘wp_more’, $mce_buttons, true);
    if ($pos !== false) {
        $tmp_buttons = array_slice($mce_buttons, 0, $pos + 1);
        $tmp_buttons[] = ‘wp_page’;
        $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
    }

    return $mce_buttons;
}
/**
 * 將物件轉成陣列
 * @param Object $obj 轉換前物件
 * @return Array 回傳轉換後的陣列
 */
if(!function_exists('obj_to_array')){
    function obj_to_array($obj)
    {
        return json_decode(json_encode($obj), true);
    }
}
