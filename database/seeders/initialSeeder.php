<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class initialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     private $permissions = [
        'product-list',
        'product-create',
        'product-edit',
        'product-delete'
    ];
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'guest',
            'admin',
            'free-role',
        ];
        
        foreach ($roles as $role) {
            $newRole = Role::create(['name' => $role]);

            if ($role == "guest") {
                $newRole->syncPermissions(1); // give guest only view product permission
            } else {
                $newRole->syncPermissions([1,2,3,4]); // give admin and free-role all the permission
            }
        }

        // for user 1 which is a guest
        $user1 = User::factory()->create();
        $user1->assignRole(['guest']);

        // for user 2 which is an admin
        $user1 = User::factory()->create();
        $user1->assignRole(['admin']);

        // for user 3 which is a free
        $user1 = User::factory()->create();
        $user1->assignRole(['free-role']);
    }
}
