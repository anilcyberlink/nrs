@extends('themes.default.common.master')
@section('content')
<div class="uk-container uk-text-center uk-margin-large">
     
   @if(session('success_message'))
   <img src="{{asset('themes-assets/images/check-circle.gif')}}" width="150" height="150" >
    <h2 style="margin-bottom:0;"> {{session('success_message')}}</h2>
    <h3 style="margin:0;">Thank You! You have completed your registration process. @if(session('reg_no')) Your registration number is {{session('reg_no')}}.@endif</h3>
    @endif
   
       @if(session('failure_message'))
        <img src="{{asset('themes-assets/images/error.gif')}}" width="150" height="150">
         <h2 style="margin-bottom:0;"> {{session('failure_message')}}</h2>
    @endif
</div>
@endsection

