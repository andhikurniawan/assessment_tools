<?php

namespace App\Repositories;

use App\Models\kompetensi;
use App\Repositories\BaseRepository;

/**
 * Class kompetensiRepository
 * @package App\Repositories
 * @version December 10, 2020, 3:06 pm UTC
*/

class kompetensiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'code',
        'question',
        'type',
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
        return kompetensi::class;
    }
}
