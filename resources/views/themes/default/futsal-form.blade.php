@extends('themes.default.common.master')
@section('content')
<!-- Breadcrumbs -->
@if($event->banner)
<section class="breadcrumbs" style="background-image: url('{{asset('uploads/banners/'.$event->banner)}}');">
  @else
<section class="breadcrumbs" style="background-image: url('{{asset('themes-assets/images/8sKoSJp.jpg')}}');">
  @endif
	<div class="container px-5 px-sm-5">
       <div class="row mb-4">
            <h2>{{$event->event_name}} Registration Form</h2> 
            <br>  
             <p class="register-text mt-1"> {!!$event->brief!!}</p>
        </div>
	</div>
</section>
		<!--/ End Breadcrumbs -->
<form id="checkout-form" method="POST" action="{{ route('futsal-registration') }}">
    @csrf
     <input type="hidden" name="event_id" value="{{ $event->id }}">
    <div class="container py-5 ">
    <h1 style="margin-bottom: 30px; color:brown;">Register Here</h1>
    <h5>TEAM PARTICULARS</h5>
    <hr>
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="tname">Team Name:</label>
            <input type="text" class="form-control" id="tname" name="team_name" required>
        </div>
        <div class="form-group col-sm-6">
            <label for="cname">Company name:</label>
            <input type="text" id="cname" name="company_name" class="form-control" required> 
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="contact">Contact No:</label>
            <input type="text" id="contact" name="team_contact" class="form-control" required>
        </div>
        <div class="form-group col-sm-6">
            <label for="email">Email:</label> 
            <input type="text" name="team_email" id="email" class="form-control" required>
        </div>
    </div>
     <div class="row">
        <div class="form-group col-sm-6">
            <label for="captain">Team Manager / Captain:</label>
            <input type="text" id="captain" name="team_captain" class="form-control" required>
        </div>
    </div>
   
</div>   
<section class="bg">
    <div class="container">
        <h5>PLAYERS PARTICULARS</h5>
        <hr style="border-top-color:brown;">
        <div class="container">
            <div class="row">
                <div class="panel-body" id="row_mountain_body">
                    <div class="row" style="color:brown; ">
                        <div class="col-md-1" >  <label><center>S/N</center> </label> </div>
                        <div class="col-md-1" >  <label>ID NO</label> </div>
                        <div class="col-md-2" >  <label>NAME</label> </div>
                        <div class="col-md-2" >  <label>D.O.B</label> </div>
                        <div class="col-md-2" >  <label>CONTACT NO</label> </div>
                        <div class="col-md-2"  >  <label>EMAIL</label> </div>
                        <div class="col-md-1">  <label>IMAGE</label> </div>
                        <div class="col-md-1" >  <label>REMARKS</label> </div>
                    </div>
                    <div class="row" >
                        <div class="col-md-1 "> 1.</div>
                        <div class="col-md-1 pr-0"><input type="text" name="identification_number[]" required  class="form-control" value="" placeholder="Identification No"/></div>
                        <div class="col-md-2 pr-0"><input type="text"  name="name[]"  class="form-control" required  value="" placeholder="Name"/></div>
                        <div class="col-md-2 pr-0"><input type="date" name="dob[]" class="form-control" required  value="" placeholder="Date of Birth"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="contact[]" class="form-control" required  value="" placeholder="Contact No"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="email[]" class="form-control" value="" required placeholder="Email"/></div>
                        <div class="col-md-1 pr-0" ><input type="file" name="image[]" class="form-control image-control" value="" /></div>
                        <div class="col-md-1 pr-0"><input type="text"  name="remarks[]" class="form-control" value="" placeholder="Remark"/></div>
                    </div>
                    <br>
                    <div class="row" >
                        <div class="col-md-1 ">2.</div>
                           <div class="col-md-1 pr-0"><input type="text" name="identification_number[]" required  class="form-control" value="" placeholder="Identification No"/></div>
                        <div class="col-md-2 pr-0"><input type="text"  name="name[]"  class="form-control" required  value="" placeholder="Name"/></div>
                        <div class="col-md-2 pr-0"><input type="date" name="dob[]" class="form-control" required  value="" placeholder="Date of Birth"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="contact[]" class="form-control" required  value="" placeholder="Contact No"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="email[]" class="form-control" value="" required placeholder="Email"/></div>
                        <div class="col-md-1 pr-0" ><input type="file" name="image[]"  class="form-control image-control" value="" /></div>
                        <div class="col-md-1 pr-0"><input type="text"  name="remarks[]" class="form-control" value="" placeholder="Remark"/></div>
                        
                    </div>
                    <br>
                    <div class="row" >
                        <div class="col-md-1 ">3.</div>
                           <div class="col-md-1 pr-0"><input type="text" name="identification_number[]" required  class="form-control" value="" placeholder="Identification No"/></div>
                        <div class="col-md-2 pr-0"><input type="text"  name="name[]"  class="form-control" required  value="" placeholder="Name"/></div>
                        <div class="col-md-2 pr-0"><input type="date" name="dob[]" class="form-control" required  value="" placeholder="Date of Birth"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="contact[]" class="form-control" required  value="" placeholder="Contact No"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="email[]" class="form-control" value="" required placeholder="Email"/></div>
                        <div class="col-md-1 pr-0" ><input type="file" name="image[]"  class="form-control image-control" value="" /></div>
                        <div class="col-md-1 pr-0"><input type="text"  name="remarks[]" class="form-control" value="" placeholder="Remark"/></div>
                        
                    </div>
                    <br>
                    <div class="row" >
                        <div class="col-md-1 pr-0">4.</div>
                            <div class="col-md-1 pr-0"><input type="text" name="identification_number[]" required  class="form-control" value="" placeholder="Identification No"/></div>
                        <div class="col-md-2 pr-0"><input type="text"  name="name[]"  class="form-control" required  value="" placeholder="Name"/></div>
                        <div class="col-md-2 pr-0"><input type="date" name="dob[]" class="form-control" required  value="" placeholder="Date of Birth"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="contact[]" class="form-control" required  value="" placeholder="Contact No"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="email[]" class="form-control" value="" required placeholder="Email"/></div>
                        <div class="col-md-1 pr-0" ><input type="file" name="image[]"  class="form-control image-control" value="" /></div>
                        <div class="col-md-1 pr-0"><input type="text"  name="remarks[]" class="form-control" value="" placeholder="Remark"/></div>
                        
                    </div>
                    <br>
                    <div class="row" >
                        <div class="col-md-1 pr-0">5.</div>
                          <div class="col-md-1 pr-0"><input type="text" name="identification_number[]" required  class="form-control" value="" placeholder="Identification No"/></div>
                        <div class="col-md-2 pr-0"><input type="text"  name="name[]"  class="form-control" required  value="" placeholder="Name"/></div>
                        <div class="col-md-2 pr-0"><input type="date" name="dob[]" class="form-control" required  value="" placeholder="Date of Birth"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="contact[]" class="form-control" required  value="" placeholder="Contact No"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="email[]" class="form-control" value="" required placeholder="Email"/></div>
                        <div class="col-md-1 pr-0" ><input type="file" name="image[]"  class="form-control image-control" value="" /></div>
                        <div class="col-md-1 pr-0"><input type="text"  name="remarks[]" class="form-control" value="" placeholder="Remark"/></div>
                        
                    </div>
                    <br>
                    <div class="row" >
                        <div class="col-md-1 pr-0">6.</div>
                            <div class="col-md-1 pr-0"><input type="text" name="identification_number[]" required  class="form-control" value="" placeholder="Identification No"/></div>
                        <div class="col-md-2 pr-0"><input type="text"  name="name[]"  class="form-control" required  value="" placeholder="Name"/></div>
                        <div class="col-md-2 pr-0"><input type="date" name="dob[]" class="form-control" required  value="" placeholder="Date of Birth"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="contact[]" class="form-control" required  value="" placeholder="Contact No"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="email[]" class="form-control" value="" required placeholder="Email"/></div>
                        <div class="col-md-1 pr-0" ><input type="file" name="image[]"  class="form-control image-control" value="" /></div>
                        <div class="col-md-1 pr-0"><input type="text"  name="remarks[]" class="form-control" value="" placeholder="Remark"/></div>
                    </div>
                    <br>
                    <div class="row" >
                        <div class="col-md-1 pr-0">7.</div>
                           <div class="col-md-1 pr-0"><input type="text" name="identification_number[]" required  class="form-control" value="" placeholder="Identification No"/></div>
                        <div class="col-md-2 pr-0"><input type="text"  name="name[]"  class="form-control" required  value="" placeholder="Name"/></div>
                        <div class="col-md-2 pr-0"><input type="date" name="dob[]" class="form-control" required  value="" placeholder="Date of Birth"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="contact[]" class="form-control" required  value="" placeholder="Contact No"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="email[]" class="form-control" value="" required placeholder="Email"/></div>
                        <div class="col-md-1 pr-0" ><input type="file" name="image[]"  class="form-control image-control" value="" /></div>
                        <div class="col-md-1 pr-0"><input type="text"  name="remarks[]" class="form-control" value="" placeholder="Remark"/></div>
                    </div>
                    <br>
                    <div class="row" >
                        <div class="col-md-1 pr-0">8.</div>
                             <div class="col-md-1 pr-0"><input type="text" name="identification_number[]" required  class="form-control" value="" placeholder="Identification No"/></div>
                        <div class="col-md-2 pr-0"><input type="text"  name="name[]"  class="form-control" required  value="" placeholder="Name"/></div>
                        <div class="col-md-2 pr-0"><input type="date" name="dob[]" class="form-control" required  value="" placeholder="Date of Birth"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="contact[]" class="form-control" required  value="" placeholder="Contact No"/></div>
                        <div class="col-md-2 pr-0"><input type="text" name="email[]" class="form-control" value="" required placeholder="Email"/></div>
                        <div class="col-md-1 pr-0" ><input type="file" name="image[]"  class="form-control image-control" value="" /></div>
                        <div class="col-md-1 pr-0"><input type="text"  name="remarks[]" class="form-control" value="" placeholder="Remark"/></div>
                    </div>
                    <br>
                </div>
            </div>
            {!! NoCaptcha::renderJs() !!}
             {!! NoCaptcha::display() !!}
            <div class="row">
              <button type="submit" class="form-btn mr-2 mb-2 mb-sm-0">Submit</button>
            </div><hr>
               {!!$event->content!!}
        </div>
    </div>
 
</section> 

</form>


@stop  