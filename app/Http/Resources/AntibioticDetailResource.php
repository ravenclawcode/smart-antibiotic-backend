<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AntibioticDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image
                ? url(Storage::url($this->image))
                : null,
            'summary' => $this->summary,
            'indication' => $this->indication,
            'mechanism' => $this->mechanism,
            'dosage' => $this->dosage,
            'video_url' => $this->video_url,
            'video_title' => $this->video_title,
            'video_duration' => $this->video_duration,
            'video_thumbnail' => $this->video_thumbnail,
        ];
    }
}
