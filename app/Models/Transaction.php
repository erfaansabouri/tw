<?php

namespace App\Models;


class Transaction extends Model
{
    public function scopeNotVerified($query){
        return $query->whereNull('verified_at');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }
}
