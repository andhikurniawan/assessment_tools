<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Assessment_Session
 * @package App\Models
 * @version October 22, 2020, 6:46 am UTC
 *
 * @property string $name
 * @property string $category
 * @property string $status
 * @property string $expired
 * @property string $start_date
 * @property string $end_date
 * @property integer $company_id
 * @property integer $competencygroup_id
 */
class Assessment_Session extends Model
{

    use SoftDeletes;
    public $table = 'assessment_session';
    
    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'category',
        'status',
        'expired',
        'start_date',
        'end_date',
        'company_id',
        'competencygroup_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'category' => 'string',
        'status' => 'string',
        'expired' => 'string',
        'start_date' => 'string',
        'end_date' => 'string',
        'company_id' => 'integer',
        'competencygroup_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function competencyModels()
    {
        return $this->belongsToMany('App\Models\CompetencyModels', 'assessment_relation', 'assessment_session_id', 'competency_models_id');
    }

    public function assignmentHeaders()
    {
        return $this->hasMany(\App\Models\AssignmentHeader::class);
    }
    
}
