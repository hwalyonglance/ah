<?php

namespace App\Repositories;

use App\Models\Materi;
use App\Repositories\BaseRepository;

/**
 * Class MateriRepository
 * @package App\Repositories
 * @version April 3, 2021, 6:51 am UTC
*/

class MateriRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'role_id',
        'type',
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
        return Materi::class;
    }
}
