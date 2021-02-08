<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Company
 * @package App\Models
 * @version November 20, 2020, 5:07 am UTC
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
    use SoftDeletes;

    public $table = 'company';
    
    protected $dates = ['deleted_at'];


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
        
        'name' => 'nullable|string|max:128',
        'address' => 'nullable|string',
        'telp' => 'nullable|string|max:32',
        'fax' => 'nullable|string|max:255',
        'email' => 'nullable|string|max:64',
        'contact_person' => 'nullable|string|max:64',
        'description' => 'nullable|string'
    ];


    public function competencyGroups()
    {
        return $this->hasMany(Competency_Group::class);
    }

    public function competencyModels()
    {
        return $this->hasMany(Competency_Model::class);
    }
        
    
}
