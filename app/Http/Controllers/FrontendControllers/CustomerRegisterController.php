<?php

namespace App\Http\Controllers\FrontendControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Members\MemberModel;
use App\Models\Circulars\CircularModel;
use Illuminate\Support\Str;

use DB;
use Mail;
use App\Mail\ForgotPassword;

class CustomerRegisterController extends Controller
{
    // Create 
    public function create(){
    	return view('themes.default.customer-register');
    }

    // Store
    public function store(Request $request){

    	$this->validate($request,[
    		'first_name'=>'required|max:255',
    		'last_name'=>'required|max:255',
    		'email'=>'required|email|unique:cl_members|max:255',
    		'password'=>'required|max:20'
    	]);
    	$req = $request->all();
    	$req['password'] = sha1($request->password);    	

    	$data = MemberModel::create($req);
    	if($data){
    		return redirect()->back()->with('message','Successfully Registered.');
    	}else{
    		return "Error";
    	}	
    }

    // Login Form
    public function customerlogin(){
    	return view('themes.default.customer-login');
    }

    // Login Action
    public function customerlogin_action(Request $request){

    	$email = $request->email;
    	$password = sha1($request->password);

    	if($email == ''){
    		return redirect()->back()->with('message','Email is required!');
    	}

    	if($password == ''){
    		return redirect()->back()->with('message','Password is required!');
    	}

    	$customer = MemberModel::where('email',$email)->where('password',$password)->first();

    	if($customer){  

            // 1 Administrator
            // 2 Member
            // 3 Wholesaler

            if( $customer->role_id == 2){
                session(['customer_id'=>$customer->id,'member_type'=>'member' ,'loginstatus' => true]);
                return redirect('customer/dashboard');
            }  else {
                return redirect()->back()->with('message','You are not a member!');
            }   

        }else{
          return redirect()->back()->with('message','Invalid Email or Password!');
      }    	
  }

    // Customer Logout
  public function employeelogout(Request $request){
      $request->session()->forget('customer_id');
      $request->session()->forget('loginstatus');
      $request->session()->forget('member_type');  
      return redirect('page/employeelogin')->with('message','Successfully Logout');
              
  }

    // Customer Dashboard
  public function customer_dashboard(){

    if(!session('loginstatus')){
        return redirect('customerlogin');            
    }
    $data = CircularModel::orderBy('id','DESC')->paginate(20);
    return view('themes.default.employee.employee-dashboard', compact('data'));  	
}

public function accountdetail(){
    if(!session('loginstatus')){
        return redirect('customerlogin');            
    }
    $customer_id = session('customer_id');
    $customer = MemberModel::where('id',$customer_id)->first();
    return view('themes.default.customer.accountdetail', compact('customer'));
}

public function editaccountdetail(){
    if(!session('loginstatus')){
        return redirect('customerlogin');            
    }
    $customer_id = session('customer_id');
    $customer = MemberModel::where('id',$customer_id)->first();
    return view('themes.default.customer.editaccountdetail', compact('customer'));
}

public function updateaccountdetail(Request $request){
    if(!session('loginstatus')){
        return redirect('customerlogin');            
    }
    $customer_id = session('customer_id');
    $data = DB::table('cl_members')
    ->where('id',$customer_id)
    ->update([
        'first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
        'email'=>$request->email
    ]);
    if($data){
       return redirect()->back()->with('message','Account detail updated.');
   }else{
    return "Error";
}


$customer_id = session('customer_id');
$customer = MemberModel::where('id',$customer_id)->first();
return view('themes.default.customer.editaccountdetail', compact('customer'));
}

public function changepassword(){
 if(!session('loginstatus')){
    return redirect('customerlogin');            
}
return view('themes.default.customer.changepassword');
}

public function changepassword_action(Request $request){
     if(!session('loginstatus')){
        return redirect('customerlogin');            
    }
    $customer_id = session('customer_id');
    $member = MemberModel::find($customer_id);
    if(sha1($request->oldpassword) == $member->password){
        $member->password = sha1($request->newpassword);
        $member->save();
        return redirect()->back()->with('message','Password update SUCCESS!');
    }else{
        return redirect()->back()->with('message','Password couldn\'t update!');
    }

}

    // Wholesaler Login 
public function employeelogin(){
    return view('themes.default.employee.employeelogin');
}


// Wholesaler Login Action
public function employeelogin_action(Request $request){

    $email = trim($request->email);
    $password = trim($request->password);

    if($email == ''){
        return redirect()->back()->with('message','Email is required!');
    }

    if($password == ''){
        return redirect()->back()->with('message','Password is required!');
    }
    
    if(MemberModel::where(['email'=>$email])->exists()){
    $row = MemberModel::where(['email'=>$email])->first();
    $pwd = $row->password;
    $_password = sha1($password);

     if( $pwd == $_password  ){
          $customer = MemberModel::where(['email'=>$email])->first();
           // 1 Administrator // 2 Employee

        if( $customer->role_id == 2){
            session(['customer_id'=>$customer->id,'member_type'=>'employee' ,'loginstatus' => true]);
            return redirect('customer/dashboard');
           // return redirect(url('/'));
        //   return "OK//";
        }  else {
            return redirect()->back()->with('message','You are not a member as Employee!');
        } 
     }else{
         return redirect()->back()->with('message','Invalid Email or Password!');
     }
        }else{
            return redirect()->back()->with('message','Invalid Email or Password!!');
        }


}

public function password_recover(){
    
        return view('themes.default.password-recover');      
      }
      
public function circular_detail($uri){
    $data = CircularModel::where(['uri'=>$uri])->first();;
    return view('themes.default.employee.circular-detail', compact('data'));
}



}
