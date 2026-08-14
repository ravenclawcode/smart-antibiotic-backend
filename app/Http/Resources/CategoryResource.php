<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image
                ? url(Storage::url($this->image))
                : null,
            'description' => $this->description,
            'antibiotics_count' => $this->when(
                isset($this->antibiotics_count),
                $this->antibiotics_count
            ),
        ];
    }
}
