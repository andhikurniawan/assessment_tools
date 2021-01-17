<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Competency_Group
 * @package App\Models
 * @version December 14, 2020, 5:19 am UTC
 *
 * @property string $name
 * @property string $description
 */
class Competency_Group extends Model
{

    public $table = 'competency_group';
    



    public $fillable = [
        'name',
        'company_id',
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
        'company_id' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function competency()
    {
        return $this->hasMany(Competency::class);
    }

    
    
}
