@extends('admin.master')
@section('title','Member Registration')
@section('breadcrumb')
    @if($user->event)
   <a href="{{ url('admin/event/'.$user->event) }}" class="btn btn-primary btn-sm">View List</a>
   @else
   <a href="{{ route('members-list') }}" class="btn btn-primary btn-sm">View List</a>
   @endif
@endsection
@section('content')
<div class="container">
 <h3>Personal Information</h3>	
	<div class="row">
		<div class="form-group col-sm-3">
			<label for="fname">First Name:</label>
			<input type="text" class="form-control" id="fname" name="first_name" value="{{$user->first_name}}" readonly> 
		</div>
		<div class="form-group col-sm-3">
			<label for="lname">Last Name:</label>
			<input type="text" id="lname" name="last_name" class="form-control" value="{{$user->last_name}}" readonly>
		</div>
		<div class="form-group col-sm-3">
		<label for="dss">Event Category</label>
		  	<input type="text" name="event" class="form-control" value="{{event_category($info->event_category)}}" readonly> 
		  </div>
		  <div class="form-group col-sm-3">
			<label>T-Shirts Size:</label>
			<input type="text" name="size" class="form-control" value="{{$info->tshirt_size}}" readonly> 
		</div>
	</div>
	<div class="row">
		<div class="form-check col-sm-3">
			<label for="gender">Gender:</label>
			<input type="text" class="form-control" value="{{$user->gender}}" readonly>
		</div>
		<div class="form-group col-sm-3">
			<label for="bloodgroup">Blood Group:</label>
			<input type="text" class="form-control" value="{{$user->blood_group}}" readonly>
		</div>
		<div class="form-group col-sm-3">
			<label>Date of Birth:</label> 
			<input type="text" class="form-control" value="{{$user->dob}}" readonly>
		</div>
		<div class="form-check col-sm-3">
			<label for="occupation">Occupation:</label><br>
			<input type="text" class="form-control" value="{{$user->occupation}}" readonly>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-3">
			<label for="nationality">Nationality:</label>
			<input type="text" id="nationality" name="nationality" class="form-control" value="{{$user->nationality}}" readonly> 
		</div>
		<div class="form-group col-sm-3">
			<label for="country">Country:</label>
			<input type="text" name="country" id="country" class="form-control" value="{{$user->country}}" readonly> 
		</div>
		<div class="form-group col-sm-3">
			<label for="city">City:</label>
			<input type="text" name="city" id="city" class="form-control" value="{{$user->city}}" readonly>  
			</div>
			<div class="form-group col-sm-3">
			<label for="address">Address:</label>
			<input type="text" name="address" id="address" class="form-control" value="{{$user->address}}" readonly> 
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-3">
			<label for="tnumber">Telephone number:</label>
			<input type="number" name="tel_no" id="tnumber" class="form-control" value="{{$user->telephone_no}}" readonly>
		</div>
		<div class="form-group col-sm-3">
		<label for="mnumber">Mobile number:</label>
		<input type="number" name="mob_no" id="mnumber" class="form-control" value="{{$user->mobile_no}}" readonly>
		</div>
		<div class="form-group col-sm-3">
			<label for="email"> Email: </label>
			<input type="email" name="email" id="email" class="form-control" value="{{$user->email}}" readonly>
		</div>
		<div class="form-group col-sm-3">
			<label for="fb">Facebook ID:</label>
			<input type="text" name="facebook_id" id="fb" class="form-control" value="{{$user->facebook_id}}" readonly> 
		</div>
	</div>
	<div class="row">
		
	</div>
	
	<h3>Application Type</h3>
	<div class="row">
		<div class="form-check col-sm-4">
			<input type="text" name="size" class="form-control" value="{{$appType->individual_entry != NULL?'Indivual Entry':'Group Entry'}}" readonly> 
		</div>
	</div>
	<br>
	@if($appType->group_entry == 'yes')
	<div class="row">
		<div class="form-group col-sm-8">
			<label for="groupentry">If Group Entry, Group Name: </label>
			<input type="text" id="groupentry" name="group_name" class="form-control" readonly>
		</div>
		<div class="form-group col-sm-4">
			<label for="groupsize">Group Size: </label>
			<input type="text" id="groupsize" name="group_size" class="form-control" readonly>
		</div>
		<div class="form-group col-sm-8">
			<label for="type">Type of Group:</label>
			<input type="text" id="type" name="group_type" class="form-control" readonly>
		</div>
	</div>
    @endif
	<br>
    @if($emergency)
	<h3>In case of Emergency (optional)</h3>
	<p>In case of Emergency, Contact Name & Contact Number of Family/Friend/Guardian</p>
	<div class="row">
	<div class="form-group col-sm-6">
		<label for="gname">Name: </label>
		<input type="text" id="gname" name="e_name" class="form-control" value="{{$emergency->name}}" readonly>
	</div>
	<div class="form-group col-sm-6">
		<label for="relation">Relation: </label>
		<input type="text" id="relation" name="relation" class="form-control" value="{{$emergency->relation}}" readonly>
	</div>
	</div>
	<div class="row">
	<div class="form-group col-sm-4">
		<label for="type">Type of Group:</label>
		<input type="text" id="type" name="group_type" class="form-control" value="{{$emergency->group_type}}" readonly>
	</div>
	<div class="form-group col-sm-4">
		<label for="tel">Telephone: </label>
		<input type="number" id="el" name="telephone" class="form-control" value="{{$emergency->telephone}}" readonly>
	</div>
	<div class="form-group col-sm-4">
		<label for="mob">Mobile: </label>
		<input type="number" id="mob" name="mobile" class="form-control" value="{{$emergency->phone}}" readonly>
	</div>
	</div>
	@endif

	<h3>Other Information</h3>
	<div class="row">
		<div class="form-group col-sm-6">
			<label for="form-check-input">Do you have participated in any road race yet?</label>
			<input type="text" name="size" class="form-control" value="{{$user->past_record}}" readonly> 
		</div>
		<div class="form-group col-sm-6">
				<label for="form-check-input">Have you already taken part in Kathmandu Marathon?</label>
				<input type="text" name="size" class="form-control" value="{{$user->previous_runner}}" readonly> 
			</div>
	</div>
	@if($doc)
	<div class="row">
		<div class="form-group col-sm-6">
			<label for="form-check-input">ID</label>
			<a href="{{asset('uploads/doc/'.$doc->file)}}" target="_blank">
				<img src="{{asset('uploads/doc/'.$doc->file)}}" width="100%">
			</a>
		</div>		
	</div>	
	@endif
</div>
@endsection
@section('scripts')

<!-- Datatables -->
<script src="{{asset(env('PUBLIC_PATH').'vendor/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>

<!-- Datatables Tabletools addon -->
<script src="{{asset(env('PUBLIC_PATH').'vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>

<!-- Datatables ColReorder addon -->
<script src="{{asset(env('PUBLIC_PATH').'vendor/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')}}"></script>

<!-- Datatables Bootstrap Modifications  -->
<script src="{{asset(env('PUBLIC_PATH').'vendor/plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
@endsection
