  <div class="col-md-12">
<div class="panel">
  <div class="panel-heading">
    <span class="panel-title">Player Details</span>
    <a class="btn btn-primary pull-right add-certificates" data-added="0"><i class="glyphicon glyphicon-plus"></i> Add Row </a>
  </div>
   <div class="panel-body" id="row_certificates_body">
            <div class="row">
             
                <div class="col-md-1">
                    <label>ID No.</label>

                </div>
                 <div class="col-md-2">
                    <label>Name</label>

                </div> <div class="col-md-1">
                    <label>DOB</label>

                </div>
                 <div class="col-md-2">
                    <label>Contact</label>

                </div>
                    <div class="col-md-2">
                    <label>Email</label>

                </div>
                  <div class="col-md-2">
                    <label>Image</label>
                </div>
                 <div class="col-md-1">
                    <label>Remarks</label>
                </div>
                <div class="col-md-1">
                  {{-- <label>Action</label> --}}
                </div>
            </div>
        </div>  


    @if($certificates->count() > 0) 
      @foreach($certificates as $row)       
        <div class="row" id="certificates-rec-{{$loop->iteration}}"> 
           <input type="hidden" name="certificates_id[]" value="{{$row->id}}" />  
            <div class="col-md-1"><input type="text" name="identification_number[]" class="form-control" value="{{ $row->identification_number }}" /></div>
            <div class="col-md-2"><input type="text" name="name[]" class="form-control" value="{{ $row->name }}" /></div>
            <div class="col-md-1"><input type="text" name="dob[]" class="form-control" value="{{ $row->dob }}" /></div>
            <div class="col-md-2"><input type="text" name="contact[]" class="form-control" value="{{ $row->contact }}" /></div>
            <div class="col-md-2"><input type="text" name="email[]" class="form-control" value="{{ $row->email }}" /></div>
            <div class="col-md-3"><input type="file" name="image[]" class="form-control" value="{{$row->image}}" />
            @if($row->image)              
              <img src="{{ asset(env('PUBLIC_PATH').'uploads/team/' . $row->image) }}" width="100" />             
              @endif  </div>  
            <div class="col-md-1"><input type="text" name="remarks[]" class="form-control" value="{{ $row->remarks }}" /></div>  
            <div class="col-md-1"><button class="btn btn-danger delete-certificates" certificates-rowid="{{$row->id}}" certificates-data-id="{{$loop->iteration}}"><i class="glyphicon glyphicon-trash"></i></button></div>  
        </div> 
        @endforeach
        @endif      
  </div>



  <div style="display:none;">
      <div id="row_certificates_additional">
        <div class="row">
            <input type="hidden" name="certificates_id[]" value="" />
            <div class="col-md-1"><input type="text" name="identification_number[]" class="form-control" placeholder="ID" /></div>
            <div class="col-md-2"><input type="text" name="name[]" class="form-control" placeholder="Full Name" /></div>
            <div class="col-md-1"><input type="text" name="dob[]" class="form-control" placeholder="DOB" /></div>
            <div class="col-md-2"><input type="text" name="contact[]" class="form-control" placeholder="Contact" /></div>
            <div class="col-md-2"><input type="text" name="email[]" class="form-control" placeholder="Email" /></div>
            <div class="col-md-2"><input type="file" name="image[]" class="form-control" /></div>  
            <div class="col-md-1"><input type="text" name="remarks[]" class="form-control" placeholder="Remarks" /></div>  
            <div class="col-md-1"><button class="btn btn-danger delete-certificates" schedule-data-id="0"><i class="glyphicon glyphicon-trash"></i></button></div>  
        </div>
    </div>
  </div>

  
</div>


</div>   

