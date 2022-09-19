<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signup(Request $request)
    {
        $this->validate($request,[
            'username'=>'required',
            'email'=>'required|email',
            'thai_id'=>'required',
            'password'=>'required|confirmed',
        ]);
        User::create(['username'=>$request->username,
        'email'=>$request->email,
    'thai_id'=>$request->thai_id,
    'password'=>Hash::make($request->password)]);
        return response()->json(['status'=>'signup success']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return response()->json(['data'=>Auth::user(),'token' => auth()->user()->createToken('API Token')->plainTextToken,'login'=>true]);
        }else{
            return response()->json(['message'=>'login failed','login'=>false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        return response()->json(['data'=>auth()->user()]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'username'=>'required',
            'email'=>'required',
            'thai_id'=>'required',
            'image'=>'required'
        ]);
        return User::where('id',$id)->update([
            'username'=>$request->username,
            'email'=>$request->email,
            'image'=>$request->image,
            'thai_id'=>$request->thai_id
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
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['login'=>false,'message'=>'logged out']);
    }

}
