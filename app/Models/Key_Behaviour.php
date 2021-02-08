<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Key_Behaviour
 * @package App\Models
 * @version December 14, 2020, 11:34 am UTC
 *
 * @property string $level
 * @property string $description
 * @property integer $competency_id
 * @property string $indicator
 */
class Key_Behaviour extends Model
{

    public $table = 'key_behaviour';
    
    public static $levels = [
        '1' => 'Level 1',
        '2' => 'Level 2',
        '3' => 'Level 3',
        '4' => 'Level 4',
        '5' => 'Level 5',
    ];


    public $fillable = [
        'level',
        'description',
        'competency_id',
     
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'level' => 'integer',
        'description' => 'string',
        'competency_id' => 'integer',
       
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
