<?php

namespace App\Http\Controllers\AdminControllers\Event;
use Illuminate\Support\Facades\Session;
use App\Models\Event\EventModel;
use App\Models\Event\EventCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = EventCategory::orderBy('id','desc')->get();
        return view('admin.eventcategory.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
      $data = EventModel::all();
        return view('admin.eventcategory.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = $request->all();
    $data = EventCategory::create($req);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data = EventCategory::find($id);
         $company = EventModel::all();
         return view('admin.eventcategory.edit', compact('data','company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = EventCategory::find($id);        
        
       $data->name = $request->name;
        $data->event = $request->event;
         $data->price = $request->price;
         $data->type = $request->type;
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
        $data = EventCategory::find($id);
       
         $data->delete();
         return redirect()->back()->with('message','Deleted Successful.');
    }

}
