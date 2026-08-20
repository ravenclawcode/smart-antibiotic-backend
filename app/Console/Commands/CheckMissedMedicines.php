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
        $scheduleTimes = ScheduleTime::with(
            'schedule.medicine.user.preference'
        )->get();

        foreach ($scheduleTimes as $scheduleTime) {

            $medicine = $scheduleTime
                ->schedule
                ->medicine;

            $user = $medicine->user;

            $timezone = $user->timezone();

            $currentTime = now($timezone);

            $today = $currentTime->copy()->startOfDay();

            $reminderTime = Carbon::parse(
                $today->format('Y-m-d') .
                    ' ' .
                    $scheduleTime->reminder_time,
                $timezone
            );

            if (
                $currentTime->lt(
                    $reminderTime->copy()->addMinutes(2)
                )
            ) {
                continue;
            }

            MedicineHistory::firstOrCreate(
                [
                    'schedule_time_id' => $scheduleTime->id,
                    'scheduled_date' => $today->toDateString(),
                ],
                [
                    'status' => 'missed',
                    'taken_at' => null,
                    'skipped_at' => null,
                    'notes' => null,
                    'rescheduled_time' => null,
                ]
            );
        }

        $this->info('Check missed selesai.');

        return self::SUCCESS;
    }
}
