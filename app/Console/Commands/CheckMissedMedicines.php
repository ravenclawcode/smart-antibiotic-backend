<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\ScheduleTime;
use App\Models\MedicineHistory;

class CheckMissedMedicines extends Command
{
    protected $signature = 'medicine:check-missed';
    protected $description = 'Menandai obat yang terlewat (missed).';

    public function handle()
    {
        $today = today();
        $now = now();
        $scheduleTimes = ScheduleTime::with(
            'schedule.medicine.user.preference'
        )->get();

        foreach ($scheduleTimes as $scheduleTime) {

            $user = $scheduleTime
                ->schedule
                ->medicine
                ->user;

            $timezone = $user->timezone();

            $currentTime = now($timezone);

            $reminderTime = Carbon::parse(
                $today->format('Y-m-d') . ' ' . $scheduleTime->reminder_time,
                $timezone
            );

            /*
             * beri toleransi 2 menit
             */

            if ($currentTime->lt($reminderTime->copy()->addMinutes(2))) {
                continue;
            }

            MedicineHistory::firstOrCreate(

                [
                    'schedule_time_id' => $scheduleTime->id,
                    'scheduled_date' => $today
                ],

                [
                    'status' => 'missed',
                    'taken_at' => null,
                    'reason' => null,
                    'notes' => null,
                    'rescheduled_time' => null
                ]

            );
        }

        $this->info('Check missed selesai.');
    }
}
