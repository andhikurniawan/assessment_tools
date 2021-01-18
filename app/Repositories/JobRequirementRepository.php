<?php

namespace App\Repositories;

use App\Models\JobRequirement;
use App\Repositories\BaseRepository;

/**
 * Class JobRequirementRepository
 * @package App\Repositories
 * @version January 12, 2021, 4:49 am UTC
*/

class JobRequirementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'job_target_id',
        'competency_id',
        'skill_level'
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
        return JobRequirement::class;
    }
}
