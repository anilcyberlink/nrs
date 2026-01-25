<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
       <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="{{$setting->meta_key}}, @yield('meta_keyword') "/>
        <meta name="description" content="{{$setting->meta_description}}, @yield('meta_description')"/>
        <title>@yield('post_title') {{$setting->site_name}} </title>   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:title" content="@yield('title')" />
        <meta property="og:url" content="{{url()->current()}}" />
        <meta property="og:description" content="@yield('meta_description')" />
        @if (trim($__env->yieldContent('thumbnail')))
        <meta property="og:image" content="{{ asset( env('PUBLIC_PATH') . 'uploads/original/' ) }}/@yield('thumbnail')"/>
        @else
        <meta property="og:image" content="{{asset('themes-assets/images/logo-white.png')}}"/>
        @endif
        <meta property="og:type" content="article" />
        <meta property="og:site_name" content="{{$setting->site_name}}" />
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:site" content="" />
        <meta property="twitter:title" content="@yield('title')" />
        <meta property="twitter:description" content="@yield('meta_description')" />
        <meta property="twitter:image" content="{{ asset( env('PUBLIC_PATH') . 'uploads/original/' ) }}/@yield('thumbnail')" />
        <meta property="twitter:url" content="{{url()->current()}}" />
        <meta name="twitter:image:alt" content="@yield('title')" />
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="{{asset('themes-assets/images/favicon.png')}}">
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,800" rel="stylesheet">
		<!-- Bootstrap Css -->
        <link rel="stylesheet" href="{{asset('themes-assets/css/bootstrap.min.css')}}">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="{{asset('themes-assets/css/font-awesome.min.css')}}">
		<!-- Slick Nav CSS -->
        <link rel="stylesheet" href="{{asset('themes-assets/css/slicknav.min.css')}}">
		<!-- Cube Portfolio CSS -->
        <link rel="stylesheet" href="{{asset('themes-assets/css/cubeportfolio.min.css')}}">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="{{asset('themes-assets/css/magnific-popup.min.css')}}">
		<!-- Fancy Box CSS -->
        <link rel="stylesheet" href="{{asset('themes-assets/css/jquery.fancybox.min.css')}}">
		<!-- Nice Select CSS -->
        <link rel="stylesheet" href="{{asset('themes-assets/css/niceselect.css')}}">
		<!-- Owl Carousel CSS -->
	   	<link rel="stylesheet" href="{{asset('themes-assets/css/owl.theme.default.css')}}">
        <link rel="stylesheet" href="{{asset('themes-assets/css/owl.carousel.min.css')}}">
		<!-- Slick Slider CSS -->
        <link rel="stylesheet" href="{{asset('themes-assets/css/slickslider.min.css')}}">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="{{asset('themes-assets/css/animate.min.css')}}">
        	<!-- Event calendar CSS -->
		<link rel="stylesheet" href="{{asset('themes-assets/css/event.css')}}">

		<!-- NRS Sports Foundation StyleShet CSS -->
        <link rel="stylesheet" href="{{asset('themes-assets/css/reset.css')}}">
        <link rel="stylesheet" href="{{asset('themes-assets/style.css')}}">
        <link rel="stylesheet" href="{{asset('themes-assets/css/responsive.css')}}">
        <link rel="stylesheet" href="{{asset('themes-assets/lightbox.min.css')}}">
        <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=628c7ba9f90b850019d9cdef&product=sop' async='async'></script>
    </head>
    <body>
        
<!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "106572628677502");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v16.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
<!-- Start Header -->
<header id="header" class="header">
	<!-- Topbar -->
	<div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-12">
					<!-- Contact -->
					<ul class="contact">
						<li><i class="fa fa-headphones"></i>{{$setting->phone}}</li>
						<li><i class="fa fa-envelope"></i> <a href="mailto:{{$setting->email_primary}}">{{$setting->email_primary}}</a></li>

					</ul>
					<!--/ End Contact -->
				</div>
				<div class="col-lg-6 col-12">
					<div class="topbar-right">
						<!-- Social -->
						<ul class="social">
							<li><a href="{{$setting->twitter_link}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<li><a href="{{$setting->facebook_link}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
							<li><a href="{{$setting->linkedin_link}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
 							<li><a href="{{$setting->youtube_link}}" target="_blank"><i class="fa fa-youtube"></i></a></li>
						</ul>
						<!--/ End Social -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Topbar -->
	<!-- Middle Bar -->
	<div class="middle-bar">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-12">
					<!-- Logo -->
					<div class="logo">
						<a href="{{url('/')}}"><img src="{{asset('themes-assets/images/logo-white.png')}}" alt="logo"></a>
					</div>
					  <div class="link d-flex justify-content-between"><a href="{{url('/')}}"><img src="{{asset('themes-assets/images/logo-white.png')}}" width="180" class="img-fluid"  alt="logo"></a></div>
					<!--/ End Logo -->
					<button class="mobile-arrow"><i class="fa fa-bars"></i></button>
					<div class="mobile-menu"></div>
				</div>
				<div class="col-lg-10 col-12">
					<!-- Main Menu -->
					<div class="mainmenu">
						<nav class="navigation">
							<ul class="nav menu">
								<li class=""><a href="{{url('/')}}">Home</a></li>
                                @if ($navigations->count())
                                @foreach ($navigations as $row)
								<li><a href="{{ url('page/' . posttype_url($row->uri)) }}">{{$row->post_type}}</a></li>
	                            @endforeach
	                            @endif
                                <li class=" d-block d-md-none btn-nav" style="text-align:left; width:167px;">
                                Register Now
                                    <ul>
                                    @if($race_events->count()>0)
            						 @foreach($race_events as $row)
                                        <li><a href="{{url('register-now/'.$row->uri)}}">{{$row->name}}</a></li>
                                    @endforeach
                                    @endif
                                    </ul>
                                </li>
							</ul>
						</nav>
						<!-- Button -->
                       
                        @if($race_events->count()>0)
                        <div class="dropdown button">
                         <button class="btn contact-main dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Register Now</button>
                            <div class="dropdown-menu nav-bar-dropdown" aria-labelledby="dropdownMenuButton">
                                 @foreach($race_events as $row)
                                <a href="{{url('register-now/'.$row->uri)}}" target="_blank" class="dropdown-item" >{{$row->name}}</a>
                                @endforeach
                        </div>
                         @endif
                         
                               
                      
						<!--/ End Button -->
					</div>
					<!--/ End Main Menu -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Middle Bar -->
</header>
<!--/ End Header -->
