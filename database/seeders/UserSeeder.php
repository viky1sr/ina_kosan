<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrCreate(
            [
                'email' => 'admin@demo.com'
            ],
            [
                'name' => 'Admin',
                'status' => '1',
                'no_hp' => '0217777777',
                'password' => Hash::make('qweasd123'),
                'email_verified_at' => Carbon::now()
            ]);
        $admin->assignRole('admin');

        $boss = User::firstOrCreate(
            [
                'email' => 'boss@demo.com'
            ],
            [
                'name' => 'Boss Kosan',
                'status' => '1',
                'no_hp' => '029999999',
                'password' => Hash::make('qweasd123'),
                'email_verified_at' => Carbon::now()
            ]);
        $boss->assignRole('admin');

        $member = User::firstOrCreate(
            [
                'email' => 'member@demo.com'
            ],
            [
                'name' => 'Member',
                'status' => '1',
                'no_hp' => '0217777777',
                'password' => Hash::make('qweasd123'),
                'email_verified_at' => Carbon::now()
            ]);
        $member->assignRole('member');

        $visitor = User::firstOrCreate(
            [
                'email' => 'visitor@demo.com'
            ],
            [
                'name' => 'Visitor',
                'no_hp' => '0217777777',
                'password' => Hash::make('qweasd123'),
                'email_verified_at' => Carbon::now()
            ]);
        $visitor->assignRole('visitor');
    }
}
