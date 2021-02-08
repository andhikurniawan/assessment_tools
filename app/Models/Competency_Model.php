<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Competency_Model
 * @package App\Models
 * @version December 15, 2020, 2:10 am UTC
 *
 * @property string $name
 * @property string $description
 * @property integer $company_id
 * @property integer $competency_id
 */
class Competency_Model extends Model
{

    public $table = 'competency_models';
    



    public $fillable = [
        'name',
        'description',
        'company_id',
        'competency_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'company_id' => 'integer',
        'competency_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function competencies()
    {
        return $this->belongsToMany(Competency::class,'competency_relation',
            'competency_models_id','competency_id');
    }

  
    public function competencyRelation()
    {
        return $this->hasMany(Competency_Relation::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
