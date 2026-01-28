@extends('themes.default.common.master')
@section('title', $data->post_type)
@section('meta_keyword', $data->meta_keyword)
@section('meta_description', $data->meta_description)
@section('thumbnail', $data->banner)
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
<!-- <section id="partners" class="partners section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        @if($partner)
          <div class="section-title">
            <span class="title-bg">Clients</span>
            <h1>{{$partner->post_title}}</h1>
            <p>{{$partner->sub_title}}</p>
          </div>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="partners-inner">
          <div class="row no-gutters">
            @foreach($images as $value)
              <div class="col-lg-2 col-md-3 col-12">
                <div class="single-partner">
                  <a href="{{$value->title}}" target="_blank">
                    <img src="{{asset('uploads/medium/' . $value->file_name)}}" alt="#">
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->
<!--/ End Partners -->

<!-- Event -->
<section id="calendar" class="calendar section">
	<div class="container">
		<div class="row " style="margin-bottom:50px;">
			<div class="col-12 wow fadeInUp">
				<div class="section-title">
					<span class="title-bg">{{$event->post_type}}</span>
					<h1>Events Managed</h1>
					<p>{{$event->caption}}<p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12" style="padding:0px;">
				<div class="event-slider">
					@foreach($events as $row)
            <div class="single-calendar">
              <div class="center">
                <img src="{{ $row->page_thumbnail ? asset('uploads/original/'.$row->page_thumbnail) : asset('themes-assets/images/default.png') }}"
                  alt="{{ $row->post_title }}"
                  class="responsive openEventPopup"
                  data-title="{{ $row->post_title }}"
                  data-banner="{{ $row->page_thumbnail ? asset('uploads/original/'.$row->page_thumbnail) : asset('themes-assets/images/default.png') }}"
                  data-date="{{ $row->sub_title }}"
                  data-excerpt="{{ strip_tags($row->associated_title) }}"
                  data-url="{{ $row->external_link ? $row->external_link : route('page.pagedetail', ['uri' => $row['uri']]) }}"
                  data-external="{{ $row->external_link ? '1' : '0' }}"
                  style="width:200px;height:250px;object-fit:contain;"
                >
                  
                <h1>{{$row->post_title}}</h1>
                <p>
                  <a href="javascript:void(0)"
                    class="openEventPopup"
                    data-title="{{ $row->post_title }}"
                    data-banner="{{ $row->page_thumbnail ? asset('uploads/original/'.$row->page_thumbnail) : asset('themes-assets/images/default.png') }}"
                    data-date="{{ $row->sub_title }}"
                    data-excerpt="{{ strip_tags($row->associated_title) }}"
                    data-url="{{ $row->external_link ? $row->external_link : route('page.pagedetail', ['uri' => $row['uri']]) }}"
                    data-external="{{ $row->external_link ? '1' : '0' }}">
                    <span class="timeline-event">Event</span>
                  </a>

                  <span class="timeline-date">{{$row->sub_title}}</span>
                </p>
              </div>
            </div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<!-- pop up madal -->
<div class="event-popup-overlay" style="display:none;">
  <div class="event-popup">
    <span class="event-close">&times;</span>

    <h3 id="popupTitle"></h3>
    <img id="popupBanner" src="" alt="" />
    <h4 class="popup-date" id="popupDate"></h4>
    <p id="popupExcerpt"></p>

    <a href="#" id="popupUrl" class="btn primary">View Detail</a>
  </div>
</div>


<style>
  .event-popup-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .event-popup {
    background: #fff;
    width: 90%;
    max-width: 420px;
    padding: 20px;
    border-radius: 6px;
    position: relative;
    text-align: center;
  }

  .event-popup img {
    max-width: 100%;
    height: auto;
    margin: 10px 0;
  }

  .popup-date {
    font-size: 14px;
    color: #777;
    margin-bottom: 10px;
  }

  .event-close {
    position: absolute;
    right: 12px;
    top: 8px;
    font-size: 22px;
    cursor: pointer;
  }
</style>

@stop