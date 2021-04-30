<?php

namespace App\Repositories;

use App\Models\TakeExam;
use App\Repositories\BaseRepository;

/**
 * Class TakeExamRepository
 * @package App\Repositories
 * @version April 3, 2021, 2:26 pm UTC
*/

class TakeExamRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'exam_id',
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
        return TakeExam::class;
    }
}
