<?php

namespace App\Repositories;

use App\Models\CompetencyModels;
use App\Repositories\BaseRepository;

/**
 * Class CompetencyModelsRepository
 * @package App\Repositories
 * @version October 26, 2020, 5:23 am UTC
*/

class CompetencyModelsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'company_id',
        'competency_id'
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
        return CompetencyModels::class;
    }
}
