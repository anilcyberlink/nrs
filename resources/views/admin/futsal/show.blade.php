@extends('admin.master')
@section('title','Member Registration')
@section('breadcrumb')
<a href="{{ url('admin/register-now') }}" class="btn btn-primary btn-sm">Register Here</a>
@endsection
@section('content')
<div class="tray tray-center" style="">
<div class="panel">
     <div class="panel-heading">
      <ul class="nav panel-tabs-border panel-tabs panel-tabs-left">
        <li class="active">
          <a href="#tab1_1" data-toggle="tab">All Teams</a>
        </li>
        <li>
          <a href="#tab1_2" data-toggle="tab">Pending Payment</a>
        </li>
        <li>
          <a href="#tab1_3" data-toggle="tab">Verified Payment</a>
        </li>
        <li>
          <a href="#tab1_4" data-toggle="tab">Esewa</a>
        </li>
        <li>
          <a href="#tab1_5" data-toggle="tab">Cash</a>
        </li>
       
      </ul>
    </div>
    <div class="panel-body">
      <div class="tab-content pn br-n">
      	<!-- All Members -->
         <div id="tab1_1" class="tab-pane active">
          <div class="_row">
            <div class="col-md-12">             
              <div id="users" class="tab-pane active">
               <div class="table-responsive mhn20 mvn15">
		          <table class="table admin-form theme-warning fs13"  id="datatable1">
		            <thead>
		              <tr class="bg-light">
		              <th>SN</th>
								<th>Team</th>                            
								<th>Company</th>  
								<th>Team Captain</th>   
								<th>Contact</th>                                                      
								<th>Email</th>     
		              </tr>
		            </thead>
		            <tbody>
		             @if(count($data) > 0) 
		      			@foreach($data as $row)
		      			     <tr class="id{{$row->id}}">
								<td>{{ $loop->iteration }}
		      		               <td>{{ ucfirst($row->team_name) }}</td>
								<td>{{ ucfirst($row->company_name) }}</td>
								<td>{{ ucfirst($row->team_captain) }}</td>   
								<td>{{ ucfirst($row->contact) }}</td>
								<td>{{ ucfirst($row->email) }}</td>
		            {{-- <td class="text-left">
		              <a href="{{route('member-details',$row->user_id)}}">View Profile</a> |
		              @if($row->members->paid_status == 0)
		              <span class="trash"> <a href="{{route('deletemember',$row->user_id)}}" onclick="return confirm('Are you sure you want to delete this?')">Delete</a></span>
		              @endif
		            </td> --}}
		      			</tr>
		      			@endforeach
		      			@endif
		            </tbody>
		          </table>
		        </div>
		        </div>             
            </div>
          </div>
        </div>
        <!-- All Members-->
         <!-- pending payment -->
        <div id="tab1_2" class="tab-pane">
          <div class="_row">
            <div class="col-md-12">             
              <div id="users" class="tab-pane active">
               <div class="table-responsive mhn20 mvn15">
		          <table class="table admin-form theme-warning fs13"  id="datatable2">
		            <thead>
		              <tr class="bg-light">
		              <th>SN</th>
								<th>Team</th>                            
								<th>Company</th>  
								<th>Team Captain</th>   
								<th>Contact</th>                                                      
								<th>Email</th>  
		              </tr>
		            </thead>
		            <tbody>
		              @if(count($pending) > 0)
		        			@foreach($pending as $row)
							<tr class="id{{$row->id}}">
		        			<td>{{ $loop->iteration }}
		      		               <td>{{ ucfirst($row->team_name) }}</td>
								<td>{{ ucfirst($row->company_name) }}</td>
								<td>{{ ucfirst($row->team_captain) }}</td>   
								<td>{{ ucfirst($row->contact) }}</td>
								<td>{{ ucfirst($row->email) }}</td>
		        			{{-- <td>
                     @if($row->members) 
                    {{$row->members->tshirt_size}}
		        			  @endif
        			   </td>
                        <td class="text-left">
                          <a href="{{route('member-details',$row->id)}}">View Profile</a>
                        </td> --}}
		        			</tr>
		        			@endforeach
		        			@endif
		            </tbody>
		          </table>
		        </div>
		        </div>
            </div>
          </div>
        </div>
        <!-- pending payment -->
        <!-- verified payment -->
        
           <div id="tab1_3" class="tab-pane">
          <div class="row">
            <div class="col-md-12">              
              <div id="users" class="tab-pane active">
               <div class="table-responsive mhn20 mvn15">
    	        <table class="table admin-form theme-warning fs13"  id="datatable3">
    	          <thead>
    	            <tr class="bg-light">
    	              <th>SN</th>
								<th>Team</th>                            
								<th>Company</th>  
								<th>Team Captain</th>   
								<th>Contact</th>                                                      
								<th>Email</th>  
    	            </tr>
    	          </thead>
    	          <tbody>
    	            @if(count($verified) > 0)
    	      			@foreach($verified as $row)
    	      			<tr class="id{{$row->id}}">
    	      		<td>{{ $loop->iteration }}
		      		               <td>{{ ucfirst($row->team_name) }}</td>
								<td>{{ ucfirst($row->company_name) }}</td>
								<td>{{ ucfirst($row->team_captain) }}</td>   
								<td>{{ ucfirst($row->contact) }}</td>
								<td>{{ ucfirst($row->email) }}</td>
    	                  {{-- <td class="text-left">
    	                    <a href="{{route('edit-member-details',$row->id)}}">Edit Profile</a>
    	                  </td> --}}
    	      			</tr>
    	      			@endforeach
    	      			@endif
    	          </tbody>
    	        </table>
    	      </div>
    	      </div>              
            </div>
          </div>
        </div>
        <!-- verified payment -->
		
        <!-- esewa -->
        <div id="tab1_4" class="tab-pane">
          <div class="row">
            <div class="col-md-12">              
              <div id="users" class="tab-pane active">
               <div class="table-responsive mhn20 mvn15">
		          <table class="table admin-form theme-warning fs13"  id="datatable4">
		            <thead>
		              <tr class="bg-light">
		                <th>SN</th>
								<th>Team</th>                            
								<th>Company</th>  
								<th>Team Captain</th>   
								<th>Contact</th>                                                      
								<th>Email</th>  
		              </tr>
		            </thead>
		            <tbody>
		                @if(count($esewa) > 0)
		          			@foreach($esewa as $row)
		          			<tr class="id{{$row->id}}">
		          			<td>{{ $loop->iteration }}
		      		               <td>{{ ucfirst($row->team_name) }}</td>
								<td>{{ ucfirst($row->company_name) }}</td>
								<td>{{ ucfirst($row->team_captain) }}</td>   
								<td>{{ ucfirst($row->contact) }}</td>
								<td>{{ ucfirst($row->email) }}</td>
    	                      {{-- <td class="text-left">
    	                        <a href="{{route('member-details',$row->id)}}">View Profile</a>
    	                      </td> --}}
		          			</tr>
		          			@endforeach
		          			@endif
		            </tbody>
		          </table>
		        </div>
		        </div>              
            </div>
          </div>
        </div>
        <!-- esewa -->
         <!-- paid at office -->
           <div id="tab1_5" class="tab-pane">
          <div class="row">
            <div class="col-md-12">              
              <div id="users" class="tab-pane active">
               <div class="table-responsive mhn20 mvn15">
		          <table class="table admin-form theme-warning fs13"  id="datatable5">
		            <thead>
		              <tr class="bg-light">
		                <th>SN</th>
								<th>Team</th>                            
								<th>Company</th>  
								<th>Team Captain</th>   
								<th>Contact</th>                                                      
								<th>Email</th>  
		              </tr>
		            </thead>
		            <tbody>
		               @if(count($cash) > 0)
		        			@foreach($cash as $row)
		        			<tr class="id{{$row->id}}">
		        			<td>{{ $loop->iteration }}
		      		               <td>{{ ucfirst($row->team_name) }}</td>
								<td>{{ ucfirst($row->company_name) }}</td>
								<td>{{ ucfirst($row->team_captain) }}</td>   
								<td>{{ ucfirst($row->contact) }}</td>
								<td>{{ ucfirst($row->email) }}</td>
    	                    {{-- <td class="text-left">
    	                      <a href="{{route('member-details',$row->id)}}">View Profile</a>
    	                    </td> --}}
		        			</tr>
		        			@endforeach
		        			@endif
		            </tbody>
		          </table>
		        </div>
		        </div>				              
            </div>
          </div>
        </div>
        <!-- paid at office -->
      </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#datatable1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
    } );
    $('#datatable2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
    } );
    $('#datatable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
    } );
    $('#datatable4').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
    } );
    $('#datatable5').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
    } );
} );
</script>
@endsection
