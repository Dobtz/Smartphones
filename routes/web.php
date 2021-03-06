<?php
use Illuminate\Support\Facades\Input;
use App\Phones;
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


Route::get('/', function () {
    return view('welcome');
});

Route::resource('phones', 'PhonesController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/manufacturers', function(){
    $phones = DB::table('phones')->get();
    return view('ManufacturerList', ['phones'=>$phones]);
});

Route::get('/models', function(){
    $phones = DB::table('phones')->get();
    return view('ModelList', ['phones'=>$phones]);
});


Route::get('/search', 'PhonesController@search')->name('phones');

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/admin', function (){
        $phones = DB::table('phones')->get();
        $users = DB::table('users')->get();
        return view('admin', ['phones'=>$phones], ['users'=>$users]);
    });
});


