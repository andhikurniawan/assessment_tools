<?php

namespace App\Repositories;

use App\Models\Competency_Model;
use App\Repositories\BaseRepository;

/**
 * Class Competency_ModelRepository
 * @package App\Repositories
 * @version December 15, 2020, 2:10 am UTC
*/

class Competency_ModelRepository extends BaseRepository
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
        return Competency_Model::class;
    }
}
