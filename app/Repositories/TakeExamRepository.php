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

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($exam_id, $columns = ['*'], $with = [])
    {
        $query = $this->model->newQuery();

        return $query
            ->select($columns)
            ->with($with)
            ->firstWhere('exam_id', $exam_id);
    }
}
