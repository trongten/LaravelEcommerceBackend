<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;
use DB;
class ProductSeeder extends Seeder
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
                DB::table('products')->insert([
                    'name'=> Str::random(20),
                    'image'=>Str::random(20),
                    'price'=> rand(10000,1000000),
                    'rate'=>rand(1,5),
                    'count'=>rand(0,1000),
                    'description'=>Str::random(),
                    'category_id'=>$category->id,
                ]);
            }
        }
    }
}
