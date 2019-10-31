<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
     protected $table = 'child';
     protected $primaryKey = 'c_id';
     public $timestamps = false;
}
