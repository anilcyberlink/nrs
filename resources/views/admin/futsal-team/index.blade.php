@extends('admin.master')
@section('title','Futsal Team')
@section('breadcrumb')
  <a href="admin/futsal-team/create" class="btn btn-primary btn-sm">Create</a>
@endsection
@section('content')
<div class="tray tray-center" style="height: 647px;">
<div class="panel">         
	<div class="panel-body ph20">
		<div class="tab-content">
			<div id="users" class="tab-pane active">
				<div class="table-responsive mhn20 mvn15">
					<table class="table admin-form theme-warning fs13" id="datatable3">
						<thead>
							<tr class="bg-light">
								<th>SN</th>
								<th>Team</th>                            
								<th>Company</th>  
								<th>Team Captain</th>   
								<th>Contact</th>                                                      
								<th>Email</th>                                                         
								<th class="text-center">Action</th> 
							</tr>
						</thead>
						<tbody>
							@if(count($data) > 0)	            
							@foreach($data as $row)
							<tr class="id{{$row->id}}"> 
								<td>{{$loop->iteration}}</td>
								<td>{{ ucfirst($row->team_name) }}</td>
								<td>{{ ucfirst($row->company_name) }}</td>
								<td>{{ ucfirst($row->team_captain) }}</td>   
								<td>{{ ucfirst($row->contact) }}</td>
								<td>{{ ucfirst($row->email) }}</td>
								<td class="text-center">  
									<a href="{{ url('admin/futsal-team/'.$row->id.'/edit') }}">Edit</a> 
									<a href="{{ url('admin/futsal-team/'.$row->id.'/destroy') }}" onclick="return confirm('Confirm Delete?')" class="btn-delete">
										Delete
									</a>
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
@endsection
@section('libraries')
<script src="{{asset('/vendor/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('/vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
<script src="{{asset('/vendor/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')}}"></script>
<script src="{{asset('vendor/plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script> //
<script type="text/javascript">
  /************/
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
    "iDisplayLength": 10,
    "aLengthMenu": [
    [5, 10, 25, 50, -1],
    [5, 10, 25, 50, "All"]
    ],
    "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
    "oTableTools": {
      "sSwfPath": "{{asset('vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf')}}"
    }
  });
</script>
@endsection