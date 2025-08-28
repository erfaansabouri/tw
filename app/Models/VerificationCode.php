<?php

namespace App\Models;

class VerificationCode extends Model
{
    public function scopeNotUsed($query)
    {
        return $query->whereNull('used_at');
    }
}
