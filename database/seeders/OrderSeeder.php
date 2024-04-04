<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = DB::table('categories')->get();
        foreach($category as $category){
            for($i = 0; $i < 3; $i++){
                DB::table('orders')->insert([
                    'user_id'=> $category->id,
                    'price'=> rand(100000,10000000),
                    'state'=>false,
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
            }
        }
    }
}
