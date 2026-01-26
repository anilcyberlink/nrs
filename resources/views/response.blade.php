@extends('themes.default.common.master')

@section('content')

<div style="background:#e6f7e9; padding:60px 0;">

    <div style="
        max-width:900px;
        margin:0 auto;
        padding:40px;
        text-align:center;
    ">

        {{-- SUCCESS --}}
        @if(session('success_message'))

            <img src="{{ asset('themes-assets/images/check-circle.gif') }}"
                 width="120" height="120"
                 style="display:block; margin:0 auto 20px;">

            <h2 style="color:#1b5e20; font-weight:700; margin-bottom:5px;">
                Registered. Ready. Run!
            </h2>

            <p style="font-size:18px; color:#2e7d32; margin-top:0;">
                Thank you for registering, see you at the start line!
            </p>

            <p style="margin-top:10px; color:#444;">
                {{ session('success_message') }}
            </p>

            <hr style="margin:30px 0;">

            <div style="
                display:flex;
                justify-content:space-around;
                flex-wrap:wrap;
                gap:30px;
            ">

                <div>
                    <strong>Registration Number</strong>
                    <h3 style="margin-top:5px;">
                        {{ session('reg_no') ?? 'N/A' }}
                    </h3>
                </div>

                <div>
                    <strong>Bib Collection Date</strong>
                    <h4 style="margin-top:5px;">
                        9th May
                    </h4>
                </div>

            </div>

            <a href="{{ url('/') }}"
               style="
                    display:inline-block;
                    margin-top:35px;
                    padding:10px 35px;
                    background:#1b5e20;
                    color:#fff;
                    border-radius:25px;
                    text-decoration:none;
                    font-weight:600;
               ">
                Go to Home
            </a>

        @endif


        {{-- FAILURE --}}
        @if(session('failure_message'))

            <img src="{{ asset('themes-assets/images/error.gif') }}"
                 width="120" height="120"
                 style="display:block; margin:0 auto 20px;">

            <h2 style="color:#b71c1c; font-weight:700;">
                Payment Failed
            </h2>

            <p style="font-size:18px; color:#c62828;">
                {{ session('failure_message') }}
            </p>

            <a href="{{ url('/') }}"
               style="
                    display:inline-block;
                    margin-top:35px;
                    padding:10px 35px;
                    background:#b71c1c;
                    color:#fff;
                    border-radius:25px;
                    text-decoration:none;
                    font-weight:600;
               ">
                Go to Home
            </a>

        @endif

    </div>

</div>

@endsection
