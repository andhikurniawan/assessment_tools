<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Team
 * @package App\Models
 * @version January 12, 2021, 12:08 pm UTC
 *
 * @property string $name
 * @property integer $assessment_session_id
 */
class Team extends Model
{

    public $table = 'teams';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'name',
        'assessment_session_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'assessment_session_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'assessment_session_id' => 'nullable|integer'
    ];

    public function assessmentSession()
    {
        return $this->belongsTo(\App\Models\AssessmentSession::class, 'assessment_session_id');
    }

    public function jobTargets()
    {
        return $this->hasMany(\App\Models\JobTargets::class, 'team_id');
    }
}
