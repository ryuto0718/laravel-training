<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //登録するレコードの準備
        $customers = [
            ['name' => '株式会社グリーンテック'],
            ['name' => '株式会社未来ソリューションズ'],
            ['name' => '株式会社光電気'],
            ['name' => '株式会社さくらマーケティング'],
            ['name' => '株式会社ネクストリンク'],
        ];

        //登録処理
        foreach($customers as $customer){
            Customer::create($customer);
        }
    }
}

