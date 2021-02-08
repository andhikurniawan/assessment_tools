<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CompetencyModels
 * @package App\Models
 * @version October 26, 2020, 5:23 am UTC
 *
 * @property string $name
 * @property string $description
 * @property integer $company_id
 * @property integer $competency_id
 */
class CompetencyModels extends Model
{

    public $table = 'competency_models';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




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
    	return $this->belongsToMany('App\Models\Competency', 'competency_relation', 'competency_models_id', 'competency_id');
    }
}
