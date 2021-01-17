<?php

namespace App\Repositories;

use App\Models\Assessment_Session;
use App\Repositories\BaseRepository;

/**
 * Class Assessment_SessionRepository
 * @package App\Repositories
 * @version October 22, 2020, 6:46 am UTC
*/

class Assessment_SessionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'category',
        'status',
        'expired',
        'start_date',
        'end_date',
        'company_id',
        'competencygroup_id'
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
        return Assessment_Session::class;
    }
}
