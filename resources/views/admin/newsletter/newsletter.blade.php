@extends('admin.master')
@section('title','Add Newsletter')
@section('breadcrumb')
<a href="{{ route('newsletter.index') }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')

<div class="container">
    <h1>Add Newsletter </h1>

 <form action="{{ route('newsletter.submit') }}" method="POST">
     @csrf
  <div class="panel-body">
  <div class="form-group">
       <div class="col-lg-6">
        <div class="bs-component">
         <label for="exampleInputEmail1">Title</label>
         <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="bs-component">
        <label  for="exampleCheck1">Publish Date</label>
        <input type="date" name="publish_date" class="form-control" id="exampleCheck1">
        </div>
    </div>
  </div>
  <div class="form-group">
      <div class="col-lg-12">
    <label for="exampleInputPassword1">Content</label>
    <!--Content Goes here -->
    <textarea class="form-control my-editor" id="editor2" name="news_content" rows="50"> <table class="wrapper" style="padding: 0px; width: 100%;" border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="center"><!-- Monthly offer Begin--> &nbsp;
<table class="wrapper" style="width: 860px; height: 699.984px;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 699.984px;">
<td style="width: 856px; height: 699.984px;" align="center" valign="top">
<table class="wrapper" style="width: 814.5px; height: 643.391px;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 643.391px;">
<td style="width: 810.5px; height: 643.391px;" align="center" valign="top">&nbsp; &nbsp;<a href="https://www.annapurnaview.com/" target="_blank" rel="noopener"><img class="headerimg" src="/storage/photos/1/offer.jpg" width="550" height="530" /></a> &nbsp;&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
 </textarea>
    <!--Content Goes here -->
     </div>
  </div>
  </div>
  <hr/>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@stop
