<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //登録するレコードの準備
        $orders = [
            ['customer_id' => 1,'product_id' => 1,'order_date' => '2025/6/5','quantity' => 2],
            ['customer_id' => 2,'product_id' => 2,'order_date' => '2025/6/12','quantity' => 3],
            ['customer_id' => 1,'product_id' => 3,'order_date' => '2025/6/20','quantity' => 1],
            ['customer_id' => 3,'product_id' => 4,'order_date' => '2025/5/25','quantity' => 5],
            ['customer_id' => 5,'product_id' => 2,'order_date' => '2025/6/10','quantity' => 2],
            ['customer_id' => 5,'product_id' => 3,'order_date' => '2025/6/10','quantity' => 1],
            ['customer_id' => 2,'product_id' => 3,'order_date' => '2025/6/15','quantity' => 10],
            ['customer_id' => 2,'product_id' => 1,'order_date' => '2025/6/18','quantity' => 15],
        ];

        //登録処理
        foreach($orders as $order){
            Order::create($order);
        }
    }
}
