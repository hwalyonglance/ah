<?php

namespace App\Repositories;

use App\Models\CourseChapter;
use App\Repositories\BaseRepository;

/**
 * Class CourseChapterRepository
 * @package App\Repositories
 * @version April 27, 2021, 1:34 pm UTC
*/

class CourseChapterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'course_id',
        'judul',
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
        return CourseChapter::class;
    }
}
