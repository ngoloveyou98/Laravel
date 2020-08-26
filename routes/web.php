<?php

use Facade\FlareClient\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

use function GuzzleHttp\Promise\all;

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
        // $data = DB::select('select * from users');
        $data = DB::table('users')->where('id','=',2)->get();
        
        // foreach($data as $values){
            
        //     // $values = get_object_vars($values);
        //     echo "name: $values->name"."<br> email: $values->email <br>";
        //     echo '<hr>'; 
        // }

        foreach($data as $row){
            foreach($row as $key => $values){
                echo "$key : $values <br>";
            }
            echo '<hr>';
        }
        
        // var_dump($data);
    });

    Route::get('db/select', function () {
        // $data = DB::table('sanpham')->select('tensp')->where('soluong','>=',4)->get();
        $data = DB::table('sanpham')->select('tensp')->where('tensp','like','%áo%')->get();

        foreach($data as $row){
            foreach($row as $key => $values){
                echo "$key : $values <br>";
            }
            echo '<hr>';
        }
    });

    //raw
    Route::get('db/raw', function () {
        // $data = DB::table('sanpham')->select('tensp')->where('soluong','>=',4)->get();
        $data = DB::table('sanpham')->select(DB::raw('id,tensp as TenSanpham,soluong '))->get();

        foreach($data as $row){
            foreach($row as $key => $values){
                echo "$key : $values <br>";
            }
            echo '<hr>';
        }
    });

    //orderby
    Route::get('db/orderby', function () {
        // $data = DB::table('sanpham')->select('tensp')->where('soluong','>=',4)->get();
        $data = DB::table('sanpham')->select(DB::raw('id,tensp as TenSanpham,soluong '))->orderby('tensp','asc')->get();
        //desc
        foreach($data as $row){
            foreach($row as $key => $values){
                echo "$key : $values <br>";
            }
            echo '<hr>';
        }
    });

    //groupBy
    Route::get('db/groupby', function () {
        // $data = DB::table('sanpham')->select('tensp')->where('soluong','>=',4)->get();
        $data = DB::table('sanpham') 
                ->groupBy('id')
                ->having('id','>',2)
                ->skip(1)->take(3)//bo qua 1 va lay 3 phan tu tiep theo
                ->get();
        //desc
        foreach($data as $row){
            foreach($row as $key => $values){
                echo "$key : $values <br>";
            }
            echo '<hr>';
        }
    });
    //max
    Route::get('db/max', function () {
        // $data = DB::table('sanpham')->select('tensp')->where('soluong','>=',4)->get();
        $data = DB::table('sanpham')->select('tensp')
                ->max('soluong');
                // ->get();
        echo $data;
        // foreach($data as $row){
        //     foreach($row as $key => $values){
        //         echo "$key : $values <br>";
        //     }
        //     echo '<hr>';
        // }

        // foreach($data as $dt){
        //     echo $dt->tensp;
        // }
        // var_dump($data);
    });

    //update

    Route::get('db/update', function () {
        DB::table('nhanvien')->where('HoTen','like','%nở%')->update(['HoTen'=>'Thị Nở']);
        echo 'đã update';
    });


    //Model
    Route::group(['prefix' => 'model'], function () {
        Route::get('save', function () {
            $user = new App\User();
            $user->name = 'Cậu vàng';
            $user->email = 'cauvang@gmail.com';
            $user->password = bcrypt('123456');
            $user->save();
            echo 'save successfully';
        });
        Route::get('query', 'MyController@model');
        // Route::get('query', function () {
        //     $user = App\User::find(1);
        //     return $user->name;
        // });


        Route::group(['prefix' => 'sanpham'], function () {
            Route::get('save', function () {
                $sanpham = new App\SanPham();
                $sanpham ->tensp = 'Bomber 1';
                $sanpham ->soluong = 1;
                $sanpham->save();
    
                echo 'thêm thành công';
            });
            Route::get('all', 'SanPhamController@getAll');

            //chức năng tìm kiếm
            Route::get('find', 'SanPhamController@getForm');
            Route::post('postfind', ['as'=>'postfind','uses' => 'SanPhamController@postfind']);

            Route::get('lienket','SanPhamController@lkHoaDon');
        });
    });
    
    //MiddleWare
    Route::get('diem', function () {
        echo "Điểm đạt";
    })->name('diem')
    ->middleware('codiem');
    Route::get('loi', function () {
        echo 'bạn chưa có điểm';
    })->name('loi');
    Route::get('kodat', function () {
        echo 'TRƯỢT';
    })->name('kodat');

    Route::get('nhapdiem', function () {
        return view('pages.nhapdiem');
    });
    
?>
