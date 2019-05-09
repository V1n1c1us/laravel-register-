<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('guest');
        $this->user = $user;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $password = Hash::make($data['password']);


        if(isset($data['imgprofile'])){
            $file = $data['imgprofile'];
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


        return $this->user->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'imgprofile' => $fullpathThumb
        ]);



    }
}
