<?php

use Facade\FlareClient\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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

    Route::get('myname/{name}', 'MyController@getName');
    //share
   view()->share('KH', 'Laravel');

   //blade template
   Route::get('blade', function () {
       return view('pages/subject');
   });
   Route::get('subject', function() {
       return view('pages/mobie');
   });
//    Route::get('subject', function() {
//     return view('pages/subject');
// });

    Route::get('TemplateBlade/{name}','MyController@blade');


// Database
    Route::get('database', function () {
        // Schema::create('users', function ($table) {
        //     $table->bigIncrements('id');
        //     $table ->string('HoTen',50);
        //     $table ->string('DiaChi',50);
        //     // $table ->string('sdt',11);
        //     $table ->date('birthday');
        // });
        // echo 'create table users successfully';

        Schema::create('sanpham', function ( $table) {
            $table->increments('id');
            $table->string('tenSP',30);
            $table->integer('soluong');
            
        });
        echo 'ok';
    });
    Route::get('lienketbang', function () {
        Schema::create('hoadon', function ( $table) {
            $table->increments('id');   
            $table->integer('soluong')->default(0);
            $table->integer('id_sp')->unsigned();
            $table->bigInteger('id_KH')->unsigned();
            $table->foreign('id_SP')->references('id')->on('sanpham');
            $table->foreign('id_KH')->references('id')->on('users');

        });
        // Schema::enableForeignKeyConstraints();
        echo ' tao bang lien ket thanh cong';
    });

    Route::get('suabang', function () {
        Schema::table('users', function ($table) {
            $table->dropColumn('Diachi');
        });
        echo 'sửa thành công';
    });
    Route::get('themcot', function () {
        Schema::table('users', function ( $table) {
            $table->string('Address',30);
        });
        echo "Thêm cột thành công";
    });
    Route::get('doiten', function () {
        Schema::rename('users', 'KhachHang');
    });


    //query Builder
    Route::get('db/get', function () {
        $data = DB::select('select * from users');
        foreach($data as $values){
            echo $values['name'];
        }
        echo '<hr>';
    });
?>
