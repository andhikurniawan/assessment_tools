<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training_emp extends Model
{
    protected $table = 'training_emps';
    protected $guarded = []; // yang tidak bisa di isi (kebalikan diatas)

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function training()
    {
        return $this->belongsTo('App\Training', 'id_training');
    }
}
