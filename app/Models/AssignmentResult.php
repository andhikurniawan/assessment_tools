<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AssignmentResult
 * @package App\Models
 * @version November 2, 2019, 7:26 am UTC
 *
 * @property integer user_id
 * @property integer job_target_id
 * @property integer header_id
 * @property integer team_id
 * @property float gap
 */
class AssignmentResult extends Model
{
    use SoftDeletes;

    public $table = 'assignment_results';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'job_target_id',
        'header_id',
        'team_id',
        'gap'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'employee_id' => 'string',
        'job_target_id' => 'integer',
        'jobcode' => 'string',
        'header_id' => 'integer',
        'team_id' => 'integer',
        'gap' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'numeric'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function jobTarget()
    {
        return $this->belongsTo(\App\Models\JobTargets::class, 'job_target_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function team()
    {
        return $this->belongsTo(\App\Models\Team::class, 'team_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function header()
    {
        return $this->belongsTo(\App\Models\AssignmentHeader::class,'header_id' );
    }
}
