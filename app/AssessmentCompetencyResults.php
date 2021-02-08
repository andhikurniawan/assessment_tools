<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentCompetencyResults extends Model
{
    // use SoftDeletes;

    public $table = 'assessment_competency_result';
    
    //public $timestamps = true;


    // protected $dates = ['deleted_at'];


    public $fillable = [
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'session_id' => 'integer',
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function assessmentSession()
    {
        return $this->belongsTo(\App\Models\AssessmentSession::class, 'session_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo('App\User', 'userid_assessee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function competency()
    {
        return $this->belongsTo('App\Models\Competency', 'competency_id');
    }
}
