@extends('themes.default.common.master')
@section('content')
<section class="blogs-main archives single section">
    <div class="container">
<div class="container-fluid register">

    <h1>View Application</h1>    
    <hr>
    @if(session()->has('message'))
     <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session()->get('message') }}
    </div>
    @endif

    @if(session()->has('error'))
     <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session()->get('error') }}
    </div>
    @endif
    <form action="{{route('application-view')}}" method="post">
    @csrf
    <div class="row">
        <div class="form-group col-sm-6">
            <label>Request Number:</label>
            <input type="text" class="form-control" name="reg_no" required>
        </div>
        <div class="form-group col-sm-6">
            <label>Email Address:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
         <div class="form-group col-sm-4"></div>
        <div class="form-group col-sm-4">
         <button type="submit" class="btn">Submit</button>
        </div>
        <div class="form-group col-sm-4"></div>
    </div>
    </form>   
    </div>
</div>
</section>
@endsection