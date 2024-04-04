<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Str;
use Hash;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = DB::table('users')->get();
      foreach($users as $user) {
        for ($i = 0; $i < 3; $i++) {
          // code to repeat here
          DB::table('todos')->insert([
            'title' => Str::random(10),
            'content' => Str::random(),
            'user_id' => $user->id
          ]);
        }
      }
    }
}
