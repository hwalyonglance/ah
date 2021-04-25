<?php

namespace App\Repositories;

use App\Models\TakeTraining;
use App\Repositories\BaseRepository;

/**
 * Class TrainingRepository
 * @package App\Repositories
 * @version April 3, 2021, 2:26 pm UTC
*/

class TakeTrainingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'training_id',
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
        return TakeTraining::class;
    }
}
