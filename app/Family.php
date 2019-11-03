<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
     protected $table = 'family';
     protected $primaryKey = 'f_id';
     public $timestamps = false;

     protected $fillable = [
     	'first_name', 'last_name', 'phone', 'email','password', 'emerg_contact', 'emerg_phone','doctor','doc_phone','child_pickup','can_call_emerg','can_take_photos','custody_notes','iscustody'
     ];
}
