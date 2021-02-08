<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AssignmentHeader
 * @package App\Models
 * @version November 2, 2019, 7:49 am UTC
 *
 * @property integer assessment_session_id
 * @property integer run_counter
 * @property string|\Carbon\Carbon run_date
 * @property integer is_effective
 */
class AssignmentHeader extends Model
{
    use SoftDeletes;

    public $table = 'assignment_headers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'assessment_session_id',
        'run_counter',
        'run_date',
        'is_effective'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'assessment_session_id' => 'integer',
        'run_counter' => 'integer',
        'run_date' => 'datetime',
        'is_effective' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'run_counter' => 'numeric',
        'is_effective' => 'numeric'
    ];

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function details()
    {
        return $this->hasMany(\App\Models\AssignmentResult::class, 'header_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function assessmentSession()
    {
        return $this->belongsTo(\App\Models\Assessment_Session::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function assignmentResults()
    {
        return $this->hasMany(\App\Models\AssignmentResult::class,'header_id');
    }

    public function assessmentName()
    {
        if (empty($this->assessmentSession)) return '-';
        return $this->assessmentSession->name;
    }
}
