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

Route::any('/', function () {
    if(Auth::check()) {

        return redirect()->route('newsFeed');
    } else {
        return view('welcome');
    }

})->name('/');

Route::get('/newsfeed', 'NewsFeedController@index')->name('newsFeed')->middleware('auth');
Route::get('/newsfeed/{pageno}', 'NewsFeedController@index')->name('newsFeedPage')->middleware('auth');
Route::get('/newsfeed/{pageno}/{postEachPage}', 'NewsFeedController@index')->name('newsFeedCustom')->middleware('auth');

Route::post('/upload', 'UploadController@upload')->name('upload');

Route::resource('messages', 'MessageController')->middleware('auth')->only([
    'store', 'index', 'show'
]);;

Route::resource('profile', 'ProfileController')->middleware('auth')->only([
    'index', 'show', 'edit', 'store'
]);

Route::resource('comments', 'CommentController');

Auth::routes();

Route::post('/deposit', function (){
    return "Make Deposit Page";
})->name('deposit');

Route::post('/withdraw', function () {
    return "Make Withdraw Page";
})->name('withdraw');

Route::post('/send-money', 'PaymentController@sendMoney')->name('sendMoney');

Route::any('/follow/{sectionId}', 'GeneralController@follow')->name('follow');
Route::any('/unfollow/{sectionId}', 'GeneralController@unfollow')->name('unfollow');

Route::post('contact_show', [
    'uses' => 'HomeController@checker'
])->middleware('auth');

Route::resource('post', 'PostController');
Route::get('post/{id}/toggleLike', 'PostController@toggleLike')->name('post.toggleLike');

Route::get('/home', 'HomeController@index')->name('home');

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

Route::resource('payment', 'PaymentController');

Route::resource('userinfo', 'UserInfoController');
//Route::get('deposit', 'PaymentCon')

Route::resource('project', 'ProjectController')->middleware('auth');

Route::get('test', function() {
   return view('layouts.standardPageLayout');
});
