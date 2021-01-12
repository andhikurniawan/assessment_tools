<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training_competencies extends Model
{
    protected $table = 'training_competencies';

    public function training()
    {
        return $this->belongsTo('App\Training', 'id_training');
    }

    public function competency()
    {
        return $this->belongsTo('App\Competency','id_competency', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
