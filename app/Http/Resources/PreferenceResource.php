<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PreferenceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'reminder_type' => $this->reminder_type,
            'reminder_sound' => $this->reminder_sound,
            'timezone' => $this->timezone,
        ];
    }
}
