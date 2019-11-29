<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Family extends Model
{
     protected $table = 'family';
     protected $primaryKey = 'f_id';
     public $timestamps = false;

     protected $fillable = [
     	'first_name', 'last_name', 'phone', 'email','password', 'emerg_contact', 'emerg_phone','doctor','doc_phone','child_pickup','can_call_emerg','can_take_photos','custody_notes','iscustody'
     ];

     public function child()
     {
     	return Child::get()->where('f_id',$this->f_id);
     }

     public function user()
     {
     	return User::get()->where('id',$this->f_id);
     }

     public function registrations()
     {
          return DB::table('child')
                  ->join('registration','registration.c_id','child.c_id')
                  ->join('family','family.f_id','child.f_id')
                  ->join('session','session.s_id','registration.s_id')
                  ->where('family.f_id', $this->f_id)
                  ->select('child.*','session.*','registration.*')
                  ->get();
     }

}
