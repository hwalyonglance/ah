<?php

namespace App\Repositories;

use App\Models\Training;
use App\Repositories\BaseRepository;

/**
 * Class TrainingRepository
 * @package App\Repositories
 * @version April 3, 2021, 2:26 pm UTC
*/

class TrainingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'role_id',
        'gambar',
        'judul',
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
        return Training::class;
    }
}
