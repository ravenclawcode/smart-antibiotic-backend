<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        // $user = User::first();

        // if (!$user) {
        //     return;
        // }

        // Feedback::truncate();

        // Feedback::create([

        //     'user_id' => $user->id,

        //     'message' => 'Apakah Amoxicillin aman dikonsumsi bersama makanan?',

        //     'admin_reply' => 'Ya, Amoxicillin dapat diminum bersama makanan. Bahkan pada beberapa orang hal tersebut dapat membantu mengurangi gangguan lambung.',

        //     'status' => 'replied',

        //     'replied_at' => Carbon::now()->subHours(2),

        // ]);

        // Feedback::create([

        //     'user_id' => $user->id,

        //     'message' => 'Berapa lama antibiotik harus dihabiskan setelah gejala membaik?',

        //     'status' => 'pending',

        // ]);
    }
}
