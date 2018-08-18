<?php

namespace App\Http\Controllers\Auth;

use App\Membership;
use App\Message;
use App\User;
use App\Http\Controllers\Controller;
use App\userInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if($user) {
            $info = new UserInfo();
            $random1 = rand();
            $random2 = rand();
            $info->username = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', str_replace(' ', '', $user->name)));
            $info->username = $info->username.'_'.$random1.'_'.$random2;
            $user->info()->save($info);
            $user->createUserSection();

            Message::create(['sender_id'=>1, 'receiver_id'=>$user->id, 'content'=>"Hi,<br>Welcome To Connect. I am Tanmoy. Feel free to contact me anytime you want..."]);
        }

        return $user;
    }
}
