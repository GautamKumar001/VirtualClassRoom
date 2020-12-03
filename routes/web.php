<?php

use App\Http\Controllers\VideoRoomsController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('cors')->group(function () {
    Route::get('/teacherindex', 'TeacherModelController@index')->name('Teacher');
    ;
    Route::get('/teachershow', 'TeacherModelController@show')->name('TeacherView');
    Route::post('/teacherstore', 'TeacherModelController@store');
    Route::post('/insert', 'TeacherModelController@insert');


    Route::get('/studentindex', 'StudentModelController@index')->name('Student');
    Route::get('/studentshow', 'StudentModelController@show');
    Route::post('/studentstore', 'StudentModelController@store');
});

Route::view('/', 'app');
Route::post('/upload', 'TeacherModelController@upload');

Auth::routes();
Route::get('/search', 'ChatController@Search');
Route::post('/Status', 'ChatController@status');
Route::get('/Statusup', 'ChatController@statusup');
Route::get('/contact', 'ChatController@contacts');
Route::get('/Agentprofile', 'ChatController@index');
Route::get('/getmessage/{id}', 'ChatController@getMessage');
Route::get('/getname/{name}', 'ChatController@getNames');
Route::get('/message/{id}', 'ChatController@getMessage')->name('message');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/message', 'ChatController@sendMessage')->name('sendmessage');
Route::get('/TeacherUi', 'VideoRoomsController@TeacherUi')->name('TeacherUi');
Route::get('/studentUi', 'VideoRoomsController@studentUi')->name('studentUi');

Route::post('/Create', 'VideoRoomsController@createRoom');
Route::get('/joinRoom/{roomName}', 'VideoRoomsController@joinRoom');

Route::get('roomarch', 'VideoRoomsController@roomArch');
Route::view('library', 'libraryview');
Route::get('pdf', 'Pdf\htmltopdf@htmlpdf');
Route::get('/fireshow', 'Firebase\FirebaseController@show');
Route::get('/firebase', 'Firebase\FirebaseController@index');
Route::post('/store', 'Firebase\FirebaseController@store');
Route::get('/teacherbook', 'TeacherLibraryController@show');

Route::get('/teacherdate', 'TeacherLibraryController@index');

Route::post('/Tprofile', 'TeacherLibraryController@ProfileStore');
Route::post('/TBookStore', 'TeacherLibraryController@Bookstore');
Route::post('/TNoteStore', 'TeacherLibraryController@Notestore');
Route::post('/Tschedule', 'TeacherLibraryController@ScheduleStore');

Route::get('/contact', 'Contactcontroller@create');
Route::post('/contact', 'Contactcontroller@store');
Route::get('/about', 'Aboutcontroller@about');
Route::get('/Nav', 'TeacherModelController@nav');
