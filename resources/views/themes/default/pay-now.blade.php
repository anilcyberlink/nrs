@extends('themes.default.common.master')
@section('content')
<section class="blogs-main archives single section">
    <div class="container">   
   <form id="checkout-form" method="POST">  
    <h3>Registration Information</h3>
    <hr />
    <div class="row">
        <div class="form-group col-sm-4">
            <label>Request Number:</label>
            <input type="text" class="form-control" name="reg_no" readonly value="{{$store->reg_no}}">
        </div>
        <div class="form-group col-sm-4">
            <label>Email Address:</label>
            <input type="email" name="email" class="form-control" readonly value="{{$store->email}}">
        </div>
        <!--@if(!$eventcategory->price == '0')-->
        <!--<div class="form-group col-sm-1 mt-4">-->
        <!--<img src="{{asset('themes-assets/images/khalti.png')}}" width="30">-->
        <!--        <a href="" target="_blank">Pay With Khalti</a>    -->
        <!--</div>-->
         <div class="form-group col-sm-2">
        <button id="esewa1" type="submit" class="btn">Pay With Esewa</button> 
        </div>
      
        
        <!--@endif-->
    </div>  
    </form>
    
     <form action="{{ route('payment.khalti') }}" method="POST">
            @csrf
          <input type="hidden" name="runner_info_id" value="{{$store->id}}">
          <input type="hidden" name ="amount" value="{{event_price($info->event_category)}}">
          <input type="hidden" name ="eventCategory" value="{{event_category($info->event_category)}}">
           <!--<img src="{{asset('themes-assets/images/khalti.png')}}" uk-img width="50">-->
           <div class="form-group col-sm-2">
          <button type="submit" class="btn">Pay with khalti</button>
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
            {{$eventcategory->price == '0'?'FREE Entry':'Rs.'.$eventcategory->price}}
        </td>
        </tr>
        <!--<tr>-->
        <!--<td>Payment Status</td>-->
        <!--<td>-->
        <!--  {{$store->paid_status == '1'?'PAID':'NOT PAID'}}-->
        <!-- </td>-->
        <!--</tr>-->
        <tr>
        <td>Event Category</td>
        <td>{{event_category($info->event_category)}}</td>
        </tr>
        <tr>
        <td>Runner Details</td>
        <td>
            <ul>
            <li>Name: {{$store->first_name}} &nbsp; {{$store->last_name}}</li>
            <li>Gender: {{$store->gender}}</li>
            <li>Date of Birth: {{$store->dob}}</li>
            <li>Blood Group: {{$store->blood_group}}</li>
            <li>Occupation: {{$store->occupation}}</li>
            <li>Nationality: {{$store->nationality}}</li>
            <li>Country: {{$store->country}}</li>
            <li>City: {{$store->city}}</li>
            <li>Address: {{$store->address}}</li>
            <li>Contact: {{$store->telephone_no}}, {{$store->mobile_no}}</li>
            <li>Tshirt Size: {{$info->tshirt_size}}</li>
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
           $('#esewa1').on('click', function(e) {
                e.preventDefault();
              var radioValue = {{ event_price($info->event_category) }};
                var run_id={{ $store->id }};
                let form = document.getElementById('checkout-form');
                let data = new FormData(form);
                data.append('price', radioValue);
                data.append('id',run_id);
                if ($("input[name='event']:checked").data('price') == '0') {
     
                } else {
                    axios.post("{{ route('payment.verify') }}", data).then(res => {
                        // alert(res.data.status);
                 
                        var path = "https://esewa.com.np/epay/main";
                        var params = {
                            amt: res.data.total_price,
                            psc: 0,
                            pdc: 0,
                            txAmt: 0,
                            tAmt: res.data.total_price,
                            pid: res.data.ref_id,
                            scd: "NP-ES-NRSSPORTS", // please use your merchant id here...
                            su: "https://nrssportsfoundation.org.np/esewa/sucess?q=su",
                            fu: "https://nrssportsfoundation.org.np/esewa/failure?q=fu"
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

