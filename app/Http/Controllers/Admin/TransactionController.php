<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller {
    public function index ( Request $request ) {
        $transactions = Transaction::query()
                                   ->orderByDesc('id');
        if ( $request->search ) {
            $transactions = $transactions->where(function ( $q ) use ( $request ) {
                $q->where('id' , $request->search)
                  ->orWhere('transaction_id' , 'like' , '%' . $request->search . '%')
                  ->orWhere('reference_id' , 'like' , '%' . $request->search . '%')
                  ->orWhere('order_id' , 'like' , '%' . $request->search . '%');
            })
                                         ->orWhereHas('user' , function ( $q ) use ( $request ) {
                                             $q->where('id' , $request->search)
                                               ->orWhere('name' , 'like' , '%' . $request->search . '%')
                                               ->orWhere('phone' , 'like' , '%' . $request->search . '%');
                                         });
        }
        $transactions = $transactions->paginate(100);

        return view('admin.transactions.index' , compact('transactions'));
    }
}
