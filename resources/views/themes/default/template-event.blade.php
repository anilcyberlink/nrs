@extends('themes.default.common.master')
@section('title',$data->post_title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('thumbnail',$data->page_thumbnail)
@section('content')
<!-- HERO BANNER -->
<section class="event-hero"
    style="background-image: url('{{ asset('uploads/large/'.$data->banner ?? 'default-banner.jpg') }}');">
    <div class="event-hero-overlay">
        <div class="container">
            <div class="event-hero-text">
                <h1>{{$data->post_title}}</h1>
                <p class="subtitle">{{$data->sub_title}}</p>
            </div>
        </div>
    </div>
</section>

<!-- MAIN PAGE CONTENT -->
<section class="event-details section pt-5 pb-5">
    <div class="container">
        <div class="row">

            <!-- LEFT CONTENT -->
            <div class="col-lg-8 col-12">

                <!-- ABOUT EVENT -->
                <div class="event-about mb-4">
                    <h3>Event Overview</h3>
                    {!! $data->post_excerpt !!}
                    <div class="event-route mb-4">
                    <img src="{{asset('uploads/original/'.$data->page_thumbnail)}}" alt="{{$data->post_title}}" class="img-fluid rounded">
                </div>
                </div>

                <!-- ROUTE & DETAILS -->
                <div class="event-route mb-4">
                    <h4>Route Map & Details</h4>
                    <img src="{{asset('uploads/medium/'.$data->banner)}}" alt="{{$data->post_title}}" class="img-fluid rounded">
                </div>

                <!-- EVENT DESCRIPTION -->
                <div class="event-description">
                    <h4>Description</h4>
                    {!! $data->post_content !!}
                </div>

            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="col-lg-4 col-12">

                <div class="event-sidebar">

                    <h4 class="sidebar-title">Other Ongoing Events</h4>

                    <ul class="related-events list-unstyled">
                        <li>
                        @foreach($related as $value)
                            @if( $value->external_link )
                                <a href="{{ $value->external_link }}" target="_blank">
                                    <span class="event-name">{{$value->post_title}}</span> <br>
                                    <small>{{$value->sub_title}} </small>
                                </a>
                            @else
                                <a href="{{ route('page.pagedetail', ['uri' => $value['uri']]) }}">
                                    <span class="event-name">{{$value->post_title}}</span> <br>
                                    <small>{{$value->sub_title}} </small>
                                </a>
                            @endif
                        @endforeach
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</section>

<style>
    /* HERO BANNER */
.event-hero {
    height: 100px;              /* 👈 smaller height like marathon site */
    background-size: cover;
    background-position: center;
    position: relative;
}

.event-hero-overlay {
    height: 100%;
    background: linear-gradient(
        to right,
        rgba(112, 2, 2, 0.65),
        rgba(20, 19, 102, 0.35)
    );                          /* 👈 similar dark overlay */
    display: flex;
    align-items: center;
}

.event-hero-text h1 {
    color: #fff;
    font-size: 30px;            /* 👈 smaller heading */
    font-weight: 700;
    margin-bottom: 5px;
}

.event-hero-text .subtitle {
    color: #eaeaea;
    font-size: 14px;
}

/* MAIN CONTENT */
.event-details {
    padding-top: 40px;
    padding-bottom: 60px;
}

.event-about,
.event-route,
.event-description {
    margin-bottom: 40px;
}

/* INFO CARDS */
.event-info-cards .info-card {
    background: #f9f9f9;
    padding: 12px 15px;
    border-radius: 6px;
    border-left: 4px solid #ff4500;
}

.event-info-cards .info-card h5 {
    margin: 0 0 4px;
    font-weight: bold;
}

/* SIDEBAR */
.event-sidebar {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #ececec;
}

.sidebar-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 15px;
}

.related-events li a {
    display: block;
    padding: 10px 0;
    font-size: 16px;
    color: #333;
    text-decoration: none;
}

.related-events li a:hover {
    color: #ff4500;
}

</style>
@stop
