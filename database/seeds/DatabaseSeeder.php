<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products = factory(\App\Product::class, 10)->create();
        $storages = factory(\App\Storage::class, 3)->create();

        foreach ($products as $product) {
            foreach ($storages as $storage) {
                factory(\App\Operation::class, 100)->create([
                    'product_id' => $product->id,
                    'storage_id' => $storage->id,
                ]);
            }
        }
    }
}
