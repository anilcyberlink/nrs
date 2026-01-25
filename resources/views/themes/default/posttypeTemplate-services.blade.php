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

		<!-- Services -->
		<section id="services" class="services archives section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<span class="title-bg">{{$data->post_type}}</span>
							<h1>{{$data->uid}}</h1>
							<p>{{$data->caption}}<p>
						</div>
					</div>
				</div>
				<div class="row">
					@foreach($posts as $value)
					<div class="col-lg-4 col-md-6 col-12">
						<!-- Single Service -->
						<div class="single-service">
						 @if($value->page_thumbnail)
                          <img src="{{asset('uploads/original/'.$value->page_thumbnail)}}" alt="{{$value->post_title}}">
                          @else
                          <img src="{{asset('themes-assets/images/default.png')}}">
                          @endif
							<h2><a href="{{ url(geturl($value['uri'], $value['page_key'])) }}">{{$value->post_title}}</a></h2>
						  {!! Str::limit($value->post_excerpt, 150) !!}
						</div>
						<!-- End Single Service -->
					</div>
					@endforeach

				</div>
			</div>
		</section>
		<!--/ End Services -->

@stop
