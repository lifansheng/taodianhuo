@extends('layout.homes')

	<link rel="stylesheet" href="homes/css/font-awesome.min.css">
	
	<!-- BOOTSTRAP 3.3.7 CSS -->
	<link rel="stylesheet" href="homes/css/bootstrap.min.css" />
	
	<!-- SLICK v1.6.0 CSS -->
	<link rel="stylesheet" href="homes/css/slick-1.6.0/slick.css" />
	
	<link rel="stylesheet" href="homes/css/jquery.fancybox.css" />
	<link rel="stylesheet" href="homes/css/yith-woocommerce-compare/colorbox.css" />
	<link rel="stylesheet" href="homes/css/owl-carousel/owl.carousel.min.css" />
	<link rel="stylesheet" href="homes/css/owl-carousel/owl.theme.default.min.css" />
	<link rel="stylesheet" href="homes/css/js_composer/js_composer.min.css" />
	<link rel="stylesheet" href="homes/css/woocommerce/woocommerce.css" />
	<link rel="stylesheet" href="homes/css/woocommerce/woocommerce-layout.css" />
	<link rel="stylesheet" href="homes/css/woocommerce/woocommerce-smallscreen.css" />
	<link rel="stylesheet" href="homes/css/woocommerce/prettyPhoto.css" />
	<link rel="stylesheet" href="homes/css/yith-woocommerce-wishlist/style.css" />
	
	
	<link rel="stylesheet" href="homes/css/custom.css" />
	<link rel="stylesheet" href="homes/css/app-orange.css" id="theme_color" />
	<link rel="stylesheet" href="" id="rtl" /> 
	<link rel="stylesheet" href="homes/css/app-responsive.css" />
	
@section('content')
	<div class="top-form top-form-minicart etrostore-minicart pull-right">
							<div class="top-minicart-icon pull-right">
								<i class="fa fa-shopping-cart"></i>
								<a class="cart-contents" href="cart.html" title="View your shopping cart">
									<span class="minicart-number">2</span>
								</a>
							</div>
						 
							<div class="wrapp-minicart">
								<div class="minicart-padding">
									<div class="number-item">
										There are <span>items</span> in your cart
									</div>
									
									<ul class="minicart-content">
										<li>
											<a href="simple_product.html" class="product-image">
												<img 	width="100" height="100" src"homes/homes/images/1903/45-150x150.jpg" class="attachment-100x100 size-100x100 wp-post-image" alt="" 
																	srcset="homes/images/1903/45-150x150.jpg 150w, homes/images/1903/45-300x300.jpg 300w, homes/images/1903/45-180x180.jpg 180w, homes/images/1903/45.jpg 600w" 
																	sizes="(max-width: 100px) 100vw, 100px"/>
											</a>
											
											<div class="detail-item">
												<div class="product-details">
													<h4>
														<a class="title-item" href="simple_product.html">Veniam Dolore</a>
													</h4>
													
													<div class="product-price">
														<span class="price">														
															<span class="woocommerce-Price-amount amount">
																<span class="woocommerce-Price-currencySymbol">$</span>190.00
															</span>
														</span>	      
														
														<div class="qty">
															<span class="qty-number">1</span>									
														</div>
													</div>
													
													<div class="product-action clearfix">
														<a href="#" class="btn-remove" title="Remove this item">
															<span class="fa fa-trash-o"></span>
														</a>
														
														<a class="btn-edit" href="cart.html" title="View your shopping cart">
															<span class="fa fa-pencil"></span>
														</a>    
													</div>
												</div>
											</div>
										</li>
									  
										<li>
											<a href="simple_product.html" class="product-image">
												<img	 width="100" height="100" src="homes/images/1903/22-150x150.jpg" class="attachment-100x100 size-100x100 wp-post-image" alt="" 
																	srcset="homes/images/1903/22-150x150.jpg 150w, homes/images/1903/22-300x300.jpg 300w, homes/images/1903/22-180x180.jpg 180w, homes/images/1903/22.jpg 600w" 
																	sizes="(max-width: 100px) 100vw, 100px" />
											</a>
											
											<div class="detail-item">
												<div class="product-details">
													<h4>
														<a class="title-item" href="simple_product.html">Cleaner with bag</a>
													</h4>
													
													<div class="product-price">
														<span class="price">
															<span class="woocommerce-Price-amount amount">
																<span class="woocommerce-Price-currencySymbol">$</span>350.00
															</span>
														</span>
														
														<div class="qty">
															<span class="qty-number">1</span>									
														</div>
													</div>
													
													<div class="product-action clearfix">
														<a href="#" class="btn-remove" title="Remove this item">
															<span class="fa fa-trash-o"></span>
														</a>           
														
														<a class="btn-edit" href="cart.html" title="View your shopping cart">
															<span class="fa fa-pencil"></span>
														</a>
													</div>
												</div>
											</div>
										</li>
									</ul>
									
									<div class="cart-checkout">
										<div class="price-total">
											<span class="label-price-total">Total</span>
											
											<span class="price-total-w">
												<span class="price">
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>540.00
													</span>
												</span>
											</span>			
										</div>
										
										<div class="cart-links clearfix">
											<div class="cart-link">
												<a href="cart.html" title="Cart">View Cart</a>
											</div>
											
											<div class="checkout-link">
												<a href="checkout.html" title="Check Out">Check Out</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				  
						<div class="mid-header pull-right">
							<div class="widget sw_top">
								<span class="stick-sr">
									<i class="fa fa-search" aria-hidden="true"></i>
								</span>
								
								<div class="top-form top-search">
									<div class="topsearch-entry">
										<form role="search" method="get" class="form-search searchform" action="">
											<label class="hide"></label>
											<input type="text" value="" name="s" class="search-query" placeholder="Keyword here..." />
											<button type="submit" class="button-search-pro form-button">Search</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		
		<div class="listings-title">
			<div class="container">
				<div class="wrap-title">
					<h1>Turkey Qui</h1>
					<div class="bread">
						<div class="breadcrumbs theme-clearfix">
							<div class="container">
								<ul class="breadcrumb">
									<li><a href="#">Home</a><span class="go-page"></span></li>
									<li><a href="group_product.html">Group Product</a><span class="go-page"></span></li>
									<li class="active"><span>Turkey Qui</span></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	



<script src='homes/js/jquery-1.8.3.min.js'></script>
	<style>
		*{margin:0px;padding:0px;}

		#small{width:400px;height: 400px;border:solid 1px blue;position:absolute;left:30px;top:50px;cursor:move;}

		#move{
			width: 160px;
			height: 160px;
			position:absolute;
			left:0px;
			top:0px;
			background: url('homes/images/fdj/bg.png');
			display:none;

		}

		#big{
			width:400px;height: 400px;position:absolute;left:480px;top:50px;overflow:hidden;display:none;
		}

		#bigImg{
			position:absolute;

		}

		#uls{
			width:400px;
			height:84px;
			
			position:absolute;
			left:30px;
			top:460px;
		}

		#uls li{
			width: 80px;
			height: 80px;
			/*border: solid 1px green;*/
			float:left;
			list-style:none;
			margin-right:5px;
		}
	</style>


		<div class="container">
			<div class="row">
				<div id="contents-detail" class="content col-lg-12 col-md-12 col-sm-12" role="main">
					<div id="container">
						<div id="content" role="main">
							<div class="single-product clearfix">
								<div id="product-01" class="product type-product status-publish has-post-thumbnail product_cat-accessories product_brand-global-voices first outofstock featured shipping-taxable purchasable product-type-simple">
									<div class="product_detail row">
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 clear_xs">
											<div class="slider_img_productd">
												<!-- woocommerce_show_product_images -->
												<div id="product_img_01" class="product-images loading" data-rtl="false">
													<div class="product-images-container clearfix thumbnail-bottom">
														<!-- Image Slider -->
														<div class="slider product-responsive">
															<div class="item-img-slider">
																<div class="images">	
	



<!-- 放大镜 -->













</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>






























		
		<footer id="footer" class="footer default theme-clearfix">
			<!-- Content footer -->
			<div class="container">
				<div class="vc_row wpb_row vc_row-fluid">
					<div class="wpb_column vc_column_container vc_col-sm-12">
						<div class="vc_column-inner ">
							<div class="wpb_wrapper">
								<div id="sw_testimonial01" class="testimonial-slider client-wrapper-b carousel slide " data-interval="0">
									<div class="carousel-cl nav-custom">
										<a class="prev-test fa fa-angle-left" href="#sw_testimonial01" role="button" data-slide="prev"><span></span></a>
										<a class="next-test fa fa-angle-right" href="#sw_testimonial01" role="button" data-slide="next"><span></span></a>
									</div>
									
									<div class="carousel-inner">
										<div class="item active">
											<div class="item-inner">
												<div class="image-client pull-left">
													<a href="#" title="">
														<img width="127" height="127" src="homes/images/1903/tm3.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" />
													</a>
												</div>
												
												<div class="client-say-info">
													<div class="client-comment">
														In auctor ex id urna faucibus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.�						
													</div>
													
													<div class="name-client">
														<h2><a href="#" title="">Jerry</a></h2>
														<p>Web Developer</p>
													</div>
												</div>
											</div>
											
											<div class="item-inner">
												<div class="image-client pull-left">
													<a href="#" title="">
														<img width="127" height="127" src="homes/images/1903/tm1.png" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" />
													</a>
												</div>
											
												<div class="client-say-info">
													<div class="client-comment">
														In auctor ex id urna faucibus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.�						
													</div>
													
													<div class="name-client">
														<h2>
															<a href="#" title="">David Gand</a>
														</h2>
														
														<p>Designer</p>
													</div>
												</div>
											</div>
										</div>
										
										<div class="item ">
											<div class="item-inner">
												<div class="image-client pull-left">
													<a href="#" title="">
														<img width="127" height="127" src="homes/images/1903/tm2.png" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" />
													</a>
												</div>
												
												<div class="client-say-info">
													<div class="client-comment">
														In auctor ex id urna faucibus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.�						
													</div>
													
													<div class="name-client">
														<h2>
															<a href="#" title="">Taylor Hill</a>
														</h2>
														
														<p>Developer</p>
													</div>
												</div>
											</div>
											
											<div class="item-inner">
												<div class="image-client pull-left">
													<a href="#" title="">
														<img width="127" height="127" src="homes/images/1903/tm3.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" />
													</a>
												</div>
												
												<div class="client-say-info">
													<div class="client-comment">
														In auctor ex id urna faucibus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.�						
													</div>
													
													<div class="name-client">
														<h2>
															<a href="#" title="">JOHN DOE</a>
														</h2>
														
														<p>Designer</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
@stop

@section('js')

@stop
