<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class WithoutPurchaseUsersExport implements FromCollection {
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection () {
        return User::query()
                   ->whereDoesntHave('transactions' , function ( $query ) {
                       $query->whereNotNull('verified_at');
                   })
                   ->get();
    }
}
