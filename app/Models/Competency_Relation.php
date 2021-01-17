<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Competency_Relation extends Model
{
    public $table = 'competency_relation';
    



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'competency_id' => 'integer',
        'competency_models_id' => 'integer'
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

    public function competency_model()
    {
        return $this->belongsTo(Competency_Model::class, 'competency_models_id');
    }

}
