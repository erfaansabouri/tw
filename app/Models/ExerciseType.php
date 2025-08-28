<?php

namespace App\Models;


class ExerciseType extends Model
{
    const NAMES = [
        'ordered-list' => 'ordered-list',
        'textarea' => 'textarea',
        'checkbox-list' => 'checkbox-list',
        'fill-in-the-blank' => 'fill-in-the-blank',
    ];

    public function scopeName($query, $name)
    {
        $query->where('name', $name);
    }

    public function getNameFaAttribute(){
        switch ($this->name){
            case self::NAMES['ordered-list']:
                return 'لیست شماره دار';
            case self::NAMES['textarea']:
                return 'متن';
            case self::NAMES['checkbox-list']:
                return 'چک باکس';
            case self::NAMES['fill-in-the-blank']:
                return 'پر کردن جای خالی';
        }
        return 'نا مشخص';
    }
}
