<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'title' => 'Тариф 512',
                'cpu' => '1',
                'ram' => '512',
                'disk_size' => '20',
            ],
            [
                'title' => 'Тариф 1024',
                'cpu' => '2',
                'ram' => '1024',
                'disk_size' => '40',
            ],
            [
                'title' => 'Тариф 2048',
                'cpu' => '4',
                'ram' => '2048',
                'disk_size' => '80',
            ],
            [
                'title' => 'Тариф 8192',
                'cpu' => '6',
                'ram' => '8192',
                'disk_size' => '120',
            ],
        ];
        DB::table(Product::tableName())->insert($products);
    }
}
