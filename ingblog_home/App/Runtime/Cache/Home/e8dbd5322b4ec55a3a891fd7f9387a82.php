<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>浅谈：html5和html的区别-个人博客</title>
    <meta name="keywords" content="个人博客" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="/ingblog_home/Public/css/index.css"/>
    <link rel="stylesheet" href="/ingblog_home/Public/css/style.css"/>
    <link rel="stylesheet" href="/ingblog_home/Public/css/animate.css"/>
    <script type="text/javascript" src="/ingblog_home/Public/js/jquery1.42.min.js"></script>
    <script type="text/javascript" src="/ingblog_home/Public/js/common.js"></script>
    <!--[if lt IE 9]>
    <script src="/ingblog_home/Public/js/html5.js"></script>
    <![endif]-->
</head>

<body>
<!--header start-->
<div id="header">
    <h1>个人博客</h1>
    <p>青春是打开了,就合不上的书。人生是踏上了，就回不了头的路，爱情是扔出了，就收不回的赌注。</p>
</div>
<!--header end-->
<!--nav-->
<div id="nav">
    <ul>
        <li><a href="<?php echo U('index');?>">首页</a></li>
        <li><a href="<?php echo U('about');?>">关于我</a></li>
        <li><a href="<?php echo U('shuo');?>">碎言碎语</a></li>
        <li><a href="<?php echo U('riji');?>">个人日记</a></li>
        <li><a href="<?php echo U('xc');?>">相册展示</a></li>
        <li><a href="<?php echo U('learn');?>">学无止境</a></li>
        <li><a href="<?php echo U('guestbook');?>">留言板</a></li>
        <div class="clear"></div>
    </ul>
</div>
    <!--header end-->
    <!--content start-->
    <div id="content_xc">
         <div class="weizi">
           <div class="wz_text">当前位置：<a href="#">首页</a>><h1>相册展示</h1></div>
         </div>
         <div class="xc_content">
          <div class="con-bg">
              <div class="w960 mt_10">
               <div class="w650">
                <ul class="tips" id="wf-main" style="display:none" >
                        <li class="wf-cld"><img src="/ingblog_home/Public/images/photo/8.jpg"  width="200" height="178" alt="" /></li>         
                        <li class="wf-cld"><img src="/ingblog_home/Public/images/photo/1.jpg" height="147" width="200" alt="" /></li>
                        <li class="wf-cld"><img src="/ingblog_home/Public/images/photo/2.jpg"  width="200" height="267" alt="" /></li>
                        <li class="wf-cld"><img src="/ingblog_home/Public/images/photo/3.jpg"  width="200" height="125" alt="" /></li>
                        <li class="wf-cld"><img src="/ingblog_home/Public/images/photo/4.jpg" width="200" height="299" alt="" /></li>
                        <li class="wf-cld"><img src="/ingblog_home/Public/images/photo/5.jpg" width="200" height="125" alt="" /></li>
                        <li class="wf-cld"><img src="/ingblog_home/Public/images/photo/6.jpg" width="200" height="267" alt="" /></li>
                        <li class="wf-cld"><img src="/ingblog_home/Public/images/photo/7.jpg" width="200" height="135" alt="" /></li>
                        <li class="wf-cld"><img src="/ingblog_home/Public/images/photo/9.jpg"  width="200" height="300" alt="" /></li>
                        <li class="wf-cld"><img src="/ingblog_home/Public/images/photo/10.jpg"  width="200" height="107" alt="" /></li>
                    </ul>
               </div>
             </div>
           </div>
         </div>
    </div>

<div id="footer">
    <p>Design by:<a href="http://www.duanliang920.com" target="_blank">少年</a> 2014-8-9</p>
</div>
<!--footer end-->
<script type="text/javascript">jQuery(".lanmubox").slide({easing:"easeOutBounce",delayTime:400});</script>
<script  type="text/javascript" src="/ingblog_home/Public/js/nav.js"></script>

</body>
</html>