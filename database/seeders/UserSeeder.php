<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Str;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roles = DB::table('roles')->get();
      foreach($roles as $role){
        DB::table('users')->insert([
          'name' => 'user_'.Str::random(2),
          'email' => $role->name.'@mail.com',
          'password' => Hash::make('abc123'),
          'role_id' => $role->id
        ]);
      }
    }
}
