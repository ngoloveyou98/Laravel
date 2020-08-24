<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello',function(){
     return "hello world";
});

//truyen tham so
Route::get('HoTen/{ten}', function($ten){
    echo "tên của bạn là : $ten";
})-> where(['ten' => '[a-zA-Z]+']);

// dinh danh

Route::get('Route1',['as' => 'MyRoute1',function(){
    echo "Đây là route 1";
}]);


Route::get('Route2',function(){
    echo "Đây là route 2";
}) -> name('MyRoute2');

Route::get("CallRoute",function(){
    return redirect()->route('MyRoute2');
});

//Group

Route::group(['prefix' =>'MyGroup'], function(){
    Route::get('User1',function(){
        return 'User1';
    });
    Route::get('User2',function(){
        return 'User2';
    });
    Route::get('User3',function(){
        return 'User3';
    });
});


// Controller
    Route::get('CallCtr','MyController@funHello');

    Route::get('yourname/{yourname}','MyController@Nameis');


    // URL
    Route::get('MyRequest','MyController@getURL');

    // gui nhan du lieu vs request
    Route::get('getForm', function () {
        return view('postForm');
    });

    Route::post('postForm', ['as' => 'postForm', 'uses' => 'MyController@postForm']);


    // sd cookie vs request va reponse

    Route::get('setCookie', 'MyController@setCookie');
    Route::get('getCookie','MyController@getCookie');

    // upload File
    Route::get('uploadFile', function () {
        return view('uploadFile');
    });
    Route::post('postFile',['as' => 'postFile','uses' => 'MyController@postFile']);

    // Json
    Route::get('getJson', 'MyController@getJson');

    //view
    Route::get('myView','MyController@getView');

?>
