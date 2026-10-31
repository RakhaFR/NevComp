<?php

namespace Database\Seeders;

use App\Models\Station;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@traintix.test'],
            [
                'name' => 'Admin TrainTix',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        $passenger = User::firstOrCreate(
            ['email' => 'passenger@traintix.test'],
            [
                'name' => 'RakhaFR',
                'password' => Hash::make('password'),
                'role' => 'passenger',
            ]
        );

        $stationsData = [
            ['code' => 'GMR', 'name' => 'Gambir', 'city' => 'Jakarta Pusat'],
            ['code' => 'PSE', 'name' => 'Pasar Senen', 'city' => 'Jakarta Pusat'],
            ['code' => 'BD',  'name' => 'Bandung', 'city' => 'Bandung'],
            ['code' => 'CN',  'name' => 'Cirebon', 'city' => 'Cirebon'],
            ['code' => 'SMT', 'name' => 'Semarang Tawang', 'city' => 'Semarang'],
            ['code' => 'YK',  'name' => 'Yogyakarta', 'city' => 'Yogyakarta'],
            ['code' => 'SLO', 'name' => 'Solo Balapan', 'city' => 'Surakarta'],
            ['code' => 'SBI', 'name' => 'Surabaya Pasarturi', 'city' => 'Surabaya'],
        ];

        $stations = [];
        foreach ($stationsData as $data) {
            $stations[$data['code']] = Station::firstOrCreate(['code' => $data['code']], $data);
        }

        $trainsData = [
            ['name' => 'Argo Lawu', 'class' => 'Eksekutif', 'capacity' => 32],
            ['name' => 'Taksaka', 'class' => 'Eksekutif', 'capacity' => 32],
            ['name' => 'Argo Parahyangan', 'class' => 'Bisnis', 'capacity' => 32],
            ['name' => 'Matarmaja', 'class' => 'Ekonomi', 'capacity' => 32],
        ];
    }
}
