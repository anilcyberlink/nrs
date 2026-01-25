@extends('admin.master')
@section('title','Event Category')
@section('breadcrumb')
     <a href="admin/event-category" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')

<form class="form-horizontal" role="form" action="{{ url('admin/'.Request::segment(2).'/'.$data->id) }}" method="POST" enctype="multipart/form-data">
           {{ csrf_field() }}         
<div class="col-md-12">
    <!-- Input Fields -->
    <div class="panel">
      <div class="panel-heading">
        <span class="panel-title">Edit Event Category</span>
      </div>
      <div class="panel-body"> 
     
          <div class="form-group">
            <label for="inputStandard" class="col-lg-2 control-label">Name</label>
            <div class="col-lg-4">
              <div class="bs-component">
                <input type="text" id="inputStandard" name="name" class="form-control" value="{{$data->name}}"/>
                <input name="_method" type="hidden" value="PATCH">
              </div>
            </div>
          </div>
        <div class="form-group">
            <label for="inputStandard" class="col-lg-2 control-label">Event</label>
            <div class="col-lg-4">
              <div class="bs-component">
                 <select name="event" class="form-control">
                    <option value="0"> Select Event </option>
                    @if($company)
                    @foreach($company as $row)
                    <option value="{{$row->id}}" {{ ($row->id == $data->event )?'selected':'' }}> {{$row->name}}</option>
                    @endforeach  
                    @endif 
                  </select>                       
              </div>
            </div>
          </div>
            <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">Application Type</label>
              <div class="col-lg-4">
                <div class="bs-component">                  
                   <select name="type" class="form-control">
                      <option value="individual" id="individual" {{ ($data->type == 'indiviual' )?'selected':'' }}> Individual Entry</option>
                      <option value="group" id="group" {{ ($data->type == 'group' )?'selected':'' }}> Group Entry</option>               
                   </select>  
                </div>
              </div>
            </div>
          <div class="form-group">
            <label for="inputStandard" class="col-lg-2 control-label">Price</label>
            <div class="col-lg-4">
              <div class="bs-component">
                <input type="number" id="inputStandard" name="price" class="form-control" placeholder="" value="{{$data->price}}"/>
              </div>
            </div>
          </div>
           <div class="form-group">
            <label for="inputStandard" class="col-lg-2 control-label"> Status</label>
            <div class="col-lg-4">
              <div class="bs-component">
                <input type="checkbox" name="status" value="{{ $data->status }}" {{ ($data->status == 1)?'checked':'' }} /> Enable/Disable <br>
              </div>
            </div>
          </div>             
         
          <div class="form-group">
            <label class="col-lg-2 control-label" for=""></label>
            <div class="col-lg-4">
              <div class="bs-component">
                <input type="submit" class="form-control btn btn-primary" name="submit" value="Submit" />
              </div>
            </div>
          </div> 
        
      </div>
    </div>          
  </div> 
</form>
@endsection