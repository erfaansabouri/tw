<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationFeatureResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'description' => $this->description,
            'image_url' => $this->getFirstMediaUrl('image'),
            'sort' => $this->sort,
        ];
    }
}
