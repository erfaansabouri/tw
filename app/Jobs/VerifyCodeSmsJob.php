<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class VerifyCodeSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $code;
    public $phone_number;
    public function __construct($code, $phone_number)
    {
        $this->code = $code;
        $this->phone_number = $phone_number;
    }


    public function handle()
    {

        Http::post('https://rest.payamak-panel.com/api/SendSMS/BaseServiceNumber',[
            'username' => "09036732820",
            'password' => "Sepina!@24",
            'text' => $this->code,
            'to' => $this->phone_number,
            'bodyId' => '152345'
        ]);
    }
}
