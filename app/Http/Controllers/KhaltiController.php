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
        // dd($request->all());
        // 🔴 PRE-CHECK SLOT COUNT (UX protection)
        
        $totalRunners = Runner::where('paid_status', 1)
            ->whereHas('members', function ($q) {
                $q->where('event', 15);
            })
            ->count();

        if ($totalRunners >= 1000) {
            $message = 'Unfortunately, OneRun 2026 event is fully booked! All 1000 participant slots have been filled. Please check other available event.';

            return view('themes.default.common.slot-full',compact('message'));
        }
        $count = Runner::where('paid_status', 1)
            ->whereHas('members', function ($q) {
                $q->where('event_category', 27);
            })
            ->count();

        if ($count >= 25) {
            $message = 'Unfortunately, the 1K event category is already full. Please check other available event categories.';

            return view('themes.default.common.slot-full',compact('message'));
        }
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
           
            return redirect('/')->with('error', 'Network Error!');
           
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
                // Count PAID runners for 1K event
                $count = Runner::where('paid_status', 1)
                    ->whereHas('members', function ($q) {
                        $q->where('event_category', 27);
                    })->count();

                    
                $totalRunners = Runner::where('paid_status', 1)
                    ->whereHas('members', function ($q) {
                        $q->where('event', 15);
                    })
                    ->count();

                $data->ref_id = $jsonObj->transaction_id;
                $data->entry_price = $jsonObj->total_amount / 100;
                $data->paid_status = 1;
                $data->payment_type = "Khalti";
                $data->save();
                session::forget(['infoId']);

                // Slot full → special message
                if ($totalRunners >= 1000) {
                    return redirect()
                        ->route('khalti.message', $data->reg_no)
                        ->with('message',
                            'Unfortunately, OneRun 2026 event is fully booked! All 1000 participant slots have been filled. Please contact our team for refund or check other available event .'
                    );
                }
                if ($count >= 25) {
                    return redirect()
                        ->route('khalti.message', $data->reg_no)
                        ->with('message',
                            'Payment successful, but Unfortunately the event is already full. Please contact our team for refund or category change.'
                        );
                }
                // Mail::to($data->members->email)->send(new SuccessMail($data->ref_id));
                return  redirect()->route('khalti.message', $data->reg_no)->with('message', 'Payment Verification Success.');
        } else {
            return  redirect()->route('khalti.message', $data->reg_no)->with('error', 'Payment Verification Failed!');
            }
        } catch (RequestException $e) {
            return redirect()->route('/')->with('error', 'Something went wrong, Please Try Again!');
            
        } catch (GuzzleException $e) {
            return redirect()->route('/')->with('error', 'Network Error!');
        }
       
    }

    public function khaltiPaymentResponseMessage($regId){
    
        return view('themes.default.common.khaltiMessage', ['regNumber'=>$regId]);
    }
}
