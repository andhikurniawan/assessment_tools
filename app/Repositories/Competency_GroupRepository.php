<?php

namespace App\Repositories;

use App\Models\Competency_Group;
use App\Repositories\BaseRepository;

/**
 * Class Competency_GroupRepository
 * @package App\Repositories
 * @version December 14, 2020, 5:19 am UTC
*/

class Competency_GroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
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
        return Competency_Group::class;
    }
}
