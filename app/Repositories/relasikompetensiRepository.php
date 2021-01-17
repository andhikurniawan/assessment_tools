<?php

namespace App\Repositories;

use App\Models\relasikompetensi;
use App\Repositories\BaseRepository;

/**
 * Class relasikompetensiRepository
 * @package App\Repositories
 * @version December 12, 2020, 12:27 pm UTC
*/

class relasikompetensiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return relasikompetensi::class;
    }
}
