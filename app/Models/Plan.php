<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Plan extends Model implements Sortable
{
    use SoftDeletes,SortableTrait;

    protected $casts = [
        'is_unlimited' => 'boolean'
    ];
}
