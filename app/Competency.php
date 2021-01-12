<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
    protected $table = 'competency';
    
    public function training_competencies()
    {
        return $this->hasMany(Training_competencies::class, 'id_competency', 'id');
    }
}
