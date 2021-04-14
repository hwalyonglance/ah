<?php

namespace App\Repositories;

use App\Models\CourseCategory;
use App\Repositories\BaseRepository;

/**
 * Class CourseCategoryRepository
 * @package App\Repositories
 * @version April 14, 2021, 4:22 pm UTC
*/

class CourseCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
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
        return CourseCategory::class;
    }
}
