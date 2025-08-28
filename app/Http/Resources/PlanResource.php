<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'monthly_price' => $this->monthly_price,
            'total_price' => $this->total_price,
            'strikethrough_price' => $this->strikethrough_price ? (int)$this->strikethrough_price : null,
            'title' => $this->title,
            'subtitle_1' => $this->subtitle_1,
            'subtitle_2' => $this->subtitle_2,
            'title_under_price' => $this->title_under_price,
            'days' => $this->days,
            'is_unlimited' => $this->is_unlimited,
        ];
    }
}
