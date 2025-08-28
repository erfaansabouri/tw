<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstructionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'sort' => $this->sort,
            'description' => $this->description,
        ];
    }
}
