<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicineResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'medicine_name' => $this->catalog->name,
            'dosage' => $this->dosage,
            'dosage_unit' => $this->dosage_unit,
            'instruction' => $this->instruction,
            'start_date' => $this->start_date->format('Y-m-d'),
            'end_date' => $this->end_date->format('Y-m-d'),
            'status' => $this->getStatus(),
            'times' => $this->schedule
                ->times
                ->pluck('reminder_time')
                ->map(fn($time) => substr($time, 0, 5))
                ->values()
        ];
    }

    private function getStatus(): string
    {
        $today = now()->startOfDay();

        if ($today->lt($this->start_date)) {
            return 'upcoming';
        }

        if ($today->gt($this->end_date)) {
            return 'completed';
        }

        return 'active';
    }
}
