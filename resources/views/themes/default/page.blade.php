@extends('themes.default.common.master')
@section('title',$data->post_type)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('thumbnail',$data->banner)
@section('content')

<section class="breadcrumbs" style="background-image: url('{{asset('themes-assets/images/8sKoSJp.jpg')}}');">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>{{$data->post_type}}</h2>
      </div>
    </div>
  </div>
</section>
<!--/ End Breadcrumbs -->

  <!-- About Us -->
  <section class="about-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-12">
          <!-- Video -->
          <div class="about-video">
            <div class="single-video overlay">
              <img src="{{asset('uploads/original/' . $data->banner)}}" alt="#">
            </div>
          </div>
          <!--/ End Video -->
        </div>
        <div class="col-lg-6 col-12">
          <!-- About Content -->
          <div class="about-content">
            <h2>{{$data->caption}}</h2>
            {!!$data->content!!}
          </div>
          <!--/ End About Content -->
        </div>
      </div>

    </div>
  </section>
  <!--/ End About Us -->

  <!-- Partners -->
  <section id="partners" class="partners section">
    <div class="container">
      <div class="row">
        <div class="col-12 wow fadeInUp">
            @if($partner)
          <div class="section-title">
            <span class="title-bg">Clients</span>
            <h1>{{$partner->post_title}}</h1>
            <p>{{$partner->sub_title}}<p>
          </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="partners-inner">
            <div class="row no-gutters">
              <!-- Single Partner -->
              @foreach($images as $value)
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
    </div>
  </section>
  <!--/ End Partners -->

  @stop
