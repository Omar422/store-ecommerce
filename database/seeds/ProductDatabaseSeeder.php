<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(class, amount)->create();
        factory(Product::class, 20)->create();
    }
}
