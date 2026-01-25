@extends('themes.default.common.master')
@section('title',$data->post_title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('thumbnail',$data->page_thumbnail)
@section('content')
<!-- Blogs Area -->
  <section class="blogs-main archives single section">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1 col-12">
          <div class="row">
            <div class="col-12">
              <!-- Single Blog -->
              <div class="single-blog">
                  @if($data->page_thumbnail)
                <div class="blog-head" style="height:500px;">
                  <img src="{{asset('uploads/original/'.$data->page_thumbnail)}}" alt="{{$data->post_title}}">
                </div>
                @endif
                <div class="blog-inner">
                  <div class="blog-top">

                    <!-- ShareThis BEGIN -->
                    <div class="sharethis-inline-share-buttons"></div>
                    <!-- ShareThis END -->
                  </div>
                  <h2>{{$data->post_title}}</h2>
                    {!!$data->post_content!!}
                      <div class="bottom-area">
                  </div>
                </div>
              </div>
              <!-- End Single Blog -->
            </div>

          </div>
        </div>
       
      </div>
    </div>
  </section>
  <!--/ End Blogs Area -->
  @stop
