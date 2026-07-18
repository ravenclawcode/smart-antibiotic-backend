<?php

namespace App\Repositories\Api;

use App\Models\MedicineHistory;
use App\Models\ScheduleTime;

class MedicineHistoryRepository
{
    public function taken(array $data)
    {
        $scheduleTime = ScheduleTime::with(
            'schedule.medicine.user.preference'
        )->findOrFail($data['schedule_time_id']);

        $user = $scheduleTime
            ->schedule
            ->medicine
            ->user;

        return MedicineHistory::updateOrCreate(
            [
                'schedule_time_id' => $scheduleTime->id,
                'scheduled_date' => $data['scheduled_date']
            ],

            [
                'status' => 'taken',
                'taken_at' => now($user->timezone()),
                'notes' => null,
                'rescheduled_time' => null
            ]
        );
    }

    public function skipped(array $data)
    {
        return MedicineHistory::updateOrCreate(
            [
                'schedule_time_id' => $data['schedule_time_id'],
                'scheduled_date' => $data['scheduled_date']
            ],

            [
                'status' => 'skipped',
                'taken_at' => null,
                'notes' => $data['notes'],
                'rescheduled_time' => null
            ]
        );
    }

    public function reschedule(array $data)
    {
        return MedicineHistory::updateOrCreate(
            [
                'schedule_time_id' => $data['schedule_time_id'],
                'scheduled_date' => $data['scheduled_date']
            ],

            [
                'status' => 'rescheduled',
                'taken_at' => null,
                'notes' => null,
                'rescheduled_time' => $data['rescheduled_time']
            ]
        );
    }

    public function missed(array $data)
    {
        return MedicineHistory::updateOrCreate(
            [
                'schedule_time_id' => $data['schedule_time_id'],
                'scheduled_date' => $data['scheduled_date']
            ],

            [
                'status' => 'missed',
                'taken_at' => null,
                'notes' => null,
                'rescheduled_time' => null
            ]

        );
    }
}
