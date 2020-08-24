<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class MyController extends Controller
{
    public function funHello(){
        echo 'Hi Vinh';
    }
    public function Nameis($name){
        echo "Your name: $name";
        // return redirect() ->route('MyRoute2');
    }

    public function getURL(Request $request){
        // return $request -> url();
        // return $request -> path();
        if($request -> is('My*')){ // ktra xem chuỗi My có trong URL k?
            echo 'yes';
        }else echo 'no';


    }

    public function postForm(Request $request){
        echo $request ->fullname;
    }

    //
    public function setCookie(){
        $response = new Response();
        $response -> withCookie(
            'user','vinhngo',1
        );
        echo 'setCookie success';
        return $response;
    }

    public function getCookie(Request $response){
        echo 'MyCookie: ';
        return $response -> cookie('user');
    }
    public function postFile(Request $request)
    {
        if($request ->hasFile('myFile')){
            // echo 'đã có file';
            $file = $request ->file('myFile');
            if($file -> getClientOriginalExtension() == 'txt'){

                $filename = $file -> getClientOriginalName('myFile');
                $file ->move('Image',$filename);
                echo 'successfully uploaded ';
            }else echo 'mời bạn chọn đúng file .txt';
        }else echo 'chưa có file';
    }


    //json
    public function getJson()
    {
        $array = array(['name' =>'Ngo The Vinh','age' => 22],
                        ['name' => 'Nguyen Van a', 'age' => 21]);
       return response() ->json($array);
    }

    //view
    public function getView()
    {
        return view('hello.helloworld');
    }
}
