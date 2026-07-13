<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Medicine;
use App\Models\Antibiotic;
use App\Models\MedicineSchedule;
use App\Models\ScheduleTime;
use App\Models\MedicineHistory;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DummyMedicineSeeder extends Seeder
{
    public function run(): void
    {
        // $user = User::first();

        // if (!$user) {
        //     $user = User::create([
        //         'uuid' => fake()->uuid(),
        //         'name' => 'Lamine Yamal',
        //         'age' => 19,
        //         'gender' => 'Laki-laki'
        //     ]);
        // }

        // $antibiotic = Antibiotic::first();

        // if (!$antibiotic) {
        //     return;
        // }

        // $medicine = Medicine::create([

        //     'user_id' => $user->id,

        //     'antibiotic_id' => $antibiotic->id,

        //     'dosage' => '1 Tablet',

        //     'instruction' => 'Sesudah makan',

        //     'start_date' => Carbon::today()->subDays(6),

        //     'end_date' => Carbon::today()->addDays(3),

        //     'is_active' => true,

        // ]);

        // $schedule = MedicineSchedule::create([

        //     'medicine_id' => $medicine->id,

        //     'frequency_type' => 'daily',

        //     'times_per_day' => 2,

        //     'interval_value' => null,

        // ]);

        // $morning = ScheduleTime::create([

        //     'schedule_id' => $schedule->id,

        //     'reminder_time' => '08:00:00'

        // ]);

        // $night = ScheduleTime::create([

        //     'schedule_id' => $schedule->id,

        //     'reminder_time' => '20:00:00'

        // ]);

        // // Generate riwayat 7 hari
        // for ($i = 6; $i >= 0; $i--) {

        //     $date = Carbon::today()->subDays($i);

        //     foreach ([$morning, $night] as $time) {

        //         $status = collect([
        //             'taken',
        //             'taken',
        //             'taken',
        //             'missed',
        //             'skipped'
        //         ])->random();

        //         MedicineHistory::create([

        //             'schedule_time_id' => $time->id,

        //             'scheduled_date' => $date,

        //             'status' => $status,

        //             'taken_at' => $status == 'taken'
        //                 ? $date->copy()->setTimeFromTimeString($time->reminder_time)
        //                 : null,

        //             'reason' => $status == 'missed'
        //                 ? 'Lupa minum obat'
        //                 : null,

        //             'notes' => $status == 'taken'
        //                 ? 'Obat diminum sesuai jadwal'
        //                 : null,

        //         ]);
        //     }
        // }
    }
}