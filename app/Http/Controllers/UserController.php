<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Image;

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

    public function create () {
        return view('layouts.dashboard.user.create');
    }
    public function store (Request $request){

        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));


        if ($request->hasFile('imgprofile')){
            $file = $request->file('imgprofile');
            $filename = round(microtime(true) * 1000) . '.' . $file->getClientOriginalExtension();

            $fullPath = 'user_profile/'.$filename;
            $fullpathThumb = 'user_profile_thumb/'.$filename;
            //$filepath = public_path() . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . $filename;
            Storage::putFileAs('public/user_profile/', $file, $filename,'public');
            Storage::makeDirectory('public/user_profile_thumb');

            $image = Image::make('../storage/app/public/'.$fullPath)
                        ->resize(60,60)
                        ->save('../storage/app/public/'.$fullpathThumb);
        } else {
            $fullpathThumb = null;
        }
        $user = $this->user->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'imgprofile' => $fullpathThumb
        ]);

        return redirect()->route('user.user')->withSuccess('Usuário criado com sucesso');
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

    public function delete ($id)
    {
        $user = $this->user->find($id);

        if(isset($user)) {
                $deletefile = $user->imgprofile;
                $deletefilethumb = $user->imgprofile;
                Storage::disk('public')->delete([$deletefile, $deletefilethumb]);
                //unlink(storage_path('public/'.$image->file));
                //unlink(storage_path('public/'.$image->file));
                //Storage::disk('public')->delete($deletefilethumb);
            $delete = $user->delete();
            if($delete) {
                return redirect()->route('user.user')->withSuccess('Usuário deletado com sucesso!');
            } else {
                return redirect()->route('user.user')->withSuccess('Ops.. Erro ao deletar o produto!');
            }
        }
    }

}
