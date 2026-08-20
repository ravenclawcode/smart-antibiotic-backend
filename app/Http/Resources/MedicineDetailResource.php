<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicineDetailResource extends JsonResource
{
    public function toArray(
        Request $request
    ): array {

        $frequency =
            $this->schedule?->frequency_type;

        $values =
            $this->schedule?->days
            ? $this->schedule->days
            ->pluck('value')
            ->map(
                fn($value) =>
                (int) $value
            )
            ->values()
            ->toArray()
            : [];

        $days = [];
        $dates = [];

        if (
            in_array(
                $frequency,
                [
                    'certain_days',
                    'interval_weeks',
                ],
                true
            )
        ) {
            $days = $values;
        }

        if (
            $frequency ===
            'interval_months'
        ) {
            $dates = $values;
        }

        return [
            'id' =>
            $this->id,

            'name' =>
            $this->name,

            'dosage' =>
            $this->dosage,

            'dosage_unit' =>
            $this->dosage_unit,

            'instruction' =>
            $this->instruction,

            'start_date' =>
            $this->start_date?->format(
                'Y-m-d'
            ),

            'end_date' =>
            $this->end_date?->format(
                'Y-m-d'
            ),

            'is_active' =>
            $this->is_active,

            'status' =>
            $this->getStatus(),

            'schedule' => [
                'frequency_type' =>
                $frequency,

                'times_per_day' =>
                $this->schedule?->times_per_day,

                'interval_value' =>
                $this->schedule?->interval_value,

                'selections' =>
                $days,

                'dates' =>
                $dates,

                'times' =>
                $this->schedule?->times
                    ? $this->schedule->times
                    ->map(
                        fn($time) => [
                            'id' => $time->id,
                            'time' => substr(
                                $time->reminder_time,
                                0,
                                5
                            ),
                        ]
                    )
                    ->values()
                    : [],
            ],
        ];
    }

    private function getStatus(): string
    {
        $today =
            now()->startOfDay();

        if (!$this->start_date) {
            return $this->is_active
                ? 'active'
                : 'completed';
        }

        if (
            $today->lt(
                $this->start_date
            )
        ) {
            return 'upcoming';
        }

        if (
            $this->end_date &&
            $today->gt(
                $this->end_date
            )
        ) {
            return 'completed';
        }

        return 'active';
    }
}
