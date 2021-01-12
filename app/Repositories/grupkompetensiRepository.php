<?php

namespace App\Repositories;

use App\Models\grupkompetensi;
use App\Repositories\BaseRepository;

/**
 * Class grupkompetensiRepository
 * @package App\Repositories
 * @version December 10, 2020, 2:42 pm UTC
*/

class grupkompetensiRepository extends BaseRepository
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
        return grupkompetensi::class;
    }
}
