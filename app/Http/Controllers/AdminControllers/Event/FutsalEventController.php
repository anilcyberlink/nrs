<?php

namespace App\Http\Controllers\AdminControllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\FutsalEvent;
use Illuminate\Support\Str;
use Image; 
use App\Models\Model\FutsalTeam;



class FutsalEventController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $data = FutsalEvent::orderBy('id','desc')->get();
        return view('admin.futsal.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.futsal.create');   
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
            'event_name'=>'required',
            'banner'=> 'image|mimes:jpeg,png,jpg,gif|max:3072',
            'price'=>'required'
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
   
    $data = FutsalEvent::create($req);
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
        $data = FutsalTeam::where('event_id',$id)->get();
        $pending = FutsalTeam::where(['event_id'=>$id,'paid_status'=>'0'])->orderBy('id','desc')->get();
        $verified = FutsalTeam::where(['event_id'=>$id,'paid_status'=>'1'])->orderBy('id','desc')->get();
        $esewa = FutsalTeam::where(['event_id'=>$id,'payment_type'=>'eSewa'])->orderBy('id','desc')->get();
        $cash = FutsalTeam::where(['event_id'=>$id,'payment_type'=>'Paid at Office'])->orderBy('id','desc')->get();

         return view('admin.futsal.show', compact('data','pending','verified','esewa','cash'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = FutsalEvent::find($id);
         return view('admin.futsal.edit', compact('data')); 
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,FutsalEvent $EventModel, $id)
    {
       $data = FutsalEvent::find($id);
        $file = $request->file('banner');

        if($request->hasFile('banner')){

            // Remove old file if exists
            $data = FutsalEvent::find($id);
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
        
            $data->event_name = $request->event_name;
            $data->price = $request->price;
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
      $data = FutsalEvent::find($id);
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
      $data = FutsalEvent::find($request->id);      
       $default =FutsalEvent::where('id','!=', $data->id)->get();
   if($data->status == '1'){
      $data->status = '0';   
      $data->save();  
      return back();
    }else if($data->status == '0'){
       foreach($default as $row) {       
        if ( $row->status == '1' ) {
             $default = FutsalEvent::where('id',$row->id)->update(['status'=> '0']);
        }
    }
      $data->status = '1';      
      $data->save();  
      return back();
    }
    return back();  
  }
}
