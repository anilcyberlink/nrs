@extends('themes.default.common.master')
@section('title',$data->post_title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('thumbnail',$data->page_thumbnail)
@section('content')
<div class="timeline-container " >
  <ul class="vertical-scrollable-timeline" id="vertical-scrollable-timeline">
    <div class="list-progress">
      <div class="inner"></div>
     </div>
      @if($posts->count()>0)
      @foreach($posts as $value)
  <li>
    <div class="row wow fadeInUp">
        <div class="col-lg-2 col-md-5 col-sm-12 history-image" >
        @if($value->page_thumbnail)
        <img src="{{asset('uploads/original/'.$value->page_thumbnail)}} " alt="" style="object-fill: contain;"  class="responsive" >
        @else
        <img src="{{asset('themes-assets/images/default.png')}} " alt="" style="object-fill: contain;"   class="responsive" >
        @endif
        </div>
        <div class="col-lg-10 col-md-7 col-sm-12 history-content">
            <h2>{{$value->post_title}}</h2>
            <p class="top-p"><span class="timeline-event"> Event</span> <span class="history-date">{{$value->sub_title}}</span> </p>
            <p class="bottom-p">{!!$value->post_excerpt!!}</p>
        </div>
    </div>
    <div class="icon-holder">
      <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </div>
    <div class="division" ></div>
  </li>
  @endforeach
  @endif
</ul>
</div>

@endsection