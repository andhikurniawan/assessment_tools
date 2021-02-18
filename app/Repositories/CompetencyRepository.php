<?php

namespace App\Repositories;

use App\Models\Competency;
use App\Repositories\BaseRepository;

/**
 * Class CompetencyRepository
 * @package App\Repositories
 * @version December 14, 2020, 8:25 am UTC
*/

class CompetencyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'code',
        'question',
        'competencygroup_id',
        'status',
        'type',
        'number_keybehaviour'
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
        return Competency::class;
    }
}
