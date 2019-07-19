<?php

use App\Operation;
use App\Product;
use App\Storage;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Test User',
            'email' => 'test@email.address',
        ]);

        $products = factory(Product::class, 30)->create();
        $storages = factory(Storage::class, 5)->create();

        $operations = collect([]);

        foreach ($products as $product) {
            foreach ($storages as $storage) {
                $operations = $operations->merge(
                    factory(Operation::class, random_int(20, 50))->make([
                        'product_id' => $product->id,
                        'storage_id' => $storage->id,
                    ])
                );
            }
        }

        $operations
            ->sortBy(function (Operation $operation) {
                return $operation->created_at;
            })
            ->each(function (Operation $operation) {
                $operation->save();
            });
    }
}
