<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training_emp extends Model
{
    protected $table = 'training_emps';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
