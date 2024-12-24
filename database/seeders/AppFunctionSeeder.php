<?php

namespace Database\Seeders;

use App\Models\AppFunction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppFunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $functions = [
            [
                'name' => 'Portfolio management',
                'description' => 'Portfolio management',
            ],
            [
                'name' => 'Feedback from customers',
                'description' => 'Feedback from customers',
            ],
            [
                'name' => 'News management',
                'description' => 'News management',
            ],
            [
                'name' => 'Employee management',
                'description' => 'Employee management',
            ],
            [
                'name' => 'Banner management',
                'description' => 'Employee management',
            ],
        ];

        foreach ($functions as $function) {
            AppFunction::create($function);
        }
    }
}
