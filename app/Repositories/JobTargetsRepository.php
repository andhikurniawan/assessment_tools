<?php

namespace App\Repositories;

use App\Models\JobTargets;
use App\Repositories\BaseRepository;

/**
 * Class JobTargetsRepository
 * @package App\Repositories
 * @version December 13, 2020, 7:41 am UTC
*/

class JobTargetsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'job_name',
        'job_code',
        'number_position',
        'assessment_session_id',
        'team_id'
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
        return JobTargets::class;
    }
}
