@extends('themes.default.common.master')
@section('title',$data->post_title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('thumbnail',$data->page_thumbnail)
@section('content')

<section class="breadcrumbs" style="height:30vh;background-image: url('{{asset('themes-assets/images/8sKoSJp.jpg')}}');">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2>{{$data->post_title}}</h2>
			</div>
		</div>
	</div>
</section>
<!--/ End Breadcrumbs -->

 <section class="blogs-main archives section">
    <div class="container">
      <div class="row">
            @foreach($gallery as $value)
           <div class="col-lg-4 col-md-6 col-12">
          <!-- Single Blog -->
          <div class="single-blog">
            <div class="blog-head">
              <a class="example-image-link"   data-lightbox="example-set" data-title="{{$value->title}}" href="{{asset('uploads/medium/'.$value->file_name)}}">
             <img src="{{asset('uploads/medium/'.$value->file_name)}}" class="img-fluid">
             </a>
             @if($value->title)
            <div class="blog-bottom">
              <div class="blog-inner">
                {{$value->title}}
              </div>
            </div>
            @endif
          </div>
          <!-- End Single Blog -->
        </div>
        </div>
            @endforeach
        </div>
        </div>
</section>
@endsection