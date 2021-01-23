<?php

namespace App\Repositories;

use App\Models\dashboard_pm;
use App\Repositories\BaseRepository;

/**
 * Class dashboard_pmRepository
 * @package App\Repositories
 * @version January 21, 2021, 4:49 pm UTC
*/

class dashboard_pmRepository extends BaseRepository
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
        return dashboard_pm::class;
    }
}
