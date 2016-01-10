<?php

function add_theme_option()
{
    add_theme_page( 'allenplay2016佈景參數設定', '佈景參數', 'edit_theme_options', 'xmlas_slug','display_function');
}

function display_function()
{
    $_json_all_index_subject = get_option('all_index_subject');
	include_once('theme_options_form.php');
    print_r($_POST);
}

add_action('admin_menu', 'add_theme_option');
