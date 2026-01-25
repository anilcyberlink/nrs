@extends('themes.default.common.master')
@section('title',$data->post_type)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('thumbnail',$data->banner)
@section('content')
@if($data->banner)
<section class="breadcrumbs" style="background-image: url('{{asset('uploads/original/'.$data->banner)}}');">
	@else
<section class="breadcrumbs" style="background-image: url('{{asset('themes-assets/images/8sKoSJp.jpg')}}');">
	@endif
	 <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>{{$data->post_type}}</h2>
        </div>
      </div>
    </div>
  </section>
  <!--/ End Breadcrumbs -->

<!-- Start Contact -->
<section id="contact-us" class="contact-us section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<span class="title-bg">NRS Sports </span>
					<h1>{{$data->post_type}}</h1>
					<p>{{$data->caption}}<p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="contact-main">
					<div class="row">
						<!-- Contact Form -->
						<div class="col-lg-8 col-12">
							{!!$setting->google_map2!!}
						</div>
						<!--/ End Contact Form -->
						<!-- Contact Address -->
						<div class="col-lg-4 col-12">
							<div class="contact-address">
								<!-- Address -->
								<div class="contact">
									<h2>Our Contact Address</h2>
									<ul class="address">
										<li><i class="fa fa-paper-plane"></i><span>Address: </span>{{$setting->location1}}</li>
										<li><i class="fa fa-phone"></i><span>Phone: </span>{{$setting->phone}} </li>
										<li class="email"><i class="fa fa-envelope"></i><span>Email: </span><a href="mailto:{{$setting->email_primary}}">{{$setting->email_primary}}</a></li>
									</ul>
								</div>
								<!--/ End Address -->
								<!-- Social -->
								<ul class="social">
									<li class="active"><a href="{{$setting->facebook_link}}" target="_blank"><i class="fa fa-facebook"></i>Like Us facebook</a></li>
									<li><a href="{{$setting->twitter_link}}" target="_blank"><i class="fa fa-twitter"></i>Follow Us twitter</a></li>
									<li><a href="{{$setting->youtube_link}}" target="_blank"><i class="fa fa-youtube"></i>Follow Us google-plus</a></li>
									<li><a href="{{$setting->linkedin_link}}" target="_blank"><i class="fa fa-linkedin"></i>Follow Us linkedin</a></li>

								</ul>
								<!--/ End Social -->
							</div>
						</div>
						<!--/ End Contact Address -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ End Contact -->

@endsection
