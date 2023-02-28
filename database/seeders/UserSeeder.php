<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'user_role_id'   => 1,
            'name'           => 'Super Admin',
            'email'          => 'movieflix@admin.com',
            'phone'          => '01000000000',
            'password'       => Hash::make('!lov@you'),
            'account_status' => 'confirmed',
            'status'         => 'active',
        ]);

        User::create([
            'user_role_id'   => 1,
            'name'           => 'Demo',
            'email'          => 'demoadmin@movieflix.com',
            'phone'          => '01000000001',
            'password'       => Hash::make('123456'),
            'account_status' => 'confirmed',
            'status'         => 'active',
        ]);
    }
}
