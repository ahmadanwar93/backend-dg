<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TestSeeder extends Seeder
{
    private $permissions = [
        'product-list',
        'product-create',
        'product-edit',
        'product-delete'
    ];
    public function run(): void
    {
        Product::factory(50)
            ->create();
    }
}
