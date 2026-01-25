 @extends('themes.default.common.master')
@section('content')
<section class="blogs-main archives single section">
    <div class="container">   
   <form id="checkout-form" method="POST">  
    <h3>Registration Information</h3>
    <hr />
    <div class="row">
        <div class="form-group col-sm-4">
            <label>Team Name:</label>
            <input type="text" class="form-control" name="reg_no" readonly value="{{$store->team_name}}">
        </div>
        {{-- <!--@if(!$eventcategory->price == '0')--> --}}
        <!--<div class="form-group col-sm-1 mt-4">-->
        <!--<img src="{{asset('themes-assets/images/khalti.png')}}" width="30">-->
        <!--        <a href="https://rb.gy/9bcxqz" target="_blank">Pay With Khalti</a>    -->
        <!--</div>-->
         <div class="form-group col-sm-3">
        <button id="esewa1" type="submit" class="btn">Pay With Esewa</button> 
        </div>
      
        {{-- <!--@endif--> --}}
    </div>  
    </form>
    </div>
</section> 
<div class="container">
    <table class="table table-bordered table-responsive">

        <thead>
        <tr>
        <th scope="col">Particulars</th>
        <th scope="col">Details</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td>Entry Fee</td>
        <td>
            Rs.{{ $event->price }}
        </td>
        </tr>
   
        <tr>
        <td>Event Category</td>
        <td>{{$event->event_name}}</td>
        </tr>
        <tr>
        <td>Company Details</td>
        <td>
            <ul>
            <li>Company Name: {{$store->company_name}}</li>
            <li>Team Captain: {{$store->team_captain}}</li>
            <li>Team Contact: {{$store->contact}}</li>
            <li>Team Email: {{$store->email}}</li>
            </ul>
        </td>
        </tr>
        </tbody>
        </table>
        
</div>


 

@endsection  

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>  
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $('form').on('submit', function(e) {
                e.preventDefault();
              var radioValue = {{ $event->price }}; 
                var run_id={{ $store->id }};
                let form = document.getElementById('checkout-form');
                let data = new FormData(form);
                data.append('price', radioValue);
                data.append('id',run_id);
                if ($("input[name='event']:checked").data('price') == '0') {
     
                } else {
                    axios.post("{{ route('futsal.payment') }}", data).then(res => {
                  
                        var path = "https://esewa.com.np/epay/main";
                        var params = {
                            amt: res.data.total_price,
                            psc: 0,
                            pdc: 0,
                            txAmt: 0,
                            tAmt: res.data.total_price,
                            pid: res.data.ref_id,
                            scd: "NP-ES-NRSSPORTS", // please use your merchant id here...
                            su: "https://nrssportsfoundation.org.np/futsal-payment/success?q=su",
                            fu: "https://nrssportsfoundation.org.np/futsal-payment/failure?q=fu"
                        }
                        var form = document.createElement("form");
                        form.setAttribute("method", "POST");
                        form.setAttribute("action", path); 

                        for (var key in params) {
                            var hiddenField = document.createElement("input");
                            hiddenField.setAttribute("type", "hidden");
                            hiddenField.setAttribute("name", key);
                            hiddenField.setAttribute("value", params[key]);
                            form.appendChild(hiddenField);
                        }
 
                        document.body.appendChild(form);
                        form.submit();
                    });
                }
            });
        });
    </script>
@endpush

