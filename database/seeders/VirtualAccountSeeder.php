<?php

namespace Database\Seeders;

use App\Models\VirtualAccount;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VirtualAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputAdmin = [
            'id_users' => 1,
            'status' => 1,
            'code_virtual' => 2022080919951,
            'tanggal_lahir' => Carbon::now()->format('d-m-Y'),
            'saldo' => 15000000,
            'code_pin' => '070797',
        ];

        VirtualAccount::firstOrCreate($inputAdmin);

        $inputboss = [
            'id_users' => 2,
            'status' => 1,
            'code_virtual' => 2022080819972,
            'tanggal_lahir' => Carbon::now()->format('d-m-Y'),
            'saldo' => 15590000,
            'code_pin' => '123456',
        ];

        VirtualAccount::firstOrCreate($inputboss);

        $inputMember = [
            'id_users' => 3,
            'status' => 1,
            'code_virtual' => 2022080918973,
            'tanggal_lahir' => Carbon::now()->format('d-m-Y'),
            'saldo' => 9500000,
            'code_pin' => '123456',
        ];

        VirtualAccount::firstOrCreate($inputMember);
    }
}
