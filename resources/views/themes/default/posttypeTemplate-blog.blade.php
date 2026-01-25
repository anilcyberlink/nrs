@extends('themes.default.common.master')
@section('title',$data->post_title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('thumbnail',$data->page_thumbnail)
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

  <!-- Blogs Area -->
  @if($posts->count()>0)
  <section class="blogs-main archives section">
    <div class="container">
      <div class="row">
        @foreach($posts as $value)
        <div class="col-lg-4 col-md-6 col-12">
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
                {!! Str::limit($value->post_excerpt,250) !!}
                
              </div>
            </div>
          </div>
          <!-- End Single Blog -->
        </div>
        @endforeach
      </div>
    
    </div>
  </section>
  @endif
  <!--/ End Blogs Area -->

@endsection
