@extends('themes.default.common.master')
@section('title',$data->post_title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('thumbnail',$data->page_thumbnail)
@section('content')
@if($data->banner)
<section class="breadcrumbs" style="background-image: url('{{asset('uploads/original/'.$data->banner)}}');">
  @else
<section class="breadcrumbs" style="height:30vh;background-image: url('{{asset('themes-assets/images/8sKoSJp.jpg')}}');">
  @endif
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2>Gallery</h2>
			</div>
		</div>
	</div>
</section>
<!--/ End Breadcrumbs -->

 <section class="blogs-main archives section">
    <div class="container">
      <div class="row">
          @if($posts->count()>0)
            @foreach($posts as $value)
           <div class="col-lg-4 col-md-6 col-12">
          <!-- Single Blog -->
          <div class="single-blog">
            <div class="blog-head">
             <a href="{{ url(geturl($value['uri'], $value['page_key'])) }}">
             @if($value->page_thumbnail)
                <img src="{{asset('uploads/original/'.$value->page_thumbnail)}}" class="img-fluid">
              @else
              <img src="{{asset('themes-assets/images/default.png')}}" class="img-fluid">
              @endif
            </a>
            <div class="blog-bottom">
              <div class="blog-inner">
                <b><a href="{{ url(geturl($value['uri'], $value['page_key'])) }}">{{$value->post_title}}</a></b>
              </div>
            </div>
          </div>
          <!-- End Single Blog -->
        </div>
        </div>
            @endforeach
           
            @endif
        </div>
        </div>
</section>


@endsection