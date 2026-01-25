@extends('admin.master')
@section('title', 'Member Registration')
@section('breadcrumb')
    <a href="{{ url('admin/register-now',$event_id) }}" class="btn btn-primary btn-sm">
        Register Here</a>
@endsection
@section('content')
    <div class="tray tray-center" style="">
        <div class="panel">
            <div class="panel-heading">
                <ul class="nav panel-tabs-border panel-tabs panel-tabs-left">
                    <!--<li class="active">-->
                    <!--    <a href="#tab1_1" data-toggle="tab">All Members</a>-->
                    <!--</li>-->
                    <li class="active">
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
                    <li>
                        <a href="#tab1_6" data-toggle="tab">Khalti</a>
                    </li>
                    <!--<li>-->
                    <!--    <a href="#tab1_7" data-toggle="tab">Half Marathon</a>-->
                    <!--</li>-->
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content pn br-n">
                    <!-- All Members -->
                    <!--<div id="tab1_1" class="tab-pane active">-->
                    <!--    <div class="_row">-->
                    <!--        <div class="col-md-12">-->
                    <!--            <div id="users" class="tab-pane active">-->
                    <!--                <div class="table-responsive mhn20 mvn15">-->
                    <!--                    <table class="table admin-form theme-warning fs13" id="datatable1">-->
                    <!--                        <thead>-->
                    <!--                            <tr class="bg-light">-->
                    <!--                                <th class=""> Reg No.</th>-->
                    <!--                                <th class="">Date</th>-->
                    <!--                                <th class="">Name</th>-->
                    <!--                                <th class=""> Email </th>-->
                    <!--                                <th class=""> Phone </th>-->
                    <!--                                <th class="">Race Type </th>-->
                    <!--                                <th class=""> Payment Type </th>-->
                    <!--                                <th class="">Status </th>-->
                    <!--                                <th class="">Details</th>-->
                    <!--                            </tr>-->
                    <!--                        </thead>-->
                    <!--                        <tbody>-->
                                               
                    <!--                            @if (count($data) > 0)-->
                    <!--                                @foreach ($data as $row)-->
                                                    
                    <!--                                    <tr class="id{{ $row->id }}">-->
                    <!--                                        <td class="">{{ $row->members->reg_no }}</td>-->
                    <!--                                        <td>{{ $row->members->updated_at }}</td>-->
                    <!--                                        <td class="">{{ $row->members->first_name }}-->
                    <!--                                            {{ $row->members->last_name }}</td>-->
                    <!--                                        <td> {{ $row->members->email }} </td>-->
                    <!--                                           <td> {{ $row->members->mobile_no }} </td>-->
                    <!--                                        <td>{{ event_category($row->event_category) }}</td>-->
                    <!--                                        <td>{{ $row->members->payment_type }}</td>-->
                    <!--                                        <td>-->
                    <!--                                            @if ($row->members->paid_status == 1)-->
                    <!--                                                <button class="btn btn-success btn btn-sm"-->
                    <!--                                                    name="active"><i class="fa fa-check"></i></button>-->
                    <!--                                            @endif-->
                    <!--                                            <form method="post"-->
                    <!--                                                action="{{ route('payment-status') }}">-->
                    <!--                                                <input type="hidden" name="deal"-->
                    <!--                                                    value="{{ $row->user_id }}">-->
                    <!--                                                @csrf-->
                    <!--                                                @if ($row->members->paid_status == 0)-->
                    <!--                                                    <button class="btn btn-danger btn btn-sm"-->
                    <!--                                                        name="inactive"-->
                    <!--                                                        onclick="return confirm('Are you sure you want to change status?')"><i-->
                    <!--                                                            class="fa fa-times"></i></button>-->
                    <!--                                                    <br /><small>Click to change </small>-->
                    <!--                                                @endif-->
                    <!--                                            </form>-->
                    <!--                                        </td>-->
                    <!--                                        <td class="text-left">-->
                    <!--                                            <a href="{{ route('member-details', $row->user_id) }}">View-->
                    <!--                                                Profile</a> |-->
                    <!--                                            @if ($row->members->paid_status == 0)-->
                    <!--                                                <span class="trash"> <a-->
                    <!--                                                        href="{{ route('deletemember', $row->user_id) }}"-->
                    <!--                                                        onclick="return confirm('Are you sure you want to delete this?')">Delete</a></span>-->
                    <!--                                            @endif-->
                    <!--                                        </td>-->
                    <!--                                    </tr>-->
                                                      
                                                      
                    <!--                                @endforeach-->
                    <!--                            @endif-->
                    <!--                        </tbody>-->
                    <!--                    </table>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!-- All Members-->
                    <!-- pending payment -->
                    <div id="tab1_2" class="tab-pane active">
                        <div class="_row">
                            <div class="col-md-12">
                                <div id="users" class="tab-pane active">
                                    <div class="table-responsive mhn20 mvn15">
                                        <table class="table admin-form theme-warning fs13" id="datatable2">
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
                                                
                                                @if (count($pending) > 0)
                                                    @foreach ($pending as $row)
                                                  
                                                        <tr class="id{{ $row->id }}">
                                                            <td class="">{{ $row->reg_no }}</td>
                                                            <td>{{ $row->updated_at->format('d M Y') }}</td>
                                                            <td class="">{{ $row->first_name }}
                                                                {{ $row->last_name }}</td>
                                                            <td> {{ $row->email }} </td>
                                                            <td>{{ racetype($row->id) }}</td>
                                                            <td>{{ $row->telephone_no }}, {{ $row->mobile_no }}</td>
                                                            <td>{{ $row->gender }}</td>
                                                            <td>
                                                                @if ($row->members)
                                                                    {{ $row->members->tshirt_size }}
                                                                @endif
                                                            </td>
                                                            <td class="text-left">
                                                                <a href="{{ route('member-details', $row->id) }}">View
                                                                    Profile</a>
                                                                        <a href="{{ route('edit-member-details', $row->id) }}">Edit
                                                                    Profile</a><br>
                                                                        <a href="{{ route('deletemember', $row->id) }}" onclick="return confirm('Are you sure you want to delete this member?')">Delete
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
                    <!-- pending payment -->
                    <!-- verified payment -->

                    <div id="tab1_3" class="tab-pane">
                        <div class="_row">
                            <div class="col-md-12">
                                <div id="users" class="tab-pane active">
                                    <div class="table-responsive mhn20 mvn15">
                                        <table class="table admin-form theme-warning fs13" id="datatable3">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class=""> Reg No.</th>
                                                    <th class="">Date</th>
                                                    <th class="">Name</th>
                                                    <th class="">Details</th>
                                                    <th class=""> Race Type </th>
                                                    <th>Ph. No.</th>
                                                    <th>Gender</th>
                                                    <th>Tshirt Size</th>
                                                    <th class="">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($verified) > 0)
                                                    @foreach ($verified as $row)
                                                        <tr class="id{{ $row->id }}">
                                                            <td class="">{{ $row->reg_no }}</td>
                                                            <td>{{ $row->updated_at->format('d M Y') }}</td>
                                                            <td class="">{{ $row->first_name }}
                                                                {{ $row->last_name }}
                                                                <br> 
                                                                {{ $row->email }}
                                                                </td>
                                                            <td> 
                                                            Bib No: {{ $row->bib_no }} 
                                                            <br/>
                                                            Blood Group : {{$row->blood_group}}
                                                                   <br/>
                                                            Occupation: {{$row->occupation}}
                                                            <br/>

                                                            Address: {{$row->address}}
                                                            
                                                            </td>
                                                            <td>{{ racetype($row->id) }}</td>
                                                            <td>{{ $row->telephone_no }}, {{ $row->mobile_no }}</td>
                                                            <td>{{ $row->gender }}</td>
                                                            <td>
                                                                @if ($row->members)
                                                                    {{ $row->members->tshirt_size }}
                                                                @endif
                                                            </td>
                                                            <td class="text-left">
                                                                <a href="{{ route('edit-member-details', $row->id) }}">Edit
                                                                    Profile</a>
                                                                <a href="{{ route('deletemember', $row->id) }}" onclick="return confirm('Are you sure you want to delete this member?')">Delete
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
                    <!-- verified payment -->
                    <!-- esewa -->

                    <div id="tab1_4" class="tab-pane">
                        <div class="_row">
                            <div class="col-md-12">
                                <div id="users" class="tab-pane active">
                                    <div class="table-responsive mhn20 mvn15">
                                        <table class="table admin-form theme-warning fs13" id="datatable4">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class=""> Reg No.</th>
                                                    <th class="">Date</th>
                                                    <th class="">Name</th>
                                                    <th class=""> Email </th>
                                                    <th>Price</th>
                                                    <th class=""> Tshirt Size </th>
                                                    <th class="">Race Type </th>
                                                    <th class="">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($esewa) > 0)
                                                    @foreach ($esewa as $row)
                                                        <tr class="id{{ $row->id }}">
                                                            <td class="">{{ $row->reg_no }}</td>
                                                            <td>{{ $row->updated_at->format('d M Y') }}</td>
                                                            <td class="">{{ $row->first_name }}
                                                                {{ $row->last_name }}</td>
                                                            <td> {{ $row->email }} </td>
                                                            <td>Rs.{{ $row->entry_price }}</td>
                                                            <td>
                                                                @if ($row->members)
                                                                    {{ $row->members->tshirt_size }}
                                                                @endif
                                                            </td>
                                                            <td>{{ racetype($row->id) }}</td>
                                                            <td class="text-left">
                                                                <a href="{{ route('member-details', $row->id) }}">View
                                                                    Profile</a>
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
                    <!-- esewa -->
                    <!-- paid at office -->
                    <div id="tab1_5" class="tab-pane">
                        <div class="_row">
                            <div class="col-md-12">
                                <div id="users" class="tab-pane active">
                                    <div class="table-responsive mhn20 mvn15">
                                        <table class="table admin-form theme-warning fs13" id="datatable5">
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
                                                @if (count($cash) > 0)
                                                    @foreach ($cash as $row)
                                                        <tr class="id{{ $row->id }}">
                                                            <td class="">{{ $row->reg_no }}</td>
                                                            <td>{{ $row->updated_at->format('d M Y') }}</td>
                                                            <td class="">{{ $row->first_name }}
                                                                {{ $row->last_name }}</td>
                                                            <td> {{ $row->email }} </td>
                                                            <td>{{ racetype($row->id) }}</td>
                                                            <td class="text-left">
                                                                <a href="{{ route('member-details', $row->id) }}">View
                                                                    Profile</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>p
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- paid at office -->
                    <!-- Khalti Payment -->

                    <div id="tab1_6" class="tab-pane">
                        <div class="_row">
                            <div class="col-md-12">
                                <div id="users" class="tab-pane active">
                                    <div class="table-responsive mhn20 mvn15">
                                        <table class="table admin-form theme-warning fs13" id="datatable6">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class=""> Reg No.</th>
                                                    <th class="">Date</th>
                                                    <th class="">Name</th>
                                                    <th class=""> Email </th>
                                                    <th>Price</th>
                                                    <th class="">Race Type </th>
                                                    <th class="">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($khalti) > 0)
                                                    @foreach ($khalti as $row)
                                                        <tr class="id{{ $row->id }}">
                                                            <td class="">{{ $row->reg_no }}</td>
                                                            <td>{{ $row->updated_at->format('d M Y') }}</td>
                                                            <td class="">{{ $row->first_name }}
                                                                {{ $row->last_name }}</td>
                                                            <td> {{ $row->email }} </td>
                                                            <td>Rs.{{ $row->entry_price }}</td>
                                                            <td>{{ racetype($row->id) }}</td>

                                                            <td class="text-left">
                                                                <a href="{{ route('member-details', $row->id) }}">View
                                                                    Profile</a>
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
                    <!-- Khalti Payment -->
                    <!-- Half Marathon -->
                    <div id="tab1_7" class="tab-pane">
                        <div class="_row">
                            <div class="col-md-12">
                                <div id="users" class="tab-pane active">
                                    <div class="table-responsive mhn20 mvn15">
                                        <table class="table admin-form theme-warning fs13" id="datatable7">
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
                                                @if (count($half_marathone) > 0)
                                                    @foreach ($half_marathone as $row)
                                                        @if (racetype($row->id) == 'Half Marathon')
                                                            <tr class="id{{ $row->id }}">
                                                                <td class="">{{ $row->reg_no }}</td>
                                                                <td>{{ $row->updated_at->format('d M Y') }}</td>
                                                                <td class="">{{ $row->first_name }}
                                                                    {{ $row->last_name }}</td>
                                                                <td> {{ $row->email }} </td>
                                                                <td>{{ racetype($row->id) }} </td>
                                                                <td>{{ $row->telephone_no }}, {{ $row->mobile_no }}</td>
                                                                <td>{{ $row->gender }}</td>
                                                                <td>
                                                                    @if ($row->members)
                                                                        {{ $row->members->tshirt_size }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-left">
                                                                    {{-- <button class="btn btn-sm bg-danger"><a
                                                                            href="{{ route('member-details', $row->id) }}">View
                                                                            Profile</a></button><br> --}}
                                                                    <button class="btn btn-sm {{ $row->reg_email_status == 1 ? 'bg-success' : 'bg-danger' }} text-white"> <a
                                                                            class="text-white"
                                                                            href="{{ route('assign-reg-no', $row->id) }}">Send Email</a> </button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Half Marathon -->
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
            $('#datatable1').DataTable({
                dom: 'Bfrtip',
                "aaSorting": [],
                buttons: [
                    'excel'
                ]
            });
            $('#datatable2').DataTable({
                dom: 'Bfrtip',
                "aaSorting": [],
                buttons: [
                    'excel'
                ]
            });
            $('#datatable3').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            });
            $('#datatable4').DataTable({
                dom: 'Bfrtip',
                "aaSorting": [],
                buttons: [
                    'excel'
                ]
            });
            $('#datatable5').DataTable({
                dom: 'Bfrtip',
                "aaSorting": [],
                buttons: [
                    'excel'
                ]
            });
            $('#datatable6').DataTable({
                dom: 'Bfrtip',
                "aaSorting": [],
                buttons: [
                    'excel'
                ]
            });
            $('#datatable7').DataTable({
                dom: 'Bfrtip',
                "aaSorting": [],
                buttons: [
                    'excel'
                    
                ]
            });
        });
    </script>
@endsection
