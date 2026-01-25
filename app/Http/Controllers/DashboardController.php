<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts\PostModel;
use App\Models\Posts\PostCategoryModel;
use App\Models\Settings\SettingModel;
use Illuminate\Support\Str;
use App\Membership;
use App\Model\Donation;
use Hash;
use App\Model\Runner;
use App\Model\ApplicationType;
use App\Model\InfoMarathon;
use App\Model\Emergency;
use App\Model\RunnerDoc;
use Mail;
use App\VerifyUser;
use App\Mail\VerifyMail;
use DB;
use Illuminate\Support\Facades\Session;
use App\Models\Event\EventModel;
use App\Models\Event\EventCategory;
use App\Models\Subscriber;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $recent_posts = PostModel::orderBy('id','desc')->take(10)->get();
       $total_posts = PostModel::count();
       $post_visiters = PostModel::sum('visiter');
       $total_category = PostCategoryModel::count();
      $total_runner = Runner::count();
      $verified = Runner::where('paid_status','1')->count();
      $unverified = Runner::where('paid_status','0')->count();
      $male = Runner::where(['gender'=>'Male','paid_status'=>'1'])->count();
      $female = Runner::where(['gender'=>'Female','paid_status'=>'1'])->count();

       return view('admin.dashboard',compact('recent_posts','total_posts','total_category','post_visiters','total_runner','verified','unverified','male','female'));
    }
    
    public function marathon_filter(Request $request){
        
        $gender = $request->get("gender");
          $tshirt = $request->get("tshirt");
          $event = $request->get("category");
        $data = DB::table('runners')
                ->join('info_marathons','user_id','=','runners.id')
                ->where('runners.paid_status','=','1');
        if($gender!=NULL){
            $data->where('runners.gender','=', $gender);
        }
        if($tshirt!=NULL){
            $data->where('info_marathons.tshirt_size','=', $tshirt);
        }
        if($event!=NULL){
            $data->where('info_marathons.event_category','=', $event);
        }
        $val = $data->count();
        
        //return $val;
        return json_encode(array("val"=>$val));
    }

    public function member_list()
    {
        $data = Runner::orderBy('id','desc')->get();
        $pending = Runner::where('paid_status','0')->orderBy('id','desc')->get();
        $verified = Runner::where('paid_status','1')->orderBy('id','desc')->get();
        $esewa = Runner::where('payment_type','eSewa')->orderBy('id','desc')->get();
        $cash = Runner::where('payment_type','Paid at Office')->orderBy('id','desc')->get();
        return view('admin.members',compact('data','pending','verified','esewa','cash'));
    }

    public function donation_details($id)
    {
      $data=Donation::where('user_id',$id)->get();
      return view('admin.payments',compact('data'));
    }

    public function member_details($id)
    {
      $user = Runner::where('id',$id)->first();
      $info = InfoMarathon::where('user_id',$id)->first();
      $appType = ApplicationType::where('user_id',$id)->first();
      $emergency = Emergency::where('user_id',$id)->first();
      $doc = RunnerDoc::where('user_id',$id)->first();
      return view('admin.details',compact('user','info','appType','emergency','doc'));
    }
     public function edit_member_details(Request $request,$id)
    {
         if($request->isMethod('get'))
    {     
      $user = Runner::where('id',$id)->first();
      $info = InfoMarathon::where('user_id',$id)->first();
      $appType = ApplicationType::where('user_id',$id)->first();
      $emergency = Emergency::where('user_id',$id)->first();
      $category1 = EventCategory::where(['status'=>'1','type'=>'individual'])->where('event',$user->event)->get();
      $category2 = EventCategory::where(['status'=>'1','type'=>'group'])->get();
      return view('admin.edit-member',compact('user','info','appType','emergency','category1','category2'));
    }
       if($request->isMethod('put'))
    {        
        $data = Runner::find($id);
        $data['first_name']=$request->first_name;
        $data['last_name']=$request->last_name;
        $data['blood_group']=$request->blood_group;
        $data['dob']=$request->dob;
        $data['telephone_no']=$request->tel_no;
        $data['mobile_no']=$request->mob_no;
        $data['bib_no']=$request->bib_no;
       $data->save();
       
      
        $info= InfoMarathon::where('user_id',$id)
         ->update([
          'event_category'=>$request->event_category,
          'tshirt_size'=>$request->size
        ]);
       
          return redirect()->back()->with('message','Update Successful.');
    }
    }
    
    public function isverified(Request $request)
    {
    $data = Donation::find($request->id);
    if($data->verified == '1'){
      $data->verified = '0';   
      $data->save();  
     return redirect()->back()->with('error','Payment unVerified');
    }else if($data->verified == '0'){
      $data->verified = '1';
      $data->save();  
    return redirect()->back()->with('message','Payment Verified');
    }
  return redirect()->back()->with('error','Verification Failed');
    }
    
    public function deletePayment($id){
        $data = Donation::find($id);
          $data->delete();
    }
    
     public function deletemember($id){
        $data = Runner::find($id);
          $data->delete();
           return redirect()->back()->with('message','Member Deleted');
    }
    
     public function admin_become_member(Request $request, $id = null)
    {
      if($request->isMethod('get'))
      {    
        
        $event = EventModel::where('status','1')->where('id', $id)->first();
        $category1 = EventCategory::where(['status'=>'1','type'=>'individual','event'=>$event->id])->get();
        $category2 = EventCategory::where(['status'=>'1','type'=>'group','event'=>$event->id])->get();
        return view('admin.registration_form',compact('event','category1','category2'));
      } 
     if($request->isMethod('post')){
        // dd($request->all());
      $request->validate([
          'first_name'=>'required',
          'last_name'=>'required',
          'gender'=>'required',
          'blood_group'=>'required',
            'dob'=>'required',
            'occupation'=>'required',
            'nationality'=>'required',
            'country'=>'required',
            'city'=>'required',
            'address'=>'required',
            'tel_no'=>'required',
            'mob_no'=>'required',
            'email'=>'required|email',
          ]);
        
        $data['first_name']=$request->first_name;
        $data['last_name']=$request->last_name;
        $data['gender']=$request->gender;
        $data['blood_group']=$request->blood_group;
        $data['dob']=$request->dob;
        $data['occupation']=$request->occupation;
        $data['nationality']=$request->nationality;
        $data['country']=$request->country;
        $data['city']=$request->city;
        $data['address']=$request->address;
        $data['telephone_no']=$request->tel_no;
        $data['mobile_no']=$request->mob_no;
        $data['email']=$request->email;
        $data['facebook_id']=$request->facebook_id;
        $data['past_record']=$request->past_record;
        $data['previous_runner']=$request->previous_runner;
        $data['event'] = $request->event;
        $data['paid_status']='1';
        $data['payment_type']='Paid at Office';
       if(DB::table('runners')->count() == 0 ){
        $data['reg_no']='00011';
        }else{
          $ordering = Runner::max('reg_no');
          $ordering = $ordering + 1;
           $data['reg_no']=$ordering;
        }
        $store = Runner::create($data);  

        $subscriber = Subscriber::where('email',$request->email)->first(); 
        if($subscriber == NULL){           
          $user = Subscriber::create([
          'email'=> $request->email,
          'name' => $request->first_name. ' ' .$request->last_name
        ]);
        }

        $info= InfoMarathon::create([
          'user_id' => $store->id,
          'event_category'=>$request->type==1 ? $request->event_category : $request->event_category2,
           'event'=>$request->event,
          'tshirt_size'=>$request->size
        ]);

        $app=ApplicationType::create([
            'user_id' => $store->id,
            'individual_entry'=>$request->type==1 ? 'yes' : NULL,
            'group_entry'=>$request->type==2 ? 'yes': NULL,
            'group_name' => $request->type==2 ? $request->group_name : NULL,
            'group_size'=>  $request->type==2 ? $request->group_size : NULL,
            'group_type'=> $request->type==2 ? $request->group_type : NULL,
        ]);
        
        $emergency=Emergency::create(
          [
             'user_id'=>$store->id,
             'name'=>$request->e_name,
             'relation' => $request->relation,
             'group_type' =>$request->group_type,
             'telephone' => $request->telephone,
             'phone' => $request->mobile
          ]
          );

         if ($request->hasFile('file')) {            
            $image = $request->file('file');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/doc/');

            $image->move($destinationPath, $name);                      
            $document = RunnerDoc::create([
            'user_id'=>$store->id,
             'file'=>$name,
            ]);
         }
       
        if($store && $info && $app && $emergency )
        {           
          return back()->with('message','Form submitted successfully.');
        }
     }
}

 public function payment_status(Request $request)
    {
       $id = $request->deal;

        $deal = Runner::findorfail($id);

        // if (isset($_POST['active'])) {
        //     $deal->paid_status = 0;
        // }
        if (isset($_POST['inactive'])) {
            $deal->paid_status = 1;
            $deal->payment_type='Paid at Office';
        }
        $save = $deal->update();
        if ($save) {
            Session::flash('success', 'Status updated');
            return redirect()->back();
        }
    }
  
}
