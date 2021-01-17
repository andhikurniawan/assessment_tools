<?php

namespace App\Repositories;

use App\Models\Key_Behaviour;
use App\Repositories\BaseRepository;

/**
 * Class Key_BehaviourRepository
 * @package App\Repositories
 * @version December 14, 2020, 11:34 am UTC
*/

class Key_BehaviourRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'level',
        'description',
        'competency_id',
        'indicator'
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
        return Key_Behaviour::class;
    }
}
