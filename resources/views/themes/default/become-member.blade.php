@extends('themes.default.common.master')
@section('content')
<!-- Breadcrumbs -->
@if($event->status != 0)  
{!! NoCaptcha::renderJs() !!}
@if($event->banner)
<section class="breadcrumbs" style="background-image: url('{{asset('uploads/banners/'.$event->banner)}}');">
  @else
<section class="breadcrumbs" style="background-image: url('{{asset('themes-assets/images/8sKoSJp.jpg')}}');">
  @endif
   <div class="container px-5 px-sm-5">
      <div class="row mb-4">
         <h2>Registration Form for {{$event->name}}</h2>
         <br>
         <p class="register-text mt-1">
            <b>{{$event->caption}}</b>  
         </p>
         
      </div>
      <div class="row">
         <a href="#register-form" class="btn-register  mr-2 mb-2 mb-sm-0">Register Now</a>
         <!--<a href="{{ url('application-view') }}" class="btn-register">View Application</a>-->
      </div>
   </div>
</section>
<!--/ End Breadcrumbs -->
<div class="container" id="register-form">
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
      <form action="{{route('become-member')}}" method="POST" enctype="multipart/form-data">
         @csrf
         <h1 style="margin-top: 30px; color:brown;">Register Here</h1>
         <h4>Personal Information</h4>
         <hr>
         <div class="row">
            <div class="form-group col-sm-6">
               <label for="fname">First Name:</label>
              <input type="text" class="form-control" id="fname" name="first_name" required>
            </div>
            <div class="form-group col-sm-6">
               <label for="lname">Last Name:</label>
               <input type="text" id="lname" name="last_name" class="form-control" required>
            </div>
         </div>
         <div class="row">
            <div class="form-check form-section col-sm-3 ">
               <div class="form-check ">
                  <label for="gender">Gender: </label><br>
                  <select name="gender"  class="form-control"  required>
                      <!--<option value="" selected>-Select-</option>-->
                     <option value="male" > Male</option>
                     <option value="female" > Female</option>
                  </select>
               </div>
            </div>
            <div class="form-group col-md-3">
               <label>Age:</label>
               <input type="number" name="dob" class="form-control" min="10" max="100" required>
            </div>
            <div class="form-group col-md-2">
               <label for="bloodgroup">Blood Group:</label>
               <input type="text" id="bloodgroup" name="blood_group" class="form-control" >
            </div>
            <div class="form-check col-md-4">
               <label for="occupation">Occupation:</label><br>
               <select name="occupation" class="form-control" required>
                 <!--<option value="" selected>-Select-</option>-->
                  <option value="business"> Business</option>
                  <option value="selfemployed"> Self-Employed</option>
                  <option value="service"> Service</option>
                  <option value="retired">Retired</option>
                  <option value="housewife">Housewife</option>
                  <option value="student">Student</option>
        </select>
            </div>
         </div>
         <div class="row">
            <div class="form-group col-sm-6">
               <label for="nationality">Nationality:</label>
               <input type="text" id="nationality" name="nationality" class="form-control" required>
            </div>
            <div class="form-group col-sm-6">
               <label for="country">Country:</label> 
               <input type="text" name="country" id="country" class="form-control" required>
            </div>           
         </div>
         <div class="row">
            <div class="form-group col-sm-6">
               <label for="city">City:</label>
                <input type="text" name="city" id="city" class="form-control" required>
            </div>
            <div class="form-group col-sm-6">
               <label for="address">Address:</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
         </div>
         <div class="row">
            <div class="form-group col-sm-6">
               <label for="tnumber">Telephone number:</label>
               <input type="number" name="tel_no" id="tnumber" class="form-control" required>
            </div>
            <div class="form-group col-sm-6">
               <label for="mnumber">Mobile number:</label>
               <input type="number" name="mob_no" id="mnumber" class="form-control" required>
            </div>
         </div>
         <div class="row">
            <div class="form-group col-sm-6">
               <label for="email"> Email: </label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group col-sm-6">
               <label for="fb">Facebook ID:</label>
               <input type="text" name="facebook_id" id="fb" class="form-control">
            </div>
         </div>
         <br/>
         <h3>Application Type</h3>
         <hr>
         <div class="row">
            <div class="form-check col-sm-12 form-section">
                @if($category1->count()>0)
               <input type="radio" name="type" id="individual" class="form-check-inline" value="1" onclick="individualType()" checked>
               <label for="individual" >Individual Entry</label>
               @endif
                @if($category2->count()>0)
               <input type="radio" name="type" id="group" class="form-check-inline" value="2" onclick="groupType()">
               <label for="group" >Group Entry</label>
               @endif
            </div>
         </div>
         <br>
         <h3>Participation Information</h3>
         <hr>
         <input type="hidden" name="event" value="{{$event->id}}" >
         <div class="row" id="individual_category">
            <fieldset class="form-group col-sm-12" id="individual_event">
               <label for="dss">Event Category:</label>
               <div class="form-check form-section" >
                   @if($category1->count()>0)
                    @foreach($category1 as $row)
                  <input class=" form-check-inline radio-inline " value="{{$row->id}}" data-price="{{$row->price}}" type="radio" name="event_category" id="{{$row->name}}" {{$loop->first?'checked':''}}>
                  <label for="{{$row->name}}" >{{$row->name}}</label>
                   @endforeach 
                    @endif  
               </div>
            </fieldset>
         </div>
         <div class="row" id="group-event" style="display:none">
            <fieldset class="form-group col-sm-12">
               <label for="dss">Event Category</label>
               <div class="form-check form-section">
                  @if($category2->count()>0)
                    @foreach($category2 as $row)
                  <input class=" form-check-inline radio-inline " value="{{$row->id}}" data-price="{{$row->price}}" type="radio" name="event_category" id="{{$row->name}}">
                  <label for="{{$row->name}}" >{{$row->name}}</label>
                   @endforeach 
                    @endif  
               </div>
            </fieldset>
         </div>
         <div class="row">
            <div class="form-group col-sm-12">
               <label>T-Shirts Size:</label>
               <div class="form-check form-section">
                  <input type="radio" name="size" value="S" class="form-check-inline" id="s">
                  <label for="s" >S</label>
                  <input type="radio" name="size" value="M" class="form-check-inline" id="m">
                  <label for="m">M</label>
                  <input type="radio" name="size" value="L" class="form-check-inline" id="l" checked>
                  <label for="l">L</label>
                  <input type="radio" name="size" value="XL" class="form-check-inline" id="xl">
                  <label for="xl">XL</label>
                  <input type="radio" name="size" value="XXL" class="form-check-inline" id="xxl">
                  <label for="xxl">XXL</label>
                  <input type="radio" name="size" value="XXXL" class="form-check-inline" id="xxxl">
                  <label for="xxxl">XXXL</label>
               </div>
            </div>
         </div>
         <div class="row" id="group-entry" style="display:none">
            <div class="form-group col-sm-8">
               <label for="groupentry">If Group Entry, Group Name: </label>
             <input type="text" id="groupentry" name="group_name" class="form-control">
            </div>
            <div class="form-group col-sm-4">
               <label for="groupsize">Group Size: </label>
                <input type="number" id="group_size" name="group_size" class="family_size form-control"  >
            </div>
            <div class="form-group col-sm-8">
               <label for="type">Type of Group:</label>
               <input type="text" id="type" name="group_type" class="form-control">
            </div>           
         </div>
         <br/>
         <?php /*?>
         <div class="row" id="upload_id">
            <div class="form-check col-sm-6">
               <label for="schoolId" class="form-label">Upload ID </label>
               <input class="form-control" type="file" id="schoolId" name="file"/>              
            </div> 
            <div class="form-check col-sm-6">              
               <ul><li>School recommendation letter for school</li>
               <li> Citizenship, Passport, Liscense for masters</li>
               <li> Company recommendation for corporate</li>
            </ul>
            </div>            
         </div>
        <?php */?>
         <br/>
         <h3>In case of Emergency (optional)</h3>
         <hr>
         <b>In case of Emergency, Contact Name & Contact Number of Family/Friend/Guardian</b>
         <br/>
         <br/>
         <div class="row">
            <div class="form-group col-sm-6">
               <label for="gname">Name: </label>
               <input type="text" id="gname" name="e_name" class="form-control">
            </div>
            <div class="form-group col-sm-6">
               <label for="relation">Relation: </label>
                <input type="text" id="relation" name="relation" class="form-control">
            </div>
         </div>
         <div class="row">            
            {{-- <div class="form-group col-sm-4">
               <label for="tel">Telephone: </label>
                <input type="number" id="el" name="telephone" class="form-control">
            </div> --}}
            <div class="form-group col-sm-4">
               <label for="mob">Mobile: </label>
              <input type="number" id="mob" name="mobile" class="form-control">
            </div>
         </div>
         <h3>Other Information</h3>
         <hr>
         <div class="row">
            <div class="form-group form-section col-sm-12">
               <label for="form-check-input">Do you have participated in any road race yet?</label>
               <input type="radio" name="past_record" value="yes" class="form-check-inline" id="yes">
               <label for="yes">Yes</label>
               <input type="radio" name="past_record" value="no" class="form-check-inline" id="no">
               <label for="no">No</label>
            </div>
         </div>
        <!--  <div class="row">
            <div class="form-group form-section col-sm-12">
               <label for="form-check-input">Have you already taken part in Kathmandu Marathon?</label>
               <input type="radio" name="previous_runner" value="yes" class="form-check-inline" id="yess">
               <label for="yess">Yes</label>
               <input type="radio" name="previous_runner" value="no" class="form-check-inline" id="noo">
               <label for="noo">No</label>
            </div>
         </div> -->
         
        {!!$event->brief!!}
        {!!$event->content!!}

         
         <div class="form-check" style="padding:0 15px;padding-bottom:15px;">
             <input type="checkbox" name="conditions" id="conditions" class="form-check-input" required>
             <label for="conditions">I hereby fully understand and accept all the terms and conditions mentioned in the waiver above.</label>
         </div>                                            
         
         {!! NoCaptcha::display() !!}
        
             <div class="col-sm-12 button">
                <button type="submit" class="btn-register" style="margin-bottom: 10px;
    margin-top: 10px;">Submit</button>
             </div>
         
         </form>
    </div>
    @else
    <section class="breadcrumbs" style="height:30vh;background-image: url('{{asset('themes-assets/images/8sKoSJp.jpg')}}');">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2>Event Closed!</h2>
          </div>
        </div>
      </div>
    </section>
    <!--/ End Breadcrumbs -->

  <!-- About Us -->
  <section class="about-us section">
    <div class="container">
      <div class="row">       
        <div class="col-lg-9 col-12">
          <!-- About Content -->
          <div class="about-content">
              {!!$setting->welcome_text !!}
          </div>
          <!--/ End About Content -->
        </div>
      </div>

    </div>
  </section>
  <!--/ End About Us -->
@endif

@endsection