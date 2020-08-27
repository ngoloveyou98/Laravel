<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(userSeeder::class);
    }
}
class userSeeder extends Seeder{
    public function run(){
        // DB::table('users')->insert([
        //     'name'=>'vinh',
        //     'email'=>Str::random(4).'@gmail.com',
        //     'password'=>bcrypt('matkhau')
        // ]);
        // DB::insert('insert into users (name, email,password) values (?, ?,?)', ['vinhngo', 'vinh@gmail.com',bcrypt(('123456'))]);
        
        // DB::insert('insert into nhanvien (hoten, diachi,salary) values (?, ?,?)', ['Nguyễn Chí Phèo','Hà Nội',500000]);
        
    }
}
