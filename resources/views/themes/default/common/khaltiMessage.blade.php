@extends('themes.default.common.master')

@section('content')

{{-- FULL WIDTH BACKGROUND (theme-controlled) --}}
<div style="background:#e6f7e9; padding:60px 0;">

    {{-- CENTERED CONTENT WRAPPER --}}
    <div style="
        max-width:900px;
        margin:0 auto;
        padding:40px;
        background:#e6f7e9;
    ">

        {{-- SUCCESS --}}
        @if(session('message'))
            <div style="text-align:center;">

                <img src="{{ asset('themes-assets/images/tick-image.gif') }}"
                    width="120" height="120"
                    style="display:block; margin:0 auto 20px;">


                <h2 style="color:#1b5e20; font-weight:700;">
                    Registered. Ready. Run!
                </h2>

                <p style="font-size:18px; color:#2e7d32;">
                    Thank you for registering, see you at the start line!
                </p>

                <p style="margin-top:15px;">
                    {{ session('message') }}
                </p>

                <hr style="margin:30px 0;">

                <div style="display:flex; justify-content:space-around; flex-wrap:wrap;">

                    <div style="margin-bottom:20px;">
                        <strong>Registration Number</strong>
                        <h3>{{ $regNumber ?? 'N/A' }}</h3>
                    </div>

                    <div>
                        <strong>Bib Collection Date</strong>
                        <h4>9th May</h4>
                    </div>

                </div>

                <a href="{{ url('/') }}"
                   style="
                     display:inline-block;
                     margin-top:30px;
                     padding:10px 30px;
                     background:#1b5e20;
                     color:#fff;
                     border-radius:25px;
                     text-decoration:none;
                   ">
                    Go to Home
                </a>
            </div>
        @endif

        {{-- ERROR --}}
        @if(session('error'))
            <div style="text-align:center;">

                <img src="{{ asset('themes-assets/images/wrong-red.gif') }}"
                    width="120" height="120"
                    style="display:block; margin:0 auto 20px;">

                <h2 style="color:#b71c1c;">
                    Registration Failed
                </h2>

                <p style="font-size:18px; color:#c62828;">
                    {{ session('error') }}
                </p>
                <hr style="margin:30px 0;">

                @if($regNumber)
                    <div style="display:flex; justify-content:space-around; flex-wrap:wrap;">

                        <div style="margin-bottom:20px;">
                            <strong>Registration Number</strong>
                            <h3>{{ $regNumber }}</h3>
                        </div>
                    </div>
                @endif

                <a href="{{ url('/') }}"
                   style="
                     display:inline-block;
                     margin-top:30px;
                     padding:10px 30px;
                     background:#b71c1c;
                     color:#fff;
                     border-radius:25px;
                     text-decoration:none;
                   ">
                    Go to Home
                </a>
            </div>
        @endif

    </div>
</div>

@endsection
