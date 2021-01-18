<?php

namespace App\Repositories;

use App\Models\perusahaan;
use App\Repositories\BaseRepository;

/**
 * Class perusahaanRepository
 * @package App\Repositories
 * @version December 11, 2020, 5:07 am UTC
*/

class perusahaanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address',
        'telp',
        'fax',
        'email',
        'contact_person',
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
        return perusahaan::class;
    }
}
