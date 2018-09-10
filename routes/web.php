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

use App\Request;
use App\Section;
use App\SimpleNotification;
use App\User;
use App\UserInfo;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::any('/', function () {
    if (Auth::check()) {

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

Route::post('/deposit', function () {
    return "Make Deposit Page";
})->name('deposit');

Route::post('/withdraw', function () {
    return "Make Withdraw Page";
})->name('withdraw');

Route::any('/send-money', 'PaymentController@sendMoney')->name('sendMoney');


Route::any('/follow/{sectionId}', 'GeneralController@follow')->name('follow');
Route::any('/unfollow/{sectionId}', 'GeneralController@unfollow')->name('unfollow');

Route::post('contact_show', [
    'uses' => 'HomeController@checker'
])->middleware('auth');

Route::resource('post', 'PostController');
Route::get('post/{id}/toggleLike', 'PostController@toggleLike')->name('post.toggleLike');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sendMail', ['as' => 'mail', 'middleware' => 'auth', function () {

    $user = Auth::user();
    if (isset($user))
        $user = $user->name;
    if ($user == null) $user = "Brother";
    $data = [
        'title' => 'Can you see me?',
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
Route::get('project/create/{parentId}', 'ProjectController@create')->middleware('auth')->name('createSection');

Route::get('search', 'SearchController@index')->name('search');

Route::get('test', function () {
    return view('layouts.standardPageLayout');
});

Route::post('manageRequest', 'RequestController@manageRequest')->name('manageRequest');

Route::get('acceptRequest/{requestId}', function ($requestId) {
    $section = Section::find(Request::find($requestId)->section_id);
    Auth::user()->acceptRequest($requestId);

    return redirect(Route('project.show', ['id' => $section->id]));
})->name('acceptRequest');

Route::get('rejectRequest/{requestId}', function ($requestId) {
    Auth::user()->rejectRequest($requestId);
    return redirect()->back();
})->name('rejectRequest');

Route::get('makeAdmin/{sectionId}/{userId}', function ($sectionId, $userId) {
    $user = User::findOrFail($userId);
    if ($user->isMember($sectionId)) {
        $user->setRoleByName($sectionId, 'admin');
    }

    $section = Section::find($sectionId);
    $notification = new SimpleNotification();
    $notification->recepient_id = $user->id;
    $notification->link = Route('project.show', $section->id);
    $notification->image_to_show = $section->getLogoPath();
    $notification->notification_text = Auth::user()->name . ' made you an admin of ' . $section->name;
    $notification->save();

    return redirect()->back();
})->name('makeAdmin');

Route::get('makeManager/{sectionId}/{userId}', function ($sectionId, $userId) {
    $user = User::findOrFail($userId);
    if ($user->isMember($sectionId)) {
        $user->setRoleByName($sectionId, 'manager');
    }

    $section = Section::find($sectionId);
    $notification = new SimpleNotification();
    $notification->recepient_id = $user->id;
    $notification->link = Route('project.show', $section->id);
    $notification->image_to_show = $section->getLogoPath();
    $notification->notification_text = Auth::user()->name . ' made you an manager of ' . $section->name;
    $notification->save();

    return redirect()->back();
})->name('makeManager');

Route::get('makeMember/{sectionId}/{userId}', function ($sectionId, $userId) {
    $user = User::findOrFail($userId);
    if ($user->isMember($sectionId)) {
        $user->setRoleByName($sectionId, 'member');
    }

    $section = Section::find($sectionId);
    $notification = new SimpleNotification();
    $notification->recepient_id = $user->id;
    $notification->link = Route('project.show', $section->id);
    $notification->image_to_show = $section->getLogoPath();
    $notification->notification_text = Auth::user()->name.' made you an member of '.$section->name;
    $notification->save();

    return redirect()->back();
})->name('makeMember');

Route::get('kick/{sectionId}/{userId}', function ($sectionId, $userId) {
    $user = User::findOrFail($userId);
    $user->leave($sectionId);

    $section = Section::find($sectionId);
    $notification = new SimpleNotification();
    $notification->recepient_id = $user->id;
    $notification->link = Route('project.show', $section->id);
    $notification->image_to_show = $section->getLogoPath();
    $notification->notification_text = Auth::user()->name.' kicked you out of '.$section->name;
    $notification->save();

    return redirect()->back();
})->name('kick');

Route::get('invite/{userId?}', 'GeneralController@invite')->name('invite');
Route::get('inviteToSection/{sectionId?}', 'GeneralController@inviteToSection')->name('inviteToSection');
Route::any('makeInvitation', 'GeneralController@makeInvitation')->name('makeInvitation');

Route::get('notifications', function () {
    return view('notificationsPage');
})->name('notifications');

Route::get('clearNotifications', function () {
    Auth::user()->notifications()->delete();
    return redirect()->back();
})->name('clearNotifications');
