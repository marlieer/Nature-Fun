<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
     protected $table = 'registration';
     protected $primaryKey = 'r_id';
     public $timestamps = false;
}
