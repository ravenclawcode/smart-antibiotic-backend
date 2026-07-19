<?php

namespace App\Repositories\Api;

use App\Models\MedicineHistory;
use App\Models\ScheduleTime;
use App\Models\Medicine;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;

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

    public function history($request)
    {
        $format = $request->format ?? 'daily';

        $startDate = Carbon::today();
        $endDate   = Carbon::today();

        switch ($format) {

            case 'weekly':
                $startDate = Carbon::today()->subDays(6);
                break;

            case 'monthly':
                $startDate = Carbon::today()->subDays(29);
                break;
        }

        $query = MedicineHistory::with([
            'scheduleTime.schedule.medicine.catalog'
        ])

            ->whereBetween('scheduled_date', [
                $startDate,
                $endDate
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
                    default => 'Status Harian'
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

                        'items' => $items->map(function ($history) {

                            return [

                                'history_id' => $history->id,

                                'medicine_id' => $history
                                    ->scheduleTime
                                    ->schedule
                                    ->medicine
                                    ->id,

                                'medicine_name' => $history
                                    ->scheduleTime
                                    ->schedule
                                    ->medicine
                                    ->catalog
                                    ->name,

                                'medicine_image' => $history
                                    ->scheduleTime
                                    ->schedule
                                    ->medicine
                                    ->catalog
                                    ->image,

                                'dosage' => $history
                                    ->scheduleTime
                                    ->schedule
                                    ->medicine
                                    ->dosage,

                                'time' => substr(
                                    $history
                                        ->scheduleTime
                                        ->reminder_time,
                                    0,
                                    5
                                ),

                                'status' => $history->status,

                                'taken_at' => $history->taken_at,

                                'notes' => $history->notes,

                                'rescheduled_time' => $history->rescheduled_time

                            ];
                        })->values()

                    ];
                })

                ->values()
        ];
    }

    public function filterMedicines(int $userId)
    {
        return Medicine::query()
            ->with('catalog:id,name')
            ->where('user_id', $userId)
            ->select('id', 'medicine_catalog_id')
            ->orderByDesc('id')
            ->get()
            ->map(function ($medicine) {
                return [
                    'medicine_id' => $medicine->id,
                    'name' => $medicine->catalog->name,
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
                $history['period']['end_date']
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
            'adherence' => $adherence
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
