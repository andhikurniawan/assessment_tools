<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class JobTargets
 * @package App\Models
 * @version December 13, 2020, 7:41 am UTC
 *
 * @property \App\Models\AssessmentSession $assessmentSession
 * @property \Illuminate\Database\Eloquent\Collection $assignmentResults
 * @property \Illuminate\Database\Eloquent\Collection $jobRequirements
 * @property string $job_name
 * @property string $job_code
 * @property integer $number_position
 * @property integer $assessment_session_id
 * @property integer $team_id
 */
class JobTargets extends Model
{

    public $table = 'job_target';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'job_name',
        'job_code',
        'number_position',
        'assessment_session_id',
        'team_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'job_name' => 'string',
        'job_code' => 'string',
        'number_position' => 'integer',
        'assessment_session_id' => 'integer',
        'team_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'job_name' => 'required|string|max:256',
        'job_code' => 'required|string|max:32',
        'number_position' => 'required|integer',
        'assessment_session_id' => 'nullable|integer',
        'team_id' => 'required|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function assessmentSession()
    {
        return $this->belongsTo(\App\Models\AssessmentSession::class, 'assessment_session_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function assignmentResults()
    {
        return $this->hasMany(\App\Models\AssignmentResult::class, 'job_target_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function jobRequirements()
    {
        return $this->hasMany(\App\Models\JobRequirement::class, 'job_target_id');
    }

    public function jobTargets()
    {
        return $this->hasMany(\App\Models\JobRequirement::class, 'job_target_id');
    }

    public function team()
    {
        return $this->belongsTo(\App\Models\Team::class, 'team_id');
    }
}
