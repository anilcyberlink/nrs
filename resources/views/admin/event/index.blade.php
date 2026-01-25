@extends('admin.master')
@section('title','Banner')
@section('breadcrumb')
  <a href="admin/event/create" class="btn btn-primary btn-sm">Create</a>
  
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
								<th>Created at</th>                            
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							@if(count($data) > 0)	            
							@foreach($data as $row)
							<tr class="id{{$row->id}}">
								<td>{{$loop->iteration}}</td>
								<td><a href="{{ url('admin/event/'.$row->id) }}">{{ ucfirst($row->name) }}</a></td>
								
								<td class="">
								    <form action="{{route('event.isdefault',$row->id)}}" method="POST">
										@csrf	
										 @if(($row->status)==0)
                        <button class="btn btn-danger btn btn-sm" name="status" value="0" type="submit"><i
                                class="fa fa-times"></i>
                        </button>
                   		 @else
                        <button class="btn btn-success btn btn-sm" name="status" value="1" type="submit"><i
                                class="fa fa-check"></i>
                        </button>
                 	   @endif								 									
									
									</form>
								</td>
								
								<td>{{ ucfirst($row->created_at) }}</td>
								<td class="text-center">  
									<a href="{{ url('admin/event/'.$row->id.'/edit') }}">Edit</a>
										@if(!is_empty_event($row->id))									 |
									<a href="{{ url('admin/event/'.$row->id.'/destroy') }}" onclick="return confirm('Confirm Delete?')" class="btn-delete">
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