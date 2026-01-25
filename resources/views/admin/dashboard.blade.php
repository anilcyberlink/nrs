@extends('admin.master')
@section('title','Dashboard')
@section('content')
<!-- Dashboard Tiles -->
<div class="row mb10">
  <div class="col-sm-6 col-md-3">
    <div class="panel bg-alert light of-h mb10">
      <div class="pn pl20 p5">
        <div class="icon-bg">
          <i class="fa fa-file-o"></i>
        </div>
        <h2 class="mt15 lh15">
          <b>{{$total_posts}}</b>
        </h2>
        <h5 class="text-muted">Total Posts</h5>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="panel bg-info light of-h mb10">
      <div class="pn pl20 p5">
        <div class="icon-bg">
          <i class="fa fa-circle-o"></i>
        </div>
        <h2 class="mt15 lh15">
          <b>{{$total_category}}</b>
        </h2>
        <h5 class="text-muted">Total Post Categories</h5>
      </div>
    </div>
  </div>
 
  <div class="col-sm-6 col-md-3">
    <div class="panel bg-warning light of-h mb10">
      <div class="pn pl20 p5">
        <div class="icon-bg">
          <i class="fa fa-bar-chart-o"></i>
        </div>
        <h2 class="mt15 lh15">
          <b>{{$post_visiters}}</b>
        </h2>
        <h5 class="text-muted">Post Visitors</h5>
      </div>
    </div>
  </div>
    <div class="col-sm-6 col-md-3">
    <div class="panel bg-primary light of-h mb10">
      <div class="pn pl20 p5">
        <div class="icon-bg">
          <i class="fa fa-users"></i>
        </div>
        <h2 class="mt15 lh15">
          <b>{{$total_runner}}</b>
        </h2>
        <h5 class="text-muted">Total Runners</h5>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="panel bg-success light of-h mb10">
      <div class="pn pl20 p5">
        <div class="icon-bg">
          <i class="fa fa-check"></i>
        </div>
        <h2 class="mt15 lh15">
          <b>{{$verified}}</b>
        </h2>
        <h5 class="text-muted">Verified</h5>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="panel bg-danger light of-h mb10">
      <div class="pn pl20 p5">
        <div class="icon-bg">
          <i class="fa fa-times"></i>
        </div>
        <h2 class="mt15 lh15">
          <b>{{$unverified}}</b>
        </h2>
        <h5 class="text-muted">Unverified</h5>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="panel bg-info light of-h mb10">
      <div class="pn pl20 p5">
        <div class="icon-bg">
          <i class="fa fa-male"></i>
        </div>
        <h2 class="mt15 lh15">
          <b>{{$male}}</b>
        </h2>
        <h5 class="text-muted">Verified Male</h5>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="panel bg-secondary light of-h mb10">
      <div class="pn pl20 p5">
        <div class="icon-bg">
          <i class="fa fa-female"></i>
        </div>
        <h2 class="mt15 lh15">
          <b>{{$female}}</b>
        </h2>
        <h5 class="text-muted">Verified Female</h5>
      </div>
    </div>
  </div>
</div>
<div class="panel panel-body ph20 tab-content">
<div class="col-sm-12 col-md-4">
    <label for="gender">Gender:</label>
    <select name="gender" id="gender" onchange="marathonFilter()" class="form-control">
        <option value="">Select Value</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
</div>
<div class="col-sm-12 col-md-4">
<label for="category">Category:</label>
    <select name="category" id="category" onchange="marathonFilter()" class="form-control">
        <option value="">Select Value</option>
        <option value="marathon">Marathon</option>
        <option value="half_marathon">Half Marathon</option>
        <option value="5k_open">5K OPEN</option>
        <option value="5k_school">5K SCHOOL</option>
        <option value="5k_masters">5K MASTERS</option>
        <option value="3k_wheel_chair">3K WHEEL CHAIR</option>
    </select>        </div>
<div class="col-sm-12 col-md-4">
  <label for="tshirt">Tshirt:</label>
    <select name="tshirt" id="tshirt" onchange="marathonFilter()" class="form-control">
        <option value="">Select Value</option>
        <option value="S">S</option>
        <option value="M">M</option>
         <option value="L">L</option>
          <option value="XL">XL</option>
           <option value="XXL">XXL</option>
            <option value="XXXL">XXXL</option>
    </select>

</div>
  <div class="col-sm-12 col-md-12">
     <h4> Count: <span id="count-val"></span></h4>
      </div>
</div>
</div>

     
@endsection

@section('scripts')

<script>

function marathonFilter(){
    
    gender = $("#gender").val();
    category = $("#category").val();
    tshirt = $("#tshirt").val();
    
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
      method: 'post',
      url: "/admin/marathon_filter",
      data: {'gender':gender, 'category':category, 'tshirt':tshirt},
          success: function(data)
          {
            const obj = JSON.parse(data);
            $("#count-val").html(obj["val"]);
          }
      });
}

</script>

@endsection


