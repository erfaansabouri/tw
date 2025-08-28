<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\HtmlString;

class Dashboard extends BaseWidget {
    protected function getStats (): array {
        return [
            Stat::make(new HtmlString('<a href="'.route('online-users').'">کاربران فعال</a>') , User::query()
                                            ->where('was_online_at' , '>=' , now()->subDays(1))
                                            ->count()) ,
            Stat::make(new HtmlString('<a href="'.route('inactive-users').'">کاربران غیر فعال</a>') , User::query()
                                                ->where('was_online_at' , '<' , now()->subDays(1))
                                                ->count()) ,
            Stat::make(new HtmlString('<a href="'.route('without-purchase-users').'">کاربران بدون خرید</a>') , User::query()
                                                 ->whereDoesntHave('transactions', function ( $query ) {
                                                     $query->whereNotNull('verified_at');
                                                 })
                                                 ->count()) ,
            Stat::make(new HtmlString('<a href="'.route('with-purchase-users').'">کاربران با خرید</a>') , User::query()
                                                    ->whereHas('transactions', function ( $query ) {
                                                        $query->whereNotNull('verified_at');
                                                    })
                                               ->count()) ,
            Stat::make(new HtmlString('<a href="'.route('with-purchase-ended-premium-users').'"> کاربران با خرید که اشتراکشان تمام شده </a>') , User::query()
                                                                        ->whereHas('transactions', function ( $query ) {
                                                                            $query->whereNotNull('verified_at');
                                                                        })
                                                                     ->where('premium_expired_at' , '<' , now())
                                                                     ->count()) ,
            Stat::make(new HtmlString('<a href="'.route('multi-purchase').'"> کاربرانی که بیش از یک بار خرید کردند </a>') , User::query()
                                                                    ->whereHas('transactions' , function ( $query ) {
                                                                        $query->whereNotNull('verified_at')
                                                                              ->groupBy('user_id')
                                                                              ->havingRaw('COUNT(*) > 1');
                                                                    })
                                                                    ->count()) ,
        ];
    }
}
