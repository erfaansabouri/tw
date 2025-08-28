<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopupQuestion extends Model
{
    const SIMPLE_WHITE_DESCRIPTION = 'SIMPLE_WHITE_DESCRIPTION';
    const SIMPLE_BLACK_DESCRIPTION = 'SIMPLE_BLACK_DESCRIPTION';
    const FILL_IN_THE_BLANK = 'FILL_IN_THE_BLANK';
    const ORDERED_LIST = 'ORDERED_LIST';
    const PERCENTAGE_WITH_TEXT = 'PERCENTAGE_WITH_TEXT';
    const CHECKBOX = 'CHECKBOX';
    const NOTE = 'NOTE';

    protected $casts = [
        'question' => 'array'
    ];
}
