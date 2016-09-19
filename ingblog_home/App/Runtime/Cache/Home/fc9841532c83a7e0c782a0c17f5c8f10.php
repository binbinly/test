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
<!--gallery-->
<link rel="stylesheet" type="text/css" href="/ingblog_home/Public/css/gallerybox.css">

<style type="text/css">
	#gallery-wrapper {
		position: relative;
		width: 100%;
		margin:20px auto;
	}
	img.gallerybox {
		width: 100%;
		max-width: 100%;
		height: auto;
	}
	.white-panel {
		position: absolute;
		background: white;
		border-radius: 5px;
		box-shadow: 0px 1px 2px rgba(0,0,0,0.3);
		padding: 10px;
	}
	.white-panel h1 {
		font-size: 1em;
	}
	.white-panel h1 a {
		color: #A92733;
	}
	.white-panel:hover {
		box-shadow: 1px 1px 10px rgba(0,0,0,0.5);
		margin-top: -5px;
		-webkit-transition: all 0.3s ease-in-out;
		-moz-transition: all 0.3s ease-in-out;
		-o-transition: all 0.3s ease-in-out;
		transition: all 0.3s ease-in-out;
	}
</style>
<div class="single">
	<div class="container">
		<div class="single-top">
			<p class="h4 nav-html"><?php echo ($navHtml); ?></p>
			<div class=" single-grid wow slideInRight" data-wow-delay="0.3s">
				<div class="h4 text-center"><?php echo ($info["title"]); ?></div>
				<ul class="blog-ic text-center">
					<li><a href="#"><span> <i  class="glyphicon glyphicon-user"> </i>作者：<?php echo ($info["author"]); ?></span> </a> </li>
					<li><span><i class="glyphicon glyphicon-time"> </i>时间：<?php echo (date("Y-m-d",$info["ctime"])); ?></span></li>
					<li><span><i class="glyphicon glyphicon-eye-open"> </i>浏览：<?php echo ($info["click_count"]); ?></span></li>
				</ul>
			</div>
			<section id="gallery-wrapper" class="wrapper">
				<?php if(is_array($info["file"])): foreach($info["file"] as $key=>$item): ?><article style="width: 256.75px; left: 0px; top: 0px;" class="white-panel r1 c0">
					<img style="cursor: pointer;" src="<?php echo (getTypeFileUrl($item["savepath"],imagesDir,'min')); ?>" class="thumbnail gallerybox">
				</article><?php endforeach; endif; ?>
			</section>
			<div class="row">
				<?php if($prev): ?><div class="prev col-sm-6">上一篇：<a href="<?php echo U('single', array('id'=>$prev['id']));?>"><?php echo ($prev["title"]); ?></a></div><?php endif; ?>
				<?php if($next): ?><div class="next col-sm-6 text-right"><a href="<?php echo U('single', array('id'=>$next['id']));?>"><?php echo ($next["title"]); ?></a>：下一篇</div><?php endif; ?>
			</div>
			<div class="comment-bottom heading wow slideInRight" data-wow-delay="0.3s">
    <p class="h2">我也说点什么呢!</p>
    <form class="form-horizontal" id="commentForm">
        <?php if($_SESSION['tourist_id']== 0): ?><div class="form-group has-remove">
                <label class="col-sm-2 control-label">昵称：</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" placeholder="username">
                </div>
            </div>
            <div class="form-group has-remove">
                <label class="col-sm-2 control-label">Email：</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" placeholder="email">
                </div>
            </div>
            <div class="form-group has-remove">
                <label class="col-sm-2 control-label">头像：</label>
                <div class="col-sm-9 avatarDir"></div>
                <div class="refresh_avatar_div"><a class="refresh_avatar" href="javascript:;"><i class="glyphicon glyphicon-refresh"></i>换一批</a></div>
                <input type="hidden" value="0" name="avatar"/>
            </div><?php endif; ?>
        <div class="form-group has-avatar">
            <?php if($_SESSION['tourist_id']== 0): ?><label class="col-sm-2 control-label">内容：</label>
                <?php else: ?>
                <div class="col-sm-2">
                    <img src="/ingblog_home/Public/images/avatar/<?php echo (session('avatar')); ?>.jpg" class="user_avatar">
                    <p class="text-center user_name"><?php echo (session('username')); ?></p>
                </div><?php endif; ?>
            <div class="col-sm-10">
                <textarea class="form-control comment_text" name="comment_text" id="comment_text"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <a class="btn faceBtn" href="javascript:void(0);"><i class="glyphicon imgBtn"></i>表情</a>
                <a class="btn imageBtn" href="javascript:void(0);"><i class="glyphicon glyphicon-picture"></i>图片</a>
                <div class="faceDiv"> </div>
            </div>
            <div class="col-sm-2 text-right">
                <input type="submit" value="Send">
            </div>
        </div>
    </form>
</div>
<div class="comments heading wow slideInLeft" data-wow-delay="0.3s">
    <p class="h2"><?php if(ACTION_NAME == 'contact'): ?>留言<?php else: ?>评论<?php endif; ?></p>
    <div class="commentList">
    <?php if(is_array($commentList)): foreach($commentList as $key=>$comment): ?><div class="row comment-row">
        <div class="col-sm-2 comment_avatar">
            <img src="/ingblog_home/Public/images/avatar/<?php echo ($comment["avatar"]); ?>.jpg" class="user_avatar">
        </div>
        <div class="col-sm-9">
            <div class="media-heading h4"><?php echo ($comment["username"]); ?></div>
            <p class="comment_text"><?php echo ($comment["comment_content"]); ?></p>
            <a href="javascrip:;" class="comment_act comment_reply" data-id="<?php echo ($comment["comment_id"]); ?>" data-uid="<?php echo ($comment["tourist_id"]); ?>"><i class="glyphicon glyphicon-share-alt"></i>回复</a>
        </div>
        <div class="col-sm-1 comment_story">
            <p class="text-right"><?php echo ($comment["comment_story"]); ?> 楼</p>
            <p class="text-right"><?php echo (format_date($comment["ctime"])); ?></p>
        </div>
    </div><?php endforeach; endif; ?>
    </div>
    <div class="pages clearfix"><?php echo ($page); ?></div>
</div>

<link href="/ingblog_home/Public/css/face.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="/ingblog_home/Public/js/jquery.validate.min.js"></script>

<script type="text/javascript">
    var image_base_url = '/ingblog_home/Public/images';
    var add_comment_url = "<?php echo U('ajaxAddComment');?>";
    var post_id = '<?php echo ($info["id"]); ?>';
    var uid = '<?php echo (session('tourist_id')); ?>';
    var avatar = '<?php echo (session('avatar')); ?>';
    var username = '<?php echo (session('username')); ?>';
    var reply_tourist_id = 0;
    var reply_comment_id = 0;
    var comment_type = 1;
</script>
<script type="text/javascript" src="/ingblog_home/Public/js/face.js"></script>

		</div>
	</div>
</div>
<script src="/ingblog_home/Public/js/pinterest_grid.js"></script>
<script src="/ingblog_home/Public/js/images.js"></script>
<script type="text/javascript">
	//瀑布流插件
	$(function(){
		$("#gallery-wrapper").pinterest_grid({
			no_columns: 4,
			padding_x: 10,
			padding_y: 10,
			margin_bottom: 50,
			single_column_breakpoint: 700
		});
		loadImages();

	});
	//滚动滚动条的时候调用的事件
	var scrollH = '';//可视区高度
	var scrollT = '';//滚动条高度
	var _height = 0;
	var page = 2;
	var is_load = 0;
	$(window).scroll(function(){
		_height = parseInt($("#gallery-wrapper").height() + $("#gallery-wrapper").position().top);
		scrollH = $(window).height();
		scrollT = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
		if(_height - scrollH<scrollT && is_load == 0){
			load();
			is_load = 1;
		}
	});
	function load() {
		var url = "<?php echo U('ajaxGetPhotoList');?>";
		var post_id = '<?php echo ($info["id"]); ?>';
		$.post(url, {id:post_id, p:page}, function(data){
			if(data.code == 1) {
				$.each(data.data, function(k, v){
					var html = '<article class="white-panel r1 r3 c1" style="opacity:0"> ' +
							'<img class="thumbnail gallerybox" src="'+ v.savepath+'" style="cursor: pointer;"> ' +
							'</article>';
					$("#gallery-wrapper").append(html);
					$("#gallery-wrapper article").fadeTo(1000, 1);
				});
				page = ++data.p;
				is_load = 0;
				loadImages();
			}else{
				layer.msg(data.msg);
			}
		}, 'json');
	}
	function loadImages(){
		$(".gallerybox").gallerybox({
			bgColor:"#000",
			bgOpacity:0.85
		});
	}
</script>

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