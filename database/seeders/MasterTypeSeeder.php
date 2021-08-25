<?php

namespace Database\Seeders;

use App\Models\MasterType;
use Illuminate\Database\Seeder;

class MasterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
          'Campuran',
          'Laki-Laki',
          'Perempuan',
        ];

        foreach ($type as $key => $item) {
            MasterType::firstOrCreate([
                'name' => $item
            ]);
        }
    }
}
