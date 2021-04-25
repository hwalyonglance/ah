<?php

namespace App\Repositories;

use App\Models\QuestionOption;
use App\Repositories\BaseRepository;

/**
 * Class QuestionOptionRepository
 * @package App\Repositories
 * @version April 25, 2021, 6:40 am UTC
*/

class QuestionOptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question_id',
        'option'
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
        return QuestionOption::class;
    }
}
