<?php

namespace App\Http\Controllers\AdminControllers\Event;
use App\Models\Event\EventModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Event\EventCategory;
use App\Model\Runner;
use App\Model\ApplicationType;
use App\Model\InfoMarathon;
use App\Model\Emergency;
use App\Model\RunnerDoc;
use Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = EventModel::orderBy('id','desc')->get();
        return view('admin.event.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'banner'=> 'image|mimes:jpeg,png,jpg,gif|max:3072',
            'uri'=>'required|unique:events',
        ]);

    $req = $request->all();
    $file =  $request->file('banner');

    if($request->hasFile('banner')){
        $banner = $request->file('banner')->getClientOriginalName();
        $extension = $request->file('banner')->getClientOriginalExtension();
        $banner = explode('.', $banner);
        $banner_name = Str::slug($banner[0]) . '-' . Str::random(40) . '.' . $extension;
        $destinationPath = public_path('uploads/banners');
        $banner_picture = Image::make($file->getRealPath());       
        $banner_picture->save($destinationPath .'/'. $banner_name );
        $req['banner'] = $banner_name;
    }
   
    $data = EventModel::create($req);
    if($data){
        return redirect()->back()->with('message','Successfully added.');
    }else{
        return "Error";
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event_id = $id;
        // $data = InfoMarathon::where('event',$id)->get();
        $data = InfoMarathon::where('event', $id)->orderBy('id', 'desc')->paginate(50); // 50 per page

        $pending1 = Runner::where(['event'=>$id,'paid_status'=>'0'])->orderBy('id','desc')->get();
        // Filter the $pending1 collection based on the fetched category name
        $pending = $pending1->unique('email');
        $verified = Runner::where(['event'=>$id,'paid_status'=>'1'])->orderBy('id','desc')->get();
        $esewa = Runner::where(['event'=>$id,'payment_type'=>'eSewa'])->orderBy('id','desc')->get();
        $cash = Runner::where(['event'=>$id,'payment_type'=>'Paid at Office'])->orderBy('id','desc')->get();
        $khalti = Runner::where(['event'=>$id,'payment_type'=>'Khalti'])->orderBy('id','desc')->get();
        $half_marathone = Runner::where(['event' => '9', 'paid_status' => '1'])->orderBy('id', 'desc')->get();
        return view('admin.event.show', compact('data', 'pending', 'verified', 'esewa', 'cash', 'khalti', 'half_marathone','event_id'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = EventModel::find($id);
         return view('admin.event.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,EventModel $EventModel, $id)
    {
        $request->validate([
            'banner'=> 'image|mimes:jpeg,png,jpg,gif|max:3072',
            'uri'=>'required|unique:events,uri,'.$id,
        ]);
        
       $data = EventModel::find($id);
        $file = $request->file('banner');

        if($request->hasFile('banner')){

            // Remove old file if exists
            $data = EventModel::find($id);
           if($data->banner != NULL){
                if(file_exists(public_path('uploads/banners/' .  $data->banner))){
                      unlink(env('PUBLIC_PATH').'uploads/banners/' . $data->banner);
                    }
                }
            // Upload new file
            $banner = $request->file('banner')->getClientOriginalName();
            $extension = $request->file('banner')->getClientOriginalExtension();
            $banner = explode('.', $banner);
            $banner_name = Str::slug($banner[0]) . '-' . Str::random(40) . '.' . $extension;
            $destinationPath = public_path('uploads/banners');
            $banner_picture = Image::make($file->getRealPath());
            $banner_picture->save($destinationPath .'/'. $banner_name );
            $data->banner = $banner_name;
            }                
        
           $data->name = $request->name;
           $data->uri = $request->uri;
           $data->caption = $request->caption;
            $data->brief = $request->brief;
            $data->content = $request->content;
           $isChecked = $request->has('status');       
            $data['status'] = ($isChecked)?'1':'0';
          
           $data->save();
           
        return redirect()->back()->with('message','Update Successful.'); 
          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = EventModel::find($id);
       if($data->banner != NULL){
        if(file_exists(public_path('uploads/banners/' .  $data->banner))){
              unlink(env('PUBLIC_PATH').'uploads/banners/' . $data->banner);
            }
        }
        $data->delete();
         return redirect()->back()->with('message','Deleted Successful.'); 
    }

     public function isdefault(Request $request)
    {  
      $data = EventModel::find($request->id);      
       $default = EventModel::where('id','!=', $data->id)->get();
    
    // single status enable
    //   if($data->status == '1'){
    //       $data->status = '0';   
    //       $data->save();  
    //       return back();
    //     }else if($data->status == '0'){
    //       foreach($default as $row) {       
    //         if ( $row->status == '1' ) {
    //              $default = EventModel::where('id',$row->id)->update(['status'=> '0']);
    //         }
    //     }
    //   $data->status = '1';      
    //   $data->save();  
    //   return back();
    // }
    
    // multiple status enable
     if ($data->status == '1') {
            $data->status = 0;
            $data->save();
        }
    
      elseif ($data->status == '0') {
            $data->status = 1;
            $data->save();
        }
        else{
        $data->save();
        }
       
    return back();  
  }
}
