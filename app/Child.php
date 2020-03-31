<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
     protected $table = 'child';
     protected $primaryKey = 'c_id';
     public $timestamps = false;

      protected $fillable = [
     	'child_name', 'allergy_info', 'notes','birthdate','f_id'
     ];


     public function registration()
     {
     	return Registration::get()->where('c_id',$this->c_id);
     }

     public function user()
     {
          return User::find($this->f_id);
     }

     public function age()
     {
          return (new DateTime($this->birthdate))->diff(new DateTime())->y;
     }
}
