<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    protected $table = "company";
    protected $guarded = []; // yang tidak bisa di isi (kebalikan diatas)

}
