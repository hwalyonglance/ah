<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Repositories\BaseRepository;

/**
 * Class ExamRepository
 * @package App\Repositories
 * @version April 14, 2021, 5:34 pm UTC
*/

class ExamRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'role_id',
        'image_url',
        'title',
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
        return Exam::class;
    }
}
