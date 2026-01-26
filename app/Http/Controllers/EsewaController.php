<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Str;
use App\Model\Runner;
use App\Model\ApplicationType;
use App\Model\InfoMarathon;
use App\Model\Emergency;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Mail\SuccessMail;
use Mail;
use App\Models\Model\FutsalTeam;



class EsewaController extends Controller
{

    public function payment_verify(Request $request)
    {

        if ($request->isMethod('post')) {
            // dd($request->all());    
            // 🔴 PRE-CHECK SLOT COUNT (UX protection)
            $totalRunners = Runner::where('paid_status', 1)
                ->whereHas('members', function ($q) {
                    $q->where('event', 15);
                })
                ->count();

            if ($totalRunners >= 1000) {
                $message = 'Sorry, OneRun 2026 event is fully booked! All 1000 participant slots have been filled. Please check other available event.';

                return view('themes.default.common.slot-full',compact('message'));
            }
            $count = Runner::where('paid_status', 1)
                ->whereHas('members', function ($q) {
                    $q->where('event_category', 27);
                })
                ->count();

            if ($count >= 25) {
                $message = 'Sorry, the 1K event is already full. Please check other available event category for participation.';

                return view('themes.default.common.slot-full',compact('message'));
            }
            
            $refid = 'NP-ES-NRSSPORTS-' . Str::random(5);
            $amt = $request->price;
            $runner_id = $request->id;
            $data = Runner::where('id', $runner_id)->first();
            $data->ref_id = $refid;
            $data->entry_price = $amt;
            $data->save();

            // if($store && $info && $app && $emergency)
            // {
            //  Mail::send(new VerifyMail($verifyUser->token, $store->id, $store->name, $request->password));
            return response()->json([
                'id' => $runner_id,
                'total_price' => $amt,
                'ref_id' => $refid,
                'status' => 'success'
            ]);
            // }
        }

    }


    public function success(Request $request)
    {
        $oid = $request->oid;
        $ref = $request->refId;
        $fraudcheck_url = 'https://esewa.com.np/epay/transrec';

        $payment = Runner::where("ref_id", $oid)->firstorfail();

        $data = [
            'amt' => $payment->entry_price,
            'rid' => $ref,
            'pid' => $oid,
            'scd' => 'NP-ES-NRSSPORTS' // please use your own merchant id...
        ];

        $curl = curl_init($fraudcheck_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        // dd($response);
        $find = Runner::where('ref_id', $oid)->first();

        if (strpos($response, "Success") !== false) {
            if (isset($payment)) {
                //for OneRun 2026 -> 1K event limiting the 25 slot
                $count = Runner::where('paid_status', 1)
                    ->whereHas('members', function ($q) {
                        $q->where('event_category', 27);
                    })->count();

                //for OneRun 2026 -> 1K slot limit
                $totalRunners = Runner::where('paid_status', 1)
                    ->whereHas('members', function ($q) {
                        $q->where('event', 15);
                    })
                    ->count();

                $data1 = ([
                    'paid_status' => '1',
                    'payment_type' => 'eSewa'
                ]);

                Runner::where('ref_id', $oid)->update($data1);

                if ($totalRunners >= 1000) {
                    return redirect()->route('payment.response', $find->ref_id)->with(['success_message' => 'Payment Successful. But Unfortunately, OneRun 2026 event is fully booked! All 1000 participant slots have been filled. Please contact our team for refund or check other available event.', 'reg_no' => $payment->reg_no]);
                }
                if ($count >= 25) {
                    return redirect()->route('payment.response', $find->ref_id)->with(['success_message' => 'Payment Successful. But Unfortunately, the 1K event slot is already full. Please contact our team for refund or category change.', 'reg_no' => $payment->reg_no]);
                }

            }
            // Mail::to($payment->email)->send(new SuccessMail($find->reg_no));

            return redirect()->route('payment.response', $find->ref_id)->with(['success_message' => 'Payment Successful', 'reg_no' => $payment->reg_no]);
        } else {
            return redirect()->route('payment.response', $find->ref_id)->with('failure_message', 'Sorry! Payment Failed.');
        }
    }
    public function failure(Request $request)
    {
        if ($request->id) {
            $get = Runner::where('ref_id', $request->id)->first();
            $get->delete();
        }
        return redirect()->route('payment.response')->with('failure_message', 'Sorry! Payment Failed.');
    }

    public function response(Request $request)
    {
        $get = Runner::where('ref_id', $request->id)->first();
        return view('response', compact('get'));
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha' => captcha_img('flat')]);
    }


    public function futsal_payment(Request $request)
    {

        if ($request->isMethod('post')) {
            $refid = 'NP-ES-NRSSPORTS-' . Str::random(5);
            $amt = $request->price;
            $runner_id = $request->id;
            $data = FutsalTeam::where('id', $runner_id)->first();
            $data->ref_id = $refid;
            $data->entry_price = $amt;
            $data->save();

            // if($store && $info && $app && $emergency)
            // {
            //  Mail::send(new VerifyMail($verifyUser->token, $store->id, $store->name, $request->password));
            return response()->json([
                'id' => $runner_id,
                'total_price' => $amt,
                'ref_id' => $refid,
                'status' => 'success'
            ]);
            // }
        }

    }

    public function payment_success(Request $request)
    {
        $oid = $request->oid;
        $ref = $request->refId;
        $fraudcheck_url = 'https://esewa.com.np/epay/transrec';

        $payment = FutsalTeam::where("ref_id", $oid)->firstorfail();

        $data = [
            'amt' => $payment->entry_price,
            'rid' => $ref,
            'pid' => $oid,
            'scd' => 'NP-ES-NRSSPORTS' // please use your own merchant id...
        ];

        $curl = curl_init($fraudcheck_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $find = FutsalTeam::where('ref_id', $oid)->first();

        if (strpos($response, "Success") !== false) {
            if (isset($payment)) {
                $data1 = ([
                    'paid_status' => '1',
                    'payment_type' => 'eSewa'
                ]);

                FutsalTeam::where('ref_id', $oid)->update($data1);

            }
            // Mail::to($payment->email)->send(new SuccessMail($find->reg_no));

            return redirect()->route('payment.response', $find->ref_id)->with('success_message', 'Payment Successful');
        } else {
            return redirect()->route('payment.response', $find->ref_id)->with('failure_message', 'Sorry! Payment Failed.');
        }
    }

    public function payment_response(Request $request)
    {
        $get = FutsalTeam::where('ref_id', $request->id)->first();
        return view('response', compact('get'));
    }

}