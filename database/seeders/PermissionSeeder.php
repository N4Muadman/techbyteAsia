<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'Add',
                'description' => '',
            ],
            [
                'name' => 'Edit',
                'description' => '',
            ],
            [
                'name' => 'Delete',
                'description' => '',
            ],
            [
                'name' => 'Show',
                'description' => '',
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
