<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('products')->get()->count() == 0){
            DB::table('products')->insert([
                [
                    'name' => 'Mc-1',
                    'description' => 'Spaghetti with Soy Sauce and Dishwashing Liquid',
                    'price' => 49.50,
                    'photo' => base64_encode("Mc-1.png"),
                    'stock' => 150,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Mc-2',
                    'description' => 'Strawberry Ice Cream Topped with Vinegar and Tofu',
                    'price' => 55.90,
                    'photo' => base64_encode("Mc-2.png"),
                    'stock' => 100,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
        }
        else {
            echo "Table is not empty. SEEDER FAILED.";
        }

    }
}
