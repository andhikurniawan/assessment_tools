<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Gap_Analysis
 * @package App\Models
 * @version January 12, 2021, 8:31 am UTC
 *
 * @property string $gap
 * @property string $is_match
 */
class Gap_Analysis extends Model
{

    public $table = 'gap_analysis';
    



    public $fillable = [
        'gap',
        'is_match'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'gap' => 'string',
        'is_match' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
