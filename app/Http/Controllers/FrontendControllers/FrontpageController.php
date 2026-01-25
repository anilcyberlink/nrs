<?php
namespace App\Http\Controllers\FrontendControllers;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactMail;
use App\Models\Settings\CountryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banners\BannerModel;
use App\Models\MultipleBanners\MultipleBannerModel;
use App\Models\Posts\PostModel;
use App\Models\Posts\AssociatedPostModel;  
use App\Models\Posts\PostCategoryModel;
use App\Models\Posts\PostImageModel;
use App\Models\Posts\PostDocModel;
use App\Models\Settings\SettingModel;
use App\Models\Galleries\ImageGalleryModel;
use App\Models\Galleries\ImageGalleryCategoryModel;
use App\Models\Galleries\VideoGalleryModel;
use Mail;
use App\Mail\SendMail;
use App\Mail\SendMailContact;
use App\Models\Posts\PostTypeModel;  
use App\Models\Portfolios\PortfolioCategoryModel;
use App\Models\Portfolios\PortfolioModel;
use App\Models\Portfolios\AssociatedPortfolioModel;
use App\Model\Runner;
use App\Model\ApplicationType;
use App\Model\InfoMarathon;
use App\Model\Emergency;
use App\Model\RunnerDoc;
use App\Models\Event\EventModel;
use App\Models\Event\EventCategory;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use DB;
use App\Models\Model\FutsalTeam;
use App\Models\Model\FutsalPlayers;
use App\Models\Model\FutsalEvent;



class FrontpageController extends Controller
{

  public function index(Request $request)
  {
      $banner = BannerModel::all();
      $service = PostTypeModel::where('id','39')->first();
      $services = PostModel::where('post_type','39')->orderBy('post_order','desc')->take(6)->get();
      $about = PostTypeModel::where('id','38')->first();
      $testimonial= PostModel::where('post_type','34')->get();
      $blog=PostTypeModel::where('id','40')->first();
      $blogs = PostModel::where('post_type','40')->orderBy('post_order','desc')->take(6)->get();
      $logo=PostImageModel::where('post_id', '228')->get();
      $partner = PostModel::where('post_type','46')->first();
      $achievement=PostTypeModel::where('id',42)->first();
      $event = PostTypeModel::where('id','45')->first();
      $events = PostModel::where('post_type','45')->where('status', 1 )->orderBy('post_order','desc')->get();
      $popup = PostModel::where('post_category','16')->orderBy('post_order','asc')->get();
      return view('themes.default.frontpage',compact('achievement','banner','about','service','testimonial','blog','logo','partner','blogs','services','event','events','popup'));

  }

  public function posttype(Request  $request,$uri){
  if(!check_posttype_uri($uri)){
    abort(404);
  }
  $data = PostTypeModel::where('uri',$uri)->first();
  $tmpl['template'] = 'page';
  if($tmpl['template']){
    $data['template'] = $data['template'];
  }
  if($data){
    $posts = PostModel::where(['post_type'=>$data->id,'status'=>'1'])->orderBy('post_order','desc')->get();
    $postasc = PostModel::where(['post_type'=>$data->id,'status'=>'1'])->orderBy('post_order','asc')->get();
  }
  $country=CountryModel::all();
  $category=PostCategoryModel::all();
   $documents = PostDocModel::where('post_id', $data['id'])->orderBy('ordering','desc')->get();
   $partner = PostModel::where('post_type','43')->first();
   $images=PostImageModel::where('post_id', '228')->get();
  return view('themes.default.'.$data['template'].'', compact('images','category','data','documents','posts','country','partner','postasc'));
  }

  public function pagedetail($uri){
    if(!check_uri($uri)){
      abort(404);
    }
    $data = PostModel::where('uri',$uri)->orWhere('page_key',$uri)->first();
    $tmpl['template'] = 'single';
    if($tmpl['template']){
      $data['template'] = $data['template'];
    }

    if($data->id){
      $data->visiter = $data->visiter + 1;
      $data->save();
    }
   if ($data->post_type == 40) {
            $data['template'] = 'blog-single';
        }
    if ($data->post_type == 44) {
        $data['template'] = 'gallery';
    }
    $data_child = PostModel::where('post_parent', $data['id'])->orderBy('post_order','desc')->paginate(12);
    $associated_posts = AssociatedPostModel::where('post_id', $data['id'])->orderBy('ordering','desc')->paginate(6);
    $gallery = PostImageModel::where('post_id', $data['id'])->get();
    $documents = PostDocModel::where('post_id', $data['id'])->orderBy('ordering','desc')->get();
    $pos_type = PostTypeModel::where('id',$data->post_type)->first();
    $related= PostModel::where('post_type', $data['post_type'])->where('post_parent','=',0)->where('id','!=',$data->id)->get();


    return view('themes.default.'.$data['template'].'', compact('related','data','data_child','associated_posts','documents','pos_type','gallery'));
  }

public function pagedetail_child($parenturi,$uri){
    $data = PostModel::where('uri',$uri)->orWhere('page_key',$uri)->first();

    $tmpl['template'] = 'single';
    if($tmpl['template']){
      $data['template'] = $data['template'];
    }

    if($data->id){
      $data->visiter = $data->visiter + 1;
      $data->save();
    }

    $data_child = PostModel::where('id', $data['post_parent'])->first();
    if($data_child){

     $data['template'] = $data_child['template_child'];
   }
   $associated_posts = array();
   if( $data){
    $associated_posts = AssociatedPostModel::where('post_id', $data['id'])->get();
  }
  $post_id = $data->id;
  $documents = PostDocModel::where('post_id', $data['id'])->orderBy('ordering','desc')->get();
   $pos_type = PostTypeModel::where('id',$data->post_type)->first();
  return view('themes.default.'.$data['template'].'', compact('data','data_child','associated_posts','documents','pos_type'));
}

public function portfolio($uri){
  $data = PortfolioModel::where('uri',$uri)->first();
  $associated_post = AssociatedPortfolioModel::where('portfolio_id', $data['id'])->get();
   $trades = PortfolioModel::inRandomOrder()->limit(2)->get();
  if($data){
    return view('themes.default.trade', compact('data','associated_post','trades'));
  }
  return false;
}


public function navigation($uri){
 $getId = PostModel::where(['uri'=>$uri])->first();
 $childCount = PostModel::where(['post_parent'=>$getId->id])->count();
 if( $childCount > 0 ){
   $parent_post = PostModel::where('uri',$uri)->first();
   $post = PostModel::where(['post_parent'=>intval($getId->id)])->orderBy('post_order','asc')->paginate(15);
   $template = $parent_post->template;
 }else{
  $parent_post = PostModel::where('uri',$uri)->first();
  $post = PostModel::where('uri',$uri)->first();
  $template = $post->template;
  $news_updates = PostModel::where(['post_type'=>9])->orderBy('post_order','asc')->paginate(15);
}
$bod = PostModel::where(['post_type'=>12])->get();
return view('themes.default.'.$template.'',compact('post','bod','parent_post','news_updates'));
}

public function category_navigation($uri){
  $newsroom = PostTypeModel::where('id','29')->first();
 $category=PostCategoryModel::all();
  $post_category = PostCategoryModel::where('uri',trim($uri))->first();
  if($post_category){
    $data =  PostModel::where(['post_category'=>$post_category->id])->orderBy('post_order','asc')->paginate(15);
  }
  return view('themes.default.newsroom-list',compact('data','post_category','category','newsroom'));
}

/***********************************
******** Root Navigation ***********
************************************/

public function photo_gallery($cat_id){
   $data = ImageGalleryModel::where(['category_id'=>$cat_id])->get();
   $cat = ImageGalleryCategoryModel::where(['id'=>$cat_id])->first();
   return view('themes.default.photo_gallery_thumbnail',compact('data','cat'));
}

public function sendmail(){
  $data = SettingModel::where('id',1)->first();
  Mail::to($data->email_primary)->send( new SendMail() );
  return redirect()->back()->with('message','Contact message successfully sent.');
}

public function sendmail_contact(Request $request){

    // $data = SettingModel::where('id',1)->first();
    return new ContactMail();
    Mail::send( new ContactMail());
    return redirect()->back()->with('message','Contact message successfully sent.');

}

private function getCaptcha($Secretkey){
  $secret = env('SECRET_KEY');
  $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$Secretkey}");
  $return = json_decode($response);
  return $return;
}



public function postby_category($id){
  $post_category = PostCategoryModel::where(['id'=>$id])->first();
  $data = PostModel::where(['post_category'=>$id])->paginate(20);
  if($data){
    return view('themes.default.postbycategory',compact('data','post_category'));
  }
  return false;
}

 
  public function become_member(Request $request)
    {
        if($request->isMethod('get'))
        {      
            $event = EventModel::where('status','1')->first();
            if($event)
            {
            $category1 = EventCategory::where(['status'=>'1','type'=>'individual','event'=>$event->id])->get();
            $category2 = EventCategory::where(['status'=>'1','type'=>'group','event'=>$event->id])->get();
            }
            else{
                $category1 = '';
                $category2 = '';
            }
            return view('themes.default.become-member',compact('event','category1','category2'));
    
        }
        if($request->isMethod('post'))
        {
            $request->validate([
              'first_name'=>'required',
              'last_name'=>'required',
              'gender'=>'required',
                'dob'=>'required',
                'occupation'=>'required',
                'nationality'=>'required',
                'country'=>'required',
                'city'=>'required',
                'address'=>'required',
                'tel_no'=>'required',
                'mob_no'=>'required',
                'email'=>'required|email',
                'g-recaptcha-response' => 'required|captcha'
            ]);
            if($request->event_category == 18){
                $request->validate([
                    'blood_group' => 'required',
                    'e_name' => 'required',
                    'relation' => 'required',
                    'mobile' => 'required'
                ]);
            }
            if($request->event_category == 18){
                $request->validate([
                   'dob' => ['required', 'numeric', 'min:18']
                ]);
            }
            if($request->event_category == 16){
                $request->validate([
                   'dob' => ['required', 'numeric', 'min:12']
                ]);
            }
        if(isset($request->conditions))
        {
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
            $data['event'] = $request->event;
            $data['facebook_id']=$request->facebook_id;
            $data['past_record']=$request->past_record;
            $data['previous_runner']=$request->previous_runner;
            if(DB::table('runners')->count() == 0 ){
            $data['reg_no']='00011';
        }else{
          $ordering = Runner::max('reg_no');
          $ordering = $ordering + 1;
           $data['reg_no']=$ordering;
        }
        $store=Runner::create($data);         
        
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
            'group_entry'=>$request->type == 2 ? 'yes': NULL,
            'group_name' => $request->type == 2 ? $request->group_name : NULL,
            'group_size'=>  $request->type == 2 ? $request->group_size : NULL,
            'group_type'=> $request->type == 2 ? $request->group_type : NULL,
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
        $eventcategory = EventCategory::where('id',$info->event_category)->first();
        
        if($store && $info && $app && $emergency)
        { 
         return view('themes.default.pay-now',compact('data','store','info','emergency','app','eventcategory'));
        }
      }else{
        return response()->json(['error'=>'Please accept the given terms & conditions.']);

      }
    }
}

 public function application_view(Request $request)
    {
      if($request->isMethod('get'))
      {    
        return view('themes.default.application-view');
      }
      if($request->isMethod('post')){        
      $request->validate([          
            'reg_no'=>'required',
            'email'=>'required|email',
          ]);
        $reg_no = $request->reg_no;
        $email = $request->email;
        $store = Runner::where(['reg_no'=>$reg_no,'email'=>$email])->first();
        if($store == NULL){
          return redirect()->back()->with('error','Given details doesnot match');
        }else{
        $info = InfoMarathon::where('user_id',$store->id)->first();
        $app = ApplicationType::where('user_id',$store->id)->first();
        $emergency = Emergency::where('user_id',$store->id)->first();
        $eventcategory = EventCategory::where('id',$info->event_category)->first();
        return view('themes.default.pay-now',compact('store','info','app','emergency','eventcategory'));
      }
      }
    }

    public function futsal_registration(Request $request)
    {
    if($request->isMethod('get'))
      {    
        $event=FutsalEvent::where('status',1)->first();
        return view('themes.default.futsal-form',compact('event'));
      }
      if($request->isMethod('post')){
      $request->validate([          
             'team_name'=>'required',
             'company_name'=>'required',
             'team_captain'=>'required',
             'team_contact'=>'required',
             'team_email'=>'required|email',
             'g-recaptcha-response' => 'required|captcha'
          ]);

    $store=new FutsalTeam(); 
    $store->event_id=$request->event_id;
    $store->team_name=$request->team_name;
    $store->company_name=$request->company_name;
    $store->team_captain=$request->team_captain;
    $store->contact=$request->team_contact;
    $store->email=$request->team_email;
    $store->save();
    $last_id = $store->id;
      if (isset($request->identification_number)) {
                $gear_keys = array_keys($request->identification_number); 
                $sn_gear = 1;
                $sn_gear_count = count($request->identification_number);
                foreach ($gear_keys as $key => $value) {
                    if ($key + 1 >= $sn_gear_count) {
                        continue;
                    }
                    $MemberCertificate = new FutsalPlayers();
                    $MemberCertificate->team_id = $last_id;
                    $thumb_file = $request->file('image');
                    if (isset($thumb_file[$value])) {
                        $thumb = time() . '-' . Str::random(15) . $thumb_file[$value]->getClientOriginalName();
                        $destinationPath = public_path('uploads/team');
                        $thumb_file[$value]->move($destinationPath, $thumb);
                        $MemberCertificate->image = $thumb;
                    }
                     $MemberCertificate->identification_number = $request->identification_number[$key];   
                     $MemberCertificate->name = $request->name[$key];   
                     $MemberCertificate->dob = $request->dob[$key];   
                     $MemberCertificate->contact = $request->contact[$key];   
                     $MemberCertificate->email = $request->email[$key];  
                     $MemberCertificate->remarks = $request->remarks[$key];   
                     $MemberCertificate->save();
                     $sn_gear++;
                }
            }

        $event=FutsalEvent::where('status',1)->first();
         return redirect()->route('futsal-payment');
    }
  }

  public function futsal_payment()
  {
    $store=FutsalTeam::latest()->first();
     $event=FutsalEvent::where('status',1)->first();
     return view('themes.default.corporate-esewa',compact('store','event'));
  }

 public function register_now($uri)
    {
         $event = EventModel::where('uri',$uri)->first();
          if($event){
        $category1 = EventCategory::where(['status'=>'1','type'=>'individual','event'=>$event->id])->get();
        $category2 = EventCategory::where(['status'=>'1','type'=>'group','event'=>$event->id])->get();
        }else{
            $category1 = '';
            $category2 = '';
        }
        return view('themes.default.become-member',compact('event','category1','category2'));
    }
}
