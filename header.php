<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset');?>" />
    <title>
        <?php
			if (is_home()) {
				bloginfo('name');
				echo ' - ';
				bloginfo('description');
			} else {
				wp_title(' - ', true, 'right');
				bloginfo('name');
			}
        ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <link href="<?php bloginfo('template_directory') ?>/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php bloginfo('template_directory') ?>/css/bootstrap-theme.min.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php bloginfo('template_directory') ?>/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css" />
    <!--[if IE 7]>
        <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/css/font-awesome-ie7.min.css">
	<![endif]-->
    <link href="<?php bloginfo('template_directory') ?>/style.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="<?php bloginfo('template_directory') ?>/js/jquery-1.11.3.min.js"></script>
    <script src="<?php bloginfo('template_directory') ?>/js/bootstrap.min.js"></script>
    <script src="<?php bloginfo('template_directory') ?>/js/jquery.masonry.min.js"></script>
    <script src="<?php bloginfo('template_directory') ?>/js/func.js"></script>
    <?php wp_head(); ?>
</head>

<body>
    <header class="header">
        <h1><?php bloginfo('name')?></h1>
        <nav class="navbar navbar-static-top navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <?php
					wp_nav_menu(
					            array(
								    'menu'              => 'primary',
									'theme_location'    => 'primary',  //這邊要填你的選單名稱
									'depth'             => 2,
									'container'         => 'div',
									'container_class'   => 'collapse navbar-collapse',
									'container_id'      => 'bs-example-navbar-collapse-1',
									'menu_class'        => 'nav navbar-nav',
									'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
									'walker'            => new wp_bootstrap_navwalker()
								)
							);
				?>

            </div>

        </nav>
    </header>
