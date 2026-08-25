<?php

namespace App\Repositories\Api;

use App\Models\Medicine;
use App\Models\MedicineHistory;
use App\Models\ScheduleTime;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

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

        $timezone = $user->timezone();

        if ($data['action_time'] === 'now') {
            $takenAt = now($timezone);
        } else {
            $takenAt = Carbon::parse(
                $data['scheduled_date'] . ' ' . $scheduleTime->reminder_time,
                $timezone
            );
        }

        return MedicineHistory::updateOrCreate(
            [
                'schedule_time_id' => $scheduleTime->id,
                'scheduled_date' => $data['scheduled_date'],
            ],
            [
                'status' => 'taken',
                'taken_at' => $takenAt,
                'skipped_at' => null,
                'notes' => null,
                'rescheduled_time' => null,
            ]
        );
    }

    public function skipped(array $data)
    {
        $scheduleTime = ScheduleTime::with(
            'schedule.medicine.user.preference'
        )->findOrFail($data['schedule_time_id']);

        $user = $scheduleTime
            ->schedule
            ->medicine
            ->user;

        $timezone = $user->timezone();

        if ($data['action_time'] === 'now') {
            $skippedAt = now($timezone);
        } else {
            $skippedAt = Carbon::parse(
                $data['scheduled_date'] . ' ' . $scheduleTime->reminder_time,
                $timezone
            );
        }

        return MedicineHistory::updateOrCreate(
            [
                'schedule_time_id' => $scheduleTime->id,
                'scheduled_date' => $data['scheduled_date'],
            ],
            [
                'status' => 'skipped',
                'taken_at' => null,
                'skipped_at' => $skippedAt,
                'notes' => $data['notes'],
                'rescheduled_time' => null,
            ]
        );
    }

    public function reschedule(array $data)
    {
        return MedicineHistory::updateOrCreate(
            [
                'schedule_time_id' => $data['schedule_time_id'],
                'scheduled_date' => $data['scheduled_date'],
            ],
            [
                'status' => 'rescheduled',
                'taken_at' => null,
                'skipped_at' => null,
                'notes' => null,
                'rescheduled_time' => $data['rescheduled_time'],
            ]
        );
    }

    public function missed(array $data)
    {
        return MedicineHistory::updateOrCreate(
            [
                'schedule_time_id' => $data['schedule_time_id'],
                'scheduled_date' => $data['scheduled_date'],
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

    public function cancel(array $data)
    {
        $history = MedicineHistory::where(
            'schedule_time_id',
            $data['schedule_time_id']
        )
            ->where(
                'scheduled_date',
                $data['scheduled_date']
            )
            ->first();

        if ($history) {
            $history->delete();
        }

        return true;
    }

    public function history($request)
    {
        $format = $request->format ?? 'daily';

        $user = User::with('preference')->findOrFail(
            $request->user_id
        );

        $timezone = $user->timezone();

        $date = $request->filled('date')
            ? Carbon::parse($request->date, $timezone)
            : Carbon::now($timezone)->startOfDay();

        $startDate = $date->copy()->startOfDay();
        $endDate = $date->copy()->endOfDay();

        switch ($format) {
            case 'weekly':
                $startDate = $date->copy()->subDays(6)->startOfDay();
                $endDate = $date->copy()->endOfDay();
                break;

            case 'monthly':
                $startDate = $date->copy()->subDays(29)->startOfDay();
                $endDate = $date->copy()->endOfDay();
                break;
        }

        $query = MedicineHistory::with([
            'scheduleTime.schedule.medicine',
        ])
            ->whereBetween('scheduled_date', [
                $startDate->toDateString(),
                $endDate->toDateString(),
            ])
            ->whereHas(
                'scheduleTime.schedule.medicine',
                function ($q) use ($request) {
                    $q->where(
                        'user_id',
                        $request->user_id
                    );

                    if ($request->filled('medicine_id')) {
                        $q->where(
                            'id',
                            $request->medicine_id
                        );
                    }
                }
            )
            ->orderBy(
                'scheduled_date',
                'desc'
            )
            ->orderBy(
                'schedule_time_id'
            );

        $histories = $query->get();

        return [
            'period' => [
                'title' => match ($format) {
                    'weekly' => 'Status Mingguan',
                    'monthly' => 'Status Bulanan',
                    default => 'Status Harian',
                },

                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
            ],

            'data' => $histories
                ->groupBy(function ($history) {
                    return Carbon::parse(
                        $history->scheduled_date
                    )->toDateString();
                })
                ->map(function ($items, $date) {
                    return [
                        'date' => $date,

                        'items' => $items
                            ->map(function ($history) {
                                $medicine = $history
                                    ->scheduleTime
                                    ->schedule
                                    ->medicine;

                                return [
                                    'history_id' => $history->id,

                                    'medicine_id' => $medicine->id,

                                    'name' => $medicine->name,

                                    'medicine_image' => null,

                                    'dosage' => $medicine->dosage,

                                    'dosage_unit' => $medicine->dosage_unit,

                                    'time' => substr(
                                        $history
                                            ->scheduleTime
                                            ->reminder_time,
                                        0,
                                        5
                                    ),

                                    'status' => $history->status,

                                    'taken_at' => $history->taken_at,

                                    'skipped_at' => $history->skipped_at,

                                    'notes' => $history->notes,

                                    'rescheduled_time' =>
                                    $history->rescheduled_time,
                                ];
                            })
                            ->values(),
                    ];
                })
                ->values(),
        ];
    }

    public function filterMedicines(int $userId)
    {
        return Medicine::query()
            ->where('user_id', $userId)
            ->select(
                'id',
                'name'
            )
            ->orderByDesc('id')
            ->get()
            ->map(function ($medicine) {
                return [
                    'medicine_id' => $medicine->id,
                    'name' => $medicine->name,
                ];
            });
    }

    public function exportPdf($request)
    {
        $history = $this->history($request);

        $user = User::findOrFail(
            $request->user_id
        );

        $summary = MedicineHistory::query()
            ->whereHas(
                'scheduleTime.schedule.medicine',
                function ($q) use ($request) {
                    $q->where(
                        'user_id',
                        $request->user_id
                    );

                    if ($request->filled('medicine_id')) {
                        $q->where(
                            'id',
                            $request->medicine_id
                        );
                    }
                }
            )
            ->whereBetween(
                'scheduled_date',
                [
                    $history['period']['start_date'],
                    $history['period']['end_date'],
                ]
            )
            ->selectRaw("
                COUNT(*) as total,
                SUM(status='taken') as taken,
                SUM(status='skipped') as skipped,
                SUM(status='missed') as missed
            ")
            ->first();

        $adherence = $summary->total > 0
            ? round(
                ($summary->taken / $summary->total) * 100,
                1
            )
            : 0;

        $pdf = Pdf::loadView(
            'pdf.medicine-history',
            [
                'user' => $user,
                'history' => $history,
                'summary' => $summary,
                'adherence' => $adherence,
            ]
        )->setPaper(
            'a4',
            'landscape'
        );

        return $pdf->download(
            'Riwayat_Obat.pdf'
        );
    }
}
