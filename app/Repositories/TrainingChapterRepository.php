<?php

namespace App\Repositories;

use App\Models\TrainingChapter;
use App\Repositories\BaseRepository;

/**
 * Class TrainingChapterRepository
 * @package App\Repositories
 * @version April 3, 2021, 2:26 pm UTC
*/

class TrainingChapterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'training_id',
        'video',
        'keterangan'
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
        return TrainingChapter::class;
    }
}
