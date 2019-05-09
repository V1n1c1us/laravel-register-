<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Image;

class UserControllerApi extends Controller
{
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index(){

        $user = $this->user->all();

        return $user;
    }

    public function store (Request $request){

        $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $user->token = $user->createToken($user->email)->accessToken;

        return $user;
    }



}
