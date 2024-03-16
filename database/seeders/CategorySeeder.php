<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();

        $json = File::get("database/data/category.json");
        $categories = json_decode($json);

        foreach ($categories as $key => $value) {
            Category::create([
                "category" => $value->name,
            ]);
        }
    }
}
