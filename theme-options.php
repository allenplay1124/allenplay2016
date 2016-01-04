<?php

function add_theme_option()
{
    add_theme_page( 'title标题', '', 'edit_themes', 'xmlas_slug','display_function');
}

function theme_option()
{
    
}

add_action('admin_menu', 'add_theme_option');
