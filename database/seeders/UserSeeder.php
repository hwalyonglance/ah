<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = \Hash::make('password');
        $list = [
            [
                'role_id'       => 1,
                'name'          => 'Akun Admin',
                'email'         => 'admin@app.com',
                'password'      => $password,
            ],
            [
                'role_id'       => 2,
                'name'          => 'Akun Karyawan',
                'email'         => 'karyawan@app.com',
                'password'      => $password,
            ],
            [
                'role_id'       => 3,
                'name'          => 'Akun Relawan Basic',
                'email'         => 'relawan.basic@app.com',
                'password'      => $password,
            ],
            [
                'role_id'       => 4,
                'name'          => 'Akun Relawan Intermediate',
                'email'         => 'relawan.intermediate@app.com',
                'password'      => $password,
            ],
            [
                'role_id'       => 5,
                'name'          => 'Akun Relawan Advance',
                'email'         => 'relawan.advance@app.com',
                'password'      => $password,
            ],
        ];
        foreach ($list as $item) {
            User::create($item);
        }
    }
}
