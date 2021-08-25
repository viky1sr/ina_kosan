<?php

namespace Database\Seeders;

use App\Models\MasterType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MasterTypeSeeder::class);
        $this->call(VirtualAccountSeeder::class);
        $this->call(LamaSewaSeeder::class);
    }
}
