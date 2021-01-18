<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Competency
 * @package App\Models
 * @version December 14, 2020, 8:25 am UTC
 *
 * @property string $name
 * @property string $code
 * @property string $question
 * @property integer $competencygroup_id
 * @property string $type
 * @property integer $number_keybehaviour
 */
class Competency extends Model
{

    public $table = 'competency';
    



    public $fillable = [
        'name',
        'code',
        'question',
        'competency_group_id',
        'type',
        'description',
        'number_keybehaviour'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'code' => 'string',
        'question' => 'string',
        'competency_group_id' => 'integer',
        'type' => 'string',
        'description' => 'string',
        'number_keybehaviour' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function competencyGroup()
    {
        return $this->belongsTo(Competency_Group::class);
    }

    public function keyBehaviour()
    {
        return $this->hasMany(Key_Behaviour::class);
    }
   
    public function jobTarget()
    {
        return $this->hasMany(Job_Target::class);
    }
    
    public function competencyRelation()
    {
        return $this->hasMany(Competency_Relation::class);
    }
}