<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use App\Models\JobTargets;
/**
 * Class JobRequirement
 * @package App\Models
 * @version January 12, 2021, 4:49 am UTC
 *
 * @property integer $job_target_id
 * @property integer $competency_id
 * @property integer $skill_level
 */
class JobRequirement extends Model
{

    public $table = 'job_requirement';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'job_target_id',
        'competency_id',
        'skill_level'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'job_target_id' => 'integer',
        'competency_id' => 'integer',
        'skill_level' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'job_target_id' => 'nullable|integer',
        'competency_id' => 'nullable|integer',
        'skill_level' => 'required|integer'
    ];

    public function jobTarget()
    {
        return $this->belongsTo(JobTargets::class, 'job_target_id');
    }

    public function Competency()
    {
        return $this->belongsTo(\App\Models\Competency::class, 'competency_id');
    }
}
