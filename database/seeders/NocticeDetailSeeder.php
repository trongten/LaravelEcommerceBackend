<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NocticeDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $noctices = DB::table('noctices')->get();
        $users = DB::table('users')->get();
        foreach($noctices as $noctice){
            foreach($users as $user){
                DB::table('noctice_details')->insert([
                    'noctice_id'=> $noctice->id,
                    'user_id'=> $user->id,
                ]);
            }
        }
    }
}
