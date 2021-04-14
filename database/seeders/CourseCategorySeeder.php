<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\CourseCategory;

class CourseCategorySeeder extends Seeder
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
                'name'          =>  'Matematika',
                'description'   =>  'matematika'
            ],
            [
                'name'          =>  'IPA',
                'description'   =>  'ips'
            ],
            [
                'name'          =>  'IPS',
                'description'   =>  'ips'
            ],
        ];
        foreach ($list as $item) {
            CourseCategory::create($item);
        }
    }
}
