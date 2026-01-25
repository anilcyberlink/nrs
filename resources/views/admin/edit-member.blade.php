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
 <h3>Edit Information</h3>
	<br>
	  <form action="{{ route('edit-member-details', Request::segment(3))}}"  method="POST">
	@csrf
	 <input type="hidden" name="_method" value="PUT"/>
	 <div class="row">
		<div class="form-group col-sm-3">
			<label for="fname">Bib Number</label>
			<input type="number" class="form-control" id="bib_no" name="bib_no" value="{{$user->bib_no}}" > 
		</div>
	</div>
	<div class="row">
		
		<div class="form-group col-sm-3">
			<label for="fname">First Name:</label>
			<input type="text" class="form-control" id="fname" name="first_name" value="{{$user->first_name}}" > 
		</div>
		<div class="form-group col-sm-3">
			<label for="lname">Last Name:</label>
			<input type="text" id="lname" name="last_name" class="form-control" value="{{$user->last_name}}" >
		</div>
		<div class="form-group col-sm-3">
			<label for="lname">Event Category</label>
		 <select name="event_category" class="form-control" id="individual_category">
            @if($category1)
            @foreach($category1 as $row)
            <option value="{{$row->id}}" {{$row->id == $info->event_category?'selected':''}}> {{$row->name}}</option>
            @endforeach 
            @endif  
         </select>   
		</div>
		<div class="form-group col-sm-3">
			<label for="tnumber">T-Shirts Size:</label>
			 <select name="size" class="form-control">
                <option value="0" {{$info->tshirt_size == '0'?'selected':''}}> None</option>
                <option value="S" {{$info->tshirt_size == 'S'?'selected':''}}> S</option>
                <option value="M" {{$info->tshirt_size == 'M'?'selected':''}}> M</option>
                <option value="L" {{$info->tshirt_size == 'L'?'selected':''}}> L</option>
                <option value="XL" {{$info->tshirt_size == 'XL'?'selected':''}}>XL </option>
                <option value="XXL" {{$info->tshirt_size == 'XXL'?'selected':''}}> XXL</option>
                 <option value="XXXL" {{$info->tshirt_size == 'XXXL'?'selected':''}}>XXXL</option>               
             </select>  
            <i class="arrow"></i>
		</div>
	</div>	
	<div class="row">
		
		<div class="form-group col-sm-3">
			<label for="bloodgroup">Blood Group:</label>
			<input type="text" class="form-control" value="{{$user->blood_group}}" name="blood_group">
		</div>
		<div class="form-group col-sm-3">
			<label>Date of Birth:</label> 
			<input type="date" class="form-control" value="{{$user->dob}}" name="dob">
		</div>
		<div class="form-group col-sm-3">
			<label for="tnumber">Telephone number:</label>
			<input type="number" name="tel_no" id="tnumber" class="form-control" value="{{$user->telephone_no}}" >
		</div>
		<div class="form-group col-sm-3">
			<label for="mnumber">Mobile number:</label>
		<input type="number" name="mob_no" id="mnumber" class="form-control" value="{{$user->mobile_no}}" >
		</div>		
	</div>
	 
<button type="submit">Submit</button>
</form>
</div>
@endsection

