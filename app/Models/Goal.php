<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Goal extends Model implements HasMedia , Sortable {
    use InteractsWithMedia , SortableTrait;

    public function registerMediaCollections (): void {
        $this->addMediaCollection('image')
             ->singleFile();
    }

    protected static function booted () {
        static::deleted(function ( $goal ) {
            DB::table('goal_user')
              ->where('goal_id' , $goal->id)
              ->delete();
        });
    }
}
