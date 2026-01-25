@extends('themes.default.common.master')
@section('title',$data->post_title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('thumbnail',$data->page_thumbnail)
@section('content')
<section class="blogs-main archives section">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-12">
			<!-- Service Image -->
			@if($data->page_thumbnail)
			<div class="service-img">
				<img src="{{asset('uploads/original/'.$data->page_thumbnail)}}" alt="#">
			</div>
			@endif
			<!-- Service Content -->
			<div class="service-content">
				<h4>{{$data->post_title}}</h4>
				<hr>
			  {!!$data->post_content!!}
			</div>
		</div>
		<div class="col-lg-4 col-12">
			<div class="single-sidebar category">
				<h2><span> Services</span></h2>
				<ul>
                  @foreach($related as $value)
				    <li><a href="{{url(geturl($value->uri))}}">{{$value->post_title}}</a></li>
                  @endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
</section>
@stop
