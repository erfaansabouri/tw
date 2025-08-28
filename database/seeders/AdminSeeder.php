<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::query()
            ->create([
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('as12AS!@'),
            ]);
    }
}
