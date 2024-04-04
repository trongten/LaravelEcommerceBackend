<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;
class NocticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $noctices = ['one', 'two'];
        foreach ($noctices as $noctice) {
            DB::table('noctices')->insert([
                'title'=>$noctice,
                'detail'=>Str::random(),
            ]);
        }
    }
}
