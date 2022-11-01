<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class SubCategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $half = intval(Category::count()/2);
        $categories = Category::orderBy('id', 'DESC')->take($half)->get();
        $id = $categories->last()->id;

        foreach($categories as $category) {
            $category->parent_id = rand(1, $id-1);
            $category->save();
        }
    }
}
