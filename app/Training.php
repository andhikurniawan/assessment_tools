<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use SoftDeletes;
    protected $table = 'training';
    protected $guarded = []; // yang tidak bisa di isi (kebalikan diatas)

}
