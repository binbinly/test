<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <title>Home</title>
    <link href="/ingblog_home/Public/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/ingblog_home/Public/js/jquery-1.11.0.min.js"></script>
    <!-- Custom Theme files -->
    <link href="/ingblog_home/Public/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Custom Theme files -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

    <script src="/ingblog_home/Public/js/bootstrap.min.js"></script>
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
                        <li class="active"><a href="<?php echo U('index');?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">首页 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo U('index');?>">Action</a></li>
                                <li><a href="<?php echo U('index');?>">Another action</a></li>
                                <li><a href="<?php echo U('index');?>">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo U('index');?>">Separated link</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>

                        </li>
                        <li><a href="<?php echo U('about');?>" data-hover="我的相册">我的相册</a></li>
                        <li><a href="<?php echo U('services');?>" data-hover="Services">Services</a></li>
                        <li><a href="<?php echo U('shortcodes');?>" data-hover="Shortcodes">Shortcodes</a></li>
                        <li><a href="<?php echo U('portfolio');?>" data-hover="Portfolio">Portfolio</a></li>
                        <li><a href="<?php echo U('contact');?>" data-hover="Contact">Contact</a></li>
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
<!--contact start here-->
<div class="contact">
	<div class="contact-main">
	   <div class="container">
			<div class="contact-top wow fadeInDownBig" data-wow-delay="0.3s">
				<h1>Contact</h1>
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.</p>
			</div>
			<div class="contact-bottom">
			  <form>
				<div class="col-md-7 contact-left wow slideInLeft" data-wow-delay="0.3s">
					<p>Name</p>
		             <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}"/>
		            <p>E-mail</p> 
		             <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}"/>
		            <p>Subject</p>
		             <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}"/>
		            <p>Phone</p>
		             <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}"/>
				</div>
				<div class="col-md-5 contact-right wow slideInRight" data-wow-delay="0.3s">
					<p>Messages</p>
					  <textarea onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}"> </textarea>
		             <input type="submit" value="Send">
				 </div>
				 <div class="clearfix"> </div>
			  </form>
			</div>
		</div>
	</div>
</div>
<!--contact end here-->
<!--map start here-->
<div class="map">
	<div class="container">
		<div class="col-md-7 map-left wow slideInLeft" data-wow-delay="0.3s">
			<h2>Contact Info</h2>
				      <P>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</P>
				     <div class="addre">
					      <h4>Address</h4>
					      <p>Address : Richard McClintock</p>
						  <p>New Street : Letraset sheets </p>
						  <p>ph : +123 859 6050</p>
						  <p>Email : <a href="mailto:info@example.com">example@gmail.com</a></p>
					 </div>
		</div>
	</div>
</div>
<!--map end here-->
<!--footer start here-->
<div class="footer">
    <div class="container">
        <div class="footer-main">
            <div class="col-md-4 ftr-grd wow zoomIn" data-wow-delay="0.3s">
                <h3>Get in Touch</h3>
                <p>8901 ibero  Road</p>
                <p>Nam libero tempore</p>
                <p>Phone: +148 5746 415</p>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-md-4 ftr-grd wow zoomIn" data-wow-delay="0.3s">
                <h3>Recent Post</h3>
                <div class="ftr-sub-gd">
                    <div class="col-md-4 ftr-gd1-img">
                        <a href="single.html"><img src="/ingblog_home/Public/images/f1.jpg" alt="" class="img-responsive"></a>
                    </div>
                    <div class="col-md-8 ftr-gd1-text">
                        <h4><a href="single.html">libero tempore soluta</a></h4>
                        <p>Lorem Ipsum comes Lorem Ipsum comes</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="ftr-sub-gd">
                    <div class="col-md-4 ftr-gd1-img">
                        <a href="single.html"><img src="/ingblog_home/Public/images/f2.jpg" alt="" class="img-responsive"></a>
                    </div>
                    <div class="col-md-8 ftr-gd1-text">
                        <h4><a href="single.html">voluptas assumenda</a></h4>
                        <p>No one rejects dislikes it is pleasure</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="ftr-sub-gd">
                    <div class="col-md-4 ftr-gd1-img">
                        <a href="single.html"><img src="/ingblog_home/Public/images/f3.jpg" alt="" class="img-responsive"></a>
                    </div>
                    <div class="col-md-8 ftr-gd1-text">
                        <h4><a href="single.html">dignissimos ducimus</a></h4>
                        <p>Lorem Ipsum comes Lorem Ipsum comes</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-4 ftr-grd wow zoomIn" data-wow-delay="0.3s">
                <h3>Join Our Newsletter</h3>
                <form>
                    <input type="text" value="Email"  onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}"/>
                    <input type="submit" value="Subscribe">
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