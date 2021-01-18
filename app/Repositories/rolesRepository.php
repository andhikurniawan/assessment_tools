<?php

namespace App\Repositories;

use App\Models\roles;
use App\Repositories\BaseRepository;

/**
 * Class rolesRepository
 * @package App\Repositories
 * @version December 14, 2020, 6:32 am UTC
*/

class rolesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'is_admin',
        'is_superadmin'
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
        return roles::class;
    }
}
