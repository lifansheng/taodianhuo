<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 50 ; $i++) { 
        	DB::table("user")->insert([
	            "username" => str_random(10),
	            "password" => Hash::make("123456"),
	            "email" => str_random(10)."@qq.com",
	            "phone" => "13".rand(111111111,999999999),
	            "profile"=>"/uploads/9071542547157.jpg",
	            "status"=>"1"
	        ]);
        }
    }
}
