<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Job_Target extends Model
{

    public $table = 'job_target';
    



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
        
    ];

    public function competency()
    {
        return $this->belongsTo(Competency::class, 'competency_id');
    }
   
    
}
