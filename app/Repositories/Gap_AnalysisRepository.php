<?php

namespace App\Repositories;

use App\Models\Gap_Analysis;
use App\Repositories\BaseRepository;

/**
 * Class Gap_AnalysisRepository
 * @package App\Repositories
 * @version January 12, 2021, 8:31 am UTC
*/

class Gap_AnalysisRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'gap',
        'is_match'
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
        return Gap_Analysis::class;
    }
}
