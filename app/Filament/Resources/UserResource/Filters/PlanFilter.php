<?php

namespace App\Filament\Resources\UserResource\Filters;

use Filament\Tables\Filters\SelectFilter;

class PlanFilter extends SelectFilter {
    public static function getDefaultName (): ?string {

        return 'plan';
    }

    protected function setUp (): void {

        parent::setUp();
        $this->label('فیلتر بر اساس پلن');
        $this->placeholder('انتخاب پلن');
        $this->relationship('plans' , 'title');
        $this->searchable();
        $this->preload();
    }
}
