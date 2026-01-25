@extends('admin.master')
@section('title','Banner')
@section('breadcrumb')
     <a href="admin/event" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')

<form class="form-horizontal" role="form" action="{{ url('admin/'.Request::segment(2).'/'.$data->id) }}" method="POST" enctype="multipart/form-data">
           {{ csrf_field() }}         
<div class="col-md-12">
      <!-- Input Fields -->
      <div class="panel">
        <div class="panel-heading">
          <span class="panel-title">Edit Event</span>
        </div>
        <div class="panel-body"> 
       
            <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">Name</label>
              <div class="col-lg-6">
                <div class="bs-component">
                  <input type="text" id="name" name="name" class="form-control" value="{{$data->name}}"/>
                  <input name="_method" type="hidden" value="PATCH">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">URI</label>
              <div class="col-lg-6">
                <div class="bs-component">
                   <input type="text" id="uri" name="uri" class="form-control" value="{{$data->uri}}" readonly/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">Caption</label>
              <div class="col-lg-6">
                <div class="bs-component">
                  <input type="text" id="inputStandard" name="caption" class="form-control" value="{{$data->caption}}"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-2 control-label" for="banner">Picture</label>
              <div class="col-lg-6">
                <div class="bs-component">
                  <input type="file" class="form-control" name="banner"/>
                </div> <br />
                 ( Width: 1900px, Height:560px all time fix size )
              </div>

            </div>

            @if($data->banner != '' OR $data->banner != null)
            <div class="form-group">
              <label class="col-lg-2 control-label" for="banner"></label>
              <div class="col-lg-6">
                <div class="bs-component">
                  <img src="{{url(env('PUBLIC_PATH').'uploads/banners/' . $data->banner )}}" width="70%" />
                </div>
              </div>
            </div>
            @endif

             <div class="form-group">
                <label class="col-lg-2 control-label" for="textArea3"> Brief </label>
                <div class="col-lg-9">
                    <div class="bs-component">
                        <textarea class="form-control my-editor" id="" name="brief"
                                  rows="6"> {{$data->brief}}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label" for="textArea2">Content</label>
                <div class="col-lg-10">
                    <div class="bs-component">
                        <textarea class="form-control my-editor" id="editor2" name="content"
                                  rows="12"> {{$data->content}}</textarea>
                    </div>
                </div>
                    </div>


             <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label"> Status</label>
              <div class="col-lg-6">
                <div class="bs-component">
                  <input type="checkbox" name="status" value="{{ $data->status }}" {{ ($data->status == 1)?'checked':'' }} /> Enable/Disable <br>
                </div>
              </div>
            </div>             
           
            <div class="form-group">
              <label class="col-lg-2 control-label" for=""></label>
              <div class="col-lg-6">
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
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#name').on('keyup', function () {
                var name;
                name = $('#name').val();
                name = name.replace(/[^a-zA-Z0-9 ]+/g, "");
                name = name.replace(/\s+/g, "-");
                $('#uri').val(name);
            });
        });
    </script>
@endsection