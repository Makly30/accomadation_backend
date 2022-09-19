<?php

namespace App\Http\Controllers;

use App\Models\Dorm;
use Illuminate\Http\Request;

class DormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dorms=Dorm::all();
        return response()->json(['data'=>$dorms]);
    }
    public function showOnlyAdmin($admin_id)
    {
        //
        $dorms=Dorm::query()->where('admin_id',$admin_id)->get();
        return response()->json(['data'=>$dorms]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'dorm_name'=>'required',
            'dorm_address'=>'required',
            'dorm_profile'=>'required',
            'dorm_facebook'=>'required',
            'phone'=>'required',
            'dorm_deposition'=>'required',
            'dorm_contract'=>'required',
            'dorm_electric'=>'required',
            'dorm_water'=>'required',
            'dorm_wifi'=>'required',
        ]);
     return   Dorm::create([
            'dorm_name'=>$request->dorm_name,
            'dorm_address'=>$request->dorm_address,
            'dorm_profile'=>$request->dorm_profile,
            'dorm_facebook'=>$request->dorm_facebook,
            'phone'=>$request->phone,
            'dorm_deposition'=>$request->dorm_deposition,
            'dorm_contract'=>$request->dorm_contract,
            'dorm_electric'=>$request->dorm_electric,
            'dorm_water'=>$request->dorm_water,
            'dorm_wifi'=>$request->dorm_wifi,
            'like'=>0,
            'rate'=>0,
            'admin_id'=>auth()->user()->id
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($dorm_id)
    {
        //
        return response()->json(['data'=>Dorm::find($dorm_id)])
;    }
public function findDorm(Request $request){
    if($request->dorm_name){
        $dorms=Dorm::query()->where('dorm_name','LIKE','%'.$request->dorm_name.'%')->get();
    }else{
        $dorms=Dorm::all();
    }
    
    return response()->json(['data'=>$dorms]);
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
        //
        $this->validate($request,[
            'dorm_name'=>'required',
            'dorm_address'=>'required',
            'dorm_profile'=>'required',
            'dorm_facebook'=>'required',
            'phone'=>'required',
            'dorm_deposition'=>'required',
            'dorm_contract'=>'required',
            'dorm_electric'=>'required',
            'dorm_water'=>'required',
            'dorm_wifi'=>'required',
        ]);
     return   Dorm::where('id',$id)->update([
            'dorm_name'=>$request->dorm_name,
            'dorm_address'=>$request->dorm_address,
            'dorm_profile'=>$request->dorm_profile,
            'dorm_facebook'=>$request->dorm_facebook,
            'phone'=>$request->phone,
            'dorm_deposition'=>$request->dorm_deposition,
            'dorm_contract'=>$request->dorm_contract,
            'dorm_electric'=>$request->dorm_electric,
            'dorm_water'=>$request->dorm_water,
            'dorm_wifi'=>$request->dorm_wifi,
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function delete(Request $request){
       return  Dorm::destroy($request->id);
    }
}
