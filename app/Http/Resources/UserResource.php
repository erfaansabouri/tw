<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'register_completed' => $this->register_completed,
            'is_premium' => $this->is_premium,
            'premium_remaining_days' => $this->premium_remaining_days,
            'avatar_url' => $this->avatar ? $this->avatar->getFirstMediaUrl('image') : null,
            'avatar_id' => $this->avatar_id,
        ];
    }
}
