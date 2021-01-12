<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class modelkompetensi
 * @package App\Models
 * @version December 10, 2020, 3:08 pm UTC
 *
 * @property string $name
 * @property string $description
 */
class modelkompetensi extends Model
{

    public $table = 'modelkompetensis';
    



    public $fillable = [
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
