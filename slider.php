<div id="carousel-example-generic" class="carousel slide container container_bg" data-ride="carousel">
    <!-- Indicators -->

    <div class="indicators-bg" style="width:<?php echo count($_arr_slider_posts)+3 ?>0pt;"></div>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php foreach($_arr_slider_posts as $key => $val){ ?>
            <a href="<?php echo wp_get_shortlink($val['ID']) ?>">
                <div class="item <?php if($key == 0){ ?>active<?php }?>">
                    <div class="slider-fill" style="background-image:url(<?php echo $val['url_thumb_img'] ?>)"></div>
                    <div class="slider-content">
                        <h2 class="slider-title col-sm-3"><?php echo $val['post_title'] ?></h2>
                        <div class="slider-desc col-sm-9"><?php echo mb_substr(strip_tags($val['post_content']), 0, 255, 'utf-8') ?>
                        ...<a class="btn btn-danger btn-xs" href="<?php echo wp_get_shortlink($val['ID']) ?>">完整閱讀</a>
                        </div>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
