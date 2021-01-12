<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class perusahaan
 * @package App\Models
 * @version December 11, 2020, 5:07 am UTC
 *
 * @property string $name
 * @property string $address
 * @property string $telp
 * @property string $fax
 * @property string $email
 * @property string $contact_person
 * @property string $description
 */
class Company extends Model
{

    public $table = 'company';
    



    public $fillable = [
        'name',
        'address',
        'telp',
        'fax',
        'email',
        'contact_person',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'address' => 'string',
        'telp' => 'string',
        'fax' => 'string',
        'email' => 'string',
        'contact_person' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function competencyGroups()
    {
        return $this->hasMany(Competency_Group::class);
    }
}
