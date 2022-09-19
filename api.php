<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DormController;
use App\Http\Controllers\RoomController;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// admin
Route::group(['middleware'=>['auth:sanctum']],function (){
    Route::get('/admin/dashboard',[DormController::class,'index']);
    Route::post('/admin/dorm',[DormController::class,'store']);
    Route::get('/admin/{admin_id}/dorm',[DormController::class,'showOnlyAdmin']);
    Route::post('/admin/dorm/room',[RoomController::class,'store']);
    Route::get('/admin/dorm-detail/room/{dorm_name}',[RoomController::class,'showByDormName']);
    Route::delete('/admin/dorm/room',[RoomController::class,'delete']);
    Route::delete('/admin/dorm',[DormController::class,'delete']);
    Route::get('/admin/dorm/{id}',[DormController::class,'show']);
    Route::put('/admin/dorm/{id}',[DormController::class,'update']);
    Route::put('/admin/dorm/room/{id}',[RoomController::class,'update']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/admin/profile',[AuthController::class,'show']);
    Route::put('/admin/profile/{id}',[AuthController::class,'update']);
});
// visited
Route::group(['prefix'=>'accomadation'],function (){
    Route::get('/dorm',[DormController::class,'index']);
    Route::get('/dorm/{dorm_id}/room',[RoomController::class,'show']);
    Route::get('/findDorm',[DormController::class,'findDorm']);
});
// authentication
Route::post('/signup',[AuthController::class,'signup']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/welcome',function(){
    
    return response()->json(['data'=>'Hello']);
});

