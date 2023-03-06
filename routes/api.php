<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::post("signup",[usercontroller::class,"signup"]);
Route::post("login",[usercontroller::class,"login"]);

Route::group(['middleware'=>["auth:sanctum"]],function() {
    Route::get("userprofile",[usercontroller::class,"userprofile"]);
    Route::get("logout",[usercontroller::class,"logout"]);
    Route::put("update/{id}",[usercontroller::class,"update"]);


});
Route::group(['middleware'=>["auth:sanctum"]],function() {

});
