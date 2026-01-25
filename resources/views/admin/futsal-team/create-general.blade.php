
<div class="col-md-12">
      <!-- Input Fields -->
      <div class="panel">
        <div class="panel-heading">
          <span class="panel-title">Futsal Team</span> 
        </div>
        <div class="panel-body">   

             <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">Event</label>
              <div class="col-lg-6">
                <div class="bs-component">
                  <select name="event_id" class="form-control">
                    <option value="0" selected disabled> Select Event </option>
                    @if($data)                  
                    @foreach($data as $row)
                    <option value="{{$row->id}}"> {{$row->event_name}}</option>
                    @endforeach  
                    @endif 
                  </select>
                </div>
              </div>
            </div>
       
            <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">Name</label>
              <div class="col-lg-6">
                <div class="bs-component"> 
                  <input type="text" id="inputStandard" name="team_name" class="form-control" placeholder="" />
                </div>
              </div>
            </div> 

             <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">Company</label>
              <div class="col-lg-6">
                <div class="bs-component"> 
                  <input type="text" id="inputStandard" name="company_name" class="form-control" placeholder="" />
                </div>
              </div>
            </div> 
             <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">Team Captain</label>
              <div class="col-lg-6">
                <div class="bs-component"> 
                  <input type="text" id="inputStandard" name="team_captain" class="form-control" placeholder="" />
                </div>
              </div>
            </div> 
             <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">Contact</label>
              <div class="col-lg-6">
                <div class="bs-component"> 
                  <input type="text" id="inputStandard" name="team_contact" class="form-control" placeholder="" /> 
                </div>
              </div>
            </div> 

                 <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">Email</label> 
              <div class="col-lg-6">
                <div class="bs-component"> 
                  <input type="text" id="inputStandard" name="team_email" class="form-control" placeholder="" />
                </div>
              </div>
            </div> 
        
                    
           
          
        </div>
      </div>          
    </div>
