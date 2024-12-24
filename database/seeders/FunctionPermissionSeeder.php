<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FunctionPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = DB::table('permissions')->pluck('id');

        $functions = DB::table('app_functions')->pluck('id');

        $data = [];
        foreach ($functions as $functionId) {
            foreach ($permissions as $permissionId) {
                $data[] = [
                    'permission_id' => $permissionId,
                    'function_id' => $functionId,
                ];
            }
        }

        DB::table('function_permissions')->insert($data);
    }
}
