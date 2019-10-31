<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waitlist extends Model
{
     protected $table = 'waitlist';
     protected $primaryKey = 'w_id';
     public $timestamps = false;
}
