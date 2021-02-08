<?php

namespace App\Repositories;

use App\Models\AssignmentHeader;
use App\Repositories\BaseRepository;

/**
 * Class AssignmentHeaderRepository
 * @package App\Repositories
 * @version November 2, 2019, 7:49 am UTC
*/

class AssignmentHeaderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'assessment_session_id',
        'run_counter',
        'run_date',
        'is_effective'
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
        return AssignmentHeader::class;
    }
}
