<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
     protected $table = 'session';
     protected $primaryKey = 's_id';
     public $timestamps = false;

     protected $fillable = [
     	'title', 'date', 'start_time', 'end_time','max_attendance', 'min_age', 'max_age'
     ];
}
