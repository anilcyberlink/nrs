<?php

namespace App\Http\Controllers\AdminControllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\FutsalEvent;
use App\Models\Model\FutsalTeam;
use App\Models\Model\FutsalPlayers; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class FutsalTeamController extends Controller  
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = FutsalTeam::orderBy('id','desc')->get();
        return view('admin.futsal-team.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=FutsalEvent::all(); 
         return view('admin.futsal-team.create',compact('data'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
              'team_name'=>'required',
             'company_name'=>'required',
             'team_captain'=>'required',
             'team_contact'=>'required',
             'team_email'=>'required' 
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all()
                ]);
            }

    $store=new FutsalTeam();
    $store->event_id=$request->event_id;
    $store->team_name=$request->team_name;
    $store->company_name=$request->company_name;
    $store->team_captain=$request->team_captain;
    $store->contact=$request->team_contact;
    $store->email=$request->team_email;
    $store->save();
    $last_id = $store->id;

     // Insert into Players
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
    return response()->json(['status' => 'success', 'message' => 'Team Added Successfully']);

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
         $data = FutsalTeam::find($id);
         $company = FutsalEvent::all(); 
         $certificates = $data->players()->get();
         return view('admin.futsal-team.edit', compact('data','company','certificates'));  
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
         $data = FutsalTeam::find($id);  
        
         $data->team_name = $request->team_name;
         $data->event_id = $request->event_id;
         $data->company_name = $request->company_name;
         $data->team_captain = $request->team_captain;
         $data->contact = $request->team_contact;
         $data->email = $request->team_email;

         
      // Update Players   
     
     if (isset($request->certificates_id)) {
                $certificates_keys = array_keys($request->certificates_id);
                $sn_certificates = 1;
                $sn_certificate_count = count($request->certificates_id);

                foreach ($certificates_keys as $key => $value) {
                    if ($key + 1 >= $sn_certificate_count) {
                        continue;
                    }

                    if ($request->certificates_id[$value] == "") {
                        $certificateData = new FutsalPlayers();
                        $certificateData->team_id = $data->id;
                        $thumb_file = $request->file('image');
                        if (isset($thumb_file[$value])) {
                            $thumb = $thumb_file[$value]->getClientOriginalName();
                            $destinationPath = public_path('uploads/team');
                            $thumb_file[$value]->move($destinationPath, $thumb);
                            $certificateData->image = $thumb;
                        }
                    $certificateData->identification_number = $request->identification_number[$key];   
                     $certificateData->name = $request->name[$key];   
                     $certificateData->dob = $request->dob[$key];   
                     $certificateData->contact = $request->contact[$key];   
                     $certificateData->email = $request->email[$key];  
                     $certificateData->remarks = $request->remarks[$key];                            
                       
                        $certificateData->save();
                    } else if ($request->certificates_id[$value] !== null && $request->certificates_id[$value] !== "") {
                        $certificates_id = $request->certificates_id[$value];
                        $certificateData = FutsalPlayers::find($certificates_id);

                        $thumb_file = $request->file('image');
                        if (isset($thumb_file[$key])) {

                            if ($certificateData->image) {
                                if (file_exists(env('PUBLIC_PATH') . 'uploads/team/' . $certificateData->image)) {
                                    unlink(env('PUBLIC_PATH') . 'uploads/team/' . $certificateData->image);
                                }
                            }

                            $thumb = $thumb_file[$key]->getClientOriginalName();
                            $destinationPath = public_path('uploads/team');
                            $thumb_file[$key]->move($destinationPath, $thumb);
                            $certificateData->image = $thumb;
                        }
                        $certificateData->team_id = $data->id;
                     
                     $certificateData->identification_number = $request->identification_number[$key];   
                     $certificateData->name = $request->name[$key];   
                     $certificateData->dob = $request->dob[$key];   
                     $certificateData->contact = $request->contact[$key];   
                     $certificateData->email = $request->email[$key];  
                     $certificateData->remarks = $request->remarks[$key];                   
                     $certificateData->save();
                    }

                    $sn_certificates++;
                }
            }

        $data->save();
        return response()->json(['status' => 'success', 'message' => 'Team Updated Successful!']);
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = FutsalTeam::find($id);
        $data->players()->delete();
        $data->delete();
        return redirect()->back()->with('message','Deleted Successful.'); 
    }

     public function team_destroy($team_id,$id)
    {
        $data = FutsalPlayers::find($id);
         if($data->image  != NULL){
            unlink('uploads/team/' . $data->image );
        }
        $data->delete();
        return 'Are you sure to delete?';    
    }
}
