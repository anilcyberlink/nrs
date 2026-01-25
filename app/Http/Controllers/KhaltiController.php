<?php

namespace App\Http\Controllers;

use App\Providers\Payment;
use App\Model\InfoMarathon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use App\Mail\SuccessMail;
use Mail;
use App\Model\Runner;

class KhaltiController extends Controller
{
    //
    private $complete = "Completed";

    public function paymentKhalti(Request $request)
    {
       
        $amt = $request->amount;
        $race =  $request->eventCategory;
        try {
            $payment = new Payment();
            $khaltiResponse = $payment->execute($amt, $race);
            $responseObj = json_decode($khaltiResponse);
            Session::put('infoId', $request->runner_info_id);
            return redirect($responseObj->payment_url);
        } catch (RequestException $e) {
            
            return redirect('khalti.message')->with('error', 'Something went wrong, Please Try Again!');
            
        } catch (GuzzleException $e) {
           
            return redirect('index')->with('error', 'Network Error!');
           
        }
       
    }

    public function khaltiRedirect(Request $request)
    {   
        try {
            $payment = new Payment();
            $jsonResponse = $payment->paymentVerificationLookUp($request->pidx);
            $jsonObj = json_decode($jsonResponse);
            $matchPidx = $jsonObj->pidx == $request->pidx;
            $paymentStatus = $jsonObj->status == $this->complete;
            $matchTransactionId = $jsonObj->transaction_id == $request->transaction_id;
            $data = Runner::where('id', session::get('infoId'))->first();
          
            if($paymentStatus && $matchPidx && $matchTransactionId) {
                $data->ref_id = $jsonObj->transaction_id;
                $data->entry_price = $jsonObj->total_amount / 100;
                $data->paid_status = 1;
                $data->payment_type = "Khalti";
                $data->save();
              
                // Mail::to($data->members->email)->send(new SuccessMail($data->ref_id));
                session::forget(['infoId']);
                return  redirect()->route('khalti.message', $data->reg_no)->with('message', 'Payment Verification Success.');
        } else {
            return  redirect()->route('khalti.message', $data->reg_no)->with('error', 'Payment Verification Failed!');
            }
        } catch (RequestException $e) {
            return redirect()->route('index')->with('error', 'Something went wrong, Please Try Again!');
            
        } catch (GuzzleException $e) {
            return redirect()->route('index')->with('error', 'Network Error!');
        }
       
    }

    public function khaltiPaymentResponseMessage($regId){
    
        return view('themes.default.common.khaltiMessage', ['regNumber'=>$regId]);
    }
}
