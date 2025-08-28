<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GoalResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'small_title' => $this->small_title,
            'full_title' => $this->full_title,
            'image_url' => $this->getFirstMediaUrl('image'),
            'sort' => $this->sort,
        ];
    }
}
