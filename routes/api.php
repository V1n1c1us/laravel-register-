<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors']], function () {
    Route::get('/teste', function(){
        return User::all();
    });
    Route::post('/create', function (Request $request) {
        $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $user->token = $user->createToken($user->email)->accessToken;

        return $user;
    });
    Route::post('/str', 'UserControllerApi@store');


});





