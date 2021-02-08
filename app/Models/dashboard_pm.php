<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class dashboard_pm
 * @package App\Models
 * @version January 21, 2021, 4:49 pm UTC
 *
 */
class dashboard_pm extends Model
{

    public $table = 'dashboard_pms';
    



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
