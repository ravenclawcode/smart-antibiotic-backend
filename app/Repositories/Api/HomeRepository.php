<?php

namespace App\Repositories\Api;

use Carbon\Carbon;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Medicine;
use App\Models\MedicineScheduleException;
use Illuminate\Support\Facades\Log;

class HomeRepository
{
    public function home(
        int $userId,
        ?string $date
    ) {
        $date = $date
            ? Carbon::parse($date)->startOfDay()
            : today();

        $user = User::findOrFail($userId);

        $medicines = Medicine::with([
            'schedule.days',

            'schedule.times.histories' => function ($query) use ($date) {
                $query->whereDate(
                    'scheduled_date',
                    $date->format('Y-m-d')
                );
            },
        ])
            ->where('user_id', $userId)

            ->whereDate(
                'start_date',
                '<=',
                $date
            )

            ->where(function ($query) use ($date) {
                $query
                    ->whereNull('end_date')
                    ->orWhereDate(
                        'end_date',
                        '>=',
                        $date
                    );
            })

            ->where('is_active', true)

            ->get();

        Log::info('HOME MEDICINES FOUND', [
            'user_id' => $userId,
            'date' => $date->format('Y-m-d'),
            'count' => $medicines->count(),
            'medicine_ids' => $medicines
                ->pluck('id')
                ->values()
                ->toArray(),
        ]);

        $todaySchedules = collect();

        foreach ($medicines as $medicine) {

            if (! $medicine->schedule) {
                Log::warning('HOME MEDICINE WITHOUT SCHEDULE', [
                    'medicine_id' => $medicine->id,
                ]);

                continue;
            }

            if (! $this->isScheduledOnDate(
                $medicine,
                $date
            )) {
                continue;
            }

            foreach ($medicine->schedule->times as $time) {

                $isDeleted = MedicineScheduleException::where(
                    'medicine_id',
                    $medicine->id
                )
                    ->where(
                        'schedule_time_id',
                        $time->id
                    )
                    ->whereDate(
                        'scheduled_date',
                        $date
                    )
                    ->where(
                        'action',
                        'deleted'
                    )
                    ->exists();

                if ($isDeleted) {
                    continue;
                }

                $history = $time->histories->first();

                $dosage = $history?->dosage
                    ?? $medicine->dosage;

                $dosageUnit = $history?->dosage_unit
                    ?? $medicine->dosage_unit;

                $todaySchedules->push([

                    'medicine_id' =>
                    $medicine->id,

                    'schedule_time_id' =>
                    $time->id,

                    'scheduled_date' =>
                    $date->format('Y-m-d'),

                    'medicine' => [
                        'id' =>
                        $medicine->id,

                        'name' =>
                        $medicine->name,

                        'dosage' =>
                        $dosage,

                        'dosage_unit' =>
                        $dosageUnit,

                        'instruction' =>
                        $medicine->instruction,

                        'start_date' =>
                        $medicine->start_date?->format('Y-m-d'),

                        'end_date' =>
                        $medicine->end_date?->format('Y-m-d'),

                        'is_active' =>
                        $medicine->is_active,

                        'frequency_type' =>
                        $medicine->schedule
                            ->frequency_type,

                        'times_per_day' =>
                        $medicine->schedule
                            ->times_per_day,

                        'interval_value' =>
                        $medicine->schedule
                            ->interval_value,

                        'days' =>
                        $medicine->schedule->days
                            ->pluck('value')
                            ->map(
                                fn($value) => (int) $value
                            )
                            ->values()
                            ->toArray(),

                        'schedule_times' =>
                        $medicine->schedule->times
                            ->map(function ($scheduleTime) {
                                return [
                                    'id' =>
                                    $scheduleTime->id,

                                    'time' =>
                                    substr(
                                        (string) $scheduleTime->reminder_time,
                                        0,
                                        5
                                    ),
                                ];
                            })
                            ->values()
                            ->toArray(),
                    ],

                    'reminder_time' =>
                    substr(
                        (string) $time->reminder_time,
                        0,
                        5
                    ),

                    'history_id' =>
                    $history?->id,

                    'status' =>
                    $history
                        ? $history->status
                        : 'pending',

                    'taken_at' =>
                    $history?->taken_at
                        ? $history->taken_at->format(
                            'Y-m-d H:i:s'
                        )
                        : null,

                    'skipped_at' =>
                    $history?->skipped_at
                        ? $history->skipped_at->format(
                            'Y-m-d H:i:s'
                        )
                        : null,

                    'notes' =>
                    $history?->notes,

                    'rescheduled_time' =>
                    $history?->rescheduled_time,
                ]);
            }
        }

        Log::info('HOME TODAY SCHEDULES', [
            'user_id' => $userId,
            'date' => $date->format('Y-m-d'),
            'count' => $todaySchedules->count(),
        ]);

        return [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
            ],

            'selected_date' =>
            $date->format('Y-m-d'),

            'today_schedules' =>
            $todaySchedules
                ->sortBy('reminder_time')
                ->values(),

            'quizzes' =>
            Quiz::select(
                'id',
                'level',
                'description'
            )
                ->orderBy('level')
                ->take(2)
                ->get(),
        ];
    }

    private function isScheduledOnDate(
        Medicine $medicine,
        Carbon $date
    ): bool {
        $schedule = $medicine->schedule;

        if (! $schedule) {
            return false;
        }

        $frequencyType =
            $schedule->frequency_type;

        if (
            $frequencyType === 'daily' ||
            $frequencyType === 'every_day'
        ) {
            return true;
        }

        if (
            $frequencyType === 'certain_days'
        ) {
            $dayValue =
                $date->dayOfWeek;

            foreach ($schedule->days as $day) {

                if (
                    (int) $day->value ===
                    $dayValue
                ) {
                    return true;
                }
            }

            return false;
        }

        if (
            $frequencyType === 'interval_weeks'
        ) {
            foreach ($schedule->days as $day) {

                if (
                    (int) $day->value ===
                    $date->dayOfWeek
                ) {
                    return true;
                }
            }

            return false;
        }

        if (
            $frequencyType === 'interval_days'
        ) {
            $interval =
                (int) (
                    $schedule->interval_value ?? 1
                );

            if ($interval <= 0) {
                $interval = 1;
            }

            $startDate =
                Carbon::parse(
                    $medicine->start_date
                )->startOfDay();

            $difference =
                $startDate->diffInDays($date);

            return
                $difference % $interval === 0;
        }

        if (
            $frequencyType === 'interval_months'
        ) {
            $interval =
                (int) (
                    $schedule->interval_value ?? 1
                );

            if ($interval <= 0) {
                $interval = 1;
            }

            $startDate =
                Carbon::parse(
                    $medicine->start_date
                )->startOfDay();

            $difference =
                $startDate->diffInMonths($date);

            return
                $difference % $interval === 0;
        }

        return true;
    }
}
