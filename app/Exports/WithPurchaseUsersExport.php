<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class WithPurchaseUsersExport implements FromCollection {
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection () {
        return User::query()
                   ->whereHas('transactions' , function ( $query ) {
                       $query->whereNotNull('verified_at');
                   })
                   ->get();
    }
}
