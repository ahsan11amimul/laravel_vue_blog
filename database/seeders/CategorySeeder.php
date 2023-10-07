<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'PHP',
        ]);
        DB::table('categories')->insert([
            'name' => 'Python',
        ]);
        DB::table('categories')->insert([
            'name' => 'Java',
        ]);
        DB::table('categories')->insert([
            'name' => 'C#',
        ]);
    }
}
