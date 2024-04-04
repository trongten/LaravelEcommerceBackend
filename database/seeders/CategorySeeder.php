<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = ['pen', 'book'];
        foreach ($category as $category) {
            DB::table('categories')->insert([
                'name'=>$category,
                'description'=>Str::random(),
            ]);
        }
    }
}
