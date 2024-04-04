<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = DB::table('orders')->get();
        $products = DB::table('products')->get();
        foreach($orders as $order){
            foreach($products as $product){
                DB::table('order_details')->insert([
                    'order_id'=> $order->id,
                    'product_id'=> $product->id,
                    'count'=>rand(1,10),
                ]);
            }
        }
    }
}
