<?php

use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/' , function () {
    return view('welcome');
});
Route::get('/payment/verify' , [
    TransactionController::class ,
    'verify' ,
])
     ->name('transaction.verify');
Route::get('/sub_success' , [
    TransactionController::class ,
    'subSuccess' ,
])
     ->name('transaction.sub-success');
Route::get('/sub_failed' , [
    TransactionController::class ,
    'subFailed' ,
])
     ->name('transaction.sub-failed');
Route::prefix('export-users')
     ->group(function () {
         Route::get('/online-users' , [
             \App\Http\Controllers\ExportController::class ,
             'onlineUsers' ,
         ])
              ->name('online-users');
         Route::get('/inactive-users' , [
             \App\Http\Controllers\ExportController::class ,
             'inactiveUsers' ,
         ])
              ->name('inactive-users');
         Route::get('/without-purchase-users' , [
             \App\Http\Controllers\ExportController::class ,
             'withoutPurchase' ,
         ])
              ->name('without-purchase-users');
         Route::get('/with-purchase-users' , [
             \App\Http\Controllers\ExportController::class ,
             'withPurchase' ,
         ])
              ->name('with-purchase-users');
         Route::get('/with-purchase-ended-premium-users' , [
             \App\Http\Controllers\ExportController::class ,
             'withPurchaseEndedPremium' ,
         ])
              ->name('with-purchase-ended-premium-users');
         Route::get('/multi-purchase' , [
             \App\Http\Controllers\ExportController::class ,
             'multiPurchase' ,
         ])
              ->name('multi-purchase');
     });
Route::prefix('test-fcm')
     ->group(function () {
         Route::get('/sample' , function ( Request $request ) {

             $request->validate([
                                    'user_id' => [ 'required' ] ,
                                ]);
             $user = \App\Models\User::query()
                                     ->findOrFail($request->get('user_id'));
             if ( !$user->firebase_token ) {
                 return response()->json([
                                             'error' => 'کاربر توکن ندارد' ,
                                         ]);
             }
             $text = "عادت تستی منتظرتونه، برید سراغش و بذاریدش توی روتین زندگی‌تون 🤍🌱";
             $data = [
                 'custom_title' => "بیست و یک روز" ,
                 'custom_description' => $text ,
                 'click_action' => 'android.intent.action.VIEW' ,
                 'image' => asset('landing-assets/img/logo.png') ,
             ];
             $messaging = app('firebase.messaging');
             try {
                 $message = CloudMessage::withTarget('token' , $user->firebase_token)
                     ->withDefaultSounds()
                                        ->withNotification(Messaging\Notification::create("بیست و یک روز" , $text , asset('landing-assets/img/logo.png')))
                                        ->withData($data);
                 $messaging->send($message);

                 return response()->json([
                                             'success' => true,
                                         ]);
             }
             catch ( Exception $exception ) {
                 return response()->json([
                                             'error' => $exception->getMessage(),
                                         ]);
             }
         });
     });
