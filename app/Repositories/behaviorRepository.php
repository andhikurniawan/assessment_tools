<?php

namespace App\Repositories;

use App\Models\behavior;
use App\Repositories\BaseRepository;

/**
 * Class behaviorRepository
 * @package App\Repositories
 * @version December 10, 2020, 3:10 pm UTC
*/

class behaviorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'level',
        'description',
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
        return behavior::class;
    }
}
