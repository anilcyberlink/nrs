@extends('admin.master')
@section('title','Post Category')
@section('breadcrumb')
@if(Request::segment(3))
<a href="{{url('admin/associated/'.Request::segment(3).'/'.$data->post_id)}}" class="btn btn-primary btn-sm">Go Back</a>
@endif
@endsection
@section('content')
<form class="form-horizontal" role="form" action="{{url('admin/associated/'.Request::segment(3).'/'.Request::segment(4))}}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
   <input type="hidden" name="_method" value="PUT" />
  <div class="col-md-12">
    <!-- Input Fields -->
    <div class="panel">
      <div class="panel-heading">
        <span class="panel-title">Edit Associated Post</span>
      </div>
      <div class="panel-body">
  <input type="hidden" name="post_id" value="{{Request::segment(4)}}" />
     <div class="form-group">
        <label for="title" class="col-lg-2 control-label">Title</label>
        <div class="col-lg-8">
          <div class="bs-component">
            <input type="text" id="title" name="title" class="form-control" value="{{$data->title}}" />
          </div>
        </div>
      </div>
      <div class="form-group">
       <label for="title" class="col-lg-2 control-label">Sub Title</label>
        <div class="col-lg-8">
          <div class="bs-component">
            <input type="text" id="title" name="sub_title" class="form-control" value="{{$data->sub_title}}" />
          </div>
        </div>
      </div>

    <div class="form-group">
     <label for="inputStandard" class="col-lg-2 control-label">Brief</label>
     <div class="col-lg-8">
      <div class="bs-component">
        <div class="bs-component">
          <textarea class="form-control" id="" name="brief" rows="3" autocomplete="off">{{$data->brief}}</textarea>
        </div>
      </div>
    </div>
  </div>

    <div class="form-group">
        <label for="inputStandard" class="col-lg-2 control-label">Content</label>
        <div class="col-lg-8">
            <div class="bs-component">
                <div class="bs-component">
                    <textarea class="form-control my-editor" id="" name="contents" rows="12" autocomplete="off">{{$data->content}}</textarea>
                </div>
            </div>
        </div>
    </div>
      @if(Request::segment(3)=='core-companies')
        <div class="form-group">
            <label for="inputSelect" class="col-lg-2 control-label"> Category </label>
            <div class="col-lg-8">
                <div class="bs-component">
                    <select name="category" class="form-control">
                        <option @if ($data->category== 1) selected @endif   value="1">Slider</option>
                        <option @if ($data->category== 2) selected @endif  value="2">Lightbox</option>
                        
                    </select>
                    <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt;
                        &gt;
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="form-group">
            <label for="title" class="col-lg-2 control-label">External Link</label>
            <div class="col-lg-8">
                <div class="bs-component">
                    <input type="text" id="ordering" name="phone" value="{{$data->phone}}" class="form-control"/>
                </div>
            </div>
        </div>

   <!--      <div class="form-group">
            <label for="title" class="col-lg-2 control-label">Email</label>
            <div class="col-lg-8">
                <div class="bs-component">
                    <input type="text" id="ordering" name="email"  value="{{$data->email}}" class="form-control"/>
                </div>
            </div>
        </div> -->

{{--        <div class="form-group">--}}
{{--            <label for="title" class="col-lg-2 control-label">Facebook Link</label>--}}
{{--            <div class="col-lg-8">--}}
{{--                <div class="bs-component">--}}
{{--                    <input type="text" id="ordering" name="facebook_link" value="{{$data->facebook_link}}" class="form-control"/>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label for="title" class="col-lg-2 control-label">Twitter Link</label>--}}
{{--            <div class="col-lg-8">--}}
{{--                <div class="bs-component">--}}
{{--                    <input type="text" id="ordering" name="twitter_link" value="{{$data->twitter_link}}" class="form-control"/>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label for="title" class="col-lg-2 control-label">LinkedIn Link</label>--}}
{{--            <div class="col-lg-8">--}}
{{--                <div class="bs-component">--}}
{{--                    <input type="text" id="ordering" name="linked_in_link" value="{{$data->linked_in_link}}" class="form-control"/>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

  <div class="form-group">
        <label for="title" class="col-lg-2 control-label">Ordering</label>
        <div class="col-lg-8">
          <div class="bs-component">
            <input type="text" id="ordering" name="ordering" class="form-control" value="{{$data->ordering}}" />
          </div>
        </div>
  </div>


    <div class="form-group">
     <label for="inputStandard" class="col-lg-2 control-label">Thumbnail</label>
     <div class="col-lg-8">
      <div class="bs-component">
        <div class="bs-component">
          <div id="xedit-demo">
            @if($data->thumbnail)
              <span class="id{{$data->id}}">
              <a href="#{{$data->id}}" class="imagedelete"></a>
              <img src="{{ asset(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail) }}" width="300" />
              </span>
              <hr>
              @endif
         <input type="file" name="thumbnail" />
       </div>
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-lg-2 control-label" for=""> </label>
    <div class="col-lg-8">
      <div class="bs-component">
       <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
     </div>
   </div>
 </div>


</div>
</div>
</div>

<div class="col-md-4"> </div>
</form>
@endsection
@section('scripts')
@endsection
