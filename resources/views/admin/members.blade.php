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
          <a href="#tab1_1" data-toggle="tab">All Members</a>
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
           <div id="tab1_1" class="tab-pane active">
          <div class="_row">
            <div class="col-md-12">
             
              <div id="users" class="tab-pane active">
               <div class="table-responsive mhn20 mvn15">
          <table class="table admin-form theme-warning fs13"  id="datatable1">
            <thead>
              <tr class="bg-light">
               <th class=""> Reg No.</th>
                <th class="">Date</th>
        				<th class="">Name</th>
        				<th class=""> Email </th>
        				<th class="">Race Type </th>
        				<th class=""> Payment Type </th>
        				<th class="">Status  </th>
                <th class="">Details</th>
              </tr>
            </thead>
            <tbody>
             @if(count($data) > 0)
      			@foreach($data as $row)
      			<tr class="id{{$row->id}}">
      			<td class="">{{$row->reg_no}}</td>
            <td>{{$row->updated_at->format('d M Y')}}</td>
      			<td class="">{{$row->first_name}} {{$row->last_name}}</td>
      			<td> {{ $row->email }} </td>
      			<td>{{racetype($row->id)}}</td>
      			<td>{{$row->payment_type}}</td>
      			<td>
      			@if($row->paid_status == 1)
                <button class="btn btn-success btn btn-sm" name="active" ><i class="fa fa-check"></i></button>
                @endif
      	      <form method="post" action="{{route('payment-status')}}">
              <input type="hidden" name="deal" value="{{$row->id}}">
              @csrf
      		  @if($row->paid_status == 0)
                <button class="btn btn-danger btn btn-sm" name="inactive" onclick="return confirm('Are you sure you want to change status?')"><i class="fa fa-times"></i></button>
                <br/><small>Click to change </small>
      		    @endif
                </form>
      			</td>
            <td class="text-left">
              <a href="{{route('member-details',$row->id)}}">View Profile</a> |
              @if($row->paid_status == 0)
              <span class="trash"> <a href="{{route('deletemember',$row->id)}}" onclick="return confirm('Are you sure you want to delete this?')">Delete</a></span>
              @endif
            </td>
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
        <div id="tab1_2" class="tab-pane">
          <div class="_row">
            <div class="col-md-12">
             
              <div id="users" class="tab-pane active">
               <div class="table-responsive mhn20 mvn15">
                <table class="table admin-form theme-warning fs13"  id="datatable2">
                  <thead>
                    <tr class="bg-light">
                     <th class=""> Reg No.</th>
                      <th class="">Date</th>
              				<th class="">Name</th>
              				<th class=""> Email </th>
              				<th class=""> Race Type</th>
              				<th>Ph. No.</th>
              				<th>Gender</th>
              				<th>Tshirt Size</th>
                      <th class="">Details</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($pending) > 0)
              			@foreach($pending as $row)
              			<tr class="id{{$row->id}}">
              			<td class="">{{$row->reg_no}}</td>
                          <td>{{$row->updated_at->format('d M Y')}}</td>
              			<td class="">{{$row->first_name}} {{$row->last_name}}</td>
              			<td> {{ $row->email }} </td>
              			<td>{{racetype($row->id)}}</td>
              			<td>{{$row->telephone_no}}, {{$row->mobile_no}}</td>
              			<td>{{$row->gender}}</td>
              			<td>
                           @if($row->members) 
                          {{$row->members->tshirt_size}}
              			  @endif
              			   </td>
                          <td class="text-left">
                            <a href="{{route('member-details',$row->id)}}">View Profile</a>
                          </td>
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
        
           <div id="tab1_3" class="tab-pane">
          <div class="row">
            <div class="col-md-12">
              
              <div id="users" class="tab-pane active">
               <div class="table-responsive mhn20 mvn15">
                <table class="table admin-form theme-warning fs13"  id="datatable3">
                  <thead>
                    <tr class="bg-light">
                       <th class=""> Reg No.</th>
                      <th class="">Date</th>
              				<th class="">Name</th>
              				<th class=""> Bib No </th>
              				<th class=""> Race Type </th>
              				<th>Ph. No.</th>
              				<th>Gender</th>
              				<th>Tshirt Size</th>
                      <th class="">Details</th>
                    </tr>
                  </thead>
                  <tbody>
                         @if(count($verified) > 0)
              			@foreach($verified as $row)
              			<tr class="id{{$row->id}}">
              			<td class="">{{$row->reg_no}}</td>
                          <td>{{$row->updated_at->format('d M Y')}}</td>
              			<td class="">{{$row->first_name}} {{$row->last_name}} <br> {{ $row->email }}</td>
              			<td> {{ $row->bib_no }} </td>
              			<td>{{racetype($row->id)}}</td>
              			<td>{{$row->telephone_no}}, {{$row->mobile_no}}</td>
              			<td>{{$row->gender}}</td>
              			<td>
              			      @if($row->members) 
                          {{$row->members->tshirt_size}}
              			  @endif
              			  
              			</td>
                          <td class="text-left">
                            <a href="{{route('edit-member-details',$row->id)}}">Edit Profile</a>
                          </td>
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
        
        <div id="tab1_4" class="tab-pane">
          <div class="row">
            <div class="col-md-12">
              
              <div id="users" class="tab-pane active">
               <div class="table-responsive mhn20 mvn15">
                <table class="table admin-form theme-warning fs13"  id="datatable4">
                  <thead>
                    <tr class="bg-light">
                       <th class=""> Reg No.</th>
                      <th class="">Date</th>
              				<th class="">Name</th>
              				<th class=""> Email </th>
              				<th class="">Race Type </th>
                      <th class="">Details</th>
                    </tr>
                  </thead>
                  <tbody>
                         @if(count($esewa) > 0)
                			@foreach($esewa as $row)
                			<tr class="id{{$row->id}}">
                			<td class="">{{$row->reg_no}}</td>
                            <td>{{$row->updated_at->format('d M Y')}}</td>
                			<td class="">{{$row->first_name}} {{$row->last_name}}</td>
                			<td> {{ $row->email }} </td>
                			<td>{{racetype($row->id)}}</td>
                            <td class="text-left">
                              <a href="{{route('member-details',$row->id)}}">View Profile</a>
                            </td>
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
         
           <div id="tab1_5" class="tab-pane">
          <div class="row">
            <div class="col-md-12">
              
              <div id="users" class="tab-pane active">
               <div class="table-responsive mhn20 mvn15">
                <table class="table admin-form theme-warning fs13"  id="datatable5">
                  <thead>
                    <tr class="bg-light">
                       <th class=""> Reg No.</th>
                      <th class="">Date</th>
              				<th class="">Name</th>
              				<th class=""> Email </th>
              				<th class=""> Race Type </th>
                      <th class="">Details</th>
                    </tr>
                  </thead>
                  <tbody>
                         @if(count($cash) > 0)
              			@foreach($cash as $row)
              			<tr class="id{{$row->id}}">
              			<td class="">{{$row->reg_no}}</td>
                          <td>{{$row->updated_at->format('d M Y')}}</td>
              			<td class="">{{$row->first_name}} {{$row->last_name}}</td>
              			<td> {{ $row->email }} </td>
              			<td>{{racetype($row->id)}}</td>
                          <td class="text-left">
                            <a href="{{route('member-details',$row->id)}}">View Profile</a>
                          </td>
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
       
        
      </div>
    </div>

</div>
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
<script type="text/javascript">

$('#datatable1').dataTable({
    "aoColumnDefs": [{
      'bSortable': true,
      'aTargets': [-1]

    }],
    "oLanguage": {
      "oPaginate": {
        "sPrevious": "Previous",
        "sNext": "Next"
      }
    },
    "iDisplayLength": 50,
    "aLengthMenu": [
    [5, 10, 25, 50, -1],
    [5, 10, 25, 50, "All"]
    ],
   
    "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',

    "oTableTools": {
      "sSwfPath": "{{asset(env('PUBLIC_PATH'))}}vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
    },
    
  });
  
  $('#datatable2').dataTable({
    "aoColumnDefs": [{
      'bSortable': true,
      'aTargets': [-1]

    }],
    "oLanguage": {
      "oPaginate": {
        "sPrevious": "Previous",
        "sNext": "Next"
      }
    },
    "iDisplayLength": 30,
    "aLengthMenu": [
    [5, 10, 25, 50, -1],
    [5, 10, 25, 50, "All"]
    ],
    "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
    "oTableTools": {
      "sSwfPath": "{{asset(env('PUBLIC_PATH'))}}vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
    }
  });
$('#datatable3').dataTable({
    "aoColumnDefs": [{
      'bSortable': true,
      'aTargets': [-1]

    }],
    "oLanguage": {
      "oPaginate": {
        "sPrevious": "Previous",
        "sNext": "Next"
      }
    },
    "iDisplayLength": 30,
    "aLengthMenu": [
    [5, 10, 25, 50, -1],
    [5, 10, 25, 50, "All"]
    ],
    "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
    "oTableTools": {
      "sSwfPath": "{{asset(env('PUBLIC_PATH'))}}vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
    }
  });
$('#datatable4').dataTable({
    "aoColumnDefs": [{
      'bSortable': true,
      'aTargets': [-1]

    }],
    "oLanguage": {
      "oPaginate": {
        "sPrevious": "Previous",
        "sNext": "Next"
      }
    },
    "iDisplayLength": 30,
    "aLengthMenu": [
    [5, 10, 25, 50, -1],
    [5, 10, 25, 50, "All"]
    ],
    "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
    "oTableTools": {
      "sSwfPath": "{{asset(env('PUBLIC_PATH'))}}vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
    }
  });

$('#datatable5').dataTable({
    "aoColumnDefs": [{
      'bSortable': true,
      'aTargets': [-1]

    }],
    "oLanguage": {
      "oPaginate": {
        "sPrevious": "Previous",
        "sNext": "Next"
      }
    },
    "iDisplayLength": 30,
    "aLengthMenu": [
    [5, 10, 25, 50, -1],
    [5, 10, 25, 50, "All"]
    ],
    "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
    "oTableTools": {
      "sSwfPath": "{{asset(env('PUBLIC_PATH'))}}vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
    }
  });

  </script>
@endsection
