<?php

namespace App\Repositories;

use App\Models\modelkompetensi;
use App\Repositories\BaseRepository;

/**
 * Class modelkompetensiRepository
 * @package App\Repositories
 * @version December 10, 2020, 3:08 pm UTC
*/

class modelkompetensiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return modelkompetensi::class;
    }
}
