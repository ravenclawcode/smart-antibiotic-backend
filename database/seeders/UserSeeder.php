<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User::insert([
        //     [
        //         'uuid' => Str::uuid(),
        //         'name' => 'Lamine Yamal',
        //         'age' => 19,
        //         'gender' => 'Laki-laki',
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ],
        //     [
        //         'uuid' => Str::uuid(),
        //         'name' => 'Jude Bellingham',
        //         'age' => 23,
        //         'gender' => 'Laki-laki',
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]
        // ]);
    }
}
