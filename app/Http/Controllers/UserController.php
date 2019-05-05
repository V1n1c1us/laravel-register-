<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index(){

        $user = $this->user->all();

        return view('layouts.dashboard.user.index', compact('user'));
    }

    public function edit($id){
        $user = $this->user->find($id);
        
        return view('layouts.dashboard.user.edit', compact('user'));

    }

    public function update(Request $request, $id){

        $user = $this->user->find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();

        return redirect()->route('user.user')->withSuccess('Usuário Editado com Sucesso');
    }

}
