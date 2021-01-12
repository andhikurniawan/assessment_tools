<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use SoftDeletes;
    protected $table = 'training';
    protected $guarded = []; // yang tidak bisa di isi (kebalikan diatas)
   
    public function training_emps()
    {
        return $this->hasMany(Training_emp::class);
    }

    public function training_competencies()
    {
        return $this->hasMany(Training_competencies::class, 'id_training');
    }
}
