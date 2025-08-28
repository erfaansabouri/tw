<?php

namespace App\Models;

use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DayLesson extends Model implements HasMedia, Sortable
{
    use InteractsWithMedia, SortableTrait;

    protected $with = ['media'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
