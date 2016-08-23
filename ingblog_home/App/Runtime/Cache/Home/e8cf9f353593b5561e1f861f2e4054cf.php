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
<!--gallery-->
<div class="portfolio">
   <div class="container">
	  <div class="portfolio-top wow fadeInDownBig" data-wow-delay="0.3s">
			<h1>Portfolio</h1>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.</p>
		</div>	
		<div class="sap_tabs">
			
						 <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
						  <ul class="resp-tabs-list">
						  	  <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>All</span></li>
							  <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Category</span></li>
							  <li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>Category1</span></li>
							 <li class="resp-tab-item" aria-controls="tab_item-3" role="tab"><span>Category2</span></li>
							  <div class="clearfix"> </div>
						  </ul>				  	 
							<div class="resp-tabs-container">
							    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
									<div class="tab_img">
									  <div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p1.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p1.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			    <a href="/ingblog_home/Public/images/p2.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			    	<img src="/ingblog_home/Public/images/p2.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p3.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p3.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			     <a href="/ingblog_home/Public/images/p4.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			     	<img src="/ingblog_home/Public/images/p4.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
											<div class="clearfix"> </div>
							     </div>	
							     <div class="tab_img">
									  <div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p5.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p5.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			    <a href="/ingblog_home/Public/images/p6.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			    	<img src="/ingblog_home/Public/images/p6.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p7.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p7.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			     <a href="/ingblog_home/Public/images/p8.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			     	<img src="/ingblog_home/Public/images/p8.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
											<div class="clearfix"> </div>
							     </div>	
							     <div class="tab_img">
									  <div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p9.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p9.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			    <a href="/ingblog_home/Public/images/p10.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			    	<img src="/ingblog_home/Public/images/p10.jpg" class="img-responsive" alt=""/>
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p11.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p11.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			     <a href="/ingblog_home/Public/images/p12.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			     	<img src="/ingblog_home/Public/images/p12.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
											<div class="clearfix"> </div>
							     </div>	
									 	        					 
						  </div>
							    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
								
							     <div class="tab_img">
									  <div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p13.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p13.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			    <a href="/ingblog_home/Public/images/p1.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			    	<img src="/ingblog_home/Public/images/p1.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p2.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p2.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			     <a href="/ingblog_home/Public/images/p3.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			     	<img src="/ingblog_home/Public/images/p3.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
											<div class="clearfix"> </div>
							     </div>	
							     	<div class="tab_img">
									  <div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p4.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p4.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			    <a href="/ingblog_home/Public/images/p5.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			    	<img src="/ingblog_home/Public/images/p5.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p6.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p6.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
											<div class="clearfix"> </div>
							     </div>	
									 	        					 
						  </div>
						    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
								
									  <div class="tab_img">
									  <div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p7.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p7.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			    <a href="/ingblog_home/Public/images/p8.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			    	<img src="/ingblog_home/Public/images/p8.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p9.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p9.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
									<div class="col-md-3 img-top ">
					   		  			    <a href="/ingblog_home/Public/images/p10.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			    	<img src="/ingblog_home/Public/images/p10.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
											<div class="clearfix"> </div>
							     </div>	
							     	<div class="tab_img">
									  <div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p11.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p11.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			    <a href="/ingblog_home/Public/images/p12.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			    	<img src="/ingblog_home/Public/images/p12.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										
											<div class="clearfix"> </div>
							     </div>		        					 
						  </div>
						   <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-3">
						   	<div class="tab_img">
									  <div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p13.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p13.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			    <a href="/ingblog_home/Public/images/p1.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			    	<img src="/ingblog_home/Public/images/p1.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p2.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p2.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			     <a href="/ingblog_home/Public/images/p3.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			     	<img src="/ingblog_home/Public/images/p3.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
											<div class="clearfix"> </div>
							     </div>	
							     <div class="tab_img">
									  <div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p4.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p4.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			    <a href="/ingblog_home/Public/images/p5.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			    	<img src="/ingblog_home/Public/images/p5.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			   <a href="/ingblog_home/Public/images/p6.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			   	<img src="/ingblog_home/Public/images/p6.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
										<div class="col-md-3 img-top ">
					   		  			     <a href="/ingblog_home/Public/images/p7.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
					   		  			     	<img src="/ingblog_home/Public/images/p7.jpg" class="img-responsive" alt="">
												 <div class="link-top">
												 <i class="link"> </i>
												 </div>
					   		  			   </a>
										</div>
											<div class="clearfix"> </div>
							     </div>	
						   	</div>		
                  </div>
             </div>
         </div>
    </div>	
</div>
<!--gallery-->
<script src="/ingblog_home/Public/js/easyResponsiveTabs.js" type="text/javascript"></script>
		    <script type="text/javascript">
			    $(document).ready(function () {
			        $('#horizontalTab').easyResponsiveTabs({
			            type: 'default', //Types: default, vertical, accordion           
			            width: 'auto', //auto or any width like 600px
			            fit: true   // 100% fit in a container
			        });
			    });
				
</script>
<link rel="stylesheet" href="/ingblog_home/Public/css/swipebox.css">
	<script src="/ingblog_home/Public/js/jquery.swipebox.min.js"></script>
	    <script type="text/javascript">
			jQuery(function($) {
				$(".swipebox").swipebox();
			});
</script>

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