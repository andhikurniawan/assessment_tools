<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class behavior
 * @package App\Models
 * @version December 10, 2020, 3:10 pm UTC
 *
 * @property string $level
 * @property string $description
 * @property string $indicator
 */
class behavior extends Model
{

    public $table = 'behaviors';
    



    public $fillable = [
        'level',
        'description',
        'indicator'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'level' => 'string',
        'description' => 'string',
        'indicator' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function kompetensi() 
    {
    return $this->belongsTo(kompetensi::class);
    }

    
}
