<?php

namespace App\Repositories;

use App\Models\AssignmentResult;
use App\Repositories\BaseRepository;

/**
 * Class AssignmentResultRepository
 * @package App\Repositories
 * @version November 2, 2019, 7:26 am UTC
*/

class AssignmentResultRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'employee_id',
        'job_target_id',
        'jobcode',
        'header_id',
        'team_id',
        'gap'
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
        return AssignmentResult::class;
    }
}
