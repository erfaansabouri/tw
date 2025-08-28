<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DayLessonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'sort' => $this->sort,
            'description' => $this->description,
            'image_url' => $this->getFirstMediaUrl('image'),
        ];
    }
}
