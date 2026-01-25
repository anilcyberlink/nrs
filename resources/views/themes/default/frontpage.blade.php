@extends('themes.default.common.master')
@section('content')
<!-- Hero Area -->
<section id="hero-area" class="hero-area">
  <!-- Slider -->
  <div class="slider-area">
    <!-- Single Slider -->
    @foreach($banner as $value)
    @if($loop->iteration %2 != 0)
    <div class="single-slider" style="background-image:url('{{asset('uploads/banners/'.$value->picture)}}')">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 col-md-6 col-12">
            <!-- Slider Text -->
            <div class="slider-text">
                <h1>{{$value->title}}</h1>
                 <p>{{$value->content}}</p>
              <!--<div class="button">-->
              <!--  <a href="{{ url('page/' . posttype_url('services')) }}" class="btn">Our Services</a>-->
              <!--</div>-->
            </div>
            <!--/ End Slider Text -->
          </div>
          <div class="col-lg-5 col-md-6 col-12">
            <!-- Image Gallery -->
            <div class="image-gallery">
              <div class="single-image">
                <img src="{{asset('uploads/banners/'.$value->picture)}}" alt="#">
              </div>

            </div>
            <!--/ End Image Gallery -->
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="single-slider slider-right" style="background-image:url('{{asset('uploads/banners/'.$value->picture)}}')">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-6 col-12">
            <!-- Image Gallery -->
            <div class="image-gallery">
              <div class="single-image">
                <img src="{{asset('uploads/banners/'.$value->picture)}}" alt="#">
              </div>

            </div>
            <!--/ End Image Gallery -->
          </div>
          <div class="col-lg-7 col-md-6 col-12">
            <!-- Slider Text -->
            <div class="slider-text text-right">
              <h1>{{$value->title}}</h1>
              {!!$value->content!!}
              <!--<div class="button">-->
              <!--  <a href="{{ url('page/' . posttype_url('services')) }}" class="btn">Our Services</a>-->
              <!--</div>-->
            </div>
            <!--/ End Slider Text -->
          </div>
        </div>
      </div>
    </div>
    @endif
    @endforeach
    <!--/ End Single Slider -->
    <!-- Single Slider -->

    <!--/ End Single Slider -->

  </div>
  <!--/ End Slider -->
</section>
<!--/ End Hero Area -->

<!-- About Us -->
<section class="about-us section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title wow fadeInUp">
          <h1>{{$about->post_type}}</h1>
          <p>{{$about->caption}}</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-12 wow fadeInLeft" data-wow-delay="0.6s">
        <!-- Video -->
        <div class="about-video">
          <div class="single-video overlay">
            <img src="{{asset('uploads/original/' . $about->banner)}}" alt="#">
          </div>
        </div>
        <!--/ End Video -->
      </div>
      <div class="col-lg-6 col-12 wow fadeInRight" data-wow-delay="0.8s">
        <!-- About Content -->
        <div class="about-content">
           {!!$about->content!!}
        </div>
        <!--/ End About Content -->
      </div>
    </div>

  </div>
</section>
<!--/ End About Us -->
@if($events->count()>0)
<!-- Event calendar -->
<section id="calendar" class="calendar section">
	<div class="container">
		<div class="row " style="margin-bottom:50px;">
			<div class="col-12 wow fadeInUp">
				<div class="section-title">
					<span class="title-bg">{{$event->post_type}}</span>
					<h1>{{$event->uid}}</h1>
					<p>{{$event->caption}}<p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12" style="padding:0px;">
				<div class="calendar-slider">
					<!-- Single Service -->
					@foreach($events as $row)
					<div class="single-calendar">
						<div class="center">
							@if($row->page_thumbnail)
                            <img src="{{asset('uploads/original/'.$row->page_thumbnail)}} " alt="" class="responsive" style="width:200px;height: 250px;object-fit: contain;">
                            @else
                            <img src="{{asset('themes-assets/images/default.png')}} " alt="" class="responsive" style="width:200px;height: 250px;object-fit: contain;">
                            @endif
							<h1>{{$row->post_title}}</h1>
							<p>
							   <a href="{{$row->external_link}}"><span class="timeline-event">Event</span></a>
							<span class="timeline-date">{{$row->sub_title}}</span>
							</p>
						</div>
					</div>
					@endforeach
					<!-- End Single Service -->
					
				</div>
			</div>
			<div class="col-12 d-flex justify-content-center " style="padding:25px;" >
				<div class="arrow">
					<a href="{{ url('page/' . posttype_url($event->uri)) }}" class="btn primary">Know More</a>
				</div>
		    </div>
		</div>
	</div>
</section>
<!-- End Event Calendar -->
@endif
@if($services->count()>0)
<!-- Services -->
<section id="services" class="services section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <span class="title-bg">{{$service->post_type}}</span>
          <h1>{{$service->uid}}</h1>
          <p>{{$service->caption}}</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="service-slider">
          <!-- Single Service -->
          @foreach($services as $value)
          <div class="single-service">
              @if($value->page_thumbnail)
              <img src="{{asset('uploads/original/'.$value->page_thumbnail)}}" alt="{{$value->post_title}}">
              @else
              <img src="{{asset('themes-assets/images/default.png')}}">
              @endif
            <h2><a href="{{ url(geturl($value['uri'], $value['page_key'])) }}">{{$value->post_title}}</a></h2>
            {!!strip_tags(Str::limit($value->post_excerpt, 150)) !!}
           
          </div>
          @endforeach
          <!-- End Single Service -->

        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Services -->
@endif
<!-- Fun Facts -->
<?php /*?>
<section id="fun-facts" class="fun-facts section">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-12 wow fadeInLeft" data-wow-delay="0.5s">
        <div class="text-content">
          <div class="section-title">
            <h1><span>{{$achievement->post_type}}</span>{{$achievement->uid}}</h1>
            <p>{{$achievement->caption}}</p>
            <a href="{{ url('page/' . posttype_url('contact-us')) }}" class="btn primary">Contact Us</a>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-12">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="0.6s">
            <!-- Single Fact -->
            <div class="single-fact">
              <div class="icon"><i class="fa fa-clock-o"></i></div>
              <div class="counter">
                <p><span class="count">{{$setting->field1}}</span></p>
                <h4>years of success</h4>
              </div>
            </div>
            <!--/ End Single Fact -->
          </div>
          <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="0.8s">
            <!-- Single Fact -->
            <div class="single-fact">
              <div class="icon"><i class="fa fa-bullseye"></i></div>
              <div class="counter">
                <p><span class="count">{{$setting->field2}}</span>K</p>
                <h4>Project Complete</h4>
              </div>
            </div>
            <!--/ End Single Fact -->
          </div>
          <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="1s">
            <!-- Single Fact -->
            <div class="single-fact">
              <div class="icon"><i class="fa fa-dollar"></i></div>
              <div class="counter">
                <p><span class="count">{{$setting->field3}}</span>K</p>
                <h4>Total Earnings</h4>
              </div>
            </div>
            <!--/ End Single Fact -->
          </div>
          <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="1.2s">
            <!-- Single Fact -->
            <div class="single-fact">
              <div class="icon"><i class="fa fa-trophy"></i></div>
              <div class="counter">
                <p><span class="count">{{$setting->field4}}</span></p>
                <h4>Winning Awards</h4>
              </div>
            </div>
            <!--/ End Single Fact -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Fun Facts -->
<?php */?>

@if($blogs->count()>0)
<!-- Blogs Area -->
<section class="blogs-main section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <span class="title-bg">News</span>
          <h1>Latest {{$blog->post_type}}</h1>
          <p>{{$blog->caption}}<p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="row blog-slider">
          @foreach($blogs as $value)
          <div class="col-lg-4 col-12">
            <!-- Single Blog -->
            <div class="single-blog">
              <div class="blog-head">
                  @if($value->page_thumbnail)
              <img src="{{asset('uploads/original/'.$value->page_thumbnail)}}" alt="{{$value->post_title}}">
              @else
              <img src="{{asset('themes-assets/images/default.png')}}">
              @endif
              </div>
              <div class="blog-bottom">
                <div class="blog-inner">
                  <h4><a href="{{ url(geturl($value['uri'], $value['page_key'])) }}">{{$value->post_title}}</a></h4>
                 {!! strip_tags(Str::limit($value->post_excerpt, 150)) !!}
                </div>
              </div>
            </div>
            <!-- End Single Blog -->
          </div>
        @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Blogs Area -->
@endif
<!-- Partners -->
@if($partner)
<section id="partners" class="partners section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <span class="title-bg">Clients</span>
          <h1>{{$partner->post_title}}</h1>
          <p>{{$partner->sub_title}}<p>
        </div>
      </div>
    </div>
    @if($logo->count()>0)
        <div class="row">
      <div class="col-12">
        <div class="partners-inner">
          <div class="row no-gutters">
            <!-- Single Partner -->
            @foreach($logo as $value)
            <div class="col-lg-2 col-md-3 col-12">
              <div class="single-partner">
                <a href="{{$value->title}}" target="_blank">
                  <img src="{{asset('uploads/medium/'.$value->file_name)}}" alt="#">
                </a>
              </div>
            </div>
              @endforeach
            <!--/ End Single Partner -->

          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</section>
@endif
<!--/ End Partners -->
@if($popup->count()>0)
@foreach($popup as $row)
 <!--modal start -->
<div id="Modal{{$loop->iteration}}" class="modal fade p-0" role="dialog" style="z-index:99999;">
	<div class="modal-dialog ">
		 <!--Modal content-->
		<div class="modal-content">
			<div class="modal-header pb-0 border-0">
				<h5 class="pb-0">{{$row->post_title}}</h5>
				 <button type="button" class="close primary-close-button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="primary-close">&times;</span>
                </button>
			</div>
			<div class="modal-body p-0">
				<div class=" d-flex justify-content-center">
					<img src="{{asset('uploads/original/'.$row->page_thumbnail)}}" alt="" style="height:420px; object-fit:contain ;">
				</div>
				<div class="p-3" style=" border-top: 1px solid #8080804f; margin-top: 7px; text-align:center;">
				    <div class="arrow">
				        @if($row->external_link)
			            <a href="{{$row->external_link}}" class="btn primary">Register Now</a>
			            @endif
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>
 <!--modal end -->
@endforeach
@endif
@stop