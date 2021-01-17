<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class relasikompetensi
 * @package App\Models
 * @version December 12, 2020, 12:27 pm UTC
 *
 */
class relasikompetensi extends Model
{

    public $table = 'relasikompetensis';
    



    public $fillable = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
