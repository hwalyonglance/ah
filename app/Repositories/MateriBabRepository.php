<?php

namespace App\Repositories;

use App\Models\MateriBab;
use App\Repositories\BaseRepository;

/**
 * Class MateriBabRepository
 * @package App\Repositories
 * @version April 3, 2021, 2:26 pm UTC
*/

class MateriBabRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'materi_id',
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
        return MateriBab::class;
    }
}
