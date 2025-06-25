<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //登録するレコードの準備
        $products = [
            ['name' => 'ジェルボールペン（黒）','price' => 120],
            ['name' => 'B5ノート（横罫）','price' => 180],
            ['name' => 'シャープペンシル0.5mm','price' => 350],
            ['name' => '消しゴム（プラスチック）','price' => 100],
            ['name' => '30cm定規（透明）','price' => 220],
        ];

        //登録処理
        foreach($products as $product){
            Product::create($product);
        }
    }
}
