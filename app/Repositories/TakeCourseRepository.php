<?php

namespace App\Repositories;

use App\Models\TakeCourse;
use App\Repositories\BaseRepository;

/**
 * Class TakeCourseRepository
 * @package App\Repositories
 * @version April 3, 2021, 2:26 pm UTC
*/

class TakeCourseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'course_id',
        'status',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TakeCourse::class;
    }
}
