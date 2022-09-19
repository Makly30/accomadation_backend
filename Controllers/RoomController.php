<?php

namespace App\Http\Controllers;


use App\Models\Room;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    //
    public function show($dorm_id){
        $rooms=Room::query()->where('dorm_id',$dorm_id)->get();
        return response()->json(['data'=>$rooms]);
    }
    public function showByDormName($dorm_name){
        $rooms=DB::table('room')->join('dorm','room.dorm_id','=','dorm.id')
        ->select('room.*')->where('dorm.dorm_name',$dorm_name)->get();
        return response()->json(['data'=>$rooms]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'room_profile'=>'required',
            'dorm_id'=>'required',
            'facilities'=>'required',
            'bed'=>'required',
            'price'=>'required'
        ]);
      return   Room::create($request->all());
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'room_profile'=>'required',
            'facilities'=>'required',
            'bed'=>'required',
            'price'=>'required'
        ]);
      return   Room::where('id',$id)->update([
        'room_profile'=>$request->room_profile,
        'facilities'=>$request->facilities,
        'bed'=>$request->bed,
        'price'=>$request->price
      ]);
    }
    public function delete(Request $request){
      return  Room::where('id',$request->id)->delete();
    }
}
