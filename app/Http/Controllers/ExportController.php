<?php

namespace App\Http\Controllers;

use App\Exports\InactiveUsersExport;
use App\Exports\MultiPurchaseUsersExport;
use App\Exports\OnlineUsersExport;
use App\Exports\WithoutPurchaseUsersExport;
use App\Exports\WithPurchaseEndedPremiumUsersExport;
use App\Exports\WithPurchaseUsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function onlineUsers(){
        return Excel::download(new OnlineUsersExport(), 'online-users.xlsx');
    }

    public function inactiveUsers(){
        return Excel::download(new InactiveUsersExport(), 'inactive-users.xlsx');
    }

    public function withoutPurchase(){
        return Excel::download(new WithoutPurchaseUsersExport(), 'without-purchase-users.xlsx');
    }

    public function withPurchase(){
        return Excel::download(new WithPurchaseUsersExport(), 'with-purchase-users.xlsx');
    }

    public function withPurchaseEndedPremium(){
        return Excel::download(new WithPurchaseEndedPremiumUsersExport(), 'with-purchase-ended-premium-users.xlsx');
    }

    public function multiPurchase(){
        return Excel::download(new MultiPurchaseUsersExport(), 'multi-users.xlsx');
    }
}
