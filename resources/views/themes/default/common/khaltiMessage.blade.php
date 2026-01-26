@extends('themes.default.common.master')
@section('content')
<div class="uk-container uk-text-center uk-margin-large">
                    @if(session('message'))
                    <div class="alert alert-success">
                        <img src="{{asset('themes-assets/images/tick-image.gif')}}" width="150" height="150" >
                        <h3 style="margin:0;">Thank You! You have completed your registration process. Your Registration No is: {{$regNumber}}</h3>
                        <br> 
                        <h2 style="margin-bottom:0;"> {{session('message')}} </h2>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger">
                        <img src="{{asset('themes-assets/images/wrong-red.gif')}}" width="150" height="150">
                       <h3> {{session('error')}}
                       </h3>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection