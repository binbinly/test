<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <title>Home</title>
    <link href="/ingblog_home/Public/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/ingblog_home/Public/js/jquery-1.11.0.min.js"></script>
    <!-- Custom Theme files -->
    <link href="/ingblog_home/Public/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/ingblog_home/Public/css/style1.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Custom Theme files -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

    <script src="/ingblog_home/Public/js/bootstrap.min.js"></script>
    <script src="/ingblog_home/Public/js/layer/layer.js"></script>
    <!--responsive-->
    <script src="/ingblog_home/Public/js/responsiveslides.min.js"></script>
</head>
<body>
<!--header start here-->
<!-- NAVBAR
==================================================-->
<!--header start here-->
<!-- animated-css -->
<link href="/ingblog_home/Public/css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="/ingblog_home/Public/js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<!-- animated-css -->
<div class="header">
    <div class="navbar-wrapper">
        <div class="container">
            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="navbar-header">
                    <div class="logo wow slideInLeft" data-wow-delay="0.3s">
                        <a class="navbar-brand" href="index.html"><img src="/ingblog_home/Public/images/logo1.png" /></a>
                    </div>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo U('index');?>">首页</a></li>
                        <li><a href="<?php echo U('about');?>">代码分享</a></li>
                        <li><a href="<?php echo U('study');?>">学无止境</a></li>
                        <li><a href="<?php echo U('photo');?>">青葱留影</a></li>
                        <li><a href="<?php echo U('contact');?>">留言板</a></li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </nav>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="clearfix"> </div>
</div>
<!--header end here-->

<div class="portfolio">
	<div class="container fitness-rit">
			<?php if(ACTION_NAME == 'search'): ?><p class="h4 nav-html"><a href="<?php echo U('index');?>">首页</a> &gt; <a href="javascript:;">搜索</a></p>
			<div class="text-center search_text">
				<?php if($keyword): ?>当前搜索关键字“<?php echo ($keyword); ?>”
				<?php elseif($cat_name): ?>
					当前搜索分类"<?php echo ($cat_name); ?>"
				<?php elseif($tag_name): ?>
					当前搜索标签"<?php echo ($tag_name); ?>"<?php endif; ?>
			</div>
			<?php else: ?>
			<div class="portfolio-top wow fadeInDownBig" data-wow-delay="0.3s">
				<h1>学无止境</h1>
				<p>书山有路勤为径，学海无涯苦作舟。</p>
			</div><?php endif; ?>
			<?php if(is_array($post)): foreach($post as $key=>$item): ?><div class="fitness-bottom">
        <div class="col-md-3 fitness-lft wow zoomIn" data-wow-delay="0.3s">
            <img src="<?php echo ($item["cover_url"]); ?>" alt="" class="img-responsive">
        </div>
        <div class="col-md-9 fitness-rit wow zoomIn" data-wow-delay="0.3s">
            <p class="post_title"><a href="<?php echo U('single', array('id'=>$item['id']));?>"><?php echo ($item["title"]); ?></a></p>
            <p class="post_content"><?php echo (msubstr(strip_tags($item["content"]),0,300,'utf-8',true)); ?></p>
            <div class="row">
                <div class="col-lg-8">
                    <span class="datetime"><i class="glyphicon glyphicon-time"></i> <?php echo (date("Y-m-d",$item["ctime"])); ?></span>
                    &nbsp;&nbsp;
                    <?php if(is_array($item["tagList"])): foreach($item["tagList"] as $key=>$tag): ?><a class="tags" href="<?php echo U('search', array('tag'=>$tag['tag_id']));?>"><i class="glyphicon glyphicon-tags"></i><?php echo ($tag["tagname"]); ?></a><?php endforeach; endif; ?>
                </div>
                <div class="col-lg-4 text-right post_detail"><a href="<?php echo U('single', array('id'=>$item['id']));?>" class="hvr-underline-from-left">查看详情</a></div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div><?php endforeach; endif; ?>
		<div class="pages clearfix"><?php echo ($page); ?></div>
	</div>
</div>
<!--footer start here-->
<div class="footer">
    <div class="container">
        <div class="footer-main clearfix">
            <div class="col-md-4 ftr-grd wow zoomIn" data-wow-delay="0.3s">
                <div class="h3">标签</div>
                <div class="tag-list">
                <?php if(is_array($tagAll)): foreach($tagAll as $key=>$item): ?><a class="label <?php echo (random_style($item["count"])); ?>" href="<?php echo U('search', array('tag'=>$item['tag_id']));?>"><?php echo ($item["tagname"]); ?></a><?php endforeach; endif; ?>
                </div>
            </div>
            <div class="col-md-4 ftr-grd wow zoomIn" data-wow-delay="0.3s">
                <div class=h3>热门文章</div>
                <?php if(is_array($hot)): foreach($hot as $key=>$item): ?><div class="ftr-sub-gd">
                    <div class="col-md-4 ftr-gd1-img">
                        <a href="<?php echo U('single', array('id'=>$item['id']));?>"><img src="<?php echo (getTypeFileUrl($item["cover_url"])); ?>" alt="" class="img-responsive"></a>
                    </div>
                    <div class="col-md-8 ftr-gd1-text">
                        <h4><a href="<?php echo U('single', array('id'=>$item['id']));?>" title="<?php echo ($item["title"]); ?>"><?php echo (msubstr($item["title"],0,15,'utf-8',true)); ?></a></h4>
                        <p class="post_content"><?php echo (msubstr(strip_tags($item["content"]),0,20,'utf-8',true)); ?></p>
                    </div>
                    <div class="clearfix"> </div>
                </div><?php endforeach; endif; ?>
            </div>
            <div class="col-md-4 ftr-grd wow zoomIn" data-wow-delay="0.3s">
                <div class="h3">搜索</div>
                <form action="<?php echo U('search');?>">
                <div class="input-group search">
                    <input type="text" class="form-control" name="word">
                    <span class="input-group-btn"> <input class="btn btn-primary" type="submit" value="搜索"/> </span>
                </div>
                </form>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<div class="copy-right wow slideInRight" data-wow-delay="0.3s">
    <p>Copyright &copy; 2016.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a></p>
</div>
<script type="text/javascript" src="/ingblog_home/Public/js/move-top.js"></script>
<script type="text/javascript" src="/ingblog_home/Public/js/easing.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
        };
        $().UItoTop({ easingType: 'easeOutQuart' });

    });
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
        });
    });
</script>
<a href="javascript:;" id="toTop" style="display: none;"><span id="toTopHover" style="opacity: 1;"></span></a>
<!--footer end here-->
</body>
</html>