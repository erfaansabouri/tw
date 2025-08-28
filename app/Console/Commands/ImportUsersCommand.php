<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Models\Goal;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Console\Command;

class ImportUsersCommand extends Command
{
    protected $signature = 'import-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        $users = collect(json_decode(file_get_contents(asset('admin-assets/json/users.json'))));
        $immortal = Plan::findOrFail(3);
        foreach ($users as $user){
            $phone = Helper::standardPhone($user->phone);
            $name = $user->name ?? '';
            $user_model = User::firstOrCreate([
                'phone' => $phone,
            ],[
                'name' => $name,
            ]);
            $user_model->register_completed_at = now();
            $user_model->save();

            $user_model->addCredit($immortal);
            $user_model->goals()->sync(Goal::inRandomOrder()->take(3)->get()->pluck('id'));
        }
    }
}
