<?php

namespace App\Repositories\Api;

use Carbon\Carbon;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Medicine;

class HomeRepository
{
    public function home(
        int $userId,
        ?string $date
    ) {
        $date = $date
            ? Carbon::parse($date)
            : today();

        $user = User::findOrFail($userId);

        $medicines = Medicine::with([

            'catalog',

            'schedule.times.histories' => function ($query) use ($date) {

                $query->whereDate(
                    'scheduled_date',
                    $date
                );
            }

        ])
            ->where('user_id', $userId)
            ->whereDate(
                'start_date',
                '<=',
                $date
            )
            ->whereDate(
                'end_date',
                '>=',
                $date
            )
            ->get();

        $todaySchedules = collect();

        foreach ($medicines as $medicine) {

            if (! $medicine->schedule) {
                continue;
            }

            foreach ($medicine->schedule->times as $time) {

                $history = $time
                    ->histories
                    ->first();

                $todaySchedules->push([
                    'schedule_time_id' => $time->id,
                    'medicine' => [

                        'id' => $medicine->id,

                        'name' => $medicine
                            ->catalog
                            ->name,

                        'image' => $medicine
                            ->catalog
                            ->image,

                        'dosage' => $medicine
                            ->dosage

                    ],

                    'reminder_time' => substr(
                        $time->reminder_time,
                        0,
                        5
                    ),

                    'status' => $history
                        ? $history->status
                        : 'pending',

                    'taken_at' => optional(
                        $history?->taken_at
                    )->format('H:i')

                ]);
            }
        }

        return [

            'user' => [
                'id' => $user->id,
                'name' => $user->name
            ],

            'selected_date' => $date
                ->format('Y-m-d'),

            'today_schedules' => $todaySchedules
                ->sortBy('reminder_time')
                ->values(),

            'quizzes' => Quiz::select(
                'id',
                'level',
                'description'

            )
                ->orderBy('level')
                ->take(2)
                ->get()

        ];
    }
}
