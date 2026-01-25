@extends('admin.master')
@section('title','Registration Form')
@section('breadcrumb')
@if($event)
   <a href="{{ url('admin/event/'.$event->id) }}" class="btn btn-primary btn-sm">View List</a>
   @else
   <a href="{{ route('members-list') }}" class="btn btn-primary btn-sm">View List</a>
   @endif
@endsection

@section('content')
@if($event)
<form class="form-horizontal" role="form" action="{{ route('admin-become-member')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

<div class="col-md-9">
    <!-- Input Fields -->
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">New Registration for {{$event->name}}</span>
             <input type="hidden" name="event" value="{{$event->id}}" >
        </div>
        <div class="panel-body"> 
          <div class="form-group">
           <div class="col-lg-6">
            <div class="bs-component">
             <label>First Name<span class="text-red">*</span></label>
             <input type="text" name="first_name" class="form-control"  placeholder="Enter First Name" value="{{ old('first_name') }}" required >
            </div>
           </div>
          <div class="col-lg-6">
            <div class="bs-component">
            <label>Last Name<span class="text-red">*</span></label>
            <input type="text" name="last_name" class="form-control"  placeholder="Enter Last Name" value="{{ old('last_name') }}" required>
            </div>
          </div>
          </div>

          <div class="form-group">
           <div class="col-lg-4">
            <div class="bs-component">
             <label>Gender<span class="text-red">*</span></label><br>
             <select name="gender" class="form-control">
                <option value="male" > Male</option>
                <option value="female"> Female</option>               
             </select>                 
            </div>
           </div>
          <div class="col-lg-4">
            <div class="bs-component">
            <label>Blood Group</label>
            <select name="blood_group" class="form-control">
                <option value="0" selected disabled> None</option>
                <option value="A+ve"> A +ve</option>
                <option value="A-ve"> A -ve</option>
                <option value="B+ve"> B +ve</option>
                <option value="B-ve"> B -ve</option>
                <option value="AB+ve"> AB +ve</option>
                 <option value="AB-ve"> AB -ve</option>
                <option value="O+ve"> O +ve</option>
                <option value="O-ve"> O -ve</option>        
             </select>            
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
            <label>Date of Birth<span class="text-red">*</span></label>
            <input type="date" name="dob" class="form-control" value="1999-12-30" required>
            </div>
          </div>
          </div>

            <div class="form-group">
           <div class="col-lg-4">
            <div class="bs-component">
             <label for="occupation">Occupation</label><br>
               <select name="occupation" class="form-control">
                <option value="business"> Business</option>
                <option value="selfemployed"> Self-Employed</option>
                <option value="service"> Service</option>
                <option value="retired">Retired</option>
                <option value="housewife">Housewife</option>
                <option value="student">Student</option>
             </select>
            </div>
           </div>
          <div class="col-lg-4">
            <div class="bs-component">
            <label>Nationality<span class="text-red">*</span></label>
             <input type="text" id="nationality" name="nationality" value="Nepali" class="form-control" >
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
            <label>Country<span class="text-red">*</span></label>
            <input type="text" name="country" id="country" value="Nepal" class="form-control">
            </div>
          </div>
          </div>

           <div class="form-group">
           <div class="col-lg-4">
            <div class="bs-component">
             <label for="gender">City<span class="text-red">*</span></label><br>
              <input type="text" name="city" id="city" class="form-control" value="Kathmandu">
             </div>
            </div>          
          <div class="col-lg-4">
            <div class="bs-component">
            <label>Address<span class="text-red">*</span></label>
               <input type="text" name="address" id="address" class="form-control" value="Kathmandu">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
            <label>Telephone<span class="text-red">*</span></label>
            <input type="number" name="tel_no" id="tnumber" class="form-control" value="{{ old('tel_no') }}" required>
            </div>
          </div>
          </div>

          <div class="form-group">
           <div class="col-lg-4">
            <div class="bs-component">
             <label for="gender">Mobile<span class="text-red">*</span></label><br>
              <input type="number" name="mob_no" id="mnumber" class="form-control" value="{{ old('mob_no') }}" required>
             </div>
            </div>          
          <div class="col-lg-4">
            <div class="bs-component">
            <label>Email<span class="text-red">*</span></label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
            <label>Facebook ID</label>
           <input type="text" name="facebook_id" id="fb" class="form-control" value="{{ old('facebook_id') }}">
            </div>
          </div>
          </div>      

        </div>
    </div>
    <!-- Application Types -->
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">In case of Emergency (OPTIONAL)</span>
        </div>
        <div class="panel-body">         

          <div class="form-group">
           
          <div class="col-lg-4">
            <div class="bs-component">
            <label>Name</label>
            <input type="text" name="e_name" class="form-control" value="{{ old('e_name') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
            <label>Relation</label>
            <input type="text" name="relation" class="form-control" value="{{ old('relation') }}">
            </div>
          </div>
        
           <div class="col-lg-4">
            <div class="bs-component">
            <label>Telephone</label>
            <input type="number" name="telephone" class="form-control" value="{{ old('telephone') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
            <label>Mobile</label>
            <input type="number" name="mobile" class="form-control" value="{{ old('mobile') }}">
            </div>
          </div>           
                
          </div>
           <div class="form-group">
            <div class="col-lg-9">
            <div class="bs-component">
            <label>Do you have participated in any road race yet?</label>
           <input type="radio" name="past_record" value="yes" class="form-check" id="yes">
            <label for="yes">Yes</label>
            <input type="radio" name="past_record" value="no" class="form-check" id="no">
            <label for="no">No</label>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="bs-component">
            <label>Have you already taken part in Kathmandu Marathon?</label>
             <input type="radio" name="previous_runner" value="yes" class="form-check" id="yess">
            <label for="yess">Yes</label>
            <input type="radio" name="previous_runner" value="no" class="form-check" id="noo">
            <label for="noo">No</label>
            </div>
          </div>
        
           </div>         

        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="admin-form">
        <div class="sid_ mb10">                    
            <footer>
                <div id="publishing-action">
                    <input type="submit" class="btn btn-primary btn-sm" value="Publish"/>
                </div>
                <div class="clearfix"></div>
            </footer>
            <div class="clearfix"></div>
        </div>

         <div class="sid_ mb10">
            <label class="field">
                 <h4> Application Type<span class="text-red">*</span> </h4> 
                 <span class="form-control">                        
                   <input type="radio" name="type" id="individual" class="form-check" value="1">
                    <label for="individual">Individual Entry</label>
                    <input type="radio" name="type" id="group" class="form-check" value="2">
                    <label for="group">Group Entry</label>
                </span>
                <i class="arrow"></i>
            </label>
        </div>

        <div class="sid_ mb10">
            <label class="field">
                 <h4> Event Category<span class="text-red">*</span> </h4>                         
                 <select name="event_category" class="form-control" id="individual_category">
                    @if($category1)
                    @foreach($category1 as $row)
                    <option value="{{$row->id}}"> {{$row->name}}</option>
                    @endforeach 
                    @endif  
                 </select>   
                   <select name="event_category2" class="form-control" style="display:none" id="group-event">
                    @if($category2)
                    @foreach($category2 as $row)
                    <option value="{{$row->id}}"> {{$row->name}}</option>
                    @endforeach 
                    @endif  
                 </select> 
                <i class="arrow"></i>
            </label>
        </div>

        <div class="sid_ mb10">
            <label class="field">
                 <h4> T-Shirts Size</h4>                         
                 <select name="size" class="form-control">
                    <option value="0" > None</option>
                    <option value="S"> S</option>
                    <option value="M"> M</option>
                    <option value="L"> L</option>
                    <option value="XL">XL </option>
                    <option value="XXL"> XXL</option>
                     <option value="XXXL">XXXL</option>               
                 </select>  
                <i class="arrow"></i>
            </label>
        </div>
         <div class="row" id="group-entry" style="display:none">
            <div class="sid_ mb10">
                <label class="field text"> Group Name:
                    <input type="text" id="" name="group_name" class="form-control" value="{{ old('group_name') }}"/>
                </label>
            </div>
             <div class="sid_ mb10">
                <label class="field text"> Group Size:
                    <input type="number" id="" name="group_size" class="form-control" value="{{ old('group_size') }}"min="2" max="4"/>
                </label>
            </div>
             <div class="sid_ mb10">
                <label class="field text"> Type of Group:
                    <input type="text" id="" name="group_type" class="form-control" value="{{ old('group_type') }}"/>
                </label>
            </div>
       </div>
        <div class="sid_ mb10">
            <h4> ID Image </h4>
            <div class="hd_show_con">
                <div id="xedit-demo">
                    <input type="file" name="file"/>
                </div>                       
            </div>
        </div>           
    </div>
</div>
</form>
@else
<h2><center>Registration Closed</center></h2>
@endif
@endsection

