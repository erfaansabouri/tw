<?php

namespace App\Models;


use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Instruction extends Model implements Sortable
{
    use SortableTrait;
}
