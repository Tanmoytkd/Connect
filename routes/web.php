<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;
use App\UserInfo;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(Auth::check()) {
        return redirect()->route('home');
    } else {
        return view('welcome');
    }

})->name('/');

Auth::routes();

Route::get('/test', function (){
    return view('auth.newLogin');
})->name('test');

Route::post('contact_show', [
    'uses' => 'HomeController@checker'
])->middleware('auth');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/enterdata/{username}', function ($username) {
    $user = Auth::user();

    $info = new UserInfo(['username'=>$username]);

    if(count($user->info()->get())) {
        return $user->info()->get();
    } else {
        return $user->info()->save($info);
    }

});

Route::get('/sendMail', ['as'=>'mail', 'middleware'=>'auth' ,function (){

    $user = Auth::user();
    if(isset($user))
        $user = $user->name;
    if($user == null) $user = "Brother";
    $data = [
        'title'=>'Can you see me?',
        'user' => $user,
        'sender' => 'TKD from connectapp'
    ];
    Mail::send('mails.test', $data, function ($message) {
        $message->to('tanmoykrishnadas@gmail.com', 'Tanmoy')->subject('dekhi jay kina')->from('postmaster@mail.connectapp.ml', "Tanmoytkd");
    });
}]);
