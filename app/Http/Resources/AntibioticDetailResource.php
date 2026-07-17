<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AntibioticDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'summary' => $this->summary,
            'indication' => $this->indication,
            'mechanism' => $this->mechanism,
            'dosage' => $this->dosage,
            'video_url' => $this->video_url
        ];
    }
}
