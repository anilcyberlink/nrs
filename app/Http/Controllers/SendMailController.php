<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Newsletter;
use App\Mail\SendNewsletter;
use App\Mail\AssignRegNoMail;
use App\Model\Runner;
use Illuminate\Support\Facades\Mail;
use App\Models\Settings\SettingModel;
use App\Models\Subscriber;
use Carbon\Carbon;
use DB;

class SendMailController extends Controller 
{
  public function send_mail(Request $request)
 {
   $details = [
     'subject' => 'Test Notification',
     'email'=>'kebib96@gmail.com'
   ];
     $job = (new \App\Jobs\SendQueueEmail($details))
           ->delay(now()->addSeconds(2));

     dispatch($job);
     echo "Mail send successfully !!";
 }

 public function index(Request $request)
    {
        $users = Subscriber::orderBy('id','desc')->paginate(50); 
        $news=Newsletter::orderBy('id','desc')->get();
        return view('admin.newsletter.send_newsletter', compact('users','news'));
    }


//     public function sendEmail(Request $request)
//     {
//     if($request->ajax())
//     {
//         try{
//       $users = Subscriber::whereIn("id", $request->ids)->get();
//       $news_id=Newsletter::where('id',$request->news_id)->first();
//       foreach ($users as $key => $user) {
//           $mail = preg_replace( "/<br>|\n/", "", $user->email );
//         //   return new SendNewsletter($news_id);
//           Mail::to($mail)->send(new SendNewsletter($news_id));
//       }
//       return response()->json(['message'=>'Newsletter sent successfully']);
//     }
//      catch(Exception $e)
//         {
//             return response()->json([
//                 'success' => 'false',
//                 'errors'  => $e->getMessage(),
//             ], 400);
//         }
//     }
//   }

public function sendEmail(Request $request)
    {
      $data = SettingModel::where('id',1)->first(); //settings 
       $users = Subscriber::whereIn("id", $request->ids)->get(); // subscribers
       $news_id = Newsletter::where('id',$request->news_id)->first(); //newsletters
        
        // Total emails
      $sent_emails = $data->sent_emails; // database count of sent_emails
      $total = $users->count()+ $sent_emails; //already sent email + current selected
      
     // start and end time  
      $start_time = Carbon::now();
      $end_time = $data->end_time;
      
      // to find the time difference   
      $current = strtotime(Carbon::now()); //current time
      $last = strtotime(Carbon::createFromFormat('Y-m-d H:i:s', $end_time)); // limit end time
      $diff = $last - $current; //time difference in seconds
    //  dd($current, $last,$diff);
     
       if($sent_emails <= 100 && $total <= 100)
       {
           $data->sent_emails = $total;
           $data->start_time = $start_time;
               if($diff <= 0){
               $data->end_time = Carbon::now()->addMinutes(61);
               }
           $data->current_time = Carbon::now();
           $data->save();
            foreach ($users as $key => $user) {
              $mail = preg_replace( "/<br>|\n/", "", $user->email );
            //  return new SendNewsletter($news->id);
              Mail::to($mail)->send(new SendNewsletter($news_id));
         }
         return response()->json(['message'=>'Newsletter sent successfully']);
       }
       elseif($diff <= 0)
       {
           $data->sent_emails = $users->count();
           $data->start_time = $start_time;
           $data->end_time = Carbon::now()->addMinutes(61);
           $data->current_time = Carbon::now();
           $data->save();
            foreach ($users as $key => $user) {
              $mail = preg_replace( "/<br>|\n/", "", $user->email );
                        //   return new SendNewsletter($news->id);

              Mail::to($mail)->send(new SendNewsletter($news_id));
         }
          return response()->json(['message'=>'Newsletter sent']);
       }
       else
       {
           return response()->json(['message'=>'Limit Reached. Try after sometime.']);
       }
    
  }
  
  
  public function assignregno($runner_id)
  {
$initial_data = Runner::find($runner_id);
    $initial_data['reg_email_status'] = 1;
    $initial_data->save();

    $data = Runner::where(['id' => $runner_id])->first();
  
   Mail::to($data->email)->send(new AssignRegNoMail($data));
    return redirect()->back()->with('message', 'The registraion number has been assigned.');
  }

  public function newsletter(Request $request)
  {
    if($request->isMethod('get')){
         return view('admin.newsletter.newsletter');
    }

    if($request->isMethod('post')){     
      $request->validate([
         'title'=>'required',
         'news_content'=>'required',
         'publish_date'=>'required'
      ]);
        $data['title']=$request->title;
        $data['news_content']=$request->news_content;
        $data['publish_date']=$request->publish_date;
        $store=Newsletter::create($data);
        if($store)
        {
          return back()->with('message','Newsletter added successfully');
        }
    }
  }

  public function newsindex(Request $request)
  {
     if($request->isMethod('get'))
     {
       $data=Newsletter::orderBy('id','desc')->get();
       return view('admin.newsletter.news-index', compact('data'));
     }
  }

  public function newsedit(Request $request)
  {
     if($request->isMethod('get'))
     {
       $id=$request->id;
       $data=Newsletter::find($id);
       return view('admin.newsletter.news-edit',compact('data'));
     }
     if($request->isMethod('post'))
     {
          $request->validate([
         'title'=>'required',
         'news_content'=>'required',
         'publish_date'=>'required'
      ]);
         $id=$request->id;
        $data=Newsletter::find($id);
        $data['title']=$request->title;
        $data['news_content']=$request->news_content;
        $data['publish_date']=$request->publish_date;
        $update=$data->save();
          if($update)
        {
          return back()->with('message','Newsletter updated successfully');
        }
     }
  }

  public function newsdelete(Request $request)
  {
    $id=$request->id;
    $data=Newsletter::find($id);
    $del=$data->delete();
    return back()->with('message','Newsletter deleted successfully');
    
  }

  public function usercreate(Request $request)
  {
    if($request->isMethod('get')){
        // dd('ok');
         return view('admin.newsletter.user-create');
    }

    if($request->isMethod('post')){
      $request->validate([
         'full_name'=>'required',
         'email'=>'required|unique:subscribers,email|email'
      ]);
        $data['name']=$request->full_name;
        $data['email']=$request->email;
        $store=Subscriber::create($data);
        if($store)
        {
          return back()->with('message','Subscriber added successfully');
        }
    }
  }

    public function userindex(Request $request)
  {
     if($request->isMethod('get'))
     {
        //  delete Duplicate emails
//          $data1=Subscriber::all();
//          $duplicateRecords = $data1->unique('email');
//           $usersDupes = $data1->diff($duplicateRecords);
//           foreach($usersDupes as $record) {
//              $record->delete();
//            }
       $data=Subscriber::orderBy('id','desc')->get();
       return view('admin.newsletter.user-index', compact('data'));
     }
  }

   public function useredit(Request $request)
  {
     if($request->isMethod('get'))
     {
       $id=$request->id;
       $data=Subscriber::find($id);
       return view('admin.newsletter.user-edit',compact('data'));
     }
     if($request->isMethod('post'))
     { $id=$request->id;
          $request->validate([
         'full_name'=>'required',
          'email'=>'required|email|unique:subscribers,email,'.$id,
      ]);
        
          $data=Subscriber::find($id);
         $data['name']=$request->full_name;
         $data['email']=$request->email;
         $update=$data->save();
          if($update)
        {
          return back()->with('message','Subscriber updated successfully');
        }
     }
  }

    public function userdelete(Request $request)
  {
    $id=$request->id;
    $data=Subscriber::find($id);
    $del=$data->delete();
    return back()->with('message','User deleted successfully');
    
  }
}
