<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [
                'nama'          =>  'Admin',
                'keterangan'    =>  'admin',
            ],
            [
                'nama'          =>  'Karyawan',
                'keterangan'    =>  'karyawan',
            ],
            [
                'nama'          =>  'Relawan Basic',
                'keterangan'    =>  'relawan basic',
            ],
            [
                'nama'          =>  'Relawan Intermediate',
                'keterangan'    =>  'relawan intermediate',
            ],
            [
                'nama'          =>  'Relawan Advance',
                'keterangan'    =>  'relawan advance',
            ],
        ];
        foreach ($list as $item) {
            Role::create($item);
        }
    }
}
