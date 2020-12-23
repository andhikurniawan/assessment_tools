<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use SoftDeletes;
    protected $table = 'training';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
