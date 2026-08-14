<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AntibioticListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->antibiotic_category_id,
            'category_name' => $this->whenLoaded(
                'category',
                fn() => $this->category?->name
            ),
            'name' => $this->name,
            'image' => $this->image
                ? url(Storage::url($this->image))
                : null,
        ];
    }
}
