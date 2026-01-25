@extends('admin.master')
@section('title','Banner')
@section('breadcrumb')
  <a href="admin/event-category/create" class="btn btn-primary btn-sm">Create</a>
  
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
								<th>Title</th>                            
								<th>Status</th>  
								<th>Event</th>    
								<th>Price</th>                              
								<th>Created at</th>                            
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							@if(count($data) > 0)	            
							@foreach($data as $row)
							<tr class="id{{$row->id}}">
								<td>{{$loop->iteration}}</td>
								<td>{{ $row->name }}</td>
								<td>{{($row->status == 1)?'Enable':'Disable'}}</td>
								<td>{{ event_name($row->event) }}</td>
								<td>{{ $row->price }}</td>		
								<td>{{ ucfirst($row->created_at) }}</td>
								<td class="text-center">  
									<a href="{{ url('admin/event-category/'.$row->id.'/edit') }}">Edit</a>	
									@if(!is_empty_eventcategory($row->id))|
									<a href="{{ url('admin/event-category/'.$row->id.'/destroy') }}" onclick="return confirm('Confirm Delete?')" class="btn-delete">
										Delete
									</a>
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